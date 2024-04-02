@php
$currentRouteName = Route::currentRouteName();
@endphp

<div class="affiliate-menu">
    <a class="affiliate-menu__tab {{ $currentRouteName == 'myprofileAffiliate' ? 'active' : '' }}" href="{{route('myprofileAffiliate')}}">
        {{__("front.affiliate my campaigns")}}
    </a>
    <a class="affiliate-menu__tab {{ $currentRouteName == 'myprofileAffiliateExchanges' ? 'active' : '' }}" href="{{route('myprofileAffiliateExchanges')}}">
        {{__("front.affiliate my affiliates")}}
    </a>
    <a class="affiliate-menu__tab {{ $currentRouteName == 'myprofileAffiliateBalances' ? 'active' : '' }}" href="{{route('myprofileAffiliateBalances')}}">
        {{__("front.affiliate my balance")}}
    </a>
    <a class="affiliate-menu__tab {{ $currentRouteName == 'myprofileAffiliateWithdraws' ? 'active' : '' }}" href="{{route('myprofileAffiliateWithdraws')}}">
        {{__("front.affiliate my withdraws")}}
    </a>
</div>