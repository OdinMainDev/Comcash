<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Role extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.roles.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        // ->editColumn("name", function($row){
        //     return $this->tableImage($row, @$row->data['image']);
        // })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminRoleEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = Role::query();
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_name" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_name)){
            $search = mb_strtolower($request->filter_name);
            $query = $query->whereRaw('lower(name) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
