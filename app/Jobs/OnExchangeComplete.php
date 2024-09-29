<?php

namespace App\Jobs;

use App\Http\Traits\Models\HasAffiliate;
use App\Http\Traits\Models\HasUtm;
use App\Mail\ExchangeComplete;
use App\Models\AffiliateBalance;
use App\Models\AffiliateExchange;
use App\Models\Currency;
use App\Models\Exchange;
use App\Models\Statistic;
use App\Models\StatisticCompleteExchange;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OnExchangeComplete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HasAffiliate, HasUtm;

    private $exchange_id;
    private $exchange;
    private $user;

    public function __construct($exchange_id){
        $this->exchange_id = $exchange_id;
    }

    public function handle(): void{
        $this->exchange = Exchange::where("id", $this->exchange_id)->first();
        if(!$this->exchange) {
            sendTelegramNotification("СВЕРХ СТРАННАЯ ОШИБКА, ОБРАТИТЕСЬ К РАЗРАБОТЧИКУ\nexchange_id: ".$this->exchange_id."\nОшибка при OnExchangeComplete");
            return;
        }

        $check = StatisticCompleteExchange::where("exchange_id", $this->exchange->id)->first();
        if($check){
            return;
        }
        unset($check);



        // проверяем и сохраняем utm
        if(isset($this->exchange->data['request_data']['utm_id'])
            && is_numeric($this->exchange->data['request_data']['utm_id'])){
            $this->setUtmExchangeAsCompleted($this->exchange, $this->exchange->data['request_data']['utm_id']);
        }

        // сохраняем статистику
        $stat_complete_exchange = new StatisticCompleteExchange; 
        $stat_complete_exchange->exchange_id = $this->exchange->id;
        $stat_complete_exchange->save();

        $today_date = strtotime(date('Y-m-d 00:00:00'));
        $stat_today_from = Statistic::where("currency", $this->exchange->currency_from)->where("created_at", $today_date)->first();
        if(!$stat_today_from){
            $stat_today_from = new Statistic;
            $stat_today_from->currency = $this->exchange->currency_from;
            $stat_today_from->created_at = $today_date;
            $stat_today_from->save();
        }
        $stat_today_from->increment("amount", $this->exchange->data['amount_data']['amount_send']);
        $stat_today_from->increment("amount_usd", $this->exchange->data['amount_data']['amount_send_usd']);

        $stat_today_to = Statistic::where("currency", $this->exchange->currency_to)->where("created_at", $today_date)->first();
        if(!$stat_today_to){
            $stat_today_to = new Statistic;
            $stat_today_to->currency = $this->exchange->currency_to;
            $stat_today_to->created_at = $today_date;
            $stat_today_to->save();
        }
        $stat_today_to->decrement("amount", $this->exchange->data['amount_data']['amount_receive']);
        $stat_today_to->decrement("amount_usd", $this->exchange->data['amount_data']['amount_receive_usd']);

        $this->user = User::where("id", $this->exchange->user_id)->first();
        if(!$this->user) {
            sendTelegramNotification("СВЕРХ СТРАННАЯ ОШИБКА, ОБРАТИТЕСЬ К РАЗРАБОТЧИКУ\nexchange_id: ".$this->exchange_id."\nuser_id:".$this->exchange->user_id."\nОшибка при OnExchangeComplete");
            return;
        }

        if($this->user->email[0] != "@")
            Mail::to($this->user->email)->send(new ExchangeComplete($this->user->id, $this->user->email, $this->exchange));

        // подбираем данные по человеку
        $currentTime = Carbon::now();
        $needUpdateExchange = false;
        if($currentTime->diffInSeconds($this->user->created_at) < 86400){
            $this->exchange->is_new_client = true;
            $needUpdateExchange = true;
        }

        if($this->user->getCountExchanges() <= 1){
            $this->exchange->is_first_completed = true;
            $needUpdateExchange = true;
        }

        if($needUpdateExchange){
            $this->exchange->save();
        }

        $aff_user = $this->getAffiliatedUser($this->exchange->user_id);
        if(!$aff_user || !$aff_user->campaign || !$aff_user->campaign->status){
            return;
        }

        $affAvailCurrencies = $this->getAffilateCurrencies();
        if(count($affAvailCurrencies) > 0 && !in_array($this->exchange->currency_from, $affAvailCurrencies)){
            return;
        }

        $aff_full_amount = $this->exchange->data['amount_data']['amount_send'];
        $aff_currency =  $this->exchange->currency_from;
        $affUsdtOnly = $this->getAffilateUsdtOnly();
        if($affUsdtOnly == 1){
            $aff_full_amount = $this->exchange->data['amount_data']['amount_send_usd'];
            $aff_currency = Currency::where("name", "USDTTRC20")->first()->id;
        }

        $aff_balance = AffiliateBalance::where("user_id", $aff_user->campaign->user_id)->where("currency", $aff_currency)->first();
        if(!$aff_balance){
            $aff_balance = new AffiliateBalance;
            $aff_balance->user_id = $aff_user->campaign->user_id;
            $aff_balance->currency = $aff_currency;
            $aff_balance->save();
        }
        
        $aff_percent = $this->getAffilatePercent();
        $earned_amount = $aff_full_amount / 100 * $aff_percent;
        $aff_balance->increment("balance", $earned_amount);

        $aff_exchange = new AffiliateExchange;
        $aff_exchange->currency = $aff_currency;
        $aff_exchange->amount = $aff_full_amount;
        $aff_exchange->amount_earned = $earned_amount;
        $aff_exchange->exchange_id = $this->exchange->id;
        $aff_exchange->user_credential = $this->user->email;
        $aff_exchange->user_id = $aff_user->campaign->user_id;
        $aff_exchange->campaign_id = $aff_user->campaign->id;
        $aff_exchange->save();

        $aff_user->campaign->increment("profitable_transactions", 1);
    }
}
