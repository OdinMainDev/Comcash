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

            $html = '<div class="flex flex-col mb-6 w-full">';
            foreach ($tariffs['currencies']['list'] as $key => $value) {
                $currency = $this->getCachedCurrencyByName($value);
                if (!$currency || count($currency) == 0) {
                    continue;
                }
                $currency = $currency[0];
                $rows_html = "";
            
                foreach ($tariffs['currencies']['list'] as $key2 => $value2) {
                    if ($value == $value2) {
                        continue;
                    }
            
                    $currency2 = $this->getCachedCurrencyByName($value2);
                    if (!$currency2 || count($currency2) == 0) {
                        continue;
                    }
                    $currency2 = $currency2[0];
            
                    $direction = $this->getDirectionByCurrencyPair($currency, $currency2);
                    if (!$direction) {
                        continue;
                    }
            
                    $rate = $this->estimateGetRate($currency->name, $currency2->name, $direction->profit_percent);
                    $type = 1;
                    if ($rate < 0.01) {
                        $rate = $this->estimateGetRate($currency2->name, $currency->name, $direction->profit_percent);
                        $type = 2;
                    }
            
                    if ($type == 1) {
                        $sellCurrency = $currency;
                        $sellCode = $this->convertCurrencyName($currency->name);
                        $sellValue = 1;
            
                        $buyCurrency = $currency2;
                        $buyCode = $this->convertCurrencyName($currency2->name);
                        $buyValue = $rate;
                    } else {
                        $sellCurrency = $currency2;
                        $sellCode = $this->convertCurrencyName($currency2->name);
                        $sellValue = 1;
            
                        $buyCurrency = $currency;
                        $buyCode = $this->convertCurrencyName($currency->name);
                        $buyValue = $rate;
                    }
            
                    // Формируем строку
                    $rows_html .= '<tr class="h-[24px]">'
                        . '<td class="py-[10px] max-w-[90px]">'
                            . '<div class="flex items-center gap-[8px] max-w-[90px]">'
                                . '<div class="w-6 h-6 shrink-0">'
                                    . '<img src="' . $sellCurrency->image . '" alt="Comcash - ' . $sellCurrency->getTitle() . '">'
                                . '</div>'
                                . '<span class="text-white text-sm">' . $sellCurrency->getTitle() . '</span>'
                            . '</div>'
                        . '</td>'
                        . '<td class="pr-2">'
                            . '<div class="bg-white/5 rounded-full px-3 py-1 text-center text-xs">' . $sellCode . '</div>'
                        . '</td>'
                        . '<td ><div class="text-white text-sm">' . $sellValue . '</div></td>'
                        . '<td class="text-center opacity-15 min-w-[36px]">'
                            . '<svg class="inline-block" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">'
                            . '<path d="M10.8225 14.115C10.68 14.115 10.5375 14.0625 10.425 13.95C10.2075 13.7325 10.2075 13.3725 10.425 13.155L14.58 9L10.425 4.845C10.2075 4.6275 10.2075 4.2675 10.425 4.05C10.6425 3.8325 11.0025 3.8325 11.22 4.05L15.7725 8.6025C15.99 8.82 15.99 9.18 15.7725 9.3975L11.22 13.95C11.1075 14.0625 10.965 14.115 10.8225 14.115Z" fill="white"></path>'
                            . '<path d="M15.2475 9.5625H2.625C2.3175 9.5625 2.0625 9.3075 2.0625 9C2.0625 8.6925 2.3175 8.4375 2.625 8.4375H15.2475C15.555 8.4375 15.81 8.6925 15.81 9C15.81 9.3075 15.555 9.5625 15.2475 9.5625Z" fill="white"></path>'
                            . '</svg>'
                        . '</td>'
                        . '<td class="py-[10px]">'
                            . '<div class="flex items-center gap-[8px] max-w-[90px]">'
                                . '<div class="w-6 h-6 shrink-0">'
                                    . '<img src="' . $buyCurrency->image . '" alt="Comcash - ' . $buyCurrency->getTitle() . '">'
                                . '</div>'
                                . '<span class="text-white text-sm">' . $buyCurrency->getTitle() . '</span>'
                            . '</div>'
                        . '</td>'
                        . '<td class="pl-0">'
                            . '<div class="bg-white/5 rounded-full px-3 py-1 text-center text-xs">' . $buyCode . '</div>'
                        . '</td>'
                        . '<td class="pl-2 text-right">'
                            . '<div class="font-medium w-[60px]">' . $buyValue . '</div>'
                        . '</td>'
                    . '</tr>';
                }
            
                if ($rows_html != "") {
                    $html .= '<div class="flex items-center mb-4">'
                        . '<span class="text-white uppercase text-[18px] leading-[140%] mr-4 whitespace-nowrap">'
                        . htmlspecialchars($currency->getTitle())
                        . '</span>'
                        . '<div class="flex-1 h-[1px] bg-[#06AB6B]"></div>'
                        . '</div>';
            
                    $html .= '<div class="overflow-x-auto w-full">'
                        . '<table class="w-full table-auto">'
                        . '<thead>'
                        . '<tr class="text-white opacity-15 text-[14px]">'
                        . '<th class="pb-4 text-left whitespace-nowrap">{{you_sell}}</th>'
                        . '<th class="pb-4 text-left"></th>'
                        . '<th class="pb-4 text-left"></th>'
                        . '<th class="pb-4 text-left"></th>'
                        . '<th class="pb-4 text-left whitespace-nowrap">{{you_receive}}</th>'
                        . '<th class="pb-4 text-left"></th>'
                        . '<th class="pb-4 text-left"></th>'
                        . '</tr>'
                        . '</thead>'
                        . '<tbody class="text-white text-sm">'
                        . $rows_html
                        . '</tbody>'
                        . '</table>'
                        . '</div>';
                }
            }
            $html .= '</div>';
            return $html;
            
    }
}
