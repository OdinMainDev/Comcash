<div class='header__nav-mobile'>
    <div class='accordion'>
        @auth
            <button class='accordion__button'>{{__("front.profile")}}</button>
            <div class='accordion__content'>
                <a href='{{route("myprofile")}}'>{{__("front.client panel")}}</a>
                <a href='{{route("myprofileExchanges")}}' >{{__("front.exchanges history")}}</a>
                <a href='{{route("myprofileAffiliate")}}' >{{__("front.profile affiliate")}}</a>
                <a href='{{route("myprofilePassword")}}' >{{__("front.security")}}</a>
            </div>
        @endauth
        <a class='accordion__button accordion__button_custom'  href='{{route("comcashPage", ["tariffs"])}}'>{{__("front.TariffsMenu")}}</a>
        <div class='accordion__content'></div>
        <a class='accordion__button accordion__button_custom'  href='{{route("comcashPage", ["delivery"])}}'>{{__("front.CashCourierMenu")}}</a>
        <div class='accordion__content'></div>
        <a class='accordion__button accordion__button_custom'  href='{{route("comcashPage", ["faq"])}}'>{{__("front.PartnerFAQMenu")}}</a>
        <div class='accordion__content'></div>
        <a class='accordion__button accordion__button_custom'  href='{{route("comcashPage", ["reviews"])}}'>{{__("front.FeedbackMenu")}}</a>
        <div class='accordion__content'></div>
        <a class='accordion__button accordion__button_custom'  href='{{route("comcashPage", ["support"])}}'>{{__("front.SupportMenu")}}</a>
    </div>
</div>
<button class='header__burger button'>
    <img src='/comcash/img/icons/burger.svg' alt="Comcash"/>
    <img src='/comcash/img/icons/burger-cross.svg' alt="Comcash"/>
</button>
