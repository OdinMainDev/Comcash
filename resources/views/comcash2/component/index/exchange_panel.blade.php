<div class='welcome'>
    <div class='welcome__container'>
        <div class="welcome__panel-container-second">
            <form class="welcome__exchange" action="{{route("redirectToExchange")}}">
                <div class="welcome__exchange-col welcome__exchange-col_left">
                    <input class="welcome__exchange-input" id="exchangeCurrencyFrom" name="currency_from"/>
                    <div class="welcome__exchange-title">ВЫ ОТПРАВЛЯЕТЕ</div>
                    <div class="welcome__exchange-col-list">
                    </div>
                </div>
                <div class="self-center	">
                    <svg xmlns="http://www.w3.org/2000/svg" height="60" viewBox="0 -960 960 960" width="60">
                        <path d="M480-40q-112 0-206-51T120-227v107H40v-240h240v80h-99q48 72 126.5 116T480-120q75 0 140.5-28.5t114-77q48.5-48.5 77-114T840-480h80q0 91-34.5 171T791-169q-60 60-140 94.5T480-40Zm-36-160v-52q-47-11-76.5-40.5T324-370l66-26q12 41 37.5 61.5T486-314q33 0 56.5-15.5T566-378q0-29-24.5-47T454-466q-59-21-86.5-50T340-592q0-41 28.5-74.5T446-710v-50h70v50q36 3 65.5 29t40.5 61l-64 26q-8-23-26-38.5T482-648q-35 0-53.5 15T410-592q0 26 23 41t83 35q72 26 96 61t24 77q0 29-10 51t-26.5 37.5Q583-274 561-264.5T514-250v50h-70ZM40-480q0-91 34.5-171T169-791q60-60 140-94.5T480-920q112 0 206 51t154 136v-107h80v240H680v-80h99q-48-72-126.5-116T480-840q-75 0-140.5 28.5t-114 77q-48.5 48.5-77 114T120-480H40Z" fill="#009c74"/>
                    </svg>
                </div>
                <div class="welcome__exchange-col welcome__exchange-col_right">
                    <input class="welcome__exchange-input" id="exchangeCurrencyAmout" name="amount"/>
                    <input class="welcome__exchange-input" id="exchangeCurrencyTo" name="currency_to"/>
                    <div class="welcome__exchange-title">ВЫ ПОЛУЧАЕТЕ</div>
                    <div class="welcome__exchange-filter">
                        <div class="welcome__exchange-filter-item active" data-filter="all">
                            Все
                        </div>
                        <div class="welcome__exchange-filter-item" data-filter="fiat">
                            Карта
                        </div>
                        <div class="welcome__exchange-filter-item" data-filter="crypto">
                            Крипта
                        </div>
                    </div>
                    <div class="welcome__exchange-col-list">
                    </div>
                </div>
            </form>
            <form class="welcome__exchange-mobile" action="{{route("redirectToExchange")}}">
                <div class="welcome__exchange-mobile-container">
                    <div class="welcome__exchange-mobile-side">
                        <input class="welcome__exchange-input" id="exchangeCurrencyFromMobile" name="currency_from"/>

                        <div class="welcome__exchange-title">ВЫ ОТПРАВЛЯЕТЕ</div>
                        <div class="welcome__exchange-filter">
                        </div>
                        <div class="welcome__exchange-mobile-side-list welcome__exchange-mobile-side_left-list">
                            <div class="swiper-wrapper"></div>
                        </div>
                    </div>
                    <div class="welcome__exchange-mobile-side">
                        <input class="welcome__exchange-input" id="exchangeCurrencyAmoutMobile" name="amount"/>
                        <input class="welcome__exchange-input" id="exchangeCurrencyToMobile" name="currency_to"/>
                        <div class="welcome__exchange-title">ВЫ ПОЛУЧАЕТЕ</div>
                        <div class="welcome__exchange-filter">
                            <div class="welcome__exchange-filter-item active" data-filter="all">
                                Все
                            </div>
                            <div class="welcome__exchange-filter-item" data-filter="fiat">
                                Карта
                            </div>
                            <div class="welcome__exchange-filter-item" data-filter="crypto">
                                Крипта
                            </div>
                        </div>
                        <div class="welcome__exchange-mobile-side-list welcome__exchange-mobile-side_right-list">
                            <div class="swiper-wrapper"> </div>
                        </div>
                    </div>		
                </div>
                <button type="submit" class="welcome__exchange-mobile-button">
                    ОБМЕНЯТЬ
                </button>
            </form>
            <div class="welcome__descr-container">
                <div class="welcome__descr">
                    <h1 class="welcome__descr-title">
                        <?php 
                            $text = __("front.indexSidePanelText1");
                            $text = explode(" ", $text);

                            $first = $text[0];
                            $second = array_slice($text, 1, -2);
                            $second = implode(" ", $second);
                            $third = @$text[count($text) - 2];
                            $fourth = end($text);
                        ?>
                        <span class="green">{{$first}}</span> {{$second}} <span class="green">{{$third}}</span> <span class="underline">{{$fourth}}</span>
                    </h1>
                    <ul class="welcome__descr-list">
                        <?php 
                            $text = __("front.indexSidePanelText3");
                            $text = explode(" ", $text);

                            $first = implode(" ", array_slice($text, 0, 2));
                            $second = @$text[2];
                            $third = implode(" ", array_slice($text, 3));

                        ?>
                        <li>
                            {{$first}} <span class="green">{{$second}}</span> {{$third}}
                        </li>
                        <?php 
                            $text = __("front.indexSidePanelText4");
                            $text = explode(" ", $text);

                            $first = implode(" ", array_slice($text, 0, 4));
                            $second = @$text[4];
                            $third = implode(" ", array_slice($text, 5, 2));
                            $fourth = @$text[7];
                            $fifth = implode(" ", array_slice($text, 8));

                        ?>
                        <li>                    
                            {{$first}} <span class="green">{{$second}}</span> {{$third}} 
                            <span class="green">{{$fourth}}</span> {{$fifth}}
                        </li>
                        <li>
                            {{__("front.indexSidePanelText5")}}
                        </li>
                    </ul>
                    <div class="welcome__descr-copyright">
                        {{__("front.indexSidePanelText6")}}
                    </div>
                    <div class="welcome__descr-copyright">Com<span class="green">CASH</span></div>
                </div>
                <img src="/comcash/img/kyc-cross.svg" class="welcome__security-image big">
            </div>  
        </div>
    </div>
    <!-- <div class='welcome__banner'>
        <div class="welcome__banner-arrow welcome__banner-arrow_left">
            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="48" viewBox="0 0 27 48" fill="none">
                <path d="M26.0115 5.76149C27.3295 4.44347 27.3295 2.30653 26.0115 0.988515C24.6935 -0.329505 22.5565 -0.329505 21.2385 0.988515L0.988514 21.2385C-0.329504 22.5565 -0.329504 24.6935 0.988514 26.0115L21.2385 46.2615C22.5565 47.5795 24.6935 47.5795 26.0115 46.2615C27.3295 44.9435 27.3295 42.8065 26.0115 41.4885L8.14797 23.625L26.0115 5.76149Z" fill="white"/>
            </svg>
        </div>
        <div class="welcome__banner-arrow welcome__banner-arrow_right">
            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="48" viewBox="0 0 27 48" fill="none">
                <path d="M26.0115 5.76149C27.3295 4.44347 27.3295 2.30653 26.0115 0.988515C24.6935 -0.329505 22.5565 -0.329505 21.2385 0.988515L0.988514 21.2385C-0.329504 22.5565 -0.329504 24.6935 0.988514 26.0115L21.2385 46.2615C22.5565 47.5795 24.6935 47.5795 26.0115 46.2615C27.3295 44.9435 27.3295 42.8065 26.0115 41.4885L8.14797 23.625L26.0115 5.76149Z" fill="white"/>
            </svg>
        </div>
        <div class="welcome__banner-title">
            {{__("front.indexSidePanelTitle1")}} <span>{{__("front.indexSidePanelTitle2")}}</span> {{__("front.indexSidePanelTitle3")}}
        </div>
        <div class="welcome__banner-text">
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText1")}}
            </div>
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText2")}}
            </div>
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText3")}}
            </div>
        </div>
        <div class="welcome__banner-text">
            {{__("front.indexSidePanelText4")}}
        </div>
        <div class="welcome__banner-text">
            {{__("front.indexSidePanelText5")}}<br>
            {{__("front.indexSidePanelText6")}}<br>
            {{__("front.indexSidePanelText7")}} Com<span>CASH</span>
        </div>
    </div> -->
    <div class='welcome__container'>
        <div class='welcome__bottom'>
            <div class='welcome__bottom-payments'>
                <img src='/comcash/img/sber.svg' alt='' />
                <img src='/comcash/img/tinkoff.svg' alt='' />
                <img src='/comcash/img/visa.svg' alt='' />
                <img src='/comcash/img/mastercard.svg' alt='' />
                <img src='/comcash/img/mir.svg' alt='' />

            </div>
        </div>
    </div>
</div>