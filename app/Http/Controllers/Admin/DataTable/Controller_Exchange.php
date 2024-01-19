<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Exchange extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.exchange.list");
    }

    public function process(Request $request){
        $query = $this->constructQuery($request);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            // dd($row);
            return $row->id;
        })
        ->editColumn("data", function($row){
            $html = "";

            $html .= "Направление обмена ".@$row->currencyFrom->name." -> ".@$row->currencyTo->name."<br>";
            $html .= "Сумма: ".@$row->data['amount_data']['amount_send']." -> ". @$row->data['amount_data']['amount_receive']."<br>";
            $html .=  "Курс обмена: ".@$row->data['amount_data']['exchange_rate']."<br>";
            $html .=  "user_id: ".@$row->user_id."<br>";
            $html .=  "direction_id: ".@$row->direction_id."<br>";
            $html .=  "currency_from: ".@$row->currency_from."<br>";
            $html .=  "currency_to: ".@$row->currency_to."<br>";
            $html .=  "merchant_from: ".@$row->merchant_from."<br>";
            $html .=  "merchant_to: ".@$row->merchant_to."<br>";
            $html .=  "merchant_type_from: ".@$row->merchant_type_from."<br>";
            $html .=  "merchant_type_to: ".@$row->merchant_type_to."<br>";
            return $html;
        })
        ->editColumn("status", function($row){
            // dd($row);
            $html = "";
            switch($row->status){
                case 0: $html = "created"; break;
                case 1: $html = "paid"; break;
                case 2: $html = "selled currency"; break;
                case 3: $html = "wait for withdraw"; break;
                case 4: $html = "check withdraw"; break;
                case 5: $html = "success"; break;
                case 11: $html = "api error"; break;
                case 12: $html = "cancel"; break;
                case 13: $html = "deleted"; break;
                case 14: $html = "amount error"; break;
                case 15: $html = "withdraw error"; break;
            }
            return $html." (".$row->status.")";
        })
        // ->editColumn("name", function($row){
        //     return $this->tableImage($row, @$row->data['image']);
        // })
        // ->addColumn("title", function($row){
        //     $lang = mb_strtolower(app()->getLocale());
        //     if(isset($row->data['titles'][$lang])){
        //         return $row->data['titles'][$lang];
        //     }

        //     $config = config()->get("app.languages");
        //     foreach($config as $lang){
        //         $lang = mb_strtolower($lang);
        //         if(isset($row->data['titles'][$lang])){
        //             return $row->data['titles'][$lang];
        //         }
        //     }

        //     return "undefined";
        // })
        ->editColumn("hash", function($row){
            return '<div class="mb-3">
                        <input type="text" class="form-control text-white" value="'.$row->hash.'" disabled="">
                    </div>';
        })
        ->editColumn("currency_from", function($row){
            return @$row->currencyFrom->name;
        })
        ->editColumn("currency_to", function($row){
            return @$row->currencyTo->name;
        })
        ->editColumn("created_at", function($row){
            return $this->tableDate($row, "created_at");
        })
        ->addColumn('action', function ($row) {
            return $this->tableAction($row, route("adminExchangeEdit", [$row->id]));
        })
        ->make(true);
    }

    public function constructQuery($request){
        $request->validate([
            "filter_created_from" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        $query = Exchange::with("currencyFrom")->with("currencyTo");
        if(!$this->isRootUser()){
            $query = $query->where(function($q){
                $q->where("admin_id", auth()->user()->id)->orWhere(function($q2){
                    $q2->where("admin_id", 0)->where("status", 0);
                });
            });
        }

        if(!is_null($request->filter_created_from)){
            $timestamp = \Carbon\Carbon::createFromTimestamp($request->filter_created_from);
            $query = $query->where('created_at','>=',$timestamp);
        }
        return $query;
    }
}
