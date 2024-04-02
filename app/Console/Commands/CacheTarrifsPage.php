<?php

namespace App\Console\Commands;

use App\Http\Traits\Models\HasCache;
use Illuminate\Console\Command;

class CacheTarrifsPage extends Command
{
    use HasCache;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-tarrifs-page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tariffs = $this->getCacheExportJson();
        \Illuminate\Support\Facades\Cache::forever("comcash-view-tariffs", $this->generateHtml($tariffs));
    }

    public function generateHtml($tariffs) {
        if(!isset($tariffs['currencies']) ||
            !isset($tariffs['currencies']['list']) ||
            !is_array($tariffs['currencies']['list']) ||
            !isset($tariffs['exchange']) ||
            !is_array($tariffs['exchange']))
            return "";

        $html = '<div class="tariffs__list">';
        $count = 0;
        foreach($tariffs['currencies']['list'] as $key => $value){
            $currency = $this->getCachedCurrencyByName($value);
            if(!$currency || count($currency) == 0){
                continue;
            }
            $currency = $currency[0];
            $next_html = "";
            foreach($tariffs['currencies']['list'] as $key2 => $value2){
                if($value == $value2){
                    continue;
                }
                $currency2 = $this->getCachedCurrencyByName($value2);
                if(!$currency2 || count($currency2) == 0){
                    continue;
                }
                $currency2 = $currency2[0];

                $direction = $this->getDirectionByCurrencyPair($currency, $currency2);
                if(!$direction){
                    continue;
                }

                $next_html .= '<a class="tariffs__list-row" href="'.route("exchgangePage", ["ru", $currency->name, $currency2->name]).'">';
                $rate = $this->estimateGetRate($currency->name, $currency2->name);
                $type = 1;
                if($rate < 0.01){
                    $rate = $this->estimateGetRate($currency2->name, $currency->name);
                    $type = 2;
                }

                
                if($type == 1){
                    $next_html .= '<div class="tariffs__list-col">';
                    if($count == 0){
                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                    }
                    $next_html .= '<p class="tariffs__list-agent">';
                    $next_html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                    $next_html .= '<span>'.$currency->getTitle().'</span>';
                    $next_html .= '</p>';
                    $next_html .= '<p class="tariffs__list-currency">'.$this->convertCurrencyName($currency->name).'</p>';
                    $next_html .= '<p class="tariffs__list-value">1</p>';
                    $next_html .= '</div>';
                    $next_html .= '<div class="tariffs__list-col">';
                    if($count == 0){
                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                    }
                    $next_html .= '<p class="tariffs__list-agent">';
                    $next_html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                    $next_html .= '<span>'.$currency2->getTitle().'</span>';
                    $next_html .= '</p>';
                    $next_html .= '<p class="tariffs__list-currency">'.$this->convertCurrencyName($currency2->name).'</p>';
                    $next_html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                    $next_html .= '</div>';
                }else{
                    $next_html .= '<div class="tariffs__list-col">';
                    if($count == 0){
                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                    }
                    $next_html .= '<p class="tariffs__list-agent">';
                    $next_html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                    $next_html .= '<span>'.$currency->getTitle().'</span>';
                    $next_html .= '</p>';
                    $next_html .= '<p class="tariffs__list-currency">'.$this->convertCurrencyName($currency->name).'</p>';
                    $next_html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                    $next_html .= '</div>';
                    $next_html .= '<div class="tariffs__list-col">';
                    if($count == 0){
                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                    }
                    $next_html .= '<p class="tariffs__list-agent">';
                    $next_html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                    $next_html .= '<span>'.$currency2->getTitle().'</span>';
                    $next_html .= '</p>';
                    $next_html .= '<p class="tariffs__list-currency">'.$this->convertCurrencyName($currency2->name).'</p>';
                    $next_html .= '<p class="tariffs__list-value">1</p>';
                    $next_html .= '</div>';
                }




                $count++;
                $next_html .= '</a>';
            }
            if($next_html != ""){
                $html .= '<p class="tariffs__list-title">'.$currency->getTitle().'</p>';
                $html .= $next_html;
            }
            
        }

        $html .= '</div>';
        return $html;
    }
}
