<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use App\Models\Merchant;
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
        Artisan::call('cache:clear');
        return redirect()->back();
    }

    public function sitemap_generate() {
        dispatch(function () {
            Artisan::call('app:fill-sitemap');
        })->onQueue('fill-sitemap-queue');
        return redirect()->back();
    }
}
