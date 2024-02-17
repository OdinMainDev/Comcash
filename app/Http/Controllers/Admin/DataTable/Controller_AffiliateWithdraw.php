<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\AffiliateWithdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_AffiliateWithdraw extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.affiliate.withdraws.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->editColumn("amount", function($row){
            return sprintf("%.12f", $row->amount);
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminAffiliateWithdrawsEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = AffiliateWithdraw::query();
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_user_id" => "nullable|integer",
            "filter_status" => "nullable|integer",
            "filter_currency" => "nullable|integer",
            "filter_amount" => "nullable|numeric",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_user_id)){
            $query = $query->where('user_id', $request->filter_user_id);
        }
        if(!is_null($request->filter_status)){
            $query = $query->where('status', $request->filter_status);
        }
        if(!is_null($request->filter_currency)){
            $query = $query->where('currency', $request->filter_currency);
        }
        if(!is_null($request->filter_hash)){
            $search = mb_strtolower($request->filter_hash);
            $query = $query->whereRaw('lower(hash) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_amount)){
            $query = $query->where('amount', ">=", $request->filter_currency);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
