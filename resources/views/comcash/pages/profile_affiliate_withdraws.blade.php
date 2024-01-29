@extends('comcash.layout.main')

@section('content')

<div class="accounts">
	<div class="accounts__container">
        @include("comcash.component.profile_menu")
		<div class="accounts__content">
            @include("comcash.component.affiliate_menu")
			<div class="accounts__list">
				<p class="accounts__list-title">{{__("front.affiliate my withdraws")}}</p>
				@foreach($withdraws as $withdraw)
					<div class='accounts__list-row'>
						<div class='accounts__list-item'>
							<span>{{__("front.affiliate_withdraw_status".$withdraw->status)}}</span>
							<span>{{sprintf("%.12f", $withdraw->amount)}}</span>
							<span>{{$withdraw->reason}}</span>
						</div>
					</div>
				@endforeach
			</div>
			{{ $withdraws->withPath(route("myprofileAffiliateWithdraws"))->onEachSide(1)->links() }}
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
