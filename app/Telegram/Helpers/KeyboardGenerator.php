<?php

namespace App\Telegram\Helpers;

class KeyboardGenerator
{

    public static function generate($items, $columns = 2, $pagination = [], $keyboard_type = "inline_keyboard"){
        $response = [];
        $response[$keyboard_type] = [];

        $currentIndex = 0;
        foreach($items as $key => $value) {
            if(isset($response[$keyboard_type][$currentIndex])){
                if(count($response[$keyboard_type][$currentIndex]) == $columns) {
                    $currentIndex++;
                }
            }

            $response[$keyboard_type][$currentIndex][] = [
                "text" => $key,
                $value["type"] => $value["value"]
            ];
        }

        if(count($pagination) == 0) {
            return $response;
        }
        if(count($response[$keyboard_type][$currentIndex]) > 0)
            $currentIndex++;
        
        if(isset($pagination['page_previous'])){
            $response[$keyboard_type][$currentIndex][] = [
                "text" => "⬅️ ".$pagination['page_previous'],
                "callback_data" => $pagination['callback_previous']
            ];
        }
        $response[$keyboard_type][$currentIndex][] = [
            "text" => "➡️ ".$pagination['page_current']." ⬅️",
            "callback_data" => "withoutAction"
        ];
        if(isset($pagination['page_next'])){
            $response[$keyboard_type][$currentIndex][] = [
                "text" => $pagination['page_next']." ➡️",
                "callback_data" => $pagination['callback_next']
            ];
        }
  
        return $response;
    }

    public static function makeFromKeyValueArray($items, $callback) {
        $temp = [];
        foreach($items as $key => $value) {
            $temp[$key] = [
                "type" => "callback_data",
                "value" => $callback.":;:".$value,
            ];
        }
        return $temp;
    }

    public static function makePaginationData($callback, $page, $totalItems, $perPage = 10) {
        $response = [];
        if($page > 1) {
            $response['page_previous'] = $page - 1;
            $response['callback_previous'] = $callback.":;:".($page - 1);
        }
        $response['page_current'] = $page;

        if($page * $perPage <= $totalItems) {
            $response['page_next'] = $page + 1;
            $response['callback_next'] = $callback.":;:".($page + 1);
        } 
        return $response;
    }

}