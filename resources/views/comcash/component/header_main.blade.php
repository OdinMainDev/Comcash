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
                <a class='accordion__button accordion__button_custom' href='{{route("comcashPage", [app()->getLocale(), "name" => "tariffs"])}}'>{{__("front.TariffsMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom' href='{{route("comcashPage", [app()->getLocale(), "name" => "delivery"])}}'>{{__("front.CashCourierMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom' href='{{route("comcashPage", [app()->getLocale(), "name" => "faq"])}}'>{{__("front.PartnerFAQMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom' href='{{route("comcashPage", [app()->getLocale(), "name" => "reviews"])}}'>{{__("front.FeedbackMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <a class='accordion__button accordion__button_custom' href='{{route("comcashPage", [app()->getLocale(), "name" => "support"])}}'>{{__("front.SupportMenu")}}</a>
                <div class='accordion__content'>
                </div>
                <div class='accordion__button accordion__button_custom'>{{__("front.ContactsMenu")}}</div>
                <div class='accordion__content'>
                    <span class="header-info__contact copy">
                        <span class="header-info__contact-title">
                            Jobber:
                        </span>
                        &nbsp;
                        <span class="header-info__contact-label">
                            obmen@audia6.online
                        </span>	
                    </span>
                    <span class="header-info__contact copy">
                        <span class="header-info__contact-title">
                            Jobber:
                        </span>
                        &nbsp;
                        <span class="header-info__contact-label">
                            obmen@audia6.online
                        </span>	
                    </span>
                    <span class="header-info__contact">
                        <span class="header-info__contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <g clip-path="url(#clip0_318_75)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22 11C22 17.0751 17.0751 22 11 22C4.92487 22 0 17.0751 0 11C0 4.92487 4.92487 0 11 0C17.0751 0 22 4.92487 22 11ZM11.3942 8.12068C10.3243 8.5657 8.18596 9.48676 4.97924 10.8839C4.45851 11.091 4.18574 11.2935 4.1609 11.4916C4.11894 11.8264 4.53815 11.9582 5.10901 12.1377C5.18667 12.1621 5.26712 12.1874 5.34961 12.2142C5.91125 12.3968 6.66676 12.6104 7.05951 12.6189C7.41578 12.6266 7.81342 12.4797 8.25242 12.1782C11.2486 10.1558 12.7952 9.13349 12.8923 9.11145C12.9608 9.09591 13.0557 9.07636 13.12 9.13353C13.1844 9.19069 13.178 9.29896 13.1712 9.328C13.1297 9.50504 11.4841 11.0349 10.6325 11.8266C10.367 12.0734 10.1787 12.2485 10.1402 12.2885C10.054 12.3781 9.96612 12.4628 9.88165 12.5442C9.35987 13.0472 8.96859 13.4244 9.90331 14.0404C10.3525 14.3364 10.7119 14.5812 11.0705 14.8254C11.4622 15.0921 11.8528 15.3581 12.3581 15.6894C12.4869 15.7738 12.6099 15.8614 12.7296 15.9468C13.1854 16.2717 13.5949 16.5636 14.1007 16.5171C14.3946 16.49 14.6983 16.2136 14.8525 15.3893C15.2169 13.4412 15.9332 9.22025 16.0987 7.48089C16.1132 7.3285 16.095 7.13347 16.0803 7.04786C16.0657 6.96225 16.035 6.84027 15.9238 6.74997C15.792 6.64303 15.5885 6.62047 15.4975 6.62208C15.0838 6.62937 14.449 6.85008 11.3942 8.12068Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_318_75">
                                <rect width="22" height="22" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span class="header-info__contact-label">
                            @audia6_obmen
                        </span>	
                    </span>
                    <span class="header-info__contact copy">
                        <span class="header-info__contact-title">
                            qTox:
                        </span>
                        &nbsp;
                        <span class="header-info__contact-label">
                            1F2F83AA634455DE2FF21DE1CFBF3D5963E666FCFDDA18D3071D2B5F27012F7E7DEAB2186136
                        </span>	
                    </span>
                </div>
            </div>
        </div>
        <button class='header__burger button'>
            <img src='/comcash/img/icons/burger.svg' alt="Comcash"/>
            <img src='/comcash/img/icons/burger-cross.svg' alt="Comcash"/>
        </button>
    </div>
</header>
