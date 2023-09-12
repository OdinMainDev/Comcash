<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller_Profile extends Controller{

    public function view() {
        return view($this->theme.".pages.profile");
    }

}
