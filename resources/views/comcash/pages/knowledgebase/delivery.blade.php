@extends('comcash.layout.main')

@section('content')
<section class="relative max-[620px]:mt-[-3rem] max-[720px]:mt-[3rem] mt-[6rem] pl-[20px] max-[420px]:pr-[0px] max-[620px]:px-[20px]">
    <div class="mx-auto w-full max-w-[1018px] max-[600px]:max-h-[504px] max-[900px]:max-h-[404px] max-h-[304px]
                flex lg:flex-row items-center justify-between rounded-[20px]
                 max-[620px]:pt-[90px]  max-[420px]:overflow-hidden">

        <div class="text-white flex-1 z-10 max-[420px]:max-w-[202px]">
            <h2 class="text-[28px] lg:text-[32px] font-bold leading-tight mb-2 uppercase text-[#06AB6B]">{{ __('front.page_delivery_title') }}</h2>
            <p class="text-[14px] leading-[160%] font-normal">
                {{ __('front.exchangeIntro') }}<span class="text-[#06AB6B]">{{ __('front.exchangeCurrenciesList') }}</span> {{ __('front.exchangeOutro') }}
            </p>
            <p class="max-[610px]:absolute flex text-[14px] leading-[160%] font-normal mt-6 namespace-nowrap">
                {{ __('front.exchangeGlobalPresence') }}
            </p>
        </div>

        <div class="flex-shrink-0
         max-[1050px]:block
         ">
            <img src="/comcash/img/cashkeys.webp" alt="Наличные в кейсе" class="max-[700px]:h-[250px] h-[350px] w-auto object-contain">
        </div>

    </div>
</section>

<section class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] mt-10 max-[610px]:mt-20">
    <div class="flex flex-col lg:flex-row gap-6 items-start relative">

        <div class="w-full flex max-[640px]:flex-wrap flex-nowrap  gap-6">
            <div class=" bg-[#2A2A2A] rounded-xl min-[640px]:p-5 p-[14px] h-auto flex flex-row min-[640px]:flex-col items-center gap-[12px] min-[640px]:items-start min-[640px]:justify-between">
                <svg class="shrink-0 min-[640px]:hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z" fill="#06AB6B"></path>
                    <path d="M10.5799 15.58C10.3799 15.58 10.1899 15.5 10.0499 15.36L7.21994 12.53C6.92994 12.24 6.92994 11.76 7.21994 11.47C7.50994 11.18 7.98994 11.18 8.27994 11.47L10.5799 13.77L15.7199 8.62998C16.0099 8.33998 16.4899 8.33998 16.7799 8.62998C17.0699 8.91998 17.0699 9.39998 16.7799 9.68998L11.1099 15.36C10.9699 15.5 10.7799 15.58 10.5799 15.58Z" fill="#06AB6B"></path>
                </svg>

                <div class="text-left">
                    <h3 class="min-[640px]:text-[20px] text-[18px] font-medium leading-[28px] min-[640px]:mb-2 uppercase">
                        {{ __('front.reliabilityAndSpeed') }}
                    </h3>
                    <p class="text-[14px] font-normal text-white/40 leading-[18px]">
                        {{ __('front.cashDeliveryGuarantee') }}
                    </p>
                </div>
            </div>
            <div class=" bg-[#2A2A2A] rounded-xl min-[640px]:p-5 p-[14px] h-auto flex flex-row min-[640px]:flex-col items-center gap-[12px] min-[640px]:items-start min-[640px]:justify-between">
                <svg class="shrink-0 min-[640px]:hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z" fill="#06AB6B"></path>
                    <path d="M10.5799 15.58C10.3799 15.58 10.1899 15.5 10.0499 15.36L7.21994 12.53C6.92994 12.24 6.92994 11.76 7.21994 11.47C7.50994 11.18 7.98994 11.18 8.27994 11.47L10.5799 13.77L15.7199 8.62998C16.0099 8.33998 16.4899 8.33998 16.7799 8.62998C17.0699 8.91998 17.0699 9.39998 16.7799 9.68998L11.1099 15.36C10.9699 15.5 10.7799 15.58 10.5799 15.58Z" fill="#06AB6B"></path>
                </svg>

                <div class="text-left">
                    <h3 class="min-[640px]:text-[20px] text-[18px] font-medium leading-[28px] min-[640px]:mb-2 uppercase">
                        {{ __('front.guaranteeOfAnonymity') }}
                    </h3>
                    <p class="text-[14px] font-normal text-white/40 leading-[18px]">
                        {{ __('front.anonymityPolicy') }}
                    </p>
                </div>
            </div>
            <div class=" bg-[#2A2A2A] rounded-xl min-[640px]:p-5 p-[14px] h-auto flex flex-row min-[640px]:flex-col items-center gap-[12px] min-[640px]:items-start min-[640px]:justify-between">
                <svg class="shrink-0 min-[640px]:hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z" fill="#06AB6B"></path>
                    <path d="M10.5799 15.58C10.3799 15.58 10.1899 15.5 10.0499 15.36L7.21994 12.53C6.92994 12.24 6.92994 11.76 7.21994 11.47C7.50994 11.18 7.98994 11.18 8.27994 11.47L10.5799 13.77L15.7199 8.62998C16.0099 8.33998 16.4899 8.33998 16.7799 8.62998C17.0699 8.91998 17.0699 9.39998 16.7799 9.68998L11.1099 15.36C10.9699 15.5 10.7799 15.58 10.5799 15.58Z" fill="#06AB6B"></path>
                </svg>

                <div class="text-left">
                    <h3 class="min-[640px]:text-[20px] text-[18px] font-medium leading-[28px] min-[640px]:mb-2 uppercase">
                        {{ __('front.actualRates') }}
                    </h3>
                    <p class="text-[14px] font-normal text-white/40 leading-[18px]">
                        {{ __('front.dontLoseMoney') }}
                    </p>
                </div>
            </div>

        </div>

    </div>
    <div class="text-white py-5 max-w-[1024px] mx-auto text-[14px] sm:text-[16px] leading-[160%] space-y-5 mt-10">
        <p>
            {{ __('front.locationNotice') }}
        </p>
        <p>
            <strong>{{ __('front.noteAttention') }}!</strong>{{ __('front.noteNoOfficeMention') }} <span class="italic">"{{ __('front.noteOffice') }}"</span>, {{ __('front.noteCourierWorksThere') }}
            {{ __('front.noteNoReceiveMention') }} <span class="italic">"{{ __('front.noteReceivePossible') }}"</span>, {{ __('front.noteOnlyCashOut') }}
        </p>
        <p>
            {{ __('front.noteInternationalTime') }} <strong>{{ __('front.note24Hours') }}</strong> {{ __('front.noteRecommendClarify') }}
        </p>
    </div>
</section>


@include("comcash.component.index.feedback_wedev")

@endsection