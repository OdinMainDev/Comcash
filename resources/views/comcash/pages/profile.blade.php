@extends('comcash.layout.main')

@section('content')


<section
    class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
    <h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
        {{__("front.client panel")}}
    </h2>
    <div class="flex max-[720px]:block">

        @include('comcash.component.profile_sidebar', [
        'active' => 'personal'
        ])

        <div class="flex-1">

            <div id="tab-personal" class="tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">
                        {{__("front.personInfoLabel")}}
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
                        {{__("front.personInfoLabel")}}
                    </p>
                </div>
                <form 
                    action="{{route("myprofilePost")}}" 
                    id="myProfileForm" 
                    class="flex flex-col gap-[14px]">
                    @csrf
                    <div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
                        <div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1">
                            <input 
                                type="text" 
                                placeholder="{{__("front.your name")}}"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none"
                                name="first_name"
                                value="{{auth()->user()->first_name}}"
                                >
                            <input 
                                name="second_name"
                                value="{{auth()->user()->second_name}}"
                                type="text" 
                                placeholder="{{__("front.exchangePageInputSecondName")}}"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <input 
                            name="last_name"
                            type="text" 
                            placeholder="{{__("front.exchangePageInputLastName")}}"
                            value="{{auth()->user()->last_name}}"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none"
                            >
                        <input 
                            type="email" 
                            placeholder="E-mail"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none"
                            name="email" 
                            value="{{auth()->user()->email}}" 
                            @if(auth()->user()->email_verified_at > 0) 
                                disabled 
                            @endif>

                        <!-- STYLE MARK -->
                        @if(auth()->user()->email_verified_at == 0)
                            <div class="mt-[15px] text-[#A4493B] text-[13px]">
                                {{__("front.profileNotVerifiedEmail")}} 
                            </div>
                        @endif
                        <!-- STYLE MARK -->

                        <div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1">
                            <input 
                                name="phone" 
                                value="{{auth()->user()->phone}}"
                                type="text" 
                                placeholder="{{__("front.phone")}}"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none"
                                >
                            <input 
                                name="telegram" 
                                value="{{auth()->user()->telegram}}"
                                type="text" 
                                placeholder="Telegram"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <input 
                            name="passport" 
                            value="{{auth()->user()->passport}}"
                            type="text" 
                            placeholder="{{__("front.passport")}}"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                    </div>

                    <div class="flex justify-center mt-2">
                        <button type="submit"
                            class="uppercase max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
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
@endsection