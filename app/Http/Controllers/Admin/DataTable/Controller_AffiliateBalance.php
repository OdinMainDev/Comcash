<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\AffiliateBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_AffiliateBalance extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.affiliate.balances.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->editColumn("user_id", function($row){
            return '<a href="'.route("adminUserEdit", [$row->user_id]).'">'.( $row->getUser ? $row->getUser->getUserCredentials() : $row->user_id ).'</a>';
        })
        ->editColumn("currency", function($row){
            return @$row->getCurrency->name;
        })
        ->editColumn("balance", function($row){
            return sprintf("%.12f", $row->balance);
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = AffiliateBalance::with("getUser")->with("getCurrency");
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_user_id" => "nullable|integer",
            "filter_currency" => "nullable|integer",
            "filter_balance" => "nullable|numeric",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_user_id)){
            $query = $query->where('user_id', $request->filter_user_id);
        }
        if(!is_null($request->filter_currency)){
            $query = $query->where('currency', $request->filter_currency);
        }
        if(!is_null($request->filter_balance)){
            $query = $query->where('balance', ">=", $request->filter_balance);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
