<header class='header'>
    <div class='header__container'>
        <a href='/' class='header__logo'>
            <img src='/comcash/img/logo.png' alt='Comcash'/>
        </a>
        <div class='header__nav'>
            <a class='header__link' href='/pages/profile/index.html'>
                {{__("front.ExchangeMenu")}}
            </a>
            <a class='header__link'>
                {{__("front.CashCourierMenu")}}
            </a>
            <a class='header__link'>
                {{__("front.PartnerFAQMenu")}}
            </a>
            <a class='header__link'>
                {{__("front.FeedbackMenu")}}
            </a>
            <a class='header__link'>
                {{__("front.TariffsMenu")}}
            </a>
            <a class='header__link'>
                {{__("front.SupportMenu")}}
            </a>
        </div>
        <div class='select'>
            <div class='select__container'>
                <div class='select__option'>
                    <input type='radio' id='ru' name='locale' value='ru' 
                        @if(app()->getLocale() == "ru") checked @endif
                    />
                    <label for='ru'>
                    <img src='/comcash/img/icons/locales/ru.png'
                        alt='Comcash - русский язык' />
                    </label>
                </div>
                <div class='select__option'>
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
        </div>
        @guest
            <button class='header__btn button open___signin' type='submit' data-mfp-src='#auth-popup'>{{__("front.sign in")}}</button>
        @endguest
        @auth
            <a class='header__btn button' type='button' href="{{route("myprofile")}}">{{__("front.profile")}}</a>
        @endauth
        <div class='header__nav-mobile'>
            <div class='accordion'>
                @auth
                    <button class='accordion__button'>{{__("front.profile")}}</button>
                    <div class='accordion__content'>
                        <a href='#' class='active'>Личный кабинет</a>
                        <a href='#'>Мои счета</a>
                        <a href='#'>История транзации</a>
                        <a href='#'>Безопасность</a>
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
            <img src='/comcash/img/icons/burger.png' alt="Comcash"/>
            <img src='/comcash/img/icons/burger-cross.png' alt="Comcash"/>
        </button>
    </div>
</header>