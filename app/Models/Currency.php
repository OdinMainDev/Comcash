<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $hidden = [
        "status",
        "position",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        "data" => Json::class,
        "status" => "boolean"
    ];
}
