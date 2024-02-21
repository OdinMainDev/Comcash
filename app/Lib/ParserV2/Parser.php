<?php

namespace App\Lib\ParserV2;

class Parser {

    private $currencies =  [];
    private $currenciesDefault = ["USD", "USDT", "RUB", "BTC", "ETH", "DAI", "ADA", "XRP", "LTC", "LINK", "BCH", "XLM", "TRX", "DOGE", "SOL", "MATIC", "XMR"];
    private $parserConfig = [];
    private $excluded_currencies = [];
    private $included_currencies = [];


    public function __construct($currencies = false, $excluded_currencies = [], $included_currencies = []) {
        $this->currencies = $currencies ? $currencies : $this->currenciesDefault;
        $this->excluded_currencies = $excluded_currencies;
        $this->included_currencies = $included_currencies;
        $this->parserConfig = [
            "kucoin_api" => "https://api.kucoin.com/",
            "commex_api" => "https://api.commex.com/",
        ];
    }

    public function handle(){
        $response = $this->getKucoinData();
        if(!$response){
            sendTelegramNotification("Error on parse rates...");
            return;
        }
        $rubPrice = $this->getRubPrice();
        if(!$rubPrice){
            sendTelegramNotification("Failed to fetch RUB price...");
            return;
        }
        $response = $this->addRubValues($response, $rubPrice); 
        $response = $this->completeCurrencyPairs($response, $rubPrice); 
        $response = $this->addRubOppositeConversion($response);
        return $response;
    }

    private function getKucoinData() {
        // method: "api/v1/market/allTickers"
        // response: {"code":"200000","data":{"time":1708482624055,"ticker":[]}}
        // item (ticker):
        // {
        //     "symbol":"MNDE-USDT",
        //     "symbolName":"MNDE-USDT",
        //     "buy":"0.24787",
        //     "bestBidSize":"100",
        //     "sell":"0.24872",
        //     "bestAskSize":"167.1867",
        //     "changeRate":"-0.049",
        //     "changePrice":"-0.01281",
        //     "high":"0.26506",
        //     "low":"0.24781",
        //     "vol":"66034.4661",
        //     "volValue":"16938.861790165",
        //     "last":"0.2486",
        //     "averagePrice":"0.26084061",
        //     "takerFeeRate":"0.001",
        //     "makerFeeRate":"0.001",
        //     "takerCoefficient":"1",
        //     "makerCoefficient":"1"
        // },
        $url = $this->parserConfig["kucoin_api"] . "api/v1/market/allTickers";
        $response = $this->doRequest($url);
        if (!$response) {
            sendTelegramNotification("Error fetching data from Kucoin: url: ".$url);
            return [];
        }
        $data = json_decode($response, true);
        $formattedData = [];
        
        foreach ($data['data']['ticker'] as $ticker) {
            $parts = explode('-', $ticker['symbol']);
            if (count($parts) != 2) {
                continue;
            }
            list($base, $quote) = $parts;
            if (in_array($base, $this->currencies) && in_array($quote, $this->currencies)) {
                if (!isset($formattedData[$base])) {
                    $formattedData[$base] = [];
                }
                $formattedData[$base][$quote] = (float)$ticker['last'];
            }
        }
    
        if (!isset($formattedData['USDT']['USDT'])) {
            $formattedData['USDT']['USDT'] = 1.0;
        }
        if (!isset($formattedData['DAI'])) {
            $formattedData['DAI'] = ['USDT' => 1.0, 'DAI' => 1.0];
        }
        if (!isset($formattedData['USD'])) {
            $formattedData['USD'] = ['USDT' => 1.0];
        }
    
        return $formattedData;
    }

    private function getRubPrice() {
        // $url = 'https://api.commex.com/api/v1/ticker/bookTicker?symbol=USDtrub';
        // response: 
        // {
        //     "symbol":"USDTRUB",
        //     "bidPrice":"92.74000000",
        //     "bidQty":"19.00000000",
        //     "askPrice":"92.82000000",
        //     "askQty":"56.00000000"
        // }
        
        $url = $this->parserConfig["commex_api"] . "api/v1/ticker/bookTicker?symbol=USDtrub";
        $response = $this->doRequest($url);
        if (!$response) {
            sendTelegramNotification("Error fetching data from Kucoin: url: ".$url);
            return [];
        }
        $data = json_decode($response, true);
        return (float)$data['askPrice'];
    }

    private function doRequest($url) {
        $ch = curl_init(str_replace("//", "/", $url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function addRubValues($response, $rubPrice) {
        foreach ($response as $baseCurrency => $pairs) {
            if(!isset($pairs['USDT'])){
                continue;
            }
            $usdtRate = $pairs['USDT'];
            // Calculate RUB value based on USDT rate and rub_price
            $rubValue = $usdtRate * $rubPrice;
            $pairs['RUB'] = $rubValue;
            $response[$baseCurrency] = $pairs;
        }
        return $response;
    }

    private function completeCurrencyPairs($response, $rubPrice) {
        foreach ($this->currencies as $currency) {
            if (!isset($response[$currency]) || isset($response[$currency]['USDT'])) {
                continue;
            }
            foreach ($response[$currency] as $intermediate => $value) {
                if (isset($response[$intermediate]['USDT'])) {
                    $response[$currency]['USDT'] = $value * $response[$intermediate]['USDT'];
                    break;
                }
            }
        }
    
        $response['USDT']['RUB'] = $rubPrice;
        foreach ($response as $base => &$pairs) {
            foreach ($this->currencies as $targetCurrency) {
                if (isset($pairs[$targetCurrency])) {
                    continue;
                }
                if (isset($pairs['USDT']) && isset($response[$targetCurrency]['USDT'])) {
                    $baseToUsdt = $pairs['USDT'];
                    $targetToUsdt = $response[$targetCurrency]['USDT'];
                    $pairs[$targetCurrency] = $baseToUsdt / $targetToUsdt;
                }
            }
        }

        return $response;
    }

    private function addRubOppositeConversion($response) {
        // Create a separate array for RUB conversions
        $rubConversions = array();
    
        // Iterate over all currencies in kucoinData
        foreach ($response as $currency => $pairs) {
            // Find the RUB conversion rate for the currency
            if (array_key_exists('RUB', $pairs)) {
                $rubToCurrencyRate = $pairs['RUB'];
    
                // The opposite conversion rate is 1 divided by the RUB to currency rate
                $rubOppositeRate = 1 / $rubToCurrencyRate;
    
                // Add this rate to the rubConversions array
                $rubConversions[$currency] = $rubOppositeRate;
            }
        }
    
        // Ensure RUB to RUB conversion is 1
        $rubConversions['RUB'] = 1;
    
        // Now merge the rubConversions into kucoinData
        $response['RUB'] = $rubConversions;

        return $response;
    }
}