@extends('comcash.layout.main')

@section('content')
<section class="relative max-[720px]:mt-[1rem] mt-[2rem] mx-auto h-auto flex flex-col  w-full max-[400px]:px-[20px] max-[700px]:px-[40px] max-w-[600px] max-[720px]:max-w-[640px] ">
    <span class="text-[#06AB6B] font-semibold uppercase text-[32px] leading-[140%] mb-4">
        {{ __('front.faqPageTitle') }}
    </span>
    <div>
        <div class="flex items-center">
            <span class="text-white uppercase text-[18px] leading-[140%] mr-4">
                {{ __('front.faqPageText1') }}
            </span>
            <div class="flex h-[1px] bg-[#06AB6B] max-w-[100px] min-w-[80px] w-full"></div>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-8">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText2') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText3') }}
            </p>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-2">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText4') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText5') }}
            </p>
        </div>
    </div>
    <div class="mt-4">
        <div class="flex items-center">
            <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4">
                 {{ __('front.faqPageText6') }}
            </span>
            <div class="flex-1 h-[1px] bg-[#06AB6B]"></div>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-8">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText7') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText8') }}

            </p>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText9') }}
            </p>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-2">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText10') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText11') }}
            </p>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-2">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText12') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText13') }}
                 {{ __('front.faqPageText14') }}
            </p>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-2">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText15') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText16') }}
            </p>
        </div>
    </div>

    <div class="mt-4">
        <div class="flex items-center">
            <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4">
                 {{ __('front.faqPageText17') }}
            </span>
            <div class="flex-1 h-[1px] bg-[#06AB6B]"></div>
        </div>
        <div class="text-white max-[400px]:text-[20px] gap-[40px] mb-4 p-[24px] rounded-[10px] bg-[#FFFFFF0D]/5 backdrop-blur-[20px] mt-8">
            <span class="text-white text-[18px] leading-[140%]">
                 {{ __('front.faqPageText18') }}
            </span>
            <p class="text-[#FFFFFFB2]/70 text-[14px] mt-6">
                 {{ __('front.faqPageText19') }}
            </p>
        </div>
    </div>

</section>
@endsection