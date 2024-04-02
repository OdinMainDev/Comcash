<footer class='footer'>
    <div class='footer__container'>
        <div class='footer__top'>
            <div class='footer__logo'>
                <img 
                    src='/comcash/img/logo.svg'
                    alt=''
                    class='footer__logo-img' />
                <p>{{__("front.slogan")}}</p>
                <div class="footer__sponsors-list">
                    <a href="https://kurs.expert/ru/obmennik/comcash-io/feedbacks.html#stat" target="_blank" >
                        <img class="footer__sponsors-item" src="/comcash/img/cb.png" alt="KursExpert - мониторинг обменников" title="KursExpert - честный мониторинг обменников"/>
                    </a>

                    <a href="https://antiswap.info/exchanger/ComCASH-otzyvy" target="_blank">
                        <img class="footer__sponsors-item" src="https://antiswap.info/images/banner/200-70-1-anim.gif" alt="AntiSwap - мониторинг обменников" title="AntiSwap - честный мониторинг обменников">
                    </a>

                    <a target="_blank" href="https://www.okchanger.ru/exchangers/Comcash-io?a=235857">
                        <img class="footer__sponsors-item" src="https://www.okchanger.ru/images/banners/320x50.gif"   alt="OkChanger - мониторинг обменников" title="OkChanger - честный мониторинг обменников"/>
                    </a>
                </div>
            </div>
            <div class='footer__sitemap-col'>
                <p class='footer__sitemap-title'>{{__("front.footer_links_title")}}</p>
                <a href='{{route("comcashPage", ["sitemap"])}}' class='footer__sitemap-link'>{{__("front.footer_links_1")}}</a>
                <a href='{{route("comcashPage", ["rules"])}}' class='footer__sitemap-link'>{{__("front.footer_links_2")}}</a>
                <a href='{{route("comcashPage", ["delivery"])}}' class='footer__sitemap-link'>{{__("front.footer_links_3")}}</a>
                <a href='{{route("comcashPage", ["reviews"])}}' class='footer__sitemap-link'>{{__("front.footer_links_4")}}</a>
                <a href='{{route("comcashPage", ["news"])}}' class='footer__sitemap-link'>{{__("front.footer_links_5")}}</a>
            </div>
            <div class='footer__sitemap-col'>
                <p class='footer__sitemap-title'></p>
                <a href='{{route("comcashPage", ["blog"])}}' class='footer__sitemap-link'>{{__("front.footer_links_6")}}</a>
                <a href='{{route("comcashPage", ["support"])}}' class='footer__sitemap-link'>{{__("front.footer_links_7")}}</a>
                <a href='{{route("comcashPage", ["company"])}}' class='footer__sitemap-link'>{{__("front.footer_links_8")}}</a>
                <a href='{{route("comcashPage", ["faq"])}}' class='footer__sitemap-link'>{{__("front.footer_links_9")}}</a>
            </div>
            <div class='footer__sitemap'>
                <div class='footer__sitemap-col'>
                    <p class=''>{{__("front.footer_text")}}</p>
                </div>
            </div>
        </div>
        <div class='footer__bottom'>
            <p class='footer__copyright'>Since from 2023 - {{date("Y")}}! With love From ©omcash.</p>
            <!-- <div class='footer__socials'>

                <a href=''
                    class='footer__socials-link'>
                <img src='/comcash/img/icons/socials/facebook.svg'
                    alt='' />
                </a>
                <a href=''
                    class='footer__socials-link'>
                <img src='/comcash/img/icons/socials/facebook.svg'
                    alt='' />
                </a>
                <a href=''
                    class='footer__socials-link'>
                <img src='/comcash/img/icons/socials/facebook.svg'
                    alt='' />
                </a>
            </div> -->
        </div>
    </div>
</footer>
