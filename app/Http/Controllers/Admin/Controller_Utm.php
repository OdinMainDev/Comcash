<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\UtmExchanges;
use App\Models\UtmParameter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Controller_Utm extends Controller{
    
    use HasImage;
    
    public function view(Request $request, $lang, $id) {
        if(!is_numeric($id)){
            return abort(404);
        }
        $model = UtmParameter::where("id", $id)->first();
        if(!$model){
            return abort(404);
        }
        return view("admin.pages.utm.item")->with("model", $model);
    }

    public function api(Request $request, $lang, $id) {
        if(!is_numeric($id)){
            return abort(404);
        }
        return Cache::remember("admin-dashboard-chart-popular-utms-".$id, 360, function() use($id){

            $utms = UtmExchanges::where("is_completed", true)->where("utm_id", $id)
                ->groupBy('direction')
                ->selectRaw('direction, COUNT(*) as count')
                ->get();

            $directions = [];
            $counts = [];
            foreach($utms as $val){
                $directions[] = $val->direction;
                $counts[] = $val->count;
            }
            
            return [
                'directions' => $directions,
                'counts' => $counts,
            ];
        });
    }

}
