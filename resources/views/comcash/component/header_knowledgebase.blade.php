<header class='info-header'>
	<div class='info-header__container'>
        <a href='/' class='header__logo header__default'>
            <img src='/comcash/img/logo.svg' alt='logo' />
        </a>
        <a href='/' class='header__logo header__christmas'>
            <img src='/comcash/img/new_year_img/logo.png' alt='logo' />
        </a>
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
            </div>
        </div>
        <button class='header__burger button'>
            <img src='/comcash/img/icons/burger.svg' alt="Comcash"/>
            <img src='/comcash/img/icons/burger-cross.svg' alt="Comcash"/>
        </button>
	</div>
</header>
