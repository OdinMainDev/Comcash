<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $hidden = [
        "status",
        "position",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        "data" => Json::class,
        "status" => "boolean"
    ];

    public function getTitle($current_language = false){
        if(!$current_language)
            $current_language = app()->getLocale();
        
        $data = $this->data;
        if(!isset($data['titles'])){
            return "";
        }
        if(isset($data['titles'][$current_language]) && !empty($data['titles'][$current_language])){
            return $data['titles'][$current_language];
        }
        foreach($data['titles'] as $value){
            if(!empty($value)){
                return $value;
            }
        }
        return $this->name;
    }
}
