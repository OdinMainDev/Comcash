<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramBot extends Model
{
    use HasFactory;

    protected $casts = [
        "status" => "boolean"
    ];

    protected $appends = ['is_now_registered'];
    public function getIsNowRegisteredAttribute(){
        return false;
    }
}
