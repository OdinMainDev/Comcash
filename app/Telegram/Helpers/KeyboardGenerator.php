<?php

namespace App\Telegram\Helpers;

class KeyboardGenerator
{

    public static function generate($items, $columns = 2, $pagination = [], $keyboard_type = "inline_keyboard"){
        $response = [];
        $response[$keyboard_type] = [];

        $currentIndex = 0;
        foreach($items as $key => $value) {
            if(count($response[$keyboard_type][$currentIndex]) == $columns) {
                $currentIndex++;
            }

            $response[$keyboard_type][$currentIndex][] = [
                "text" => $key,
                $value["type"] => $value["value"]
            ];
        }

        if(count($pagination) == 0) {
            return $response;
        }
        $currentIndex++;
        $response[$keyboard_type][$currentIndex][] = [
            "text" => "⬅️ ".$pagination['page_previous'],
            "callback_data" => $pagination['callback_previous']
        ];
        $response[$keyboard_type][$currentIndex][] = [
            "text" => "➡️ ".$pagination['page_current']." ⬅️",
            "callback_data" => "withoutAction"
        ];
        $response[$keyboard_type][$currentIndex][] = [
            "text" => $pagination['page_next']." ➡️",
            "callback_data" => $pagination['callback_next']
        ];
  
        return $response;
    }

}