@extends('comcash.layout.main')

@section('content')
    <div class="safety">
        <p class="personal__title-mobile">{{__("front.client panel")}}</p>
        <div class="safety__container">
            @include("comcash.component.profile_menu")
            <form class="safety__content" action="{{route("myprofile2faPost")}}">
                @csrf
                <div class="safety__input-box">
                    <div class='label'>
                        <span>{{__("front.2fa_image_label")}}</span>
                    </div>
                    <div class='input-password'>
                        <img src="{{$qrcode}}" class="progress__box-img" title="" />
                    </div>
                </div>
                <div class="safety__input-box">
                    <div class='label'>
                        <span>{{__("front.2fa_otp_label")}}</span>
                    </div>
                    <div class='input-password'>
                        <input type='password' class='input  input--large' name="otppassword" placeholder='{{__("front.2fa_otp_label")}}' />
                        <a class='input-password__eye '></a>
                    </div>
                </div>
                <input type="hidden" id="otpsecret" name="otpsecret" autocomplete="off" value="{{$secret}}">

                <button type="submit" class='button safety__button'>{{__("front.save")}}</button>
            </form>
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
