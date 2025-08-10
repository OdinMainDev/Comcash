@extends('comcash.layout.main')

@section('content')
        <section
            class="relative max-[720px]:mt-[1rem] mt-[4rem] mx-auto h-auto flex flex-col  w-full max-[1040px]:px-[20px] max-w-[1018px] max-[720px]:max-w-[640px]">
            <div class="flex flex-col">
                <span class="text-[#06AB6B] font-semibold uppercase
                                               text-[32px] max-[600px]:text-[24px]
                                               leading-[140%]">
                    {{__("front.cryptoRatesOnline")}}
                </span>

                <span class="mr-auto text-white/15 text-[18px]">
                    <?= date('d.m.Y'); ?>
                </span>

            </div>
            <div class="relative flex items-start max-w-[1018px] mb-10 mt-10">
            <?php 
                $html = \Illuminate\Support\Facades\Cache::get("comcash-view-tariffs", "loading");

                $translations = [
                    '{{you_sell}}' => __('front.you sell'),
                    '{{you_receive}}' => __('front.you receive'),
                ];

                $html = str_replace(array_keys($translations), array_values($translations), $html);

                echo $html;
            ?>


                <div class="justify-between min-w-[24px]"></div>
                <form method='POST' id="dynconverter" action="{{route("redirectToExchange")}}"
                    class="crypto-form__exchange-form max-[760px]:hidden relative flex items-center flex-wrap max-w-[280px] gap-[14px] sticky top-[160px]">
                    @csrf
                    <span
                        class="text-white uppercase max-[600px]:text-[16px] text-[18px] leading-[140%] uppercase mr-4 min-[720px]:whitespace-nowrap">
                        {{__("front.converter")}}
                    </span>
                    <div
                        class="welcome-exchange__block exchnage-panel-left input-block min-[720px]:flex-1 border rounded-[10px] p-[14px] gap-[8px] flex flex-col justify-between relative max-[720px]:mb-4 max-[720px]:w-full border-[#FFFFFF1A]/10 bg-[#1B1B1B]">
                        <div class="absolute top-[-25px] right-[-25px] pointer-events-none select-none max-[720px]:hidden">
                            <svg width="86" height="59" viewBox="0 0 86 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z" fill="#008D69"></path>
                                <path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z" fill="#009C74"></path>
                                <path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z" fill="#24DE96"></path>
                                <path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z" fill="#009C74">
                                </path>
                                <path d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
                                    fill="#24DE96"></path>
                                <path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z" fill="#14C37F">
                                </path>
                                <path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z" fill="#009C74">
                                </path>
                                <path d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
                                    fill="#14C37F"></path>
                                <path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z" fill="#24DE96">
                                </path>
                                <path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z" fill="#009C74"></path>
                                <path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z" fill="#007C5C">
                                </path>
                                <path
                                    d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
                                    fill="#008D69"></path>
                                <path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74"></path>
                                <path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z" fill="#24DE96">
                                </path>
                                <path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z" fill="#14C37F"></path>
                                <path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z" fill="#008D69"></path>
                                <path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z" fill="#24DE96"></path>
                                <path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z" fill="#14C37F"></path>
                                <path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z" fill="#008D69"></path>
                                <path d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
                                    fill="#24DE96"></path>
                                <path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z" fill="#009C74"></path>
                                <path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z" fill="#008D69"></path>
                                <path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z" fill="#009C74"></path>
                                <path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z" fill="#14C37F"></path>
                                <path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96"></path>
                            </svg>
                        </div>
                        <p class="text-sm mb-2">{{__("front.yousend")}}:</p>

                        <div class="flex flex-wrap items-start gap-2 min-w-0 max-w-[280px] w-full">
                            <input name="amount" id="inputAmount" data-focus-target=".input-block" type="text"
                                placeholder="0.00" inputmode="decimal"
                                class="welcome-exchange__input amount-send__input bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
                                autocomplete="off">

                            <div
                                class="welcome-exchange__select welcome-exchange-send__select dropdown relative inline-block min-w-[262px] max-w-full w-full w-auto  min-[810px]:mt-1">
                                <input class="hidden hidden-currency" name="currency_from">
                                <button type="button" data-focus-target=".input-block"
                                    class="welcome-exchange__select-selected  transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] text-white flex items-center justify-between hover:opacity-90 rounded-full bg-[#2A2A2A]">
                                    <div class="flex items-center gap-[12px] welcome-exchange__select-selected-value ">
                                        <img src="https://comcash.io/icons/Ethereum.png"
                                            class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" /></span>
                                        <span class="text-sm " data-label="">
                                            <div class="welcome-exchange__name">---</div>
                                            <span class="text-[#FFFFFF66]/40">

                                            </span>
                                        </span>
                                    </div>
                                    <svg class="welcome-exchange__arrow dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
                                        viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div class="welcome-exchange__select-list ">
                                    <div
                                        class="welcome-exchange__list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white " style="display:none">
                                            <div class="p-2">
                                                <input type="text" placeholder="Search..."
                                                    class="input-block w-full h-[36px] px-3 text-sm bg-[#2B2B2B] text-white rounded-[8px] focus:outline-none focus:border-[#06AB6B] focus:border placeholder:text-[#888]">
                                            </div>
                                            <div class="tab-list flex gap-2 px-2 pb-2">
                                            </div>
                                            <div class="list-items max-h-[200px] overflow-y-auto">
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center  absolute top-[37%] -right-4 z-10 welcome-exchange__icon-reverse">
                        <div id="switchButton" role="button" aria-label="Поменять направления" class="
                                                transition-all duration-300
                                                 hover:scale-105 hover:drop-shadow-[0_0_12px_rgba(6,171,107,0.5)]
                                                 cursor-pointer active:scale-95 ease-out
                                                 w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                            <svg class="pointer-events-none" width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="40" height="40" rx="20" fill="url(#paint0_linear_74_2055)"></rect>
                                <rect width="40" height="40" rx="20" fill="url(#paint1_linear_74_2055)"></rect>
                                <path
                                    d="M23.49 28.76C23.3 28.76 23.11 28.69 22.96 28.54C22.67 28.25 22.67 27.77 22.96 27.48L27.97 22.47C28.26 22.18 28.74 22.18 29.03 22.47C29.32 22.76 29.32 23.24 29.03 23.53L24.02 28.54C23.87 28.68 23.68 28.76 23.49 28.76Z"
                                    fill="white"></path>
                                <path
                                    d="M28.5 23.74H11.5C11.09 23.74 10.75 23.4 10.75 22.99C10.75 22.58 11.09 22.24 11.5 22.24H28.5C28.91 22.24 29.25 22.58 29.25 22.99C29.25 23.4 28.91 23.74 28.5 23.74Z"
                                    fill="white"></path>
                                <path
                                    d="M11.5 17.76C11.31 17.76 11.12 17.69 10.97 17.54C10.68 17.25 10.68 16.77 10.97 16.48L15.98 11.47C16.27 11.18 16.75 11.18 17.04 11.47C17.33 11.76 17.33 12.24 17.04 12.53L12.03 17.54C11.89 17.68 11.69 17.76 11.5 17.76Z"
                                    fill="white"></path>
                                <path
                                    d="M28.5 17.76H11.5C11.09 17.76 10.75 17.42 10.75 17.01C10.75 16.6 11.09 16.26 11.5 16.26H28.5C28.91 16.26 29.25 16.6 29.25 17.01C29.25 17.42 28.91 17.76 28.5 17.76Z"
                                    fill="white"></path>
                                <defs>
                                    <linearGradient id="paint0_linear_74_2055" x1="-73.0756" y1="65.8286" x2="108.36"
                                        y2="67.8085" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#06AB6B"></stop>
                                        <stop offset="0.723958" stop-color="#009C74"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_74_2055" x1="28.9733" y1="20.6667" x2="165.207"
                                        y2="34.0766" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#06AB6B"></stop>
                                        <stop offset="1" stop-color="#009C74"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="welcome-exchange__block exchnage-panel-right output-block min-[720px]:flex-1 border rounded-[10px] p-[14px] gap-[8px] flex flex-col justify-between relative max-[720px]:mb-4 max-[720px]:w-full border-[#FFFFFF1A]/10 bg-[#1B1B1B]">
                        <div
                            class="absolute top-[-25px] max-[600px]:right-[-20px] right-[-25px] pointer-events-none select-none min-[720px]:hidden">
                            <svg width="86" height="59" viewBox="0 0 86 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z" fill="#008D69"></path>
                                <path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z" fill="#009C74"></path>
                                <path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z" fill="#24DE96"></path>
                                <path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z" fill="#009C74">
                                </path>
                                <path d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
                                    fill="#24DE96"></path>
                                <path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z" fill="#14C37F">
                                </path>
                                <path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z" fill="#009C74">
                                </path>
                                <path d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
                                    fill="#14C37F"></path>
                                <path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z" fill="#24DE96">
                                </path>
                                <path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z" fill="#009C74"></path>
                                <path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z" fill="#007C5C">
                                </path>
                                <path
                                    d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
                                    fill="#008D69"></path>
                                <path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74"></path>
                                <path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z" fill="#24DE96">
                                </path>
                                <path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z" fill="#14C37F"></path>
                                <path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z" fill="#008D69"></path>
                                <path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z" fill="#24DE96"></path>
                                <path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z" fill="#14C37F"></path>
                                <path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z" fill="#008D69"></path>
                                <path d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
                                    fill="#24DE96"></path>
                                <path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z" fill="#009C74"></path>
                                <path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z" fill="#008D69"></path>
                                <path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z" fill="#009C74"></path>
                                <path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z" fill="#14C37F"></path>
                                <path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96"></path>
                            </svg>
                        </div>
                        <p class="text-sm mb-2">{{__("front.youreceive")}}:</p>

                        <div class="flex flex-wrap items-start gap-2 min-w-0 max-w-[280px] w-full">
                            <input id="outputAmount" data-focus-target=".output-block" type="text" placeholder="0.00"
                                inputmode="decimal"
                                class="welcome-exchange__input amount-get__input bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
                                autocomplete="off">

                            <div
                                class="welcome-exchange__select welcome-exchange-get__select dropdown relative inline-block min-w-[262px] max-w-full w-full w-auto min-[810px]:mt-1">
                                <input class="hidden hidden-currency" name="currency_to">
                                <button type="button" data-focus-target=".output-block"
                                    class="welcome-exchange__select-selected  transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] rounded-full bg-[#2A2A2A] text-white flex items-center justify-between hover:opacity-90">
                                    <div class="flex items-center gap-[12px] welcome-exchange__select-selected-value ">
                                        <img src="https://comcash.io/icons/Ethereum.png"
                                            class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" /></span>
                                        <span class="text-sm " data-label="">
                                            <div class="welcome-exchange__name">---</div>
                                            <span class="text-[#FFFFFF66]/40">

                                            </span>
                                        </span>
                                    </div>
                                    <svg class="welcome-exchange__arrow dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
                                        viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <div class="welcome-exchange__select-list ">
                                    <div
                                        class="welcome-exchange__list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white " style="display:none">
                                            <div class="p-2">
                                                <input type="text" placeholder="Search..."
                                                    class="input-block w-full h-[36px] px-3 text-sm bg-[#2B2B2B] text-white rounded-[8px] focus:outline-none focus:border-[#06AB6B] focus:border placeholder:text-[#888]">
                                            </div>
                                            <div class="tab-list flex gap-2 px-2 pb-2">
                                            </div>
                                            <div class="list-items max-h-[200px] overflow-y-auto">
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-wrap justify-between items-center text-white text-sm gap-[14px]">
                        <div class="w-full flex items-center px-2 flex-wrap justify-center">
                            <button type="submit" class="flex items-center justify-center h-[62px] max-[850px]:mt-6
                                                         w-full
                                                         min-[850px]:grow
                                                         bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
                                                         text-white text-[18px] gap-[12px] px-6 py-2
                                                         rounded-full shadow-[0px_4px_20px_#00000026]
                                                         hover:opacity-90 uppercase">
                            <span class="relative flex content-loader">
                                {{__("front.exchange")}}
                                <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z"
                                        fill="white"></path>
                                    <path
                                        d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            </button>
                            <div class="flex justify-center">
                                <p class="text-[12px] opacity-60 mt-4 min-[500px]:hidden whitespace-nowrap text-center">
                                    {{__("front.homePagePanelRatesInfo")}}
                                </p>
                            </div>

                        </div>
                        <div>
                            <p class="text-[14px] opacity-60 max-[500px]:hidden max-w-[160px]">{{__("front.homePagePanelRatesInfo")}}</p>
                        </div>

                        <div class="flex items-center gap-[14px]">
                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.7633 17.0625H6.9033C5.4858 17.0625 4.4508 16.47 4.0533 15.45C3.6408 14.385 4.0233 13.065 5.0133 12.1725L8.4933 9L5.0133 5.8275C4.0233 4.935 3.6408 3.615 4.0533 2.55C4.4508 1.5225 5.4858 0.9375 6.9033 0.9375H11.7633C13.1808 0.9375 14.2158 1.53 14.6133 2.55C15.0258 3.615 14.6433 4.935 13.6533 5.8275L10.1733 9L13.6608 12.1725C14.6433 13.065 15.0333 14.385 14.6208 15.45C14.2158 16.47 13.1808 17.0625 11.7633 17.0625ZM9.3333 9.7575L5.7708 12.9975C5.1408 13.575 4.8633 14.415 5.1033 15.0375C5.3283 15.615 5.9658 15.9375 6.9033 15.9375H11.7633C12.7008 15.9375 13.3383 15.6225 13.5633 15.0375C13.8033 14.415 13.5333 13.575 12.8958 12.9975L9.3333 9.7575ZM6.9033 2.0625C5.9658 2.0625 5.3283 2.3775 5.1033 2.9625C4.8633 3.585 5.1333 4.425 5.7708 5.0025L9.3333 8.2425L12.8958 5.0025C13.5258 4.425 13.8033 3.585 13.5633 2.9625C13.3383 2.385 12.7008 2.0625 11.7633 2.0625H6.9033Z"
                                    fill="#06AB6B"></path>
                            </svg>
                            <span class="exchangeTimer">00:00</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="min-[760px]:hidden sticky bottom-10 flex justify-center">
                <button id="openConverter"
                    class="bg-gradient-to-t from-[#009C74] to-[#06AB6B] shadow-md max-w-[335px] w-full h-[52px] rounded-[100px] px-6 flex items-center justify-center gap-2 uppercase text-white text-sm transition duration-300 hover:opacity-90">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.7922 17.008C12.6402 17.008 12.4882 16.952 12.3682 16.832C12.1362 16.6 12.1362 16.216 12.3682 15.984L16.3762 11.976C16.6082 11.744 16.9922 11.744 17.2242 11.976C17.4562 12.208 17.4562 12.592 17.2242 12.824L13.2162 16.832C13.0962 16.944 12.9442 17.008 12.7922 17.008Z"
                            fill="white"></path>
                        <path
                            d="M16.8001 12.992H3.2001C2.8721 12.992 2.6001 12.72 2.6001 12.392C2.6001 12.064 2.8721 11.792 3.2001 11.792H16.8001C17.1281 11.792 17.4001 12.064 17.4001 12.392C17.4001 12.72 17.1281 12.992 16.8001 12.992Z"
                            fill="white"></path>
                        <path
                            d="M3.20005 8.20801C3.04805 8.20801 2.89605 8.15201 2.77605 8.03201C2.54405 7.80001 2.54405 7.41601 2.77605 7.18401L6.78405 3.17601C7.01605 2.94401 7.40005 2.94401 7.63205 3.17601C7.86405 3.40801 7.86405 3.79201 7.63205 4.02401L3.62405 8.03201C3.51205 8.14401 3.35205 8.20801 3.20005 8.20801Z"
                            fill="white"></path>
                        <path
                            d="M16.8001 8.20806H3.2001C2.8721 8.20806 2.6001 7.93606 2.6001 7.60806C2.6001 7.28006 2.8721 7.00806 3.2001 7.00806H16.8001C17.1281 7.00806 17.4001 7.28006 17.4001 7.60806C17.4001 7.93606 17.1281 8.20806 16.8001 8.20806Z"
                            fill="white"></path>
                    </svg>
                    <span>{{__("front.converter")}}</span>
                </button>
            </div>

        </section>




        <div id="converterModal"
            class="fixed inset-0 bg-[#1E1E1E]/80 backdrop-blur-[10px] z-50 flex justify-center items-end hidden">

            <div class="w-full h-[70%] bg-[#1E1E1E] justify-center overflow-auto">
                <form method='POST' id="converterInner" action="{{route("redirectToExchange")}}"
                    class="crypto-form__exchange-form overflow-y-auto overflow-x-hidden relative w-full mx-auto max-w-[480px] bg-[#1E1E1E] rounded-t-[20px] pt-14 pb-6 px-6 flex flex-col gap-[10px] overflow-auto transition-transform duration-500 translate-y-full">
                    @csrf
                    <div
                        class="absolute top-4 left-0 w-full h-14 bg-[#1E1E1E] rounded-t-[20px] flex items-center justify-between px-6 z-10">
                        <span class="uppercase text-white text-[16px]">{{__("front.converter")}}</span>
                        <button id="closeConverter">
                            <svg class="hover:opactiy-90" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.8944 6.16636L6.16643 18.8943C5.87652 19.1842 5.39568 19.1842 5.10577 18.8943C4.81586 18.6044 4.81586 18.1235 5.10577 17.8336L17.8337 5.1057C18.1236 4.81579 18.6044 4.81579 18.8944 5.1057C19.1843 5.39561 19.1843 5.87645 18.8944 6.16636Z"
                                    fill="white"></path>
                                <path
                                    d="M17.8335 18.8943L5.10553 6.16637C4.81562 5.87645 4.81562 5.39562 5.10553 5.10571C5.39545 4.81579 5.87628 4.81579 6.16619 5.10571L18.8941 17.8336C19.184 18.1235 19.184 18.6044 18.8941 18.8943C18.6042 19.1842 18.1234 19.1842 17.8335 18.8943Z"
                                    fill="white"></path>
                            </svg>
                        </button>
                    </div>

                    <div
                        class="relative max-[800px]:max-w-[500px] max-[800px]:mt-[2rem] mt-[8rem] mx-auto w-full max-w-[1018px] h-auto lg:h-[334px] flex flex-col justify-between gap-8 lg:gap-[36px]">


                        <div class="relative flex flex-wrap gap-x-[min(36px,_1.5vw)] text-white max-[800px]:justify-center">

                            <div
                                class="welcome-exchange__block exchnage-panel-left input-block min-[800px]:flex-1 border border-[#FFFFFF1A]/10 bg-[#1B1B1B] rounded-[10px] p-5 flex flex-col justify-between relative max-[800px]:mb-4 max-[800px]:w-full">
                                <div
                                    class="absolute top-[-25px] max-[600px]:right-[-20px] right-[-25px] pointer-events-none select-none min-[800px]:hidden">
                                    <svg width="86" height="59" viewBox="0 0 86 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z" fill="#008D69">
                                        </path>
                                        <path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z" fill="#009C74">
                                        </path>
                                        <path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z" fill="#24DE96">
                                        </path>
                                        <path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z"
                                            fill="#009C74"></path>
                                        <path
                                            d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
                                            fill="#24DE96"></path>
                                        <path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z"
                                            fill="#14C37F"></path>
                                        <path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z"
                                            fill="#009C74"></path>
                                        <path
                                            d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
                                            fill="#14C37F"></path>
                                        <path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z"
                                            fill="#24DE96"></path>
                                        <path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z" fill="#009C74">
                                        </path>
                                        <path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z"
                                            fill="#007C5C"></path>
                                        <path
                                            d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
                                            fill="#008D69"></path>
                                        <path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74"></path>
                                        <path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z"
                                            fill="#24DE96"></path>
                                        <path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z"
                                            fill="#14C37F"></path>
                                        <path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z" fill="#008D69">
                                        </path>
                                        <path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z" fill="#24DE96">
                                        </path>
                                        <path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z"
                                            fill="#14C37F"></path>
                                        <path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z" fill="#008D69">
                                        </path>
                                        <path d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
                                            fill="#24DE96"></path>
                                        <path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z" fill="#009C74">
                                        </path>
                                        <path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z" fill="#008D69">
                                        </path>
                                        <path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z" fill="#009C74">
                                        </path>
                                        <path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z"
                                            fill="#14C37F"></path>
                                        <path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96"></path>
                                    </svg>
                                </div>
                                <p class="text-sm mb-2">{{__("front.yousend")}}:</p>

                                <div class="flex flex-wrap items-start gap-2 min-w-0 w-full">

                                    <div
                                        class="welcome-exchange__select welcome-exchange-send__select dropdown relative inline-block min-w-[262px] max-w-full max-[410px]:w-full w-auto min-[810px]:mt-1">
                                        <input class="hidden hidden-currency" name="currency_from">
                                        <button type="button" data-focus-target=".input-block"
                                            class="welcome-exchange__select-selected  transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] text-white flex items-center justify-between hover:bg-[#06AB6B0D] rounded-full bg-[#2A2A2A]">
                                            <div class="welcome-exchange__select-selected-value flex items-center gap-[12px]">
                                                <img src="https://comcash.io/icons/Ethereum.png"
                                                    class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" /></span>
                                                <span class="text-sm" data-label="">Tether USDT <span
                                                        class="text-[#FFFFFF66]/40">TRC20</span></span>
                                            </div>
                                            <svg class="welcome-exchange__arrow dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
                                                viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>

                                        <div class="welcome-exchange__select-list ">
                                            <div
                                                class="welcome-exchange__list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white " style="display:none">
                                                    <div class="p-2">
                                                        <input type="text" placeholder="Search..."
                                                            class="input-block w-full h-[36px] px-3 text-sm bg-[#2B2B2B] text-white rounded-[8px] focus:outline-none focus:border-[#06AB6B] focus:border placeholder:text-[#888]">
                                                    </div>
                                                    <div class="tab-list flex gap-2 px-2 pb-2">
                                                    </div>
                                                    <div class="list-items max-h-[200px] overflow-y-auto">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-start gap-2 min-w-0 w-full">
                                    <input id="inputAmount" data-focus-target=".input-block" type="text" placeholder="0.00"
                                        name="amount" inputmode="decimal"
                                        class="welcome-exchange__input amount-send__input bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
                                        autocomplete="off">

                                    <p
                                        class="top-1/2 -translate-y-1/2 text-[14px] text-white/30 max-[410px]:text-[16px] mt-6">
                                        ≈
                                        <span id="usdFromHint">---</span>$
                                    </p>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-center max-[400px]:left-1/2 max-[400px]:-translate-x-1/2 max-[800px]:absolute max-[800px]:top-[44%] max-[800px]:left-10 max-[800px]:rotate-90 z-10 welcome-exchange__icon-reverse">
                                <div id="switchButton" role="button" aria-label="Поменять направления" class="
                                        transition-all duration-300
                                                hover:scale-105 hover:drop-shadow-[0_0_12px_rgba(6,171,107,0.5)]
                                                cursor-pointer active:scale-95 ease-out
                                                w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="pointer-events-none" width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="20" fill="url(#paint0_linear_74_2055)"></rect>
                                        <rect width="40" height="40" rx="20" fill="url(#paint1_linear_74_2055)"></rect>
                                        <path
                                            d="M23.49 28.76C23.3 28.76 23.11 28.69 22.96 28.54C22.67 28.25 22.67 27.77 22.96 27.48L27.97 22.47C28.26 22.18 28.74 22.18 29.03 22.47C29.32 22.76 29.32 23.24 29.03 23.53L24.02 28.54C23.87 28.68 23.68 28.76 23.49 28.76Z"
                                            fill="white"></path>
                                        <path
                                            d="M28.5 23.74H11.5C11.09 23.74 10.75 23.4 10.75 22.99C10.75 22.58 11.09 22.24 11.5 22.24H28.5C28.91 22.24 29.25 22.58 29.25 22.99C29.25 23.4 28.91 23.74 28.5 23.74Z"
                                            fill="white"></path>
                                        <path
                                            d="M11.5 17.76C11.31 17.76 11.12 17.69 10.97 17.54C10.68 17.25 10.68 16.77 10.97 16.48L15.98 11.47C16.27 11.18 16.75 11.18 17.04 11.47C17.33 11.76 17.33 12.24 17.04 12.53L12.03 17.54C11.89 17.68 11.69 17.76 11.5 17.76Z"
                                            fill="white"></path>
                                        <path
                                            d="M28.5 17.76H11.5C11.09 17.76 10.75 17.42 10.75 17.01C10.75 16.6 11.09 16.26 11.5 16.26H28.5C28.91 16.26 29.25 16.6 29.25 17.01C29.25 17.42 28.91 17.76 28.5 17.76Z"
                                            fill="white"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear_74_2055" x1="-73.0756" y1="65.8286" x2="108.36"
                                                y2="67.8085" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#06AB6B"></stop>
                                                <stop offset="0.723958" stop-color="#009C74"></stop>
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_74_2055" x1="28.9733" y1="20.6667" x2="165.207"
                                                y2="34.0766" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#06AB6B"></stop>
                                                <stop offset="1" stop-color="#009C74"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                            </div>

                            <div
                                class="welcome-exchange__block exchnage-panel-right output-block min-[800px]:flex-1 border rounded-[10px] p-5 flex flex-col justify-between relative max-[800px]:w-full border-[#FFFFFF1A]/10 bg-[#1B1B1B]">

                                <div
                                    class="absolute top-[-25px] right-[-25px] pointer-events-none select-none max-[800px]:hidden">
                                    <svg width="86" height="59" viewBox="0 0 86 59" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z" fill="#008D69">
                                        </path>
                                        <path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z" fill="#009C74">
                                        </path>
                                        <path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z" fill="#24DE96">
                                        </path>
                                        <path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z"
                                            fill="#009C74"></path>
                                        <path
                                            d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
                                            fill="#24DE96"></path>
                                        <path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z"
                                            fill="#14C37F"></path>
                                        <path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z"
                                            fill="#009C74"></path>
                                        <path
                                            d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
                                            fill="#14C37F"></path>
                                        <path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z"
                                            fill="#24DE96"></path>
                                        <path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z" fill="#009C74">
                                        </path>
                                        <path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z"
                                            fill="#007C5C"></path>
                                        <path
                                            d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
                                            fill="#008D69"></path>
                                        <path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74"></path>
                                        <path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z"
                                            fill="#24DE96"></path>
                                        <path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z"
                                            fill="#14C37F"></path>
                                        <path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z" fill="#008D69">
                                        </path>
                                        <path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z" fill="#24DE96">
                                        </path>
                                        <path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z"
                                            fill="#14C37F"></path>
                                        <path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z" fill="#008D69">
                                        </path>
                                        <path d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
                                            fill="#24DE96"></path>
                                        <path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z" fill="#009C74">
                                        </path>
                                        <path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z" fill="#008D69">
                                        </path>
                                        <path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z" fill="#009C74">
                                        </path>
                                        <path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z"
                                            fill="#14C37F"></path>
                                        <path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96"></path>
                                    </svg>
                                </div>
                                <p class="text-sm mb-2">{{__("front.youreceive")}}:</p>

                                <div class="flex flex-wrap items-start gap-2 min-w-0 w-full">
                                    <div
                                        class="welcome-exchange__select welcome-exchange-get__select dropdown relative inline-block  min-w-[262px] max-w-full max-[410px]:w-full w-auto min-[810px]:mt-1">
                                        <input class="hidden hidden-currency" name="currency_to">
                                        <button type="button" data-focus-target=".output-block"
                                            class="welcome-exchange__select-selected welcome-exchange-get__select  transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] text-white flex items-center justify-between hover:bg-[#06AB6B0D] rounded-full bg-[#2A2A2A]">
                                            <div class="flex items-center gap-[12px] welcome-exchange__select-selected-value">
                                                <img src="https://comcash.io/icons/Ethereum.png"
                                                    class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" /></span>
                                                <span class="text-sm" data-label="">Tether USDT <span
                                                        class="text-[#FFFFFF66]/40">TRC20</span></span>
                                            </div>
                                            <svg class="welcome-exchange__arrow dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
                                                viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>

                                        <div class="welcome-exchange__select-list ">
                                            <div
                                                class="welcome-exchange__list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white " style="display:none">
                                                    <div class="p-2">
                                                        <input type="text" placeholder="Search..."
                                                            class="input-block w-full h-[36px] px-3 text-sm bg-[#2B2B2B] text-white rounded-[8px] focus:outline-none focus:border-[#06AB6B] focus:border placeholder:text-[#888]">
                                                    </div>
                                                    <div class="tab-list flex gap-2 px-2 pb-2">
                                                    </div>
                                                    <div class="list-items max-h-[200px] overflow-y-auto">
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex flex-wrap items-start gap-2 min-w-0 w-full">
                                    <input id="outputAmount" data-focus-target=".output-block" type="text" inputmode="decimal"
                                        placeholder="0.00"
                                        class="welcome-exchange__input amount-get__input bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
                                        autocomplete="off">
                                <p
                                    class="top-1/2 -translate-y-1/2 text-[14px] text-white/30 max-[410px]:text-[16px] mt-6">
                                    ≈
                                    <span id="usdToHint">---</span>$
                                </p>
                                </div>
                            </div>
                        </div>


                        <div class="flex flex-wrap justify-between items-center text-white text-sm">
                            <div class="text-[24px] text-white">
                                <div class="flex max-[420px]:flex-col gap-2">
                                    <div class="flex flex-col items-start">
                                        <p class="courseFrom"></p>
                                        <span class="courseTypeFrom text-[14px] text-white/40 pl-1 pt-1"></span>
                                    </div>
                                    <p>≈</p>
                                    <div class="flex flex-col items-start max-[420px]:mt-2">
                                        <p class="courseTo"></p>
                                        <span class="courseTypeTo text-[14px] text-white/40 pt-1"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-[14px] opacity-60 max-[500px]:hidden max-w-[160px]">{{__("front.homePagePanelRatesInfo")}}</p>
                            </div>

                            <div class="flex items-center gap-[8px] max-[420px]:mb-2">
                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.7633 17.0625H6.9033C5.4858 17.0625 4.4508 16.47 4.0533 15.45C3.6408 14.385 4.0233 13.065 5.0133 12.1725L8.4933 9L5.0133 5.8275C4.0233 4.935 3.6408 3.615 4.0533 2.55C4.4508 1.5225 5.4858 0.9375 6.9033 0.9375H11.7633C13.1808 0.9375 14.2158 1.53 14.6133 2.55C15.0258 3.615 14.6433 4.935 13.6533 5.8275L10.1733 9L13.6608 12.1725C14.6433 13.065 15.0333 14.385 14.6208 15.45C14.2158 16.47 13.1808 17.0625 11.7633 17.0625ZM9.3333 9.7575L5.7708 12.9975C5.1408 13.575 4.8633 14.415 5.1033 15.0375C5.3283 15.615 5.9658 15.9375 6.9033 15.9375H11.7633C12.7008 15.9375 13.3383 15.6225 13.5633 15.0375C13.8033 14.415 13.5333 13.575 12.8958 12.9975L9.3333 9.7575ZM6.9033 2.0625C5.9658 2.0625 5.3283 2.3775 5.1033 2.9625C4.8633 3.585 5.1333 4.425 5.7708 5.0025L9.3333 8.2425L12.8958 5.0025C13.5258 4.425 13.8033 3.585 13.5633 2.9625C13.3383 2.385 12.7008 2.0625 11.7633 2.0625H6.9033Z"
                                        fill="#06AB6B"></path>
                                </svg>
                                <span class="exchangeTimer">00:00</span>
                            </div>

                            <div class="w-full min-[850px]:w-auto flex items-center px-2 flex-wrap justify-center">
                                <button type="submit" class="flex items-center justify-center h-[62px] max-[850px]:mt-6
                                                    w-full
                                                    min-[850px]:w-[362px] min-[850px]:grow
                                                    bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
                                                    text-white text-[18px] gap-[12px] px-6 py-2
                                                    rounded-full shadow-[0px_4px_20px_#00000026]
                                                    hover:opacity-90 uppercase">
                                <span class="relative flex content-loader"></span>
                                    {{__("front.exchange")}}
                                    <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z"
                                            fill="white"></path>
                                        <path
                                            d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                </button>
                                <div class="flex justify-center">
                                    <p class="text-[12px] opacity-60 mt-4 min-[500px]:hidden whitespace-nowrap text-center">
                                        {{__("front.homePagePanelRatesInfo")}}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
@endsection