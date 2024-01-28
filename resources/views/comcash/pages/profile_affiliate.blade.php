@extends('comcash.layout.main')

@section('content')

<div class="accounts">
	<div class="accounts__container">
        @include("comcash.component.profile_menu")
		<div class="accounts__content">
            @include("comcash.component.affiliate_menu")
			<form action="{{route("myprofileAffiliatePost")}}">
				<div class="input-box">
					<div class='label'>
						<span>{{__("front.add affiliate campaign")}}</span>
					</div>
					<input type="text" class="input input--large" placeholder="{{__("front.affiliate campaign name")}}" name="name" id="name">
				</div>
				<button type="submit" class='button accounts__button'>{{__("front.create")}}</button>
			</form>
			<div class="accounts__list">
				<p class="accounts__list-title">{{__("front.affiliate my campaigns")}}</p>
				@foreach($campaigns as $campaign)
				<div class='accounts__list-row'>
					<div class='accounts__list-item'>
						<p>{{$campaign->name}}</p>
						<span>{{__("front.affiliate registered_users")}}: {{$campaign->registered_users}}</span>
						<span>{{__("front.affiliate profitable_users")}}: {{$campaign->profitable_users}}</span>
					</div>
					<div class='accounts__list-item'>{{route("checkAffiliate", ["hash" => $campaign->hash])}}</div>
				</div>
				@endforeach
				
			</div>
		</div>
	</div>
</div>
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const headerHeight = document.querySelector('header')?.offsetHeight;
          const footerHeight = document.querySelector('footer')?.offsetHeight;

          document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
          document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
      });
  </script>
@endsection
