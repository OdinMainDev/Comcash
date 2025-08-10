@extends('comcash.layout.main')

@section('content')
<section
    class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
    <h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
        {{__("front.client panel")}}
    </h2>
    <div class="flex max-[720px]:block">

        @include('comcash.component.profile_sidebar', [
        'active' => '2fa'
        ])

        <div class="flex-1">

            <div id="tab-2fa" class="tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">
                        {{__("front.personDoubleAuthLabel")}}
                    </span>
                    <div class="flex-1 h-[1px] bg-[#06AB6B]"></div>
                </div>
                <div class="hidden max-[400px]:flex items-center justify-between mb-4">
                    <button class="back-to-main-tabs text-[#666666] text-[15px] uppercase">
                        <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.66667 1L0.999999 5L5.66666 9" stroke="white" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <p class="text-[16px] uppercase">
                        {{__("front.personDoubleAuthLabel")}}
                    </p>
                </div>
                <form class="flex flex-col gap-[14px]" action="{{route("myprofile2faPost")}}">
                    @csrf
                    <div
                        class="grid max-[900px]:grid-cols-[50%_50%] grid-cols-[60%_40%] max-[500px]:grid-cols-1 p-[24px] rounded-[20px] bg-white/5 items-center">
                        <p class="mb-2 text-[16px] min-[500px]:hidden">{{__("front.qr_code_double_auth")}}</p>
                        <div class="w-full max-[500px]:order-2 max-[500px]:mt-2 max-[500px]:self-stretch">
                            <p class="mb-2 text-[16px] max-[500px]:hidden">
                                {{__("front.qr_code_double_auth")}}
                            </p>
                            <input 
                                type="password" 
                                name="otppassword" 
                                placeholder='{{__("front.2fa_otp_label")}}'
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <div class="max-[500px]:justify-self-center justify-self-end">
                            <img src="{{$qrcode}}" class="w-full max-w-[196px] h-[196px] w-[196px] p-3 bg-white rounded-[10px]" title="" />
                        </div>
                    </div>

                    <input type="hidden" id="otpsecret" name="otpsecret" autocomplete="off" value="{{$secret}}">
                    <div class="flex justify-center mt-2">
                        <button type="submit"
                            class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
                            style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
                            {{__("front.save")}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('js')
@if(isset($auth_modal) && $auth_modal)
<script>
    window.openAuthModal = true;
</script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const headerHeight = document.querySelector('header')?.offsetHeight;
        const footerHeight = document.querySelector('footer')?.offsetHeight;

        document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
        document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
    });
</script>
@endsection