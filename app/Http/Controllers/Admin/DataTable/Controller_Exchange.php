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
            $html = '<table class="admin-exchange-table">';
            $html .= '<tbody>';
            $html .= '<tr class=""><td>'.__("common.amountFromClient").'</td><td>' . @$row->data['amount_data']['amount_send'] . '</td></tr>';
            $html .= '<tr class="" style="background-color: darkseagreen"><td>'.__("common.amountToClient").'</td><td>' . @$row->data['amount_data']['amount_receive'] . '</td></tr>';
            $html .= '<tr class=""><td>'.__("common.rate").'</td><td>' . @$row->data['amount_data']['exchange_rate'] . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.direction").'</td><td><a href="'.route("adminDirectionEdit", [$row->direction_id]).'">' . @$row->currencyFrom->name . ' -> ' . @$row->currencyTo->name . ' (id: '.$row->direction_id.')</a></td></tr>';
            if(isset($row->data['merchant_from_data']))
                $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.addressToReceiveMoney").'</td><td >' . @$row->data['merchant_from_data']['address'] . '</td></tr>';
            if(isset($row->data['merchant_from_data']))
                $html .= '<tr class="admin-exchange-table__row hidden-row"  style="background-color: darkseagreen"><td>'.__("common.addressToSendMoney").'</td><td >' . @$row->data['request_data']['to_address'] . '</td></tr>';
            
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.user").'</td><td><a href="'.route("adminUserEdit", [$row->user_id]).'">' . ($row->getUser ? $row->getUser->getUserCredentials() : $row->user_id) . '</a></td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>currency_from:</td><td>' . @$row->currency_from . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>currency_to:</td><td>' . @$row->currency_to . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>merchant_from:</td><td>' . @$row->merchant_from . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>merchant_to:</td><td>' . @$row->merchant_to . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.merchantTypeFrom").'</td><td>' . @$row->merchant_type_from . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.merchantTypeTo").'</td><td>' . @$row->merchant_type_to . '</td></tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            return $html;
        })
        ->editColumn("status", function($row){
            // dd($row);
            $html = "";
            switch($row->status){
                case 0: $html = "🆕 ".__("common.statusExchange".$row->status)." 🆕"; break;
                case 1: $html = "⚠️ ".__("common.statusExchange".$row->status)." ⚠️"; break;
                case 2: $html = "⚠️⚠️ ".__("common.statusExchange".$row->status)." ⚠️⚠️"; break;
                case 3: $html = "⚠️⚠️ ".__("common.statusExchange".$row->status)." ⚠️⚠️"; break;
                case 4: $html = "⚠️⚠️⚠️ ".__("common.statusExchange".$row->status)." ⚠️⚠️⚠️"; break;
                case 5: $html = "✅ ".__("common.statusExchange".$row->status)." ✅"; break;
                case 11: $html = "⛔️❗️ ".__("common.statusExchange".$row->status)." ❗️⛔️"; break;
                case 12: $html = "🚫 ".__("common.statusExchange".$row->status)." 🚫"; break;
                case 13: $html = "❌❌ ".__("common.statusExchange".$row->status)." ❌❌"; break;
                case 14: $html = "⛔️❗️ ".__("common.statusExchange".$row->status)." ❗️⛔️"; break;
                case 15: $html = "⛔️❗️ ".__("common.statusExchange".$row->status)." ❗️⛔️"; break;
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
            return $this->tableAction($row, route("adminExchangeEdit", [$row->id]), false, false, true);
        })
        ->make(true);
    }

    public function constructQuery($request){
        $request->validate([
            "filter_created_from" => 'nullable|date|date_format:Y-m-d\TH:i',
            // "filter_"
        ]);
        $query = Exchange::with("getUser")->with("currencyFrom")->with("currencyTo");
        if(!$this->isRootUser()){
            $query = $query->where(function($q){
                $q->where("admin_id", auth()->user()->id)->orWhere(function($q2){
                    $q2->where("admin_id", 0)->whereIn("status", [0, 1]);
                });
            });
        }

        if(!is_null($request->filter_created_from)){
            // dd($request->filter_created_from);
            $timestamp = \Carbon\Carbon::createFromTimestamp($request->filter_created_from);
            $query = $query->where('created_at','>=',$timestamp);
        }
        return $query;
    }
}
