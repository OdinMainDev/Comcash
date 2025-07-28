@extends('comcash.layout.main')

@section('content')
<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="flex justify-between items-start gap-[100px] flex-nowrap">
        <div class="flex flex-col gap-[24px] text-[14px] text-white/40 max-w-[900px] mb-6 transition-all duration-300 ease-in-out w-full">

            <h2 class="text-[32px] font-bold text-[#06AB6B] uppercase">{{$news->getTitle()}}</h2>

            <div class="flex gap-[40px]">
                <div class="flex items-start gap-[12px] text-[#777] text-[14px] leading-[140%]">
                    <div class="w-[25px] min-w-[25px]">
                        <svg width="25" height="32" viewBox="0 0 25 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.1265 20.6297C15.1265 20.3764 15.1376 20.0698 15.1247 19.7632C15.11 19.409 14.9854 19.2731 14.6098 19.2639C13.5724 19.2419 12.5333 19.2419 11.496 19.2308C11.2211 19.2272 10.9462 19.2308 10.6731 19.2107C10.3983 19.1905 10.3102 18.9775 10.4807 18.7664C10.5962 18.6251 10.7208 18.4892 10.8527 18.3626C11.8571 17.3933 12.5736 16.2312 13.1674 14.9774C13.5853 14.0944 13.7282 13.1729 13.6402 12.2109C13.6164 11.9411 13.5395 11.6694 13.446 11.4124C13.0831 10.4229 12.2419 10.0246 11.2449 10.3495C10.9902 10.4321 10.7721 10.6817 10.4789 10.5735C10.182 10.4633 10.0116 10.188 9.81364 9.95847C9.54971 9.65188 9.59736 9.41141 9.96025 9.22601C11.6646 8.35037 14.0544 8.7744 14.6995 11.3279C15.066 12.7764 14.7178 14.1146 14.1552 15.4254C13.9389 15.9284 13.6402 16.3965 13.3763 16.8774C13.259 17.0922 13.1234 17.296 13.0135 17.5144C12.8595 17.821 12.9512 17.9991 13.2811 18.0082C13.7685 18.0211 14.2579 18.0229 14.7454 17.9991C15.1284 17.9807 15.2713 17.7843 15.2328 17.3823C15.1797 16.804 15.1119 16.2294 15.0569 15.6511C15.0294 15.3574 15.1046 15.273 15.4106 15.2601C15.6543 15.2491 15.8999 15.2528 16.1418 15.2656C16.371 15.2785 16.4699 15.3923 16.4296 15.6273C16.3343 16.2037 16.327 16.7856 16.3471 17.3657C16.3599 17.7237 16.4974 17.8485 16.8676 17.8614C17.203 17.8724 17.5384 17.8504 17.8756 17.8485C18.1193 17.8467 18.3631 17.8467 18.6068 17.8651C18.7754 17.8779 18.8707 17.999 18.911 18.1606C18.9184 18.19 18.9202 18.2212 18.922 18.2524C18.9697 19.4695 18.9734 19.4695 17.8261 19.4199C17.4925 19.4053 17.1608 19.3281 16.8272 19.3098C16.5231 19.2933 16.3765 19.4309 16.3691 19.7467C16.3544 20.3268 16.4369 21.4851 16.4369 21.4851C16.4369 21.4851 16.5084 21.9074 16.5176 22.1203C16.5432 22.6491 16.4387 22.75 15.889 22.7665C14.9873 22.7959 14.958 22.7555 15.0551 21.8762C15.0991 21.4778 15.1009 21.0794 15.1265 20.6297Z" fill="url(#paint0_linear_74_2310)"></path>
                            <path d="M9.46345 0H12.3957V7.29675C8.31155 8.02628 5.24829 11.5732 5.24829 15.7874C5.24829 20.0017 8.31155 23.5487 12.3957 24.2782V31.5749H9.46345V28.2311C4.33476 26.3996 0.666626 21.5197 0.666626 15.7874C0.666626 10.0552 4.33476 5.17531 9.46345 3.3438V0Z" fill="url(#paint1_linear_74_2310)"></path>
                            <path d="M15.6946 31.575H18.6269V28.1643C21.0298 27.266 23.1017 25.6951 24.611 23.6822L20.953 20.9172C19.6996 22.5959 17.8451 23.8118 15.6946 24.2435V31.575Z" fill="url(#paint2_linear_74_2310)"></path>
                            <path d="M15.6946 0H18.6269V3.41077C20.9831 4.29161 23.0212 5.81921 24.5225 7.77614L20.8644 10.5412C19.6131 8.92282 17.795 7.75319 15.6946 7.33154V0Z" fill="url(#paint3_linear_74_2310)"></path>
                            <defs>
                                <linearGradient id="paint0_linear_74_2310" x1="8.7752" y1="16.4819" x2="40.4888" y2="17.0011" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#06AB6B"></stop>
                                    <stop offset="0.723958" stop-color="#009C74"></stop>
                                </linearGradient>
                                <linearGradient id="paint1_linear_74_2310" x1="-0.433011" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#06AB6B"></stop>
                                    <stop offset="0.723958" stop-color="#009C74"></stop>
                                </linearGradient>
                                <linearGradient id="paint2_linear_74_2310" x1="-0.433006" y1="17.3479" x2="39.6107" y2="17.7139" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#06AB6B"></stop>
                                    <stop offset="0.723958" stop-color="#009C74"></stop>
                                </linearGradient>
                                <linearGradient id="paint3_linear_74_2310" x1="-0.433001" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#06AB6B"></stop>
                                    <stop offset="0.723958" stop-color="#009C74"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white/70 font-normal leading-none">Comcash</span>
                        <div class="flex gap-[8px] text-white/20 mt-[2px]">
                            <span>{{date("H:i:s d.m.Y", $news->created_at->unix())}}</span>
                        </div>
                    </div>
                </div>
                @if (false)
                    <div class="inline-block px-[18px] py-[8px] text-[16px] text-[#06AB6B] bg-[#06AB6B1A] rounded-full">
                        Майнинг
                    </div>
                @endif
            </div>
            {!! $news->getContent() !!}
            
            <a
                href="/"
                class="flex items-center justify-center h-[62px] max-[850px]:mt-6
               w-full
               min-[850px]:w-[480px] min-[850px]:grow
               bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
               text-white text-[18px] gap-[12px] px-6 py-2
               rounded-full shadow-[0px_4px_20px_#00000026]
               hover:opacity-90 z-[20]">
                ОБМЕНЯТЬ
                <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z" fill="white" />
                    <path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="currentColor" />
                </svg>
            </a>
        </div>

        @if (false)
            <div class="min-w-[300px] max-w-[310px] max-[1000px]:hidden">
                <div class="flex items-center mb-[14px] mt-10">
                    <span class="text-white uppercase max-[600px]:text-[16px] text-[18px] leading-[140%] mr-4 whitespace-nowrap">
                        Рекомендуем
                    </span>
                    <div class="flex h-[1px] bg-[#06AB6B] min-w-[80px] w-full"></div>
                </div>
                <div class="flex flex-col gap-[14px] max-w-[308px]">
                    <a href="/article-1" class="block p-[14px] rounded-[10px] border-r-[2px] border-b-[2px] border-white/5 backdrop-blur-[20px] bg-white/5 min-[720px]:hidden hover:opacity-80 transition-opacity duration-200">
                        <div class="inline-block px-[10px] py-[2px] text-[14px] text-[#06AB6B] bg-[#06AB6B1A] rounded-full mb-[14px]">
                            Майнинг
                        </div>
                        <h3 class="text-white text-[16px] leading-[1.4] font-normal">
                            ХАЛВИНГ БИТКОИНА В 2024 ГОДУ: ЧТО ЭТО ТАКОЕ И ЧЕГО ОТ НЕГО ОЖИДАТЬ?
                        </h3>
                    </a>

                    <a href="/article-2" class="block p-[14px] rounded-[10px] border-r-[2px] border-b-[2px] border-white/5 backdrop-blur-[20px] bg-white/5 hover:opacity-80 transition-opacity duration-200">
                        <div class="inline-block px-[10px] py-[2px] text-[14px] text-[#06AB6B] bg-[#06AB6B1A] rounded-full mb-[14px]">
                            Майнинг
                        </div>
                        <h3 class="text-white text-[16px] leading-[1.4] font-normal">
                            ХАЛВИНГ БИТКОИНА В 2024 ГОДУ: ЧТО ЭТО ТАКОЕ И ЧЕГО ОТ НЕГО ОЖИДАТЬ?
                        </h3>
                    </a>

                    <a href="/article-3" class="block p-[14px] rounded-[10px] border-r-[2px] border-b-[2px] border-white/5 backdrop-blur-[20px] bg-white/5 hover:opacity-80 transition-opacity duration-200">
                        <div class="inline-block px-[10px] py-[2px] text-[14px] text-[#06AB6B] bg-[#06AB6B1A] rounded-full mb-[14px]">
                            Майнинг
                        </div>
                        <h3 class="text-white text-[16px] leading-[1.4] font-normal">
                            ХАЛВИНГ БИТКОИНА В 2024 ГОДУ: ЧТО ЭТО ТАКОЕ И ЧЕГО ОТ НЕГО ОЖИДАТЬ?
                        </h3>
                    </a>
                </div>


            </div>
        @endif
    </div>



    @if (false)
        <h2 class="text-[#06AB6B] text-[32px] font-bold mb-4 uppercase mt-[80px]">Другие новости</h2>
        <div class="swiper review-swiper-news w-full overflow-hidden pointer-events-none gap-[24px]">
            <div class="gap-[24px] flex max-[550px]:flex-col flex-row">
                <div class="w-full">
                    <div class="review-card bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between">
                        <div class="text-[#06AB6B] bg-[#06AB6B1A] text-[12px] font-normal leading-none rounded-full px-[12px] py-[4px] w-fit mb-3">
                            Рынки
                        </div>
                        <div class="text-white">
                            <h3 class="font-medium text-[18px] leading-[140%] tracking-[0]">СТАРЫЕ БИТКОИН-КОШЕЛЬКИ ПРОДОЛЖАЮТ ПРОСЫПАТЬСЯ</h3>
                            <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3">
                                15 апреля этого года давно бездействующий биткоин-кошелек ожил впервые почти за 14 лет...
                            </p>
                        </div>
                        <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">
                            <!-- Логотип -->
                            <div class="w-[25px] min-w-[25px]">
                                <svg width="25" height="32" viewBox="0 0 25 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.1265 20.6297C15.1265 20.3764 15.1376 20.0698 15.1247 19.7632C15.11 19.409 14.9854 19.2731 14.6098 19.2639C13.5724 19.2419 12.5333 19.2419 11.496 19.2308C11.2211 19.2272 10.9462 19.2308 10.6731 19.2107C10.3983 19.1905 10.3102 18.9775 10.4807 18.7664C10.5962 18.6251 10.7208 18.4892 10.8527 18.3626C11.8571 17.3933 12.5736 16.2312 13.1674 14.9774C13.5853 14.0944 13.7282 13.1729 13.6402 12.2109C13.6164 11.9411 13.5395 11.6694 13.446 11.4124C13.0831 10.4229 12.2419 10.0246 11.2449 10.3495C10.9902 10.4321 10.7721 10.6817 10.4789 10.5735C10.182 10.4633 10.0116 10.188 9.81364 9.95847C9.54971 9.65188 9.59736 9.41141 9.96025 9.22601C11.6646 8.35037 14.0544 8.7744 14.6995 11.3279C15.066 12.7764 14.7178 14.1146 14.1552 15.4254C13.9389 15.9284 13.6402 16.3965 13.3763 16.8774C13.259 17.0922 13.1234 17.296 13.0135 17.5144C12.8595 17.821 12.9512 17.9991 13.2811 18.0082C13.7685 18.0211 14.2579 18.0229 14.7454 17.9991C15.1284 17.9807 15.2713 17.7843 15.2328 17.3823C15.1797 16.804 15.1119 16.2294 15.0569 15.6511C15.0294 15.3574 15.1046 15.273 15.4106 15.2601C15.6543 15.2491 15.8999 15.2528 16.1418 15.2656C16.371 15.2785 16.4699 15.3923 16.4296 15.6273C16.3343 16.2037 16.327 16.7856 16.3471 17.3657C16.3599 17.7237 16.4974 17.8485 16.8676 17.8614C17.203 17.8724 17.5384 17.8504 17.8756 17.8485C18.1193 17.8467 18.3631 17.8467 18.6068 17.8651C18.7754 17.8779 18.8707 17.999 18.911 18.1606C18.9184 18.19 18.9202 18.2212 18.922 18.2524C18.9697 19.4695 18.9734 19.4695 17.8261 19.4199C17.4925 19.4053 17.1608 19.3281 16.8272 19.3098C16.5231 19.2933 16.3765 19.4309 16.3691 19.7467C16.3544 20.3268 16.4369 21.4851 16.4369 21.4851C16.4369 21.4851 16.5084 21.9074 16.5176 22.1203C16.5432 22.6491 16.4387 22.75 15.889 22.7665C14.9873 22.7959 14.958 22.7555 15.0551 21.8762C15.0991 21.4778 15.1009 21.0794 15.1265 20.6297Z" fill="url(#paint0_linear_74_2310)"></path>
                                    <path d="M9.46345 0H12.3957V7.29675C8.31155 8.02628 5.24829 11.5732 5.24829 15.7874C5.24829 20.0017 8.31155 23.5487 12.3957 24.2782V31.5749H9.46345V28.2311C4.33476 26.3996 0.666626 21.5197 0.666626 15.7874C0.666626 10.0552 4.33476 5.17531 9.46345 3.3438V0Z" fill="url(#paint1_linear_74_2310)"></path>
                                    <path d="M15.6946 31.575H18.6269V28.1643C21.0298 27.266 23.1017 25.6951 24.611 23.6822L20.953 20.9172C19.6996 22.5959 17.8451 23.8118 15.6946 24.2435V31.575Z" fill="url(#paint2_linear_74_2310)"></path>
                                    <path d="M15.6946 0H18.6269V3.41077C20.9831 4.29161 23.0212 5.81921 24.5225 7.77614L20.8644 10.5412C19.6131 8.92282 17.795 7.75319 15.6946 7.33154V0Z" fill="url(#paint3_linear_74_2310)"></path>
                                    <defs>
                                        <linearGradient id="paint0_linear_74_2310" x1="8.7752" y1="16.4819" x2="40.4888" y2="17.0011" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_74_2310" x1="-0.433011" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_74_2310" x1="-0.433006" y1="17.3479" x2="39.6107" y2="17.7139" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_74_2310" x1="-0.433001" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <!-- Текст -->
                            <div class="flex flex-col">
                                <span class="text-white/70 font-normal leading-none">Comcash3</span>
                                <div class="flex gap-[8px] text-white/20 mt-[2px]">
                                    <span>15:10:54</span>
                                    <span>24.03.2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="review-card bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between">
                        <div class="text-[#06AB6B] bg-[#06AB6B1A] text-[12px] font-normal leading-none rounded-full px-[12px] py-[4px] w-fit mb-3">
                            Рынки
                        </div>
                        <div class="text-white">
                            <h3 class="font-medium text-[18px] leading-[140%] tracking-[0]">СТАРЫЕ БИТКОИН-КОШЕЛЬКИ ПРОДОЛЖАЮТ ПРОСЫПАТЬСЯ</h3>
                            <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3">
                                15 апреля этого года давно бездействующий биткоин-кошелек ожил впервые почти за 14 лет...
                            </p>
                        </div>
                        <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">
                            <!-- Логотип -->
                            <div class="w-[25px] min-w-[25px]">
                                <svg width="25" height="32" viewBox="0 0 25 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.1265 20.6297C15.1265 20.3764 15.1376 20.0698 15.1247 19.7632C15.11 19.409 14.9854 19.2731 14.6098 19.2639C13.5724 19.2419 12.5333 19.2419 11.496 19.2308C11.2211 19.2272 10.9462 19.2308 10.6731 19.2107C10.3983 19.1905 10.3102 18.9775 10.4807 18.7664C10.5962 18.6251 10.7208 18.4892 10.8527 18.3626C11.8571 17.3933 12.5736 16.2312 13.1674 14.9774C13.5853 14.0944 13.7282 13.1729 13.6402 12.2109C13.6164 11.9411 13.5395 11.6694 13.446 11.4124C13.0831 10.4229 12.2419 10.0246 11.2449 10.3495C10.9902 10.4321 10.7721 10.6817 10.4789 10.5735C10.182 10.4633 10.0116 10.188 9.81364 9.95847C9.54971 9.65188 9.59736 9.41141 9.96025 9.22601C11.6646 8.35037 14.0544 8.7744 14.6995 11.3279C15.066 12.7764 14.7178 14.1146 14.1552 15.4254C13.9389 15.9284 13.6402 16.3965 13.3763 16.8774C13.259 17.0922 13.1234 17.296 13.0135 17.5144C12.8595 17.821 12.9512 17.9991 13.2811 18.0082C13.7685 18.0211 14.2579 18.0229 14.7454 17.9991C15.1284 17.9807 15.2713 17.7843 15.2328 17.3823C15.1797 16.804 15.1119 16.2294 15.0569 15.6511C15.0294 15.3574 15.1046 15.273 15.4106 15.2601C15.6543 15.2491 15.8999 15.2528 16.1418 15.2656C16.371 15.2785 16.4699 15.3923 16.4296 15.6273C16.3343 16.2037 16.327 16.7856 16.3471 17.3657C16.3599 17.7237 16.4974 17.8485 16.8676 17.8614C17.203 17.8724 17.5384 17.8504 17.8756 17.8485C18.1193 17.8467 18.3631 17.8467 18.6068 17.8651C18.7754 17.8779 18.8707 17.999 18.911 18.1606C18.9184 18.19 18.9202 18.2212 18.922 18.2524C18.9697 19.4695 18.9734 19.4695 17.8261 19.4199C17.4925 19.4053 17.1608 19.3281 16.8272 19.3098C16.5231 19.2933 16.3765 19.4309 16.3691 19.7467C16.3544 20.3268 16.4369 21.4851 16.4369 21.4851C16.4369 21.4851 16.5084 21.9074 16.5176 22.1203C16.5432 22.6491 16.4387 22.75 15.889 22.7665C14.9873 22.7959 14.958 22.7555 15.0551 21.8762C15.0991 21.4778 15.1009 21.0794 15.1265 20.6297Z" fill="url(#paint0_linear_74_2310)"></path>
                                    <path d="M9.46345 0H12.3957V7.29675C8.31155 8.02628 5.24829 11.5732 5.24829 15.7874C5.24829 20.0017 8.31155 23.5487 12.3957 24.2782V31.5749H9.46345V28.2311C4.33476 26.3996 0.666626 21.5197 0.666626 15.7874C0.666626 10.0552 4.33476 5.17531 9.46345 3.3438V0Z" fill="url(#paint1_linear_74_2310)"></path>
                                    <path d="M15.6946 31.575H18.6269V28.1643C21.0298 27.266 23.1017 25.6951 24.611 23.6822L20.953 20.9172C19.6996 22.5959 17.8451 23.8118 15.6946 24.2435V31.575Z" fill="url(#paint2_linear_74_2310)"></path>
                                    <path d="M15.6946 0H18.6269V3.41077C20.9831 4.29161 23.0212 5.81921 24.5225 7.77614L20.8644 10.5412C19.6131 8.92282 17.795 7.75319 15.6946 7.33154V0Z" fill="url(#paint3_linear_74_2310)"></path>
                                    <defs>
                                        <linearGradient id="paint0_linear_74_2310" x1="8.7752" y1="16.4819" x2="40.4888" y2="17.0011" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_74_2310" x1="-0.433011" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_74_2310" x1="-0.433006" y1="17.3479" x2="39.6107" y2="17.7139" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_74_2310" x1="-0.433001" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <!-- Текст -->
                            <div class="flex flex-col">
                                <span class="text-white/70 font-normal leading-none">Comcash3</span>
                                <div class="flex gap-[8px] text-white/20 mt-[2px]">
                                    <span>15:10:54</span>
                                    <span>24.03.2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-[550px]:block max-[820px]:hidden">
                    <div class="review-card bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between">
                        <div class="text-[#06AB6B] bg-[#06AB6B1A] text-[12px] font-normal leading-none rounded-full px-[12px] py-[4px] w-fit mb-3">
                            Майнинг
                        </div>
                        <div class="text-white">
                            <h3 class="font-medium text-[18px] leading-[140%] tracking-[0]">СТАРЫЕ БИТКОИН-КОШЕЛЬКИ ПРОДОЛЖАЮТ ПРОСЫПАТЬСЯ</h3>
                            <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3">
                                15 апреля этого года давно бездействующий биткоин-кошелек ожил впервые почти за 14 лет...
                            </p>
                        </div>
                        <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">
                            <!-- Логотип -->
                            <div class="w-[25px] min-w-[25px]">
                                <svg width="25" height="32" viewBox="0 0 25 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.1265 20.6297C15.1265 20.3764 15.1376 20.0698 15.1247 19.7632C15.11 19.409 14.9854 19.2731 14.6098 19.2639C13.5724 19.2419 12.5333 19.2419 11.496 19.2308C11.2211 19.2272 10.9462 19.2308 10.6731 19.2107C10.3983 19.1905 10.3102 18.9775 10.4807 18.7664C10.5962 18.6251 10.7208 18.4892 10.8527 18.3626C11.8571 17.3933 12.5736 16.2312 13.1674 14.9774C13.5853 14.0944 13.7282 13.1729 13.6402 12.2109C13.6164 11.9411 13.5395 11.6694 13.446 11.4124C13.0831 10.4229 12.2419 10.0246 11.2449 10.3495C10.9902 10.4321 10.7721 10.6817 10.4789 10.5735C10.182 10.4633 10.0116 10.188 9.81364 9.95847C9.54971 9.65188 9.59736 9.41141 9.96025 9.22601C11.6646 8.35037 14.0544 8.7744 14.6995 11.3279C15.066 12.7764 14.7178 14.1146 14.1552 15.4254C13.9389 15.9284 13.6402 16.3965 13.3763 16.8774C13.259 17.0922 13.1234 17.296 13.0135 17.5144C12.8595 17.821 12.9512 17.9991 13.2811 18.0082C13.7685 18.0211 14.2579 18.0229 14.7454 17.9991C15.1284 17.9807 15.2713 17.7843 15.2328 17.3823C15.1797 16.804 15.1119 16.2294 15.0569 15.6511C15.0294 15.3574 15.1046 15.273 15.4106 15.2601C15.6543 15.2491 15.8999 15.2528 16.1418 15.2656C16.371 15.2785 16.4699 15.3923 16.4296 15.6273C16.3343 16.2037 16.327 16.7856 16.3471 17.3657C16.3599 17.7237 16.4974 17.8485 16.8676 17.8614C17.203 17.8724 17.5384 17.8504 17.8756 17.8485C18.1193 17.8467 18.3631 17.8467 18.6068 17.8651C18.7754 17.8779 18.8707 17.999 18.911 18.1606C18.9184 18.19 18.9202 18.2212 18.922 18.2524C18.9697 19.4695 18.9734 19.4695 17.8261 19.4199C17.4925 19.4053 17.1608 19.3281 16.8272 19.3098C16.5231 19.2933 16.3765 19.4309 16.3691 19.7467C16.3544 20.3268 16.4369 21.4851 16.4369 21.4851C16.4369 21.4851 16.5084 21.9074 16.5176 22.1203C16.5432 22.6491 16.4387 22.75 15.889 22.7665C14.9873 22.7959 14.958 22.7555 15.0551 21.8762C15.0991 21.4778 15.1009 21.0794 15.1265 20.6297Z" fill="url(#paint0_linear_74_2310)"></path>
                                    <path d="M9.46345 0H12.3957V7.29675C8.31155 8.02628 5.24829 11.5732 5.24829 15.7874C5.24829 20.0017 8.31155 23.5487 12.3957 24.2782V31.5749H9.46345V28.2311C4.33476 26.3996 0.666626 21.5197 0.666626 15.7874C0.666626 10.0552 4.33476 5.17531 9.46345 3.3438V0Z" fill="url(#paint1_linear_74_2310)"></path>
                                    <path d="M15.6946 31.575H18.6269V28.1643C21.0298 27.266 23.1017 25.6951 24.611 23.6822L20.953 20.9172C19.6996 22.5959 17.8451 23.8118 15.6946 24.2435V31.575Z" fill="url(#paint2_linear_74_2310)"></path>
                                    <path d="M15.6946 0H18.6269V3.41077C20.9831 4.29161 23.0212 5.81921 24.5225 7.77614L20.8644 10.5412C19.6131 8.92282 17.795 7.75319 15.6946 7.33154V0Z" fill="url(#paint3_linear_74_2310)"></path>
                                    <defs>
                                        <linearGradient id="paint0_linear_74_2310" x1="8.7752" y1="16.4819" x2="40.4888" y2="17.0011" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_74_2310" x1="-0.433011" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_74_2310" x1="-0.433006" y1="17.3479" x2="39.6107" y2="17.7139" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_74_2310" x1="-0.433001" y1="17.3478" x2="39.6107" y2="17.7138" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06AB6B"></stop>
                                            <stop offset="0.723958" stop-color="#009C74"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <!-- Текст -->
                            <div class="flex flex-col">
                                <span class="text-white/70 font-normal leading-none">Comcash3</span>
                                <div class="flex gap-[8px] text-white/20 mt-[2px]">
                                    <span>15:10:54</span>
                                    <span>24.03.2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

</section>

@endsection