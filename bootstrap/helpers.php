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