<?php
     
namespace App\Http\Traits\Misc;

trait HasTable {

    public function tableDate($row, $key){
        $value = @$row->{$key};
        if(!$value || !is_numeric($value)){
            if(!strtotime($value))
                return "";
            $value = strtotime($value);
        }
        return date("d.m.Y H:i:s", $value);
    }

    public function tableImage($row, $image, $name = "name"){
        if(!$row || !$row->{$name})
            return "undefined";
        if(!$image)
            return '<b class="fs-0 fw-bold" >'.$row->{$name}.'</b>';
        return '<div class="d-flex align-items-center">
                    <div class="avatar avatar-xl me-3">
                        <img class="rounded-circle" src="/uploads/'.$image.'" alt="'.$row->{$name}.'" />
                    </div>
                    <div>
                        <b class="fs-0 fw-bold" >'.$row->{$name}.'</b>
                    </div>
                </div>';
    }

    public function tableAction($row, $route_edit = false, $route_delete = false, $custom = false, $route_confirm = false){
        $html = '<div class="mt-3 d-flex social-links">';
        if($route_edit){
            $html .= '
            <a href="'.$route_edit.'" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon">
                <i data-feather="edit-2" ></i>
            </a>';
        }

        if($route_confirm) {
            if ($row->status == 0 ) {
                $html .='<a href="' . route("adminExchangeSetPaid", [$row->id]) . '" class="btn btn-primary me-2">Подтвердить оплату</a>';
            }
            if ($row->status == 1) {
                $html .='<a href="' . route("adminExchangeSetWithdraw", [$row->id]) . '" class="btn btn-primary me-2">Начать выплату</a>';
            }
            
            if ($row->status == 4) {
                $html .='<a href="' . route("adminExchangeSetWithdrawComplete", [$row->id]) . '" class="btn btn-primary me-2">Подтвердить выплату</a>';
            }
        }

        if($route_delete){
            $html .= '<a href="'.$route_delete.'" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon">
                <i data-feather="trash" ></i>
            </a>';
        }
        
        if(is_array($custom)){
            foreach($custom as $value){
                if(!is_array($value))
                    continue;

                if($value['type'] == "icon"){
                    $html .= '
                        <a href="'.$value['route'].'" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon">
                            <i data-feather="'.$value['icon'].'" ></i>
                        </a>';
                }else{
                    $html .= '<a href="'.$value['route'].'" class="btn btn-primary me-2">'.$value['text'].'</a>';
                }
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function tableStatus($value, $prefix = "", $name = "status", $labels = ["danger", "success"]){
        if(is_bool($value))
            $value = intval($value);
        return '<span class="badge badge-phoenix badge-phoenix-'.$labels[$value].' me-2">'.$prefix.__("es-inputs.".$name.$value).'</span><br>';
    }

    public function tableLabel($value, $prefix = "", $label = "info"){
        return '<span class="badge badge-phoenix badge-phoenix-'.$label.' me-2">'.$prefix.$value.'</span><br>';
    }

}