<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Exchange extends Model
{
    use HasFactory;

    protected $casts = [
        "data" => Json::class,
        "is_new_client" => "boolean",
        "is_first_completed" => "boolean",
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

    public function getDirection(){
        return $this->hasOne(Direction::class, "id", "direction_id");
    }

    public function getUser(){
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function getAffiliateExchange(){
        return $this->hasOne(AffiliateExchange::class, "exchange_id", "id");
    }

    public function getAffiliateExchangeByCampaign()
    {
        return $this->hasMany(AffiliateExchange::class)
                    ->where('campaign_id', $this->campaign_id);
    }
}
