<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_User extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.user.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->editColumn("data", function($row){
            $html = "";

            if($row->first_name)
                $html .= "first_name: ".@$row->first_name."<br>";
            if($row->second_name)
                $html .= "second_name: ".@$row->second_name."<br>";
            if($row->last_name)
                $html .= "last_name: ".@$row->last_name."<br>";
            if($row->phone)
                $html .= "phone: ".@$row->phone."<br>";
            if($row->passport)
                $html .= "passport: ".@$row->passport."<br>";
            if($row->telegram)
                $html .= "telegram: ".@$row->telegram."<br>";
            
            return $html;
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminUserEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = User::query();
        if(!$this->isRootUser())
            $query = $query->doesntHave('roles', 'or', function ($q) {
                $q->where('name', "admin");
            });

        return $query;
    }
}
