<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Controller_Dashboard extends Controller
{
    public function view() {
        return view("welcome");
    }
}
