<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Blog extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.blog.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            return $row->id;
        })
        ->addColumn("name", function($row){
            $lang = mb_strtolower(app()->getLocale());
            if(isset($row->data['titles'][$lang])){
                return $row->data['titles'][$lang];
            }

            $config = config()->get("app.languages");
            foreach($config as $lang){
                $lang = mb_strtolower($lang);
                if(isset($row->data['titles'][$lang])){
                    return $row->data['titles'][$lang];
                }
            }

            return "undefined";
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminBlogEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = Blog::query();
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
