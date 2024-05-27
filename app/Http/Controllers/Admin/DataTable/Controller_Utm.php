<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Currency;
use App\Models\UtmParameter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class Controller_Utm extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.utm.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->addColumn('utm_exchanges_count', function (UtmParameter $utmParameter) {
            return $utmParameter->utm_exchanges_count;
        })
        ->addColumn('completed_utm_exchanges_count', function (UtmParameter $utmParameter) {
            return $utmParameter->completed_utm_exchanges_count;
        })
        ->orderColumn('utm_exchanges_count', function ($query, $order) {
            $query->orderBy('utm_exchanges_count', $order);
        })
        ->orderColumn('completed_utm_exchanges_count', function ($query, $order) {
            $query->orderBy('completed_utm_exchanges_count', $order);
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminUtmView", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = UtmParameter::query();
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_utm_source" => "nullable|string|max:255",
            "filter_utm_medium" => "nullable|string|max:255",
            "filter_utm_campaign" => "nullable|string|max:255",
            "filter_utm_term" => "nullable|string|max:255",
            "filter_utm_content" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_utm_source)){
            $search = mb_strtolower($request->filter_utm_source);
            $query = $query->whereRaw('lower(utm_source) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_utm_medium)){
            $search = mb_strtolower($request->filter_utm_medium);
            $query = $query->whereRaw('lower(utm_medium) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_utm_campaign)){
            $search = mb_strtolower($request->filter_utm_campaign);
            $query = $query->whereRaw('lower(utm_campaign) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_utm_term)){
            $search = mb_strtolower($request->filter_utm_term);
            $query = $query->whereRaw('lower(utm_term) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_utm_content)){
            $search = mb_strtolower($request->filter_utm_content);
            $query = $query->whereRaw('lower(utm_content) like (?)', ["%{$search}%"]);
        }
        
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
