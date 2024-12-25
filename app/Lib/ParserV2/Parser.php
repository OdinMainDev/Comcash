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
            "garantex_api" => "https://garantex.org/",
        ];
    }

    public function handle(){
        $response = $this->getKucoinData();
        if(!$response){
            sendTelegramNotification("Error on parse rates...", 4);
            return;
        }
        $rubPrice = $this->getPriceGarantex("rub");
        if(!$rubPrice){
            sendTelegramNotification("Failed to fetch RUB price...", 4);
            return;
        }
        $eurPrice = $this->getPriceGarantex("eur");
        if(!$eurPrice){
            sendTelegramNotification("Failed to fetch EUR price...", 4);
            return;
        }
        $response = $this->addRubValues($response, $rubPrice); 
        $response = $this->addEurValues($response, $eurPrice); 
        $response = $this->completeCurrencyPairs($response, $rubPrice, $eurPrice); 
        $response = $this->addRubOppositeConversion($response);
        $response = $this->addEurOppositeConversion($response);


        return $response;
    }

    private function getKucoinData() {
        // url: https://api.kucoin.com/api/v1/market/allTickers
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
        // if (!$response) {
        //     sleep(1);
        //     $response = $this->doRequest($url);
        // }

        if (!$response) {
            sendTelegramNotification("Error fetching data from Kucoin: url: ".$url, 4);
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
        
        $url = $this->parserConfig["commex_api"] . "api/v1/ticker/bookTicker?symbol=USDTRUB";
        $response = $this->doRequest($url);
        // if (!$response) {
        //     sleep(1);
        //     $response = $this->doRequest($url);
        // }

        if (!$response) {
            sendTelegramNotification("Error fetching data from Commex: url: ".$url, 4);
            return [];
        }
        $data = json_decode($response, true);
        return (float)$data['askPrice'];
    }

    private function getPriceGarantex($currency) {
        // $url = 'https://garantex.org/api/v2/k?market=usdtrub';
        // response: 
        // [
        //     { "close": 95.15, "high": 95.15, "low": 95.11, "open": 95.11, "time": 1711528620, "volume": 743413.36 },
        //     { "close": 95.1, "high": 95.18, "low": 95.1, "open": 95.15, "time": 1711528680, "volume": 8249021.51 }
        // ]

        
        $url = $this->parserConfig["garantex_api"] . "api/v2/k?market=usdt".$currency;
        $response = $this->doRequest($url);
        if (!$response) {
            sleep(1);
            $response = $this->doRequest($url);
        }

        if (!$response) {
            info("GARANTEX ERROR");
            info($url);
            info($response);
            sendTelegramNotification("Error fetching data from Garantex: url: ".$url, 4);
            return false;
        }
        $data = json_decode($response, true);
        if(!is_array($data) || count($data) == 0) {
            sendTelegramNotification("Error fetching data #2 from Garantex: url: ".$url, 4);
            return false;
        }
        $lastElement = end($data);
        if (!isset($lastElement['low'])) {
            sendTelegramNotification("Error fetching data #3 from Garantex: url: ".$url, 4);
            return false;
        }
        
        return (float)$lastElement['low'];
    }

    private function doRequest($url) {
        $options = array(
            CURLOPT_TIMEOUT => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => array(
                'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ),
        );
        $curl_options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_REFERER => '',
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36 OPR/60.0.3255.27",
        );
        $ch = curl_init(str_replace("//", "/", $url));
        foreach($options as $k => $v){
            $curl_options[$k] = $v;
        }
        
        curl_setopt_array($ch, $curl_options);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        if ($err) {
            info("ОШИБКА ПАРСИНГА");
            info($url);
            info($err);
            info($response);
            info($curl_options);
        }
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

    private function addEurValues($response, $eurPrice) {
        foreach ($response as $baseCurrency => $pairs) {
            if(!isset($pairs['USDT'])){
                continue;
            }
            $usdtRate = $pairs['USDT'];
            // Calculate RUB value based on USDT rate and rub_price
            $eurValue = $usdtRate * $eurPrice;
            $pairs['EUR'] = $eurValue;
            $response[$baseCurrency] = $pairs;
        }
        return $response;
    }

    private function completeCurrencyPairs($response, $rubPrice, $eurPrice) {
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
        $response['USDT']['EUR'] = $eurPrice;
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

    private function addEurOppositeConversion($response) {
        // Create a separate array for EUR conversions
        $eurConversions = array();
    
        // Iterate over all currencies in kucoinData
        foreach ($response as $currency => $pairs) {
            // Find the EUR conversion rate for the currency
            if (array_key_exists('EUR', $pairs)) {
                $eurToCurrencyRate = $pairs['EUR'];
    
                // The opposite conversion rate is 1 divided by the EUR to currency rate
                $eurOppositeRate = 1 / $eurToCurrencyRate;
    
                // Add this rate to the eurConversions array
                $eurConversions[$currency] = $eurOppositeRate;
            }
        }
    
        // Ensure EUR to EUR conversion is 1
        $eurConversions['EUR'] = 1;
    
        // Now merge the eurConversions into kucoinData
        $response['EUR'] = $eurConversions;

        return $response;
    }
}