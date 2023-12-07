<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycCheck extends Model
{
    use HasFactory;

    protected $casts = [
        "check" => "boolean"
    ];
}
