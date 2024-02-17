<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\MerchantLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_ExchangeLog extends Controller
{
    use HasTable;

    public function process(Request $request, $lang, $id){
        $query = $this->constructQuery($request, $id);
        return DataTables::of($query)
        ->editColumn("request", function($row){
            return '<textarea class="form-control text-white" rows="3" disabled="">'.$row->request.'</textarea>';
        })
        ->editColumn("response", function($row){
            return '<textarea class="form-control text-white" rows="3" disabled="">'.$row->response.'</textarea>';
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->make(true);
    }

    public function constructQuery($request, $id){
        $query = MerchantLog::where("exchange_id", $id);
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_action" => "nullable|string|max:255",
            "filter_url" => "nullable|string",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_action)){
            $search = mb_strtolower($request->filter_action);
            $query = $query->whereRaw('lower(action) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_url)){
            $search = mb_strtolower($request->filter_url);
            $query = $query->whereRaw('lower(url) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
