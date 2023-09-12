<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;
use App\Merchants\Handler;

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
        "merchant_type_from",
        "merchant_type_to",
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

    protected $appends = [
        'layout'
    ];

    public function getLayoutAttribute()
    {
        $layout_from = new Handler($this->merchant_type_from);
        $layout_to = new Handler($this->merchant_type_to, true);
        return array_merge($layout_from->getLayout(), $layout_to->getLayout());
    }
}
