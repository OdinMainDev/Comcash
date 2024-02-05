<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateUser extends Model
{
    use HasFactory;

    public function campaign(){
        return $this->hasOne(AffiliateCampaign::class, "id", "campaign_id");
    }

    public function getUser(){
        return $this->hasOne(User::class, "id", "user_id");
    }
}
