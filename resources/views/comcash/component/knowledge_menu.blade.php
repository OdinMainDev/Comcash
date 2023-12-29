<div class='sidebar'>
    <div class="sidebar__header">
        <a href='/' class='header__logo header__default'>
            <img src='/comcash/img/logo.svg' alt='Comcash' />
        </a>
        <a href='/' class='header__logo header__christmas'>
            <img src='/comcash/img/new_year_img/logo.png' alt='Comcash' />
        </a>
    </div>
    @auth
        <button class='sidebar__button'>
            <img src='/comcash/img/icons/nav/profile.svg' />
            <span>{{__("front.profile")}}</span>
        </button>
        <div class='sidebar__content'>
            <a href='{{route("myprofile")}}'>{{__("front.client panel")}}</a>
            <!-- <a href='#'>{{__("front.my cards")}}</a>
            <a href='#'>{{__("front.my transactions")}}</a> -->
            <a href='{{route("myprofilePassword")}}'>{{__("front.security")}}</a>
            <a href='{{route("logout")}}'>{{__("front.log out")}}</a>
        </div>
    @endauth
    <a href='{{route("comcashPage", ["tariffs"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/tarifs.svg" alt="Comcash - {{__("front.TariffsMenu")}}" />
        <span>{{__("front.TariffsMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["delivery"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/wallet.svg" alt="Comcash - {{__("front.CashCourierMenu")}}">
        <span>{{__("front.CashCourierMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["reviews"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/reviews.svg" alt="Comcash - {{__("front.FeedbackMenu")}}">
        <span>{{__("front.FeedbackMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["news"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/news.svg" alt="Comcash - {{__("front.NewsMenu")}}">
        <span>{{__("front.NewsMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["support"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/support.svg" alt="Comcash - {{__("front.SupportMenu")}}">
        <span>{{__("front.SupportMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["company"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/company.svg" alt="">
        <span>{{__("front.company")}}</span>
    </a>
    <div class='sidebar__content'></div>

    <a href='{{route("comcashPage", ["faq"])}}' class='sidebar__button accordion__button_custom'>
        <img src="/comcash/img/icons/nav/faq.svg" alt="Comcash - {{__("front.PartnerFAQMenu")}}">
        <span>{{__("front.PartnerFAQMenu")}}</span>
    </a>
    <div class='sidebar__content'></div>
</div>
