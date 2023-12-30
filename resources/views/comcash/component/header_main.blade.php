<header class='header'>
    <div class='header__container'>
        <a href='/' class='header__logo header__default'>
        <img src='/comcash/img/logo.svg' alt='logo' />
        </a>
        <a href='/' class='header__logo header__christmas'>
        <img src='/comcash/img/new_year_img/logo.png' alt='logo' />
        </a>
        <div class='header__nav'>
            <a class='header__link' href='/'>
                {{__("front.ExchangeMenu")}}
            </a>
            <a class='header__link' href='{{route("comcashPage", [app()->getLocale(), "name" => "delivery"])}}'>
                {{__("front.CashCourierMenu")}}
            </a>
            <a class='header__link' href='{{route("comcashPage", [app()->getLocale(), "name" => "faq"])}}'>
                {{__("front.PartnerFAQMenu")}}
            </a>
            <a class='header__link' href='{{route("comcashPage", [app()->getLocale(), "name" => "reviews"])}}'>
                {{__("front.FeedbackMenu")}}
            </a>
            <!-- <a class='header__link' href='{{route("comcashPage", [app()->getLocale(), "name" => "tariffs"])}}'>
                {{__("front.TariffsMenu")}}
            </a> -->
            <a class='header__link' href='{{route("comcashPage", [app()->getLocale(), "name" => "support"])}}'>
                {{__("front.SupportMenu")}}
            </a>
        </div>
        <!-- <div class='select'>
            <div class='select__container'>
                <div class='select__option language_select' name="ru">
                    <input type='radio' id='ru' name='locale' value='ru'
                        @if(app()->getLocale() == "ru") checked @endif
                    />
                    <label for='ru'>
                    <img src='/comcash/img/icons/locales/ru.png'
                        alt='Comcash - русский язык' />
                    </label>
                </div>
                <div class='select__option language_select' name="en">
                    <input type='radio' id='en' name='locale' value='en'
                        @if(app()->getLocale() == "en") checked @endif
                    />
                    <label for='en'>
                    <img src='/comcash/img/icons/locales/en.png'
                        alt='Comcash - english language' />
                    </label>
                </div>
            </div>
            <div class='select__current'></div>
        </div> -->
        <a class='header__btn-aml button' href="https://t.me/amlcheckbot">
            {{__("front.check your aml")}}
        </a>
        @guest
            <button class='header__btn button open___signin' type='submit' data-mfp-src='#auth-popup'>{{__("front.sign in")}}</button>
            <button class='header__btn button open___signup' type='submit' data-mfp-src='#auth-popup'>{{__("front.sign up")}}</button>
        @endguest
        @auth
            <a class='header__btn button' type='button' href="{{route("myprofile")}}">{{__("front.profile")}}</a>
        @endauth
        <div class='header__nav-mobile'>
            <div class='accordion'>
                @auth
                    <button class='accordion__button'>{{__("front.profile")}}</button>
                    <div class='accordion__content'>
                        <a href='{{route("myprofile")}}' class='active'>{{__("front.client panel")}}</a>
                        <!-- <a href='#'>{{__("front.mywallets")}}</a> -->
                        <!-- <a href='#'>{{__("front.transactionshistory")}}</a> -->
                        <a href='{{route("myprofilePassword")}}'>{{__("front.security")}}</a>
                    </div>
                @endauth
                <a class='accordion__button accordion__button_custom'>{{__("front.TariffsMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom'>{{__("front.CashCourierMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom'>{{__("front.PartnerFAQMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom'>{{__("front.FeedbackMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom'>{{__("front.SupportMenu")}}</a>
            </div>
        </div>
        <button class='header__burger button'>
            <img src='/comcash/img/icons/burger.svg' alt="Comcash"/>
            <img src='/comcash/img/icons/burger-cross.svg' alt="Comcash"/>
        </button>
    </div>
</header>
