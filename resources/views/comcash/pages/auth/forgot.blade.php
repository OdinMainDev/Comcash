@extends('comcash.layout.main')

@section('content')
<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="flex flex-col items-center px-4 sm:px-6 md:px-10">
        <div class="w-full flex flex-col gap-[10px] text-[14px] text-white/40 transition-all duration-300 ease-in-out">
            <div data-form="forgot">
                <div id="forgot-step-form"> 
                    <h2 class="text-[32px] font-bold mx-auto text-[#06AB6B] uppercase text-center">{{ __('front.passwordRecovery') }}</h2>
                    <p class="text-[#FFFFFF] max-[720px]:text-[14px] text-[16px] text-center mb-[60px] max-[720px]:mb-[30px]">{{ __('front.enterEmail') }}</p>

                    <form id="forgot-password" action="{{route("resetPasswordPost")}}" class="space-y-6 w-full mx-auto max-w-[600px]">
                        <div class="relative w-full">
                            <input id="forgot-email" name="email" type="email" required
                                placeholder=" " class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all" />
                            <label for="forgot-email"
                                class="pointer-events-none absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                    peer-placeholder-shown:top-[18px]
                                    peer-placeholder-shown:text-base
                                    peer-placeholder-shown:text-white/30
                                    peer-focus:top-[8px]
                                    peer-focus:text-sm
                                    peer-focus:text-emerald-400">
                                E-mail
                            </label>
                        </div>
                        <button type="submit"
                            class="w-full text-white py-3 rounded-full text-[18px] transition h-[62px] shadow-[0px_4px_20px_0px_#00000026] hover:opacity-90"
                            style="background:linear-gradient(0deg,#009C74,#009C74),linear-gradient(95.62deg,#06AB6B 70.57%,#009C74 383.64%);">
                            {{ __('front.continue') }}
                        </button>
                        <p class="text-center max-[720px]:text-[14px] text-[16px] text-white mt-2">
                            <a 
                                href="{{route("login")}}"
                                class="text-[#06AB6B] hover:opacity-70 transition-opacity ml-1">{{ __('front.goBack') }}</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>


    </div>

</section>
@endsection