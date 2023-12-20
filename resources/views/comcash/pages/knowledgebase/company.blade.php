@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="company__content">
            <div class="company__header">
            <p class="company__header-title">{{__("front.page_about_title")}}</p>
            <p class="company__header-text">{{__("front.page_about_desc_1")}}</p>
            </div>

            <div class='company__features'>
            <p class="company__features-title">{{__("front.page_about_title_2")}}</p>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-1'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_1_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_1_content")}}</p>
                </div>
                <div class='company__features-item company__features-item-2'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_2_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_2_content")}}</p>
                </div>
            </div>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-3'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_3_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_3_content")}}</p>
                </div>
                <div class='company__features-item company__features-item-4'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_4_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_4_content")}}</p>
                </div>
            </div>
            </div>

            <div class="company__about">
            <p class="company__about-title">{{__("front.page_about_title_3")}}</p>
            <p class="company__about-text">
                {{__("front.page_about_desc_2")}}
                <br/><br/>
                {{__("front.page_about_desc_3")}}
            </p>
            </div>

            <div class="company__products">
            <p class="company__products-title">{{__("front.page_about_title_4")}}</p>
            <div class="company__products-body">

                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_1_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_1_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="/">{{__("front.page_about_product_try_it")}} &rarr;</a>
                </div>
                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_2_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_2_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="{{route("comcashPage", ["delivery"])}}">{{__("front.page_about_product_try_it")}} &rarr;</a>
                </div>
                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_3_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_3_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="https://amlcheck.pw">{{__("front.page_about_product_try_it")}} &rarr;</a>
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
                <div class="accordion__text">
                    выгодные
                    курсы, моментальная конвертация, круглосуточный доступ!
                </div>
            </div>

            <button class='accordion__button'>
                <span>Тарифы</span> </button>
            <div class='accordion__content'>
                <div class="accordion__text">
                    Одной из наиболее востребованных услуг нашего сервиса является обмен цифровой валюты на фиатные наличные. В
                    любой точке мира и в любой сумме вы можете быстро и легко обменять свои криптовалюты на наличные деньги в
                    широком спектре национальных валют. Мы также готовы предложить курьерскую или офисную доставку наличных
                    средств. Важной особенностью нашего сервиса является гарантия на выдачу денег и наличие депозитов на крупных
                    форумах.
                </div>
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
                <img src='/comcash/img/mir.svg'
                    alt='' />
                </div>
            </div>
            </div>

        </div>
      </div>
</div>
@endsection
