@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="tariffs__content">
            <div class="tariffs__header">
                <p class="tariffs__header-title">{{__("front.knowledge tariffs title")}}</p>
                <p class="tariffs__header-text">
                    {{__("front.knowledge tariffs description")}}
                </p>
            </div>

            <?php 
                if(isset($tariffs)){
                    echo \Illuminate\Support\Facades\Cache::remember("comcash-view-tariffs", 60, function() use($tariffs, $controller){ 
                        if(!isset($tariffs['currencies']) ||
                            !isset($tariffs['currencies']['list']) ||
                            !is_array($tariffs['currencies']['list']) ||
                            !isset($tariffs['exchange']) ||
                            !is_array($tariffs['exchange']))
                            return "";

                        
                        $html = '<div class="tariffs__list">';
                        $count = 0;
                        foreach($tariffs['currencies']['list'] as $key => $value){
                            $currency = $controller->getCurrencyByName($value);
                            if(!$currency || count($currency) == 0){
                                continue;
                            }
                            $currency = $currency[0];
                            $next_html = "";
                            foreach($tariffs['currencies']['list'] as $key2 => $value2){
                                if($value == $value2){
                                    continue;
                                }
                                $currency2 = $controller->getCurrencyByName($value2);
                                if(!$currency2 || count($currency2) == 0){
                                    continue;
                                }
                                $currency2 = $currency2[0];

                                $direction = $controller->getDirectionByCurrencyPair($currency, $currency2);
                                if(!$direction){
                                    continue;
                                }

                                $next_html .= '<a class="tariffs__list-row" href="'.route("exchgangePage", [$currency->name, $currency2->name]).'">';
                                $rate = $controller->estimateGetRate($currency->name, $currency2->name);
                                $type = 1;
                                if($rate < 0.01){
                                    $rate = $controller->estimateGetRate($currency2->name, $currency->name);
                                    $type = 2;
                                }

                                
                                if($type == 1){
                                    $next_html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                                    }
                                    $next_html .= '<p class="tariffs__list-agent">';
                                    $next_html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                                    $next_html .= '<span>'.$currency->getTitle().'</span>';
                                    $next_html .= '</p>';
                                    $next_html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency->name).'</p>';
                                    $next_html .= '<p class="tariffs__list-value">1</p>';
                                    $next_html .= '</div>';
                                    $next_html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                                    }
                                    $next_html .= '<p class="tariffs__list-agent">';
                                    $next_html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                                    $next_html .= '<span>'.$currency2->getTitle().'</span>';
                                    $next_html .= '</p>';
                                    $next_html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency2->name).'</p>';
                                    $next_html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                                    $next_html .= '</div>';
                                }else{
                                    $next_html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                                    }
                                    $next_html .= '<p class="tariffs__list-agent">';
                                    $next_html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                                    $next_html .= '<span>'.$currency->getTitle().'</span>';
                                    $next_html .= '</p>';
                                    $next_html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency->name).'</p>';
                                    $next_html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                                    $next_html .= '</div>';
                                    $next_html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $next_html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                                    }
                                    $next_html .= '<p class="tariffs__list-agent">';
                                    $next_html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                                    $next_html .= '<span>'.$currency2->getTitle().'</span>';
                                    $next_html .= '</p>';
                                    $next_html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency2->name).'</p>';
                                    $next_html .= '<p class="tariffs__list-value">1</p>';
                                    $next_html .= '</div>';
                                }




                                $count++;
                                $next_html .= '</a>';
                            }
                            if($next_html != ""){
                                $html .= '<p class="tariffs__list-title">'.$currency->getTitle().'</p>';
                                $html .= $next_html;
                            }
                            
                        }

                        $html .= '</div>';
                        return $html;
                    }); 
                }
            ?>
            <p class='tariffs__bottom'>
                {{__("front.knowledge tariffs footer 1")}} <a href='mailto:{{__("front.knowledge tariffs footer email")}}'>{{__("front.knowledge tariffs footer email")}}</a> {{__("front.knowledge tariffs footer 2")}}
            </p>
        </div>
      </div>
</div>
@endsection