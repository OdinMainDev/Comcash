<?php // profile_menu ?>
<div class="profile-menu">
    <div class='profile-menu__nav'>
        <a href='{{route("myprofile")}}' class="profile-menu__link ">{{__("front.client panel")}}</a>
        <a href='{{route("myprofileExchanges")}}' class="profile-menu__link">{{__("front.exchanges history")}}</a>
        <a href='{{route("myprofileAffiliate")}}' class="profile-menu__link">{{__("front.profile affiliate")}}</a>
        <a href='{{route("myprofilePassword")}}' class="profile-menu__link">{{__("front.security")}}</a>
        @if(!auth()->user()->google2fa_secret || auth()->user()->google2fa_secret == "")
            <a href='{{route("myprofile2fa")}}' class="profile-menu__link">{{__("menu.2fa")}}</a>
        @endif
        <a href='{{route("logout")}}' class="profile-menu__link">{{__("front.log out")}}</a>
    </div>
</div>