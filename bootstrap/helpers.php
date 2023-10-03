<?php

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
    $respose = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $respose[$lang] = $request->{'mlName'.$lang};
    }
    return $respose;
}

function getLocalesTitles($request){
    $config = config()->get("app.languages");
    $respose = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $respose[$lang] = $request->{'mlTitle'.$lang};
    }
    return $respose;
}

function getLocalesContents($request){
    $config = config()->get("app.languages");
    $respose = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $respose[$lang] = $request->{'mlContent'.$lang};
    }
    return $respose;
}

function getLocalesSeo($request){
    $config = config()->get("app.languages");
    $respose = [
        'titles' => [],
        'descriptions' => [],
        'keywords' => [],
    ];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $respose['titles'][$lang] = $request->{'mlSeoTitle'.$lang};
        $respose['descriptions'][$lang] = $request->{'mlSeoDescription'.$lang};
        $respose['keywords'][$lang] = $request->{'mlSeoKeyword'.$lang};
    }
    return $respose;
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