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
        ->addColumn('register_type', function ($row) {
            if($row->telegram_id){
                return "🤖 Telegram 🤖";
            }
            return "🌍 Website 🌍";
        })
        ->addColumn('role', function ($row) {
            return $this->tableAction($row, route("adminUserEdit", [$row->id]));
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminUserEdit", [$row->id]));
        })
        ->addColumn('role', function ($row) {
            if(!$row->roles->first()){
                return "Обычный пользователь";
            }
            return $row->roles->first()->name;
        })
        ->make(true);
    }

    public function constructQuery($request){
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_email" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
            "filter_register_type" => "nullable|integer|min:0|max:1",
            "filter_role" => "nullable|string|max:255",
        ]);
        $query = User::with("roles");
        if(!$this->isRootUser()){
            $query = $query->doesntHave('roles', 'or', function ($q) {
                $q->where('name', "admin");
            });
        }
        if(!is_null($request->filter_email)){
            $search = mb_strtolower($request->filter_email);
            $query = $query->whereRaw('lower(email) like (?)', ["%{$search}%"]);
        }
        if($request->has("filter_register_type") && is_numeric($request->get("filter_register_type"))) {
            if($request->filter_register_type == 1){
                $query = $query->whereNotNull("telegram_id");
            }else{
                $query = $query->whereNull("telegram_id");
            }
        }

        if($request->filter_role) {
            $query = $query->whereHas('roles', function ($query) use($request) {
                $query->where('name', $request->filter_role);
            });
        }
        

        return $query;
    }
}
