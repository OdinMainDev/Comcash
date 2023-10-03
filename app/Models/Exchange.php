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
}
