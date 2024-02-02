@extends('comcash.layout.main')

@section('content')

<div class="accounts">
	<div class="accounts__container">
        @include("comcash.component.profile_menu")
		<div class="accounts__content">
            @include("comcash.component.affiliate_menu")
			<form action="{{route("myprofileAffiliateBalancesPost")}}">
				<div class="input-box">
					<div class='label'>
						<span>{{__("front.affiliate withdraw currency")}}</span>
					</div>
					<select class="input input--large" name="currency" id="currency">
						@foreach($balances as $balance)
							<option value="{{$balance->currency}}">{{$balance->getCurrency->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="input-box">
					<div class='label'>
						<span>{{__("front.affiliate withdraw balance")}}</span>
					</div>
					<input type="text" class="input input--large" placeholder="..." name="amount" id="amount">
				</div>
				<div class="input-box">
					<div class='label'>
						<span>{{__("front.affiliate withdraw address")}}</span>
					</div>
					<input type="text" class="input input--large" placeholder="..." name="address" id="address">
				</div>
				<button type="submit" class='button accounts__button'>{{__("front.affiliate withdraw button")}}</button>
			</form>
			<div class="accounts__list">
				<p class="accounts__list-title">{{__("front.affiliate my balances")}}</p>
				@foreach($balances as $balance)
				<div class='accounts__list-row'>
					<div class='accounts__list-item'>
						<p>{{$balance->getCurrency->name}}</p>
					</div>
					<div class='accounts__list-item'> {{sprintf("%.12f", $balance->balance)}}</div>
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
