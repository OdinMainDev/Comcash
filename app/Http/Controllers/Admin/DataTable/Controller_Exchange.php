<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasTable;
use App\Models\Exchange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Controller_Exchange extends Controller
{
    use HasTable;

    public function view(){
        return view("admin.pages.exchange.list");
    }

    public function process(Request $request, $lang, $id){
        $query = $this->constructQuery($request, $id);
        return DataTables::of($query)
        ->editColumn("id", function($row){
            // dd($row);
            return $row->id;
        })
        ->editColumn("data", function($row){
            $html = '<table class="admin-exchange-table">';
            $html .= '<tbody>';
            if(isset($row->data['isTelegramExchange']) && $row->data['isTelegramExchange']){
                $html .= '<tr class="admin-exchange-table__row"  style="background-color: darkgreen">
                    <td>ЗАЯВКА ИЗ ТЕЛЕГРАМ БОТА</td>
                    <td></td>
                </tr>';
            }
            $html .= '<tr class=""><td>'.__("common.amountFromClient").'</td><td>' . @$row->data['amount_data']['amount_send'] . '</td></tr>';
            $html .= '<tr class="" style="background-color: darkseagreen"><td>'.__("common.amountToClient").'</td><td>' . @$row->data['amount_data']['amount_receive'] . '</td></tr>';
            $html .= '<tr class=""><td>'.__("common.rate").'</td><td>' . @$row->data['amount_data']['exchange_rate'] . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.direction").'</td><td><a href="'.route("adminDirectionEdit", [$row->direction_id]).'">' . @$row->currencyFrom->name . ' -> ' . @$row->currencyTo->name . ' (id: '.$row->direction_id.')</a></td></tr>';
            if(isset($row->data['merchant_from_data'])){
                $html .= '<tr class="admin-exchange-table__row hidden-row">
                    <td>'.__("common.addressToReceiveMoney").'</td>
                    <td >' . @$row->data['merchant_from_data']['address'] . '</td>
                </tr>';
            }
            if(isset($row->data['merchant_from_data'])){
                $html .= '<tr class="admin-exchange-table__row hidden-row"  style="background-color: darkseagreen">
                    <td>'.__("common.addressToSendMoney").'</td>
                    <td >' . (@$row->data['request_data']['to_address'] ? @$row->data['request_data']['to_address'] : @$row->data['request_data']['to_card']) . '</td>
                </tr>';
            }

            
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.user").'</td><td><a href="'.route("adminUserEdit", [$row->user_id]).'">' . ($row->getUser ? $row->getUser->getUserCredentials() : $row->user_id) . '</a></td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>currency_from:</td><td>' . @$row->currency_from . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>currency_to:</td><td>' . @$row->currency_to . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>merchant_from:</td><td>' . @$row->merchant_from . '</td></tr>';
            // $html .= '<tr class="admin-exchange-table__row hidden-row"><td>merchant_to:</td><td>' . @$row->merchant_to . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.merchantTypeFrom").'</td><td>' . @$row->merchant_type_from . '</td></tr>';
            $html .= '<tr class="admin-exchange-table__row hidden-row"><td>'.__("common.merchantTypeTo").'</td><td>' . @$row->merchant_type_to . '</td></tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '
            <div class="admin-exchange-table__arrow">
                <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683418 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5 3.58579L8.29289 0.292893C8.68342 -0.0976311 9.31658 -0.0976311 9.70711 0.292893C10.0976 0.683418 10.0976 1.31658 9.70711 1.70711L5.70711 5.70711C5.51957 5.89464 5.26522 6 5 6C4.73478 6 4.48043 5.89464 4.29289 5.70711L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="white"/>
                </svg>
            </div>
            ';

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

    public function constructQuery($request, $id){
        $request->validate([
            "filter_id" => "nullable|integer",
            "filter_status" => "nullable|integer",
            "filter_currency_from" => "nullable|integer",
            "filter_currency_to" => "nullable|integer",
            "filter_hash" => "nullable|string|max:255",
            "filter_created_at" => 'nullable|date|date_format:Y-m-d\TH:i',
        ]);
        $query = Exchange::with("getUser")->with("currencyFrom")->with("currencyTo");
        if(is_numeric($id) && $id > 0){
            $query = $query->where("user_id", $id);
        }
        if(!$this->isRootUser()){
            $query = $query->where(function($q){
                $q->where("admin_id", auth()->user()->id)->orWhere(function($q2){
                    $q2->where("admin_id", 0)->whereIn("status", [0, 1]);
                });
            });
        }

        if(!is_null($request->filter_id)){
            $query = $query->where('id', 'like', $request->filter_id . '%');
        }
        if(!is_null($request->filter_status)){
            $query = $query->where('status', $request->filter_status);
        }
        if(!is_null($request->filter_currency_from)){
            $query = $query->where('currency_from', $request->filter_currency_from);
        }
        if(!is_null($request->filter_currency_to)){
            $query = $query->where('currency_to', $request->filter_currency_to);
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
}
