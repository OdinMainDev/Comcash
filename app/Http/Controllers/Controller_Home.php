<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use Illuminate\Http\Request;

class Controller_Home extends Controller{

    use HasCache;

    public function view() {
        return view($this->theme.".index")
            ->with("news", $this->getCacheNews())
            ->with("feedbacks", $this->getCacheFeedbacks())
            ->with("exchanges", $this->getCacheExchanges());
    }

    public function export_json() {
        return $this->getCacheExportJson();
    }
}
