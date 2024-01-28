<?php // profile_menu ?>
<p class="personal__title-mobile">{{__("front.client panel")}}</p>
<div class="profile-menu">
    <div class='profile-menu__nav'>
        <a href='{{route("myprofile")}}' class="profile-menu__link ">{{__("front.client panel")}}</a>
        <a href='{{route("myprofileExchanges")}}' class="profile-menu__link">{{__("front.exchanges history")}}</a>
        <a href='{{route("myprofileAffiliate")}}' class="profile-menu__link">{{__("front.profile affiliate")}}</a>
        <a href='{{route("myprofilePassword")}}' class="profile-menu__link">{{__("front.security")}}</a>
        <a href='{{route("logout")}}' class="profile-menu__link">{{__("front.log out")}}</a>
    </div>
</div>