@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="delivery__content">
            <div class="delivery__header">
            <p class="delivery__header-title">Доставка Наличными</p>
            <p class="delivery__header-text">Обратившись в сервис Comcash.io, вы получаете возможность быстро и по
                выгодному курсу обменять свою цифровую валюту на российские рубли, евро, американские доллары, японские иены
                и многие другие национальные валюты в самых разных точках мира. В настоящий момент времени доступны
                следующие локации для выдачи наличных:</p>
            </div>

            <div class='delivery__features'>
            <p class="delivery__features-title">Почему именно мы?</p>
            <div class='delivery__features-row'>
                <div class='delivery__features-item'>
                <p class='delivery__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='delivery__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
                <div class='delivery__features-item'>
                <p class='delivery__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='delivery__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
                <div class='delivery__features-item'>
                <p class='delivery__features-item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
                <p class='delivery__features-item-text'>Наш сайт оборудован дополнительной
                    системой защиты, для максимально безопасных сделок.</p>
                </div>
            </div>
            </div>

            <p class="delivery__accordion-title">Список стран: </p>
            <div class="delivery__accordion accordion accordion--secondary">
            <button class='accordion__button'>
                <img src="/comcash/img/icons/locales/ru.png"
                    alt="">
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
        </div>


        <p class='delivery__bottom'>
          Консультации доступны по электронной почте <a href='mailto:support@comcash.io'>support@comcash.io</a>, в
          Telegram, а также через форму обратной связи на сайте.
        </p>
      </div>
</div>
@endsection