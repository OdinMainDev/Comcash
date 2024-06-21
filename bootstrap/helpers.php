<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

function echo_image_validation($additional = []){
    if(is_array($additional) && count($additional) > 0)
        return 'file|clamav|mimes:jpeg,png,jpg,gif,svg,'.implode(",", $additional);
    return 'file|clamav|mimes:jpeg,png,jpg,gif,svg';
}

function appendLocalesNames($array){
    $config = config()->get("app.languages");
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $array['mlName'.$lang] = 'nullable|string|max:255';
    }
    return $array;
}

function appendLocalesTitles($array){
    $config = config()->get("app.languages");
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $array['mlTitle'.$lang] = 'nullable|string|max:255';
    }
    return $array;
}

function appendLocalesContents($array){
    $config = config()->get("app.languages");
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $array['mlContent'.$lang] = 'nullable|string';
    }
    return $array;
}

function appendLocalesSEO($array){
    $config = config()->get("app.languages");
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $array['mlSeoTitle'.$lang] = 'nullable|string';
        $array['mlSeoDescription'.$lang] = 'nullable|string';
        $array['mlSeoKeyword'.$lang] = 'nullable|string';
    }
    return $array;
}

function getLocalesNames($request){
    $config = config()->get("app.languages");
    $response = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $response[$lang] = $request->{'mlName'.$lang};
    }
    return $response;
}

function getLocalesTitles($request){
    $config = config()->get("app.languages");
    $response = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $response[$lang] = $request->{'mlTitle'.$lang};
    }
    return $response;
}

function getLocalesContents($request){
    $config = config()->get("app.languages");
    $response = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $response[$lang] = cleanHTML($request->{'mlContent'.$lang});
    }
    return $response;
}

function getLocalesSeo($request){
    $config = config()->get("app.languages");
    $response = [
        'titles' => [],
        'descriptions' => [],
        'keywords' => [],
    ];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $response['titles'][$lang] = $request->{'mlSeoTitle'.$lang};
        $response['descriptions'][$lang] = $request->{'mlSeoDescription'.$lang};
        $response['keywords'][$lang] = $request->{'mlSeoKeyword'.$lang};
    }
    return $response;
}

function sendTelegramNotification($text, $level = 1){
    $bot_token = env("TELEGRAM_TOKEN", false);
    $chat_id = env("TELEGRAM_CHAT_ID", false);
    if(!$bot_token || !$chat_id){
        logger()->error("TELEGRAM BOT НЕ НАСТРОЕН");
        logger()->error($text);
        return;
    }
    if(env("NOTIFICATION_LEVEL", 1) < $level){
        return;
    }

    $ch = curl_init('https://api.telegram.org/bot' . $bot_token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' =>  'html'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);
}

function generateRandomString($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_current_url(){
    if(isset($_SERVER["SERVER_NAME"]))
        return "http".(empty($_SERVER["HTTPS"])?"":"s")."://".$_SERVER["SERVER_NAME"]."/";
    return $_SERVER['HTTP_SCHEME']."://".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/";
}

function sendTelegramKycImage($kyc, $path){
    $bot_token = env("TELEGRAM_TOKEN", false);
    $chat_id = env("TELEGRAM_KYC_CHAT_ID", false);
    if(!$bot_token || !$chat_id){
        logger()->error("TELEGRAM BOT НЕ НАСТРОЕН");
        return;
    }
    $caption = "";
    $caption .= $kyc->credential ? "credential: ".$kyc->credential."\n" : "";
    $caption .= $kyc->address ? "address/credit card: ".$kyc->address."\n" : "";
    $caption .= $kyc->user_id ? "user_id: ".$kyc->user_id."\n" : "";
    $post_fields = array(
        'chat_id'   => $chat_id,
        'photo'     => new CURLFile(realpath($path)),
        'caption' => $caption,
        'parse_mode' =>  'html',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    [
                        "text" => "Подветрдить",
                        "url" => route("exchgangeAdminKyc", ["hash" => Crypt::encryptString("comcashengine-".$kyc->id)])
                    ]
                ]
            ]
        ]),
    );

    $ch = curl_init('https://api.telegram.org/bot' . $bot_token . '/sendPhoto?chat_id='.$chat_id);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $resp = curl_exec($ch);
    curl_close($ch);
}

