<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Direction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Direction extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.directions.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->editColumn("name", function($row){
            return $row->name;
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->editColumn("currency_from", function($row){
            return @$row->currencyFrom->name;
        })
        ->editColumn("currency_to", function($row){
            return @$row->currencyTo->name;
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminDirectionEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = Direction::with("currencyFrom")->with("currencyTo");
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_name" => "nullable|string|max:255",
            "filter_currency_from" => "nullable|integer",
            "filter_currency_to" => "nullable|integer",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_name)){
            $search = mb_strtolower($request->filter_name);
            $query = $query->whereRaw('lower(name) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_currency_from)){
            $query = $query->where('currency_from', $request->filter_currency_from);
        }
        if(!is_null($request->filter_currency_to)){
            $query = $query->where('currency_to', $request->filter_currency_to);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
