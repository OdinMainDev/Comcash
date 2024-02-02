<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $casts = [
        "data" => Json::class,
        "status" => "boolean",
        "is_blog" => "boolean"
    ];

    public function getTitle(){
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
        return "";
    }

    public function getContent(){
        $current_language = app()->getLocale();
        $data = $this->data;
        if(!isset($data['content'])){
            return "";
        }
        if(isset($data['content'][$current_language]) && !empty($data['content'][$current_language])){
            return $data['content'][$current_language];
        }
        foreach($data['content'] as $value){
            if(!empty($value)){
                return $value;
            }
        }
        return "";
    }
}