function sendTelegramKycSuccess($kyc){
    $bot_token = env("TELEGRAM_TOKEN", false);
    $chat_id = env("TELEGRAM_KYC_CHAT_ID", false);
    if(!$bot_token || !$chat_id){
        logger()->error("TELEGRAM BOT НЕ НАСТРОЕН");
        return;
    }
    $caption = "Подтверждено\n";
    $caption .= $kyc->credential ? "credential: ".$kyc->credential."\n" : "";
    $caption .= $kyc->address ? "address/credit card: ".$kyc->address."\n" : "";
    $caption .= $kyc->user_id ? "user_id: ".$kyc->user_id."\n" : "";
    $post_fields = array(
        'chat_id'   => $chat_id,
        'text' => $caption,
        'parse_mode' =>  'html',
    );

    $ch = curl_init('https://api.telegram.org/bot' . $bot_token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);
}


function sendTelegramBotUserMessage($text, $user, $bot, $exchangeId = false){
    $postData = array(
        'chat_id' => $user->telegram_id,
        'text' => $text,
        'parse_mode' =>  'html',
    );
    if($exchangeId) {
        $postData['reply_markup'] = json_encode([
            "inline_keyboard" => [
                [[
                    "text" => __("telegram.i_paid_button", [], $user->language),
                    "callback_data" => "exchangeIPaidButton:;:".$exchangeId, 
                ]]
            ]
        ]);
    }
    $ch = curl_init('https://api.telegram.org/bot' . $bot->token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);
}

function sendTelegramNotificationAffiliate($text, $level = 1){
    $bot_token = env("TELEGRAM_TOKEN", false);
    $chat_id = env("TELEGRAM_AFF_CHAT_ID", false);
    if(!$bot_token || !$chat_id){
        logger()->error("TELEGRAM BOT НЕ НАСТРОЕН");
        logger()->error($text);
        return;
    }
    if(env("NOTIFICATION_LEVEL", 1) < $level){
        return;
    }

    $ch = curl_init('https://api.telegram.org/bot' . $bot_token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' =>  'html'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);
}

function cleanHTML($html) {
    $allowedTags = '<h1><h2><h3><h4><h5><h6><p><br><ul><ol><li><table><tr><th><td><thead><tbody><tfoot><blockquote><pre><code><a><img><div><span><strong><em><b><i><u><strike><sub><sup>';
    $cleanedHtml = strip_tags($html, $allowedTags);
    return $cleanedHtml;
}

function sumArraysWithoutDublicates($array, $sumArray) {
    if(!$array)
        $array = [];
    if(!$sumArray)
        $sumArray = [];

    foreach($sumArray as $key => $value) {
        if(!is_array($value)) {
            if(!isset($array[$key]) || empty($array[$key])){
                $array[$key] = $value;
            }
            continue;
        }
        $array[$key] = sumArraysWithoutDublicates(@$array[$key] ? $array[$key] : [], $value);
    }

    return $array;
}

function constructUrlWithUtm($request, $lang = false) {
    $utmParameters = [
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'
    ];

    $hasUtm = false;
    foreach ($utmParameters as $param) {
        if ($request->has($param)) {
            $hasUtm = true;
        }
    }

    if ($hasUtm) {
        $queryParams = [];
        foreach ($utmParameters as $param) {
            if ($request->has($param)) {
                $queryParams[$param] = $request->get($param);
            }
        }
        $redirectUrl = '/'.($lang ? $lang."/" : "");
        if (!empty($queryParams)) {
            $redirectUrl .= '?' . http_build_query($queryParams);
        }

        return $redirectUrl;
    }
    return "/";
}