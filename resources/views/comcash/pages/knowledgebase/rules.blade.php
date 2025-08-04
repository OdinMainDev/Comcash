@extends('comcash.layout.main')

@section('content')
<section class="relative max-[720px]:mt-[1rem] mt-[2rem] mx-auto h-auto flex flex-col  w-full max-[400px]:px-[20px] max-[700px]:px-[40px] max-w-[600px] max-[720px]:max-w-[640px] ">
    <div class="text-white max-[400px]:text-[20px] gap-[24px] mb-4">
        <span class="text-[#06AB6B] font-semibold uppercase text-[32px] leading-[140%]">{{ __('front.rulesPageTitle') }}</span>
        <span class="flex text-[16px] text-white mt-6 leading-[180%]">{{ __('front.rulesPageText') }}</span>
    </div>
    <div class="text-white max-[400px]:text-[20px] gap-[24px] mb-4">
        <span class="text-[#06AB6B] font-semibold uppercase text-[24px] leading-[140%]">
            {{ __('front.rulesPageTitle2') }}
        </span>
        <ol class="text-[16px] text-white mt-6 leading-[180%] list-decimal pl-5">
            <li>{{ __('front.rulesPageText2') }}</li>
            <li>{{ __('front.rulesPageText2_2') }}</li>
            <li>{{ __('front.rulesPageText2_3') }}</li>
            <li>{{ __('front.rulesPageText2_4') }}</li>
            <li>{{ __('front.rulesPageText2_5') }}</li>
            <li>{{ __('front.rulesPageTitle9') }}</li>
        </ol>
    </div>
    <div class="text-white max-[400px]:text-[20px] gap-[24px] mb-8">
        <span class="text-[#06AB6B] font-semibold uppercase text-[24px] leading-[140%]">
            {{ __('front.rulesPageTitle3') }}
        </span>
        <span class="flex text-[16px] text-white mt-6 leading-[180%]">
            {{ __('front.rulesPageText3') }}
        </span>
    </div>
    <div class="text-white max-[400px]:text-[20px] gap-[24px] mb-8">
        <span class="text-[#06AB6B] font-semibold uppercase text-[24px] leading-[140%]">
            {{ __('front.rulesPageTitle4') }}
        </span>
        <div class="text-white text-[16px] leading-[180%] space-y-8 mt-6">
            <p>
                {{ __('front.rulesPageText4') }}
            </p>
            <p>
                {{ __('front.rulesPageText4_2') }}
            </p>
            <p>
                {{ __('front.rulesPageText4_3') }}
            </p>
            <p>
                {{ __('front.rulesPageText4_4') }}
            </p>
        </div>
    </div>
    <div class="text-white max-[400px]:text-[20px] gap-[24px] mb-4">
        <span class="text-[#06AB6B] font-semibold uppercase text-[24px] leading-[140%]">
             {{ __('front.rulesPageTitle5') }}
        </span>
        <div class="text-white text-[16px] leading-[180%] space-y-8 mt-6">
            <p>
            {{ __('front.rulesPageText5') }}
            </p>
            <p>
            {{ __('front.rulesPageText5_2') }}
            </p>
            <p>
            {{ __('front.rulesPageText5_3') }}
            </p>
            <p>
            {{ __('front.rulesPageText5_4') }}
            </p>
            <p>
            {{ __('front.rulesPageText5_5') }}
            </p>
            <p>
            {{ __('front.rulesPageText5_6') }}
            </p>
        </div>
    </div>
</section>
@endsection