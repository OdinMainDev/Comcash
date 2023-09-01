<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller_Home extends Controller
{
    public function view() {
        return view($this->theme.".index");
    }
}
