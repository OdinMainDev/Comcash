<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Exchange;
use Illuminate\Http\Request;

class Controller_Exchange extends Controller{
    
    use HasImage;

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $exchange = Exchange::where("id", $id)->first();
        if(!$exchange)
            return abort(404);

        // dd($exchange);
        
        return view("admin.pages.exchange.item")->with("model", $exchange);
    }
}
