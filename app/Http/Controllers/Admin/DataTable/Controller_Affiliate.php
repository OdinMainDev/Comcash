<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Affiliate extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.affiliate.campaings.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("user_id", function($row){
            return '<a href="'.route("adminUserEdit", [$row->user_id]).'">'.( $row->getUser ? $row->getUser->getUserCredentials() : $row->user_id ).'</a>';
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminAffiliateCampaignEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $query = AffiliateCampaign::with("getUser");
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_user_id" => "nullable|integer",
            "filter_name" => "nullable|string|max:255",
            "filter_hash" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_user_id)){
            $query = $query->where('user_id', $request->filter_user_id);
        }
        if(!is_null($request->filter_name)){
            $search = mb_strtolower($request->filter_name);
            $query = $query->whereRaw('lower(name) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_hash)){
            $search = mb_strtolower($request->filter_hash);
            $query = $query->whereRaw('lower(hash) like (?)', ["%{$search}%"]);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }


        return $query;
    }

    public function process_users(Request $request, $lang, $id){
        $query = $this->constructQueryUser($request, $id);
        return DataTables::of($query)
        ->editColumn("user_id", function($row){
            return '<a href="'.route("adminUserEdit", [$row->user_id]).'">'.( $row->getUser ? $row->getUser->getUserCredentials() : $row->user_id ).'</a>';
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->make(true);
    }

    public function constructQueryUser($request, $id){
        $query = AffiliateUser::with("getUser");
        if(is_numeric($id) && $id > 0){
            $query = $query->where("campaign_id", $id);
        }
        $request->validate([
            "filter_user_id" => "nullable|integer",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        if(!is_null($request->filter_user_id)){
            $query = $query->where('user_id', $request->filter_user_id);
        }
        if(!is_null($request->filter_created_at)){
            $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->filter_created_at);
            $query = $query->where('created_at', '>=', $date);
        }

        return $query;
    }
}
