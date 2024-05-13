<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\AffiliateWithdraw;
use App\Models\Currency;
use App\Models\Exchange;
use App\Models\Merchant;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class Controller_Api extends Controller{
    
    public function currencies() {
        $currencies = Cache::remember("currencies-admin", 60, function(){
            return Currency::get();
        });

        $response = ["results" => []];
        foreach($currencies as $currency){
            $response['results'][] = [
                "id" => $currency->id,
                "text" => $currency->id.": (".$currency->name.") ".@$currency->data['titles'][mb_strtolower(app()->getLocale())]
            ];
        }

        return json_encode($response);
    }

    public function merchants() {
        $currencies = Cache::remember("merchants-admin", 60, function(){
            return Merchant::select("name as text", "id")->get()->pluck("id", "text")->toArray();
        });

        $response = ["results" => []];
        foreach($currencies as $merchant => $id){
            $response['results'][] = [
                "id" => $id,
                "text" => "(".$id.") ".$merchant
            ];
        }

        return json_encode($response);
    }

    public function clear_cache() {
        dispatch(function () {
            Artisan::call('cache:clear');
            Artisan::call('app:cache-directions');
        });
        return redirect(route("adminDashboard"));
    }

    public function sitemap_generate() {
        dispatch(function () {
            Artisan::call('app:fill-sitemap');
        });
        return redirect(route("adminDashboard"));
    }

    public function languages_update() {
        dispatch(function () {
            Artisan::call('app:sync-languages');
        });
        return redirect(route("adminDashboard"));
    }

    public function clear_directions_seo_titles() {
        $directions = $this->getCacheDirections();
        foreach($directions as $direction) {
            if(!isset($direction->data['seo']))
                continue;
            if(!isset($direction->data['seo']['titles']))
                continue;
            if(!is_array($direction->data['seo']['titles']))
                continue;
            $data = $direction->data;
            foreach($data['seo']['titles'] as $key => $value) {
                if($key == "ru")
                    continue;
                $data['seo']['titles'][$key] = "";
            }
            $direction->data = $data;
            $direction->save();
        }
        return redirect(route("adminDashboard"));
    }

    public function dasboard_registers() {
        return Cache::remember("admin-dashboard-chart-registers", 60, function(){
            $endDate = Carbon::now();
            $dates = [];
            for ($i = 0; $i < 14; $i++) {
                $dates[] = $endDate->format('d.m.Y');
                $endDate->subDay();
            }
            $dates = array_reverse($dates);

            $usersRegistered = [];
            foreach ($dates as $val) {
                $date = Carbon::createFromFormat('d.m.Y', $val);
                $usersRegistered[] = User::whereDate('created_at', $date)->count();
            }
            
            $totalUserCount = User::count();
            return [
                'dates' => $dates,
                'usersRegistered' => $usersRegistered,
                'totalUserCount' => $totalUserCount,
                'totalUserCount14days' => array_sum($usersRegistered),
            ];
        });
    }

    public function dasboard_exchanges() {
        return $this->dasboard_exchanges_get();
    }

    public function dasboard_exchanges_complete() {
        return $this->dasboard_exchanges_get(true);
    }

    public function dasboard_exchanges_get($completed = false) {
        return Cache::remember("admin-dashboard-chart-excahgnes-".($completed ? "true" : "false"), 60, function() use($completed){
            $endDate = Carbon::now();
            $dates = [];
            for ($i = 0; $i < 14; $i++) {
                $dates[] = $endDate->format('d.m.Y');
                $endDate->subDay();
            }
            $dates = array_reverse($dates);

            $exchanges = [];
            foreach ($dates as $val) {
                $date = Carbon::createFromFormat('d.m.Y', $val);
                $count = Exchange::whereDate('created_at', $date);
                if($completed){
                    $count = $count->where("status", 5);
                }
                $exchanges[] = $count->count();
            }
            
            $totalExchangesCount = 0;
            if($completed){
                $totalExchangesCount = Exchange::where("status", 5)->count();
            }else{
                $totalExchangesCount = Exchange::count();
            }
            return [
                'dates' => $dates,
                'exchanges' => $exchanges,
                'totalExchangesCount' => $totalExchangesCount,
                'totalExchangesCount14days' => array_sum($exchanges),
            ];
        });
    }

    public function dasboard_revenue() {
        return Cache::remember("admin-dashboard-chart-revenue", 60, function(){
            $endDate = Carbon::now();
            $dates = [];
            for ($i = 0; $i < 14; $i++) {
                $dates[] = $endDate->format('d.m.Y');
                $endDate->subDay();
            }
            $dates = array_reverse($dates);

            $statistics = [];
            foreach ($dates as $val) {
                $date = Carbon::createFromFormat('d.m.Y', $val)->startOfDay()->timestamp;
                $stats = Statistic::with("getCurrency")->where('created_at', $date)->get();
                foreach($stats as $val2){
                    if(!isset($statistics[$val2->getCurrency->name])){
                        $statistics[$val2->getCurrency->name] = [];
                    }
                    $statistics[$val2->getCurrency->name][$val] = round($val2->amount_usd, 2);
                }
            }
            
            return [
                'dates' => $dates,
                'statistics' => $statistics,
            ];
        });
    }

    public function dasboard_popular_directions() {
        return Cache::remember("admin-dashboard-chart-popular-directions", 60, function(){
            $startOfMonth = Carbon::now()->subDays(31);

            $exchanges = Exchange::with("currencyFrom")->where("status", 5)->where('created_at', ">=", $startOfMonth)
                ->groupBy('currency_from')
                ->selectRaw('currency_from, COUNT(*) as count')
                ->get();

            $currencies = [];
            $counts = [];
            foreach($exchanges as $val){
                $currencies[] = $val->currencyFrom->name;
                $counts[] = $val->count;
            }
            
            return [
                'currencies' => $currencies,
                'counts' => $counts,
            ];
        });
    }

    public function dasboard_affiliate_withdraws() {
        return Cache::remember("admin-dashboard-affiliate-withdraws", 60, function(){
            $affiliates = AffiliateWithdraw::with("getUser")->with("getCurrency")->where("status", 0)->orderBy("id", "DESC")->limit(5)->get();
            
            return [
                'data' => $affiliates->toArray(),
            ];
        });
    }

    public function dasboard_fulltime_statistic() {
        return Cache::remember("admin-dashboard-fulltime-statistic", 600, function(){
            $statistics = Statistic::with("getCurrency")
                ->groupBy('currency')
                ->selectRaw('currency, SUM(amount) as amount, SUM(amount_usd) as amount_usd')
                ->get()->toArray();

            foreach($statistics as $key => $value){
                $statistics[$key]['amount'] = round($statistics[$key]['amount'], $statistics[$key]['get_currency']['units']);
                $statistics[$key]['amount_usd'] = round($statistics[$key]['amount_usd'], 2);
            }
            
            return [
                'data' => $statistics,
            ];
        });
    }

    public function get_users(Request $request){
        $request->validate([
            "search" => "required|string|max:255"
        ]);

        $search = mb_strtolower($request->search);
        $users = User::whereRaw('lower(email) like (?)', ["%{$search}%"]);
        $users = $users->orWhereRaw('lower(telegram) like (?)', ["%{$search}%"]);
        $users = $users->limit(20)->get();
        $response = [];
        foreach($users as $user){
            $response[] = [
                "text" => $user->id.": ".$user->getUserCredentials(),
                "id" => $user->id
            ];
        }

        return $response;
    }

    public function dasboard_affiliate() {
        return Cache::remember("admin-dashboard-chart-affiliate", 60, function(){
            $endDate = Carbon::now();
            $dates = [];
            for ($i = 0; $i < 14; $i++) {
                $dates[] = $endDate->format('d.m.Y');
                $endDate->subDay();
            }
            $dates = array_reverse($dates);

            $statistics = [
                "without" => [],
                "with" => [],
            ];
            foreach ($dates as $val) {
                $date = Carbon::createFromFormat('d.m.Y', $val)->startOfDay();
                $date2 = Carbon::createFromFormat('d.m.Y', $val)->addDay(1)->startOfDay();
                $exchanges = Exchange::with("getAffiliateExchange")
                    ->where('created_at', ">=", $date)
                    ->where("created_at", "<=", $date2)
                    ->where('status', 5)
                    ->get();
                foreach($exchanges as $item){
                    $key = "without";
                    if($item->getAffiliateExchange){
                        $key = "with";
                    }

                    if(!isset($statistics[$key][$val])){
                        $statistics[$key][$val] = 0;
                    }
                    $statistics[$key][$val]++;
                }
            }
            
            return [
                'dates' => $dates,
                'statistics' => $statistics,
            ];
        });
    }
}
