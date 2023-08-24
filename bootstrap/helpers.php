<?php

function echo_image_validation($additional = []){
    if(count($additional) > 0)
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

function getLocalesNames($request){
    $config = config()->get("app.languages");
    $respose = [];
    foreach($config as $lang){
        $lang = mb_strtolower($lang);
        $respose[$lang] = $request->{'mlName'.$lang};
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