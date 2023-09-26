@extends('comcash.layout.main')

@section('content')
    <div class="safety">
        <div class="safety__container">
            @include("comcash.component.profile_menu")
            <form class="safety__content" action="{{route("myprofilePasswordPost")}}">
                <div class="input-box">
                    <div class='label'>
                        <span>{{__("front.oldpassword_placeholder")}}</span>
                    </div>
                    <div class='input-password'>
                        <input type='password' class='input  input--large' name="oldpassword" placeholder='{{__("front.oldpassword_placeholder")}}' />
                        <a class='input-password__eye '></a>
                    </div>
                </div>
                <div class="input-box">
                    <div class='label'>
                        <span>{{__("front.password_placeholder")}}</span>
                    </div>
                    <div class='input-password'>
                        <input type='password' class='input  input--large' name="password" placeholder='{{__("front.password_placeholder")}}' />
                        <a class='input-password__eye '></a>
                    </div>
                </div>
                <div class="input-box">
                    <div class='label'>
                        <span>{{__("front.repassword_placeholder")}}</span>
                    </div>
                    <div class='input-password'>
                        <input type='password' class='input  input--large' name="repassword" placeholder='{{__("front.repassword_placeholder")}}' />
                        <a class='input-password__eye '></a>
                    </div>
                </div>
                
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