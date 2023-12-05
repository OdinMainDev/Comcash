<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\MerchantLog;
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
        // $request->validate([
        //     "filter_id" => "nullable|integer",
        //     "filter_enable" => "nullable|boolean",
        //     "filter_currency" => "nullable|integer",
        //     "filter_name" => "nullable|string|max:255",
        //     "filter_purchase_avalible" => "nullable|boolean",
        //     "filter_is_reuse" => "nullable|boolean",
        //     "filter_created_from" => 'nullable|date|date_format:Y-m-d\TH:i',
        //     "filter_created_to" => 'nullable|date|date_format:Y-m-d\TH:i',
        // ]);
        // if(!is_null($request->filter_id)){
        //     $query = $query->where('id', 'like', '%' . $request->filter_id . '%');
        // }
        // if(!is_null($request->filter_name)){
        //     $search = mb_strtolower($request->filter_name);
        //     $query = $query->whereRaw('lower(name) like (?)', ["%{$search}%"]);
        // }

        return $query;
    }
}
