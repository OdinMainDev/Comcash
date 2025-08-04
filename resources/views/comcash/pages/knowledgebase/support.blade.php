@extends('comcash.layout.main')

@section('content')
<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="flex justify-between items-start gap-[24px] flex-nowrap mx-auto">
        <div class="flex flex-col gap-[24px] text-[14px] text-white/40 max-w-[640px] mb-6 transition-all duration-300 ease-in-out">

            <h2 class="text-[32px] font-bold text-[#06AB6B] uppercase">{{ __('front.supportTitle') }}</h2>
            <span class="text-[#FFFFFF] text-[16px]">{{ __('front.supportSubtitle') }}</span>

            <div class="flex flex-nowrap
              text-[#F1F1F1] text-[14px]" style="font-size: clamp(10px, 2.7vw, 14px);">

                <p class="flex items-center gap-2 px-2 leading-tight max-[600px]:px-0 max-[719px]:flex">
                    <svg class="h-[17px] w-[17px] flex-shrink-0 max-[510px]:hidden" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M6 11.875C3.035 11.875 0.625 9.465 0.625 6.5C0.625 3.535 3.035 1.125 6 1.125C8.965 1.125 11.375 3.535 11.375 6.5C11.375 9.465 8.965 11.875 6 11.875ZM6 1.875C3.45 1.875 1.375 3.95 1.375 6.5C1.375 9.05 3.45 11.125 6 11.125C8.55 11.125 10.625 9.05 10.625 6.5C10.625 3.95 8.55 1.875 6 1.875Z" fill="#F1F1F1"></path>
                        <path opacity="0.4" d="M7.85501 8.465C7.79001 8.465 7.72501 8.45 7.66501 8.41L6.11501 7.485C5.73001 7.255 5.44501 6.75 5.44501 6.305V4.255C5.44501 4.05 5.61501 3.88 5.82001 3.88C6.02501 3.88 6.19501 4.05 6.19501 4.255V6.305C6.19501 6.485 6.34501 6.75 6.50001 6.84L8.05001 7.765C8.23001 7.87 8.28501 8.1 8.18001 8.28C8.10501 8.4 7.98001 8.465 7.85501 8.465Z" fill="#F1F1F1"></path>
                    </svg>

                    <span>
                        {{ __('front.headerWorkingTime1') }}
                        <span class="flex-wrap text-[#06AB6B]">{{ __('front.headerWorkingTime5') }}&nbsp;12:00&nbsp;{{ __('front.headerWorkingTime3') }}&nbsp;00:00</span>
                    </span>
                </p>

                <div class="flex items-center justify-center px-2">
                    <svg width="1" height="12" viewBox="0 0 1 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="1" height="12" fill="white" fill-opacity="0.1"></rect>
                    </svg>
                </div>

                <p class="flex items-center gap-2 px-2 leading-tight max-[600px]:px-0 max-[719px]:flex">
                    <svg class="h-[17px] w-[17px] flex-shrink-0 max-[510px]:hidden" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M7.61997 11.875H4.37997C3.43497 11.875 2.74497 11.48 2.47997 10.8C2.20497 10.09 2.45997 9.21 3.11997 8.615L5.43997 6.5L3.11997 4.385C2.45997 3.79 2.20497 2.91 2.47997 2.2C2.74497 1.515 3.43497 1.125 4.37997 1.125H7.61997C8.56497 1.125 9.25497 1.52 9.51997 2.2C9.79497 2.91 9.53997 3.79 8.87997 4.385L6.55997 6.5L8.88497 8.615C9.53997 9.21 9.79997 10.09 9.52497 10.8C9.25497 11.48 8.56497 11.875 7.61997 11.875ZM5.99997 7.005L3.62497 9.165C3.20497 9.55 3.01997 10.11 3.17997 10.525C3.32997 10.91 3.75497 11.125 4.37997 11.125H7.61997C8.24497 11.125 8.66997 10.915 8.81997 10.525C8.97997 10.11 8.79997 9.55 8.37497 9.165L5.99997 7.005ZM4.37997 1.875C3.75497 1.875 3.32997 2.085 3.17997 2.475C3.01997 2.89 3.19997 3.45 3.62497 3.835L5.99997 5.995L8.37497 3.835C8.79497 3.45 8.97997 2.89 8.81997 2.475C8.66997 2.09 8.24497 1.875 7.61997 1.875H4.37997Z" fill="#F1F1F1"></path>
                    </svg>

                    <span>
                        {{ __('front.headerClearExchangesTime1') }}
                        <span class="flex-wrap text-[#06AB6B]">{{ __('front.headerWorkingTime3') }}&nbsp;30&nbsp;{{ __('front.minutes') }}</span>
                    </span>
                </p>
            </div>
            <form 
                action="{{route("comcashSupport")}}"
                class="bg-[#1E1E1ECC] backdrop-blur-xl rounded-lg space-y-6 w-full mx-auto ">
                @csrf
                <div class="flex gap-4">
                    <div class="relative w-1/2">
                        <input 
                            type="text" 
                            name="name" 
                            @auth 
                                value="{{auth()->user()->first_name. 
                                    " ".
                                    auth()->user()->second_name.
                                    " ".auth()->user()->last_name}}" 
                            @endauth 

                            class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">

                        <label for="name" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                peer-placeholder-shown:top-[18px]
                                peer-placeholder-shown:text-base
                                peer-placeholder-shown:text-white/30
                                peer-focus:top-[8px]
                                peer-focus:text-sm
                                peer-focus:text-emerald-400
                                peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                                peer-[&amp;:not(:placeholder-shown)]:text-sm
                                peer-[&amp;:not(:placeholder-shown)]:text-white">
                            {{ __('front.your name') }}
                        </label>
                    </div>

                    <div class="relative w-1/2">
                        <input type="text" name="exchange_id" class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">
                        <label for="exchangeId" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                peer-placeholder-shown:top-[18px]
                                peer-placeholder-shown:text-base
                                peer-placeholder-shown:text-white/30
                                peer-focus:top-[8px]
                                peer-focus:text-sm
                                peer-focus:text-emerald-400
                                peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                                peer-[&amp;:not(:placeholder-shown)]:text-sm
                                peer-[&amp;:not(:placeholder-shown)]:text-white">
                            {{ __('front.exchange id') }}
                        </label>
                    </div>
                </div>

                <div class="relative w-full">
                    <input 
                        type="email" 
                        name="email" 
                        @auth 
                            value="{{auth()->user()->email}}" 
                        @endauth  
                        class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">
                    <label for="email" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                            peer-placeholder-shown:top-[18px]
                            peer-placeholder-shown:text-base
                            peer-placeholder-shown:text-white/30
                            peer-focus:top-[8px]
                            peer-focus:text-sm
                            peer-focus:text-emerald-400
                            peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                            peer-[&amp;:not(:placeholder-shown)]:text-sm
                            peer-[&amp;:not(:placeholder-shown)]:text-white">
                        E-mail
                    </label>
                </div>

                <div class="relative w-full">
                    <textarea id="message" name="message" placeholder=" " rows="4" required="" class="peer w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all resize-none"></textarea>
                    <label for="message" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                            peer-placeholder-shown:top-[18px]
                            peer-placeholder-shown:text-base
                            peer-placeholder-shown:text-white/30
                            peer-focus:top-[8px]
                            peer-focus:text-sm
                            peer-focus:text-emerald-400
                            peer-[&amp;:not(:placeholder-shown)]:top-[6px]
                            peer-[&amp;:not(:placeholder-shown)]:text-sm
                            peer-[&amp;:not(:placeholder-shown)]:text-white">
                            {{ __('front.message') }}
                    </label>
                </div>

                <button type="submit" class="w-full text-white py-3 rounded-full text-[18px] transition h-[62px] shadow-[0px_4px_20px_0px_#00000026] hover:opacity-90" style="background:linear-gradient(0deg,#009C74,#009C74),linear-gradient(95.62deg,#06AB6B 70.57%,#009C74 383.64%);">
                    {{ __('front.send message') }}
                </button>
            </form>
            <div class="flex items-center justify-between rounded-lg text-white max-[400px]:mb-10">
                <div class="w-full md:w-1/2 space-y-4">
                    <h2 class="text-[#06AB6B] text-[24px] uppercase">{{ __('front.contactDirectlyQuestion') }}</h2>
                    <ul class="space-y-4 text-sm md:text-base">
                        <li class="flex items-center gap-2">
                            <span>
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M1.23905 6.97664C6.06882 4.89792 9.29024 3.52799 10.9031 2.86591C15.5088 0.97591 16.4623 0.647287 17.0864 0.636452C17.2227 0.634243 17.5303 0.667904 17.7281 0.826746C17.8951 0.961287 17.9434 1.14243 17.9654 1.26982C17.9874 1.39731 18.0137 1.68743 17.9917 1.91412C17.7412 4.50145 16.6646 10.7804 16.1152 13.6785C15.8822 14.9046 15.4252 15.3157 14.9814 15.3564C14.221 15.4252 13.6014 14.9914 12.9158 14.5077C12.7356 14.3807 12.5511 14.2506 12.3577 14.1248C11.593 13.6319 11.0041 13.2365 10.4153 12.8396C9.8747 12.4761 9.33414 12.1123 8.6574 11.6719C7.2467 10.7554 7.8399 10.1947 8.62224 9.44625C8.74968 9.32539 8.88585 9.19894 9.0133 9.06556L9.75599 8.37896C11.0393 7.20112 13.518 4.92506 13.5795 4.66197C13.5882 4.63757 13.5927 4.57687 13.5795 4.51292C13.5706 4.46242 13.5487 4.40983 13.5048 4.37238C13.408 4.2878 13.263 4.31652 13.162 4.33987C13.0697 4.35944 12.1863 4.92233 10.5032 6.02864C9.4001 6.75321 7.95423 7.71089 6.16995 8.90177C5.77004 9.17128 5.39645 9.35789 5.04492 9.46087C4.81199 9.52978 4.5878 9.56175 4.37255 9.55744C3.77925 9.5444 2.64101 9.22714 1.79719 8.95553L1.43245 8.8416C0.571047 8.5742 -0.0573693 8.37844 0.00415635 7.88067C0.0437101 7.5856 0.452418 7.28464 1.23905 6.97664Z" fill="#F1F1F1" />
                                </svg>
                            </span> comcash_exchange
                        </li>
                        <li class="flex items-center gap-2">
                            <span>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.4" clip-path="url(#clip0_604_4295)">
                                        <path d="M6.2325 11.22C8.7975 11.0625 10.98 10.2675 12.5175 7.99502C13.9725 5.84252 13.935 3.73502 12.57 1.88252C10.98 -0.269977 7.3125 0.0825227 7.3125 0.0825227C7.3125 0.0825227 10.71 -0.577477 13.95 1.83002C17.19 4.23752 18.15 8.49752 16.38 11.85C14.61 15.2025 11.46 16.5525 8.1 16.2675C5.805 18.1125 3.015 18 3.015 18C3.015 18 4.08 17.0325 5.235 15.5625C3.75 14.94 1.095 13.29 0.592504 10.2C0.0900035 7.11002 1.4925 5.76002 1.4925 5.76002C-0.209996 9.21002 3.4275 11.3925 6.2325 11.22ZM13.3425 5.50502C13.3425 5.50502 13.8975 1.70252 9.96 0.457523C7.875 -0.202477 5.37 0.375023 3.915 1.40252C2.4075 2.46752 1.695 4.09502 1.7925 4.36502C1.9125 4.71002 3.015 3.37502 5.1675 2.85002C7.41 2.30252 10.95 2.75252 13.3425 5.50502ZM10.71 9.57002C10.53 5.82752 6.015 3.04502 2.6925 4.84502C5.0325 3.89252 7.2525 5.04002 7.8975 7.93502C8.2275 9.40502 7.86 10.785 7.86 10.785C7.86 10.785 9.8175 10.4475 10.71 9.57002ZM7.8075 8.20502C7.185 3.57002 1.5975 3.78752 1.2 6.89252C0.967503 8.70752 1.965 9.39002 1.965 9.39002C3.27 6.99002 6.6975 7.39502 7.8075 8.20502Z" fill="#F1F1F1" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_604_4295">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span> Jabber: Comcash@exploit.im
                        </li>
                        <li class="flex items-center gap-2">
                            <span>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.4" clip-path="url(#clip0_604_4295)">
                                        <path d="M6.2325 11.22C8.7975 11.0625 10.98 10.2675 12.5175 7.99502C13.9725 5.84252 13.935 3.73502 12.57 1.88252C10.98 -0.269977 7.3125 0.0825227 7.3125 0.0825227C7.3125 0.0825227 10.71 -0.577477 13.95 1.83002C17.19 4.23752 18.15 8.49752 16.38 11.85C14.61 15.2025 11.46 16.5525 8.1 16.2675C5.805 18.1125 3.015 18 3.015 18C3.015 18 4.08 17.0325 5.235 15.5625C3.75 14.94 1.095 13.29 0.592504 10.2C0.0900035 7.11002 1.4925 5.76002 1.4925 5.76002C-0.209996 9.21002 3.4275 11.3925 6.2325 11.22ZM13.3425 5.50502C13.3425 5.50502 13.8975 1.70252 9.96 0.457523C7.875 -0.202477 5.37 0.375023 3.915 1.40252C2.4075 2.46752 1.695 4.09502 1.7925 4.36502C1.9125 4.71002 3.015 3.37502 5.1675 2.85002C7.41 2.30252 10.95 2.75252 13.3425 5.50502ZM10.71 9.57002C10.53 5.82752 6.015 3.04502 2.6925 4.84502C5.0325 3.89252 7.2525 5.04002 7.8975 7.93502C8.2275 9.40502 7.86 10.785 7.86 10.785C7.86 10.785 9.8175 10.4475 10.71 9.57002ZM7.8075 8.20502C7.185 3.57002 1.5975 3.78752 1.2 6.89252C0.967503 8.70752 1.965 9.39002 1.965 9.39002C3.27 6.99002 6.6975 7.39502 7.8075 8.20502Z" fill="#F1F1F1" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_604_4295">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            Jabber: Comcash_support@exploit.im
                        </li>
                        <li class="flex items-start gap-2">
                            <span>
                                <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.3">
                                        <path d="M8.58445 6H9.42961C10.5511 6.09984 11.6536 6.60258 12.3848 7.47094C13.0317 8.22891 13.3425 9.23086 13.358 10.218C13.365 10.9683 13.358 11.7185 13.3594 12.4688C13.8966 12.4877 14.4415 12.4223 14.973 12.5173C15.5587 12.6305 16.0748 13.0376 16.316 13.5832C16.4707 13.9144 16.5248 14.2835 16.5234 14.647C16.5227 17.0616 16.5248 19.4768 16.522 21.892C16.522 22.4159 16.3673 22.9545 16.0186 23.3545C15.7219 23.704 15.2916 23.9212 14.8437 24H3.42141C2.95523 23.9578 2.48344 23.8095 2.13188 23.4895C1.67906 23.0951 1.47305 22.482 1.47727 21.8934C1.47727 19.4311 1.47375 16.9688 1.47938 14.5071C1.47867 13.7906 1.82883 13.0446 2.48414 12.7092C3.14719 12.3513 3.92133 12.5004 4.64063 12.4688C4.64273 11.7171 4.63641 10.9662 4.64344 10.2145C4.66102 9.24563 4.96125 8.26266 5.58773 7.51102C6.3225 6.62016 7.44398 6.10125 8.58445 6ZM7.66406 8.11641C6.88852 8.56641 6.41039 9.46992 6.47508 10.3636C6.5032 10.9873 6.82313 11.5941 7.34133 11.947C7.98328 12.3963 8.80523 12.4709 9.56461 12.3998C9.52172 12.8941 9.26437 13.3266 9.0007 13.7337C9.39797 13.5916 9.77977 13.4032 10.1264 13.162C10.7585 12.7247 11.2233 12.056 11.4033 11.3079C11.6079 10.467 11.6114 9.49875 11.0749 8.77453C10.3331 7.71633 8.7518 7.4625 7.66406 8.11641ZM7.62469 15.0991C7.14445 15.592 6.97641 16.3563 7.1993 17.0067C7.37859 17.5334 7.79133 17.9862 8.31445 18.1852C7.6282 18.4313 6.9975 18.9094 6.69023 19.5837C6.40547 20.1722 6.46875 20.8423 6.47578 21.4758C6.48211 21.833 6.81539 22.1198 7.16766 22.0995C8.36508 22.103 9.5625 22.103 10.7606 22.0995C11.0285 22.1072 11.3048 21.9567 11.4033 21.7001C11.5095 21.3787 11.4427 21.0321 11.4609 20.7002C11.4877 20.1005 11.2387 19.5091 10.8091 19.0943C10.4625 18.7259 9.98578 18.5325 9.58922 18.2316C10.0329 18.0403 10.4512 17.745 10.6777 17.3063C11.1298 16.4857 10.8626 15.3551 10.0758 14.8397C9.3375 14.3159 8.2357 14.4298 7.62469 15.0991Z" fill="#F1F1F1" />
                                    </g>
                                </svg>
                            </span>

                            <div class="flex flex-col">
                                <div class="flex items-center gap-1">
                                    <span class="font-medium">qTox:</span>
                                    <button onclick="copyToxID(this)" class="relative hover:opacity-70" data-tox="44F916D1AEA991BD510171AD4E48BCB80E34702A11FA9295E7C541FB67A32D762588CFCB44B9">
                                        <div class="absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-1 text-xs bg-black text-white rounded opacity-0 transition-opacity pointer-events-none" role="tooltip">Скопировано</div>

                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.325 17.0625H5.175C2.2425 17.0625 0.9375 15.7575 0.9375 12.825V9.675C0.9375 6.7425 2.2425 5.4375 5.175 5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V12.825C12.5625 15.7575 11.2575 17.0625 8.325 17.0625ZM5.175 6.5625C2.85 6.5625 2.0625 7.35 2.0625 9.675V12.825C2.0625 15.15 2.85 15.9375 5.175 15.9375H8.325C10.65 15.9375 11.4375 15.15 11.4375 12.825V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H5.175Z" fill="#06AB6B"></path>
                                            <path d="M12.825 12.5625H12C11.6925 12.5625 11.4375 12.3075 11.4375 12V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H6C5.6925 6.5625 5.4375 6.3075 5.4375 6V5.175C5.4375 2.2425 6.7425 0.9375 9.675 0.9375H12.825C15.7575 0.9375 17.0625 2.2425 17.0625 5.175V8.325C17.0625 11.2575 15.7575 12.5625 12.825 12.5625ZM12.5625 11.4375H12.825C15.15 11.4375 15.9375 10.65 15.9375 8.325V5.175C15.9375 2.85 15.15 2.0625 12.825 2.0625H9.675C7.35 2.0625 6.5625 2.85 6.5625 5.175V5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V11.4375Z" fill="#06AB6B"></path>
                                        </svg>
                                    </button>
                                </div>

                                <span class="break-all text-[16px] text-[#F1F1F1] mt-4 max-[400px]:mt-7 max-[400px]:absolute max-[400px]:max-w-[78%]">44F916D1AEA991BD510171AD4E48BCB80E34702A11FA9295E7C541FB67A32D762588CFCB44B9
                                </span>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="w-full md:w-1/3 flex justify-end mt-0 mb-auto">
                    <img src="/comcash/img/phone.webp" alt="Phone Icon" class="max-w-[200px] w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection