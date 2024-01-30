<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getCurrency(){
        return $this->hasOne(Currency::class, "id", "currency");
    }
}
