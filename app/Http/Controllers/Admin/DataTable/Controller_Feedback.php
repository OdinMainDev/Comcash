<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Feedback extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.feedback.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminFeedbackEdit", [$row->id]), route("adminFeedbackDelete", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = Feedback::query();
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_name" => "nullable|string|max:255",
            "filter_text" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_name)){
            $search = mb_strtolower($request->filter_name);
            $query = $query->whereRaw('lower(name) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_text)){
            $search = mb_strtolower($request->filter_text);
            $query = $query->whereRaw('lower(text) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
