<?php // profile_menu ?>
<p class="personal__title-mobile">{{__("front.client panel")}}</p>
<div class="profile-menu">
    <div class='profile-menu__nav'>
        <a href='{{route("myprofile")}}' class="profile-menu__link ">{{__("front.client panel")}}</a>
        <!-- <a href='#' class="profile-menu__link">Мои счета</a>
        <a href='#' class="profile-menu__link">История транзации</a> -->
        <a href='{{route("myprofilePassword")}}' class="profile-menu__link">{{__("front.security")}}</a>
        <a href='{{route("logout")}}' class="profile-menu__link">{{__("front.log out")}}</a>
    </div>
</div>