<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Exchange extends Model
{
    use HasFactory;

    protected $casts = [
        "data" => Json::class
    ];

    protected $hidden = [
        "id",
        "updated_at",
    ];

    public function currencyFrom(){
        return $this->hasOne(Currency::class, "id", "currency_from");
    }

    public function currencyTo(){
        return $this->hasOne(Currency::class, "id", "currency_to");
    }

    public function merchantFrom(){
        return $this->hasOne(Merchant::class, "id", "merchant_from");
    }

    public function merchantTo(){
        return $this->hasOne(Merchant::class, "id", "merchant_to");
    }
}
