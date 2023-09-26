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
                конфиденциальность и точное исполнение обязательств.</p>
            </div>


            <div class="tariffs__list">
                <p class="tariffs__list-title">Тинькофф RUB</p>
                <div class="tariffs__list-row">
                    <div class="tariffs__list-col">
                        <p class="tariffs__list-label">you sell</p>
                        <p class="tariffs__list-agent">
                            <img src="/comcash/img/globus.svg" alt="Comcash - Tinkoff">
                            <span>Tinkoff</span>
                        </p>
                        <p class="tariffs__list-currency">RUB</p>
                        <p class="tariffs__list-value">333.333.333</p>
                    </div>
                    <div class="tariffs__list-col">
                        <p class="tariffs__list-label">you get</p>
                        <p class="tariffs__list-agent">
                            <img src="/comcash/img/globus.svg"
                                alt="">
                            <span>Tinkoff</span>
                        </p>
                        <p class="tariffs__list-currency">RUB</p>
                        <p class="tariffs__list-value">333.333.333</p>
                    </div>
                </div>
                <div class="tariffs__list-row">
                <div class="tariffs__list-col">
                <p class="tariffs__list-label">you sell</p>
                <p class="tariffs__list-agent">
                    <img src="/comcash/img/globus.svg"
                        alt="">
                    <span>Tinkoff</span>
                </p>
                <p class="tariffs__list-currency">RUB</p>
                <p class="tariffs__list-value">333.333.333</p>
                </div>
                <div class="tariffs__list-col">
                <p class="tariffs__list-label">you get</p>
                <p class="tariffs__list-agent">
                    <img src="/comcash/img/globus.svg"
                        alt="">
                    <span>Tinkoff</span>
                </p>
                <p class="tariffs__list-currency">RUB</p>
                <p class="tariffs__list-value">333.333.333</p>
                </div>
            </div>
            <div class="tariffs__list-row">
                <div class="tariffs__list-col">
                <p class="tariffs__list-label">you sell</p>
                <p class="tariffs__list-agent">
                    <img src="/comcash/img/globus.svg"
                        alt="">
                    <span>Tinkoff</span>
                </p>
                <p class="tariffs__list-currency">RUB</p>
                <p class="tariffs__list-value">333.333.333</p>
                </div>
                <div class="tariffs__list-col">
                <p class="tariffs__list-label">you get</p>
                <p class="tariffs__list-agent">
                    <img src="/comcash/img/globus.svg"
                        alt="">
                    <span>Tinkoff</span>
                </p>
                <p class="tariffs__list-currency">RUB</p>
                <p class="tariffs__list-value">333.333.333</p>
                </div>
            </div>
            </div>


            <p class='tariffs__bottom'>
            Консультации доступны по электронной почте <a href='mailto:support@comcash.io'>support@comcash.io</a>, в
            Telegram, а также через форму обратной связи на сайте.
            </p>
        </div>
      </div>
</div>
@endsection