<footer
    class="text-white px-[20px] max-w-[1018px] mx-auto max-[620px]:pt-[6rem] pt-[10rem] pb-[24px] justify-between">
    <div class="flex items-start justify-between w-full items-center flex-nowrap gap-4 mb-2">
        <div class="flex min-w-[200px]">
            <a href='{{route("index")}}'>
                <img src='/comcash/img/logo.svg' alt='logo' />
            </a>
        </div>

        <p class="max-[600px]:hidden text-white gap-[4px] max-[640px]:max-w-[300px]">
            {{__("front.slogan")}}
        </p>

        <div class="flex justify-end">
            <div class="grid grid-cols-3 gap-2 max-w-[220px]">

                <a href="https://www.trustpilot.com/review/comcash.io" target="_blank" rel="noopener">
                    <img src="/images/trustpilot.svg" alt="Trustpilot" title="Trustpilot"
                        class="h-[28px] w-full object-contain" />
                </a>

                <a href="https://pro-obmen.ru/comcash/#comments" target="_blank" rel="noopener">
                    <img src="/images/proobmen.gif" alt="Pro-Obmen.ru" title="Pro-Obmen.ru"
                        class="h-[28px] w-full object-contain" />
                </a>

                <a href="https://change.pro/exchangers/comcash" target="_blank" rel="noopener">
                    <img src="/images/changepro.png" alt="ChangePro" title="ChangePro"
                        class="h-[28px] w-full object-contain" />
                </a>

                <a href="https://www.okchanger.ru/exchangers/Comcash-io?a=235857" target="_blank" rel="noopener">
                    <img src="/comcash/img/icons/okchanger320x50.gif" alt="OkChanger" title="OkChanger"
                        class="h-[28px] w-full object-contain" />
                </a>

                <a href="https://antiswap.info/exchanger/ComCASH-otzyvy" target="_blank" rel="noopener">
                    <img src="https://antiswap.info/images/banner/200-70-1-anim.gif" alt="AntiSwap" title="AntiSwap"
                        class="h-[28px] w-full object-contain" />
                </a>

                <a href="https://kurs.expert/ru/obmennik/comcash-io/feedbacks.html#stat" target="_blank" rel="noopener">
                    <img src="/comcash/img/cb.png" alt="KursExpert" title="KursExpert"
                        class="h-[28px] w-full object-contain" />
                </a>

            </div>
        </div>
    </div>

    <p class="min-[599px]:hidden mb-3 text-[12px] text-center
        mx-auto text-white  max-[640px]:max-w-[300px] items-start w-full mt-4">
        {{__("front.slogan")}}
    </p>

    <div class="flex flex-col min-[1240px]:flex-row justify-between gap-[40px] border-t border-white/10 pt-6">

        <div class="grid grid-cols-2 gap-[40px] text-[14px] leading-[32px]">
            <ul class="flex flex-col gap-[8px]">
                <li>
                    <a href='{{route("comcashPage", ["sitemap"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_1")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["rules"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_2")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["delivery"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_3")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["reviews"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_4")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["news"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_5")}}
                    </a>
                </li>
            </ul>
            <ul class="flex flex-col gap-[8px]">
                <li>
                    <a href='{{route("comcashPage", ["blog"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_6")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["support"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_7")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["company"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_8")}}
                    </a>
                </li>
                <li>
                    <a href='{{route("comcashPage", ["faq"])}}' class="hover:text-[#06AB6B] transition">
                        {{__("front.footer_links_9")}}
                    </a>
                </li>
            </ul>
        </div>

        <div class="text-white/40 text-[12px] w-full min-[1240px]:max-w-[480px] leading-[160%]">
            <p>
                {{__("front.footer_text")}}
            </p>
        </div>
    </div>

    <div
        class="flex flex-col lg:flex-row justify-between items-center mt-6 border-t border-white/10 py-6 text-normal text-[14px] padding">
        <p class="text-white/40">Since from 2023 - 2025!</p>
        <p class="text-white ">With love from ©comcash.</p>
    </div>
</footer>