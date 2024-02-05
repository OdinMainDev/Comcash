<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    public $casts = [
        "is_member" => "boolean",
        "is_premium" => "boolean",
        "is_rules_accepted" => "boolean"
    ];

    public function getBot(){
        return $this->hasOne(TelegramBot::class, "telegram_id", "bot_id");
    }

    public function getUser(){
        return $this->hasOne(User::class, "id", "user_id");
    }
}
