@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="company__content">
            <div class="company__header">
            <p class="company__header-title">Немного о COMCASH</p>
            <p class="company__header-text">ComCash - ваш надежный партнер в обмене криптовалюты на реальные деньги:
                выгодные
                курсы, моментальная конвертация, круглосуточный доступ!</p>
            </div>

            <div class='company__features'>
            <p class="company__features-title">Что мы можем предложить?</p>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-1'>
                <p class='company__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='company__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
                <div class='company__features-item company__features-item-2'>
                <p class='company__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='company__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
            </div>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-3'>
                <p class='company__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='company__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
                <div class='company__features-item company__features-item-4'>
                <p class='company__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='company__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
            </div>
            </div>

            <div class="company__about">
            <p class="company__about-title">Кто мы такие?</p>
            <p class="company__about-text">
                Кто мы такие?
                Добро пожаловать на Comcash - сервис обмена криптовалюты, за которым стоят
                тысячи довольных клиентов!
                Мы готовы предложить вам наилучшие
                условия, чтобы вы могли безопасно,
                быстро и с выгодой обменивать
                цифровые валюты или конвертировать
                их в фиатные наличные деньги.
                <br><br>
                Уже давно мы являемся надежным и проверенным партнером для тысяч людей по всему миру. Мы предлагаем нашим
                клиентам широкий выбор криптовалют для обмена, включая Bitcoin, Ethereum, Bitcoin Cash, Dogecoin, Tether
                ERC20 USDT, Dai, TRON и другие популярные валюты. Более того, мы предлагаем возможность перевода средств с
                банковских карт Visa/MasterCard в криптовалюту в режиме реального времени, а также заказать наличные, если
                это требуется.
            </p>
            </div>

            <div class="company__products">
            <p class="company__products-title">Наши продукты</p>
            <div class="company__products-body">

                <div class="company__products-item">
                <div class="company__products-card">
                    <p class="company__products-card-title">
                    Крипто-Обменник</p>
                    <p class="company__products-card-text">
                    Быстрый, надёжный и невероятно удобный сервис, доступен на любом устройстве.
                    </p>
                </div>
                <button class="company__products-btn">Попробовать &rarr;</button>
                </div>
                <div class="company__products-item">
                <div class="company__products-card">
                    <p class="company__products-card-title">
                    Крипто-Обменник</p>
                    <p class="company__products-card-text">
                    Быстрый, надёжный и невероятно удобный сервис, доступен на любом устройстве.
                    </p>
                </div>
                <button class="company__products-btn">Попробовать &rarr;</button>
                </div>
                <div class="company__products-item">
                <div class="company__products-card">
                    <p class="company__products-card-title">
                    Крипто-Обменник</p>
                    <p class="company__products-card-text">
                    Быстрый, надёжный и невероятно удобный сервис, доступен на любом устройстве.
                    </p>
                </div>
                <button class="company__products-btn">Попробовать &rarr;</button>
                </div>

            </div>

            </div>

            <div class="company__advantages">
            <div class="company__advantages-row">
                <div class="company__advantages-item">
                <p class="company__advantages-title">Почему именно мы?</p>
                <p class="company__advantages-text">Одной из наиболее востребованных услуг нашего сервиса является обмен
                    цифровой валюты на фиатные наличные. В любой точке мира и в любой сумме вы можете быстро и легко
                    обменять свои криптовалюты на наличные деньги в широком спектре национальных валют. Мы также готовы
                    предложить курьерскую или офисную доставку наличных средств. Важной особенностью нашего сервиса является
                    гарантия на выдачу денег и наличие депозитов на крупных форумах.
                </p>
                </div>
                <div class="company__advantages-item">
                <p class="company__advantages-title">Партнёрская
                    программа</p>
                <p class="company__advantages-text">
                    15000 — 0.5%
                    10000 — 0.4%
                    7500 — 0.3%
                    5000 — 0.2%
                </p>
                </div>
            </div>
            <div class="company__advantages-row">
                <div class="company__advantages-item">
                <p class="company__advantages-title">Сайт безопасен?</p>
                <p class="company__advantages-text">Одной из наиболее востребованных услуг нашего сервиса является обмен
                    цифровой валюты на фиатные наличные. В любой точке мира и в любой сумме вы можете быстро и легко
                    обменять свои криптовалюты на наличные деньги в широком спектре национальных валют. Мы также готовы
                    предложить курьерскую или офисную доставку наличных средств. Важной особенностью нашего сервиса является
                    гарантия на выдачу денег и наличие депозитов на крупных форумах.
                </p>
                </div>
            </div>
            </div>

            <div class="company__faq accordion accordion--secondary">
            <button class='accordion__button'>
                <span>Профиль</span>
            </button>
            <div class='accordion__content'>
                выгодные
                курсы, моментальная конвертация, круглосуточный доступ!
            </div>

            <button class='accordion__button'>
                <span>Тарифы</span> </button>
            <div class='accordion__content'>
                Одной из наиболее востребованных услуг нашего сервиса является обмен цифровой валюты на фиатные наличные. В
                любой точке мира и в любой сумме вы можете быстро и легко обменять свои криптовалюты на наличные деньги в
                широком спектре национальных валют. Мы также готовы предложить курьерскую или офисную доставку наличных
                средств. Важной особенностью нашего сервиса является гарантия на выдачу денег и наличие депозитов на крупных
                форумах.
            </div>

            <button class='accordion__button'>
                <span>Наличные курьером</span>

            </button>
            <div class='accordion__content'>

            </div>

            <button class='accordion__button'>
                <span>Отзывы</span>
            </button>
            <div class='accordion__content'>

            </div>

            <button class='accordion__button'>
                <span>Новости</span>
            </button>
            <div class='accordion__content'>

            </div>

            <button class='accordion__button'>
                <span>Поддержка</span>
            </button>
            <div class='accordion__content'>

            </div>

            <button class='accordion__button'>
                <span>Компания</span>
            </button>
            <div class='accordion__content'>

            </div>

            <button class='accordion__button'>
                <span>FAQ</span>
            </button>
            <div class='accordion__content'>

            </div>
            </div>

            <div class="company__bottom">
            <p class="company__bottom-title">Обратная связь</p>
            <div class="company__bottom-socials">
                <a href="">
                <img src="/comcash/img/icons/socials/vk.svg"
                    class="company__bottom-socials-item"></img>
                </a>
                <a href="">
                <img src="/comcash/img/icons/socials/vk.svg"
                    class="company__bottom-socials-item"></img>
                </a>
                <a href="">
                <img src="/comcash/img/icons/socials/vk.svg"
                    class="company__bottom-socials-item"></img>
                </a>
            </div>

            <div class='company__bottom'>
                <div class='company__bottom-text'>
                ПОКУПАЙТЕ КРИПТУ С ПОМОЩЬЮ
                </div>
                <div class='company__bottom-payments'>
                <img src='/comcash/img/sber.svg'
                    alt='' />
                <img src='/comcash/img/tinkoff.svg'
                    alt='' />
                <img src='/comcash/img/visa.svg'
                    alt='' />
                <img src='/comcash/img/mastercard.svg'
                    alt='' />
                </div>
            </div>
            </div>

        </div>
      </div>
</div>
@endsection