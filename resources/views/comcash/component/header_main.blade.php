<header class='header'>
    <div class='header__container'>
        <a href='/' class='header__logo'>
            <img src='/comcash/img/logo.png' alt='Comcash'/>
        </a>
        <div class='header__nav'>
            <a class='header__link' href='/pages/profile/index.html'>
                exchange
            </a>
            <a class='header__link'>
                cash courier
            </a>
            <a class='header__link'>
                partner faq
            </a>
            <a class='header__link'>
                reviews
            </a>
            <a class='header__link'>
                support
            </a>
        </div>
        <div class='select'>
            <div class='select__container'>
                <div class='select__option'>
                    <input type='radio' id='en' name='locale' value='en'
                        @if(app()->getLocale() == "en") checked @endif
                    />
                    <label for='en'>
                    <img src='/comcash/img/icons/locales/en.png'
                        alt='Comcash - english' />
                    </label>
                </div>
                <div class='select__option'>
                    <input type='radio' id='ru' name='locale' value='ru' 
                        @if(app()->getLocale() == "ru") checked @endif
                    />
                    <label for='ru'>
                    <img src='/comcash/img/icons/locales/ru.png'
                        alt='Comcash - русский' />
                    </label>
                </div>
            </div>
            <div class='select__current'></div>
        </div>
        @guest
            <button class='header__btn button open___signin' type='submit' data-mfp-src='#auth-popup'>{{__("front.sign in")}}</button>
        @endguest
        @auth
            <a class='header__btn button' type='button' href="{{route("myprofile")}}">{{__("front.my profile")}}</a>
        @endauth
        <div class='header__nav-mobile'>
            <div class='accordion'>
                <button class='accordion__button'>Профиль</button>
                <div class='accordion__content'>
                    <a href='#'
                        class='active'>Личный кабинет</a>
                    <a href='#'>Мои счета</a>
                    <a href='#'>История транзации</a>
                    <a href='#'>Безопасность</a>
                </div>
                <button class='accordion__button'>Тарифы</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>Наличные курьером</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>Отзывы</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>Новости</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>Поддержка</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>Компания</button>
                <div class='accordion__content'>
                </div>
                <button class='accordion__button'>FAQ</button>
                <div class='accordion__content'>
                </div>
            </div>
        </div>
        <button class='header__burger button'>
            <img src='/comcash/img/icons/burger.png' alt="Comcash"/>
            <img src='/comcash/img/icons/burger-cross.png' alt="Comcash"/>
        </button>
    </div>
</header>