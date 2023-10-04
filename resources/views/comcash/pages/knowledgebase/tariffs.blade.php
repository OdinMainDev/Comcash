@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="tariffs__content">
            <div class="tariffs__header">
                <p class="tariffs__header-title">Тарифы</p>
                <p class="tariffs__header-text">
                    Если вас интересует обмен криптовалют, то рекомендуется обязательно изучить тарифы Comcash.io. Ниже
                    представлен актуальный перечень цифровых валют с курсами по обмену. Задействовав наш сервис, вы сможете
                    моментально, безопасно и выгодно обменять Bitcoin, Ethereum, Dogecoin, Bitcoin Cash, Tether ERC20, Dai, TRON
                    и иные криптовалюты. Больше того, на нашем сайте доступна возможность по покупке электронных валют с
                    банковских карт Visa и MasterCard. Наш сервис гарантирует защиту всех предоставленных данных,
                    конфиденциальность и точное исполнение обязательств.
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
                            $html .= '<p class="tariffs__list-title">'.$currency->getTitle().'</p>';
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

                                $html .= '<div class="tariffs__list-row">';
                                $rate = $controller->estimateGetRate($currency->name, $currency2->name);
                                $type = 1;
                                if($rate < 0.001){
                                    $rate = $controller->estimateGetRate($currency2->name, $currency->name);
                                    $type = 2;
                                }

                                
                                if($type == 1){
                                    $html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                                    }
                                    $html .= '<p class="tariffs__list-agent">';
                                    $html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                                    $html .= '<span>'.$currency->getTitle().'</span>';
                                    $html .= '</p>';
                                    $html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency->name).'</p>';
                                    $html .= '<p class="tariffs__list-value">1</p>';
                                    $html .= '</div>';
                                    $html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                                    }
                                    $html .= '<p class="tariffs__list-agent">';
                                    $html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                                    $html .= '<span>'.$currency2->getTitle().'</span>';
                                    $html .= '</p>';
                                    $html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency2->name).'</p>';
                                    $html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                                    $html .= '</div>';
                                }else{
                                    $html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $html .= ' <p class="tariffs__list-label">'.__("front.you sell").'</p>';
                                    }
                                    $html .= '<p class="tariffs__list-agent">';
                                    $html .= '<img src="'.$currency->image.'" alt="Comcash - '.$currency->getTitle().'">';
                                    $html .= '<span>'.$currency->getTitle().'</span>';
                                    $html .= '</p>';
                                    $html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency->name).'</p>';
                                    $html .= '<p class="tariffs__list-value">'.$rate.'</p>';
                                    $html .= '</div>';
                                    $html .= '<div class="tariffs__list-col">';
                                    if($count == 0){
                                        $html .= ' <p class="tariffs__list-label">'.__("front.you receive").'</p>';
                                    }
                                    $html .= '<p class="tariffs__list-agent">';
                                    $html .= '<img src="'.$currency2->image.'" alt="Comcash - '.$currency2->getTitle().'">';
                                    $html .= '<span>'.$currency2->getTitle().'</span>';
                                    $html .= '</p>';
                                    $html .= '<p class="tariffs__list-currency">'.$controller->getRealCurrencyCode($currency2->name).'</p>';
                                    $html .= '<p class="tariffs__list-value">1</p>';
                                    $html .= '</div>';
                                }




                                $count++;
                                $html .= '</div>';
                            }
                            
                            
                        }

                        $html .= '</div>';
                        return $html;
                    }); 
                }
            ?>
            <p class='tariffs__bottom'>
                Консультации доступны по электронной почте <a href='mailto:support@comcash.io'>support@comcash.io</a>, в
                Telegram, а также через форму обратной связи на сайте.
            </p>
        </div>
      </div>
</div>
@endsection