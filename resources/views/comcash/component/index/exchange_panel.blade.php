<div class='welcome'>
    <div class='welcome__container'>
        <div class="welcome__panel-container">
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
            <div class='welcome__top'>
                <div class='welcome__form crypto-form'>
                    <div class='welcome__tabs-body'>
                        <div class='welcome__tabs-content active' data-tab='tab1'>
                            <form method='POST' class="crypto-form__exchange-form" action="{{route("redirectToExchange")}}">
                                @csrf
                                <div class='label'>
                                    {{__("front.you send")}}
                                    <div class="welcome__limit">
                                        <span class="welcome__exchange-covert-send-currency">0</span>
                                        &ensp;
                                        <span>≈</span>
                                        &ensp;
                                        <span class="welcome__exchange-covert-send-usd">0$</span>
                                    </div>
                                </div>
                                <div class='input-control'>
                                    <input type='text' class="input" id="cryptoYouSend" name="amount"/>
                                    <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                    <div class="custom-select__select-container" id="cryptoYouSendSelect" data-currency="cryptoYouSendSelect">
                                        <div class="custom-select__select-label">{{__("front.choose currency")}}</div>
                                        <input class="custom-select__select-label-input" name="currency_from"/>
                                        <div class="custom-select__select-list-container hide">
                                            <div class="custom-select__select-list">
                                                <div class="custom-select__search">
                                                    <input class="custom-select__search-field"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="crypto-form__reverse">
                                    <span class='label__tarif'></span>
                                </div>
                                <div class='label'>
                                    <span>{{__("front.you receive")}}</span>
                                    <div class="welcome__limit">
                                        <span class="welcome__exchange-covert-get-currency">0</span>
                                        &ensp;
                                        <span>≈</span>
                                        &ensp;
                                        <span class="welcome__exchange-covert-get-usd">0$</span>
                                    </div>
                                </div>
                                <div class='input-control'>
                                    <input type='text' class='input' id="cryptoYouGet"/>
                                    <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                    <div class="custom-select__select-container" id="cryptoYouGetSelect" data-currency="cryptoYouGetSelect">
                                        <div class="custom-select__select-label">{{__("front.choose currency")}}</div>
                                        <input class="custom-select__select-label-input" name="currency_to"/>
                                        <div class="custom-select__select-list-container hide">
                                            <div class="custom-select__select-list">
                                                <div class="custom-select__search">
                                                    <input class="custom-select__search-field"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button class='button button--auto' type='submit'>{{__("front.exchange")}}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="welcome__security">
                    <img src="/comcash/img/kyc-cross.svg" class="welcome__security-image">
                </div>  
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