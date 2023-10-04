<div class='welcome'>
    <div class='welcome__container'>
        <div class='welcome__top'>
            <div class='welcome__text'>
                <p class='welcome__title'><span>Быстрый</span> и <span>надёжный</span> криптообменник</p>
                <p class='welcome__subtitle'>
                    {{__("front.comcash welcome 2")}}
                </p>
            </div>
            <div class='welcome__form crypto-form'>
                <div class='welcome__tabs'>
                    <div class='welcome__tabs-btn active'
                        onclick="window.openIndexExchangeTab(event, 'tab1')">{{__("front.exchange crypto")}}</div>
                    <div class='welcome__tabs-btn'
                        onclick="window.openIndexExchangeTab(event, 'tab2')">{{__("front.buy sell")}}</div>
                </div>
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
                    <div class='welcome__tabs-content' data-tab='tab2'>
                        <form action='POST' class="crypto-form__buy-and-sell-form">
                            <div class='label'>You Pay</div>
                            <div class='input-control'>
                                <input type='number' class="input" id="cryptoYouPay" />
                                <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                <div class="custom-select__select-container" id="cryptoYouPaySelect" data-currency="cryptoYouPaySelect">
                                    <div class="custom-select__select-label">
                                        Выберите крипту 
                                    </div>
                                    <div class="custom-select__select-list hide">
                                        <div class="custom-select__search">
                                            <input class="custom-select__search-field"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="crypto-form__switch-container">
                                <div class="crypto-form__switch">
                                    <input type="checkbox" id="cryptoFormSwitch">
                                    <label for="cryptoFormSwitch" class="crypto-form__switch-item active">
                                        Sell
                                        <svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg" fill="#808086" class="fiat-buttons-swap__arrow-sell">
                                            <path d="M3.73358 12.7001C4.07748 13.1013 4.69817 13.1013 5.04208 12.7001L7.79082 9.4933C8.26994 8.93435 7.87278 8.07082 7.13658 8.07082L5.92858 8.07082L5.92859 1.22888C5.92859 0.752981 5.54279 0.367188 5.06689 0.367188L3.70882 0.367188C3.23292 0.367187 2.84713 0.75298 2.84713 1.22888L2.84713 8.07082H1.63924C0.903052 8.07082 0.505887 8.93433 0.984984 9.49329L3.73358 12.7001Z">
                                            </path>
                                        </svg>
                                    </label>
                                    <label for="cryptoFormSwitch" class="crypto-form__switch-item">
                                        Buy
                                        <svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg" fill="#808086" class="fiat-buttons-swap__arrow-buy">
                                            <path d="M3.73358 12.7001C4.07748 13.1013 4.69817 13.1013 5.04208 12.7001L7.79082 9.4933C8.26994 8.93435 7.87278 8.07082 7.13658 8.07082L5.92858 8.07082L5.92859 1.22888C5.92859 0.752981 5.54279 0.367188 5.06689 0.367188L3.70882 0.367188C3.23292 0.367187 2.84713 0.75298 2.84713 1.22888L2.84713 8.07082H1.63924C0.903052 8.07082 0.505887 8.93433 0.984984 9.49329L3.73358 12.7001Z">
                                            </path>
                                        </svg>
                                    </label>
                                </div>
                            </div>
                            <div class='label'>
                                <span>you get</span>
                            </div>
                            <div class='input-control'>
                                <input type='number' class='input' id="cryptoYouBuy"/>
                                <img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
                                <div class="custom-select__select-container" id="cryptoYouBuySelect" data-currency="cryptoYouBuySelect">
                                    <div class="custom-select__select-label">
                                        Выберите крипту 
                                    </div>
                                    <div class="custom-select__select-list hide">
                                        <div class="custom-select__search">
                                            <input class="custom-select__search-field"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                class='button button--auto'
                                type='submit'
                                >Buy</button>
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