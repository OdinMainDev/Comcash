<div class='welcome'>
    <div class='welcome__container'>
        <div class='welcome__top'>
            <div class='welcome__text'>
                <p class='welcome__title'>
                    <span>{{__("front.fast")}}</span> {{__("front.and")}} <span>{{__("front.secure")}}</span> {{__("front.cryptoexchanger")}}
                </p>
                <p class='welcome__subtitle'>
                    {{__("front.comcash welcome 2")}}
                    <br/>
                    {{__("front.comcash welcome 3")}}
                </p>
            </div>
            <div class='welcome__form crypto-form'>
                <div class='welcome__tabs-body'>
                    <div class='welcome__tabs-content active' data-tab='tab1'>
                        <form method='POST' class="crypto-form__exchange-form" action="{{route("redirectToExchange")}}">
                            @csrf
                            <div class='label'>{{__("front.you send")}}</div>
                            <div class='input-control'>
                                <input type='text' class="input" id="cryptoYouSend" name="amount"/>
                                <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                <div class="custom-select__select-container" id="cryptoYouSendSelect" data-currency="cryptoYouSendSelect">
                                    <div class="custom-select__select-label">{{__("front.choose currency")}}</div>
                                    <input class="custom-select__select-label-input" name="currency_from"/>
                                    <div class="custom-select__select-list hide">
                                        <div class="custom-select__search">
                                            <input class="custom-select__search-field"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crypto-form__reverse">
                                <span class='label__tarif'>>{{__("front.currency rate")}}: 0.0000</span>
                            </div>
                            <div class='label'>
                                <span>{{__("front.you receive")}}</span>
                            </div>
                            <div class='input-control'>
                                <input type='text' class='input' id="cryptoYouGet"/>
                                <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                <div class="custom-select__select-container" id="cryptoYouGetSelect" data-currency="cryptoYouGetSelect">
                                    <div class="custom-select__select-label">{{__("front.choose currency")}}</div>
                                    <input class="custom-select__select-label-input" name="currency_to"/>
                                    <div class="custom-select__select-list hide">
                                        <div class="custom-select__search">
                                            <input class="custom-select__search-field"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class='button button--auto' type='submit'>{{__("front.exchange")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='welcome__bottom'>
            <div class='welcome__bottom-text'>{{__("front.Buy Crypto With")}}</div>
            <div class='welcome__bottom-payments'>
                <img src='/comcash/img/sber.svg' alt='' />
                <img src='/comcash/img/tinkoff.svg' alt='' />
                <img src='/comcash/img/visa.svg' alt='' />
                <img src='/comcash/img/mastercard.svg' alt='' />
            </div>
        </div>
    </div>
</div>