<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Direction extends Model
{
    use HasFactory;


    protected $casts = [
        "data" => Json::class,
        "status" => "boolean"
    ];

    protected $hidden = [
        "id",
        "status",
        "name",
        "position",
        "merchant_from",
        "merchant_to",
        "total_in",
        "total_out",
        "profit_percent",
        "created_at",
        "updated_at",
    ];

    public function currencyFrom(){
        return $this->hasOne(Currency::class, "id", "currency_from");
    }

    public function currencyTo(){
        return $this->hasOne(Currency::class, "id", "currency_to");
    }
}
