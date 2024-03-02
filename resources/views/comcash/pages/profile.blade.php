@extends('comcash.layout.main')

@section('content')
    <div class="personal">
        <p class="personal__title-mobile">{{__("front.client panel")}}</p>
        <div class="personal__container">
            @include("comcash.component.profile_menu")
            <form class="personal__content" action="{{route("myprofilePost")}}" id="myProfileForm">
                @csrf
                <div class="personal__top">
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.first_name")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="first_name" value="{{auth()->user()->first_name}}">
                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.second_name")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="second_name" value="{{auth()->user()->second_name}}">
                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.last_name")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="last_name" value="{{auth()->user()->last_name}}">
                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.email")}}</span>
                        </div>
                        <div class="flex align-center">
                            <input type="text" class="input input--large mr-[10px]" name="email" value="{{auth()->user()->email}}" @if(auth()->user()->email_verified_at > 0) disabled @endif>
                            @if(auth()->user()->email_verified_at == 0) 
                                <button type="submit" class='button personal__button' onclick="document.getElementById('myProfileForm').setAttribute('action', '{{route('myprofileVerifyPost')}}');">{{__("front.verifyEmail")}}</button>
                            @endif
                        </div>

                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.telegram")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="telegram" value="{{auth()->user()->telegram}}">
                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.phone")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="phone" value="{{auth()->user()->phone}}">
                    </div>
                    <div class="input-box">
                        <div class='label'>
                            <span>{{__("front.passport")}}</span>
                        </div>
                        <input type="text" class="input input--large" name="passport" value="{{auth()->user()->passport}}">
                    </div>
                </div>
                <div class="personal__bottom">
                    <button type="submit" class='button personal__button' document.getElementById('myProfileForm').setAttribute('action', '{{route('myprofilePost')}}');">{{__("front.save")}}</button>
                </div>
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