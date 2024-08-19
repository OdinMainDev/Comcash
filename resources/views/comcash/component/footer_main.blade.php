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
                        <img class="footer__sponsors-item" src="/comcash/img/cb.png" alt="KursExpert" title="KursExpert"/>
                    </a>

                    <a href="https://antiswap.info/exchanger/ComCASH-otzyvy" target="_blank">
                        <img class="footer__sponsors-item" src="https://antiswap.info/images/banner/200-70-1-anim.gif" alt="AntiSwap" title="AntiSwap">
                    </a>

                    <a target="_blank" href="https://www.okchanger.ru/exchangers/Comcash-io?a=235857">
                        <img class="footer__sponsors-item" src="https://www.okchanger.ru/images/banners/320x50.gif" alt="OkChanger" title="OkChanger"/>
                    </a>

                    <a target="_blank" href="https://change.pro/exchangers/comcash">
                        <img class="footer__sponsors-item" src="/images/changepro.png" alt="ChangePro" title="ChangePro"/>
                    </a>

                    <a target="_blank" href="https://pro-obmen.ru/comcash/#comments">
                        <img class="footer__sponsors-item" alt="Pro-Obmen.ru" src="/images/proobmen.gif" title="Pro-Obmen.ru" />
                    </a>
                    <a target="_blank" href="https://www.trustpilot.com/review/comcash.io">
                        <img class="footer__sponsors-item" alt="Pro-Obmen.ru" src="/images/trustpilot.svg" title="Pro-Obmen.ru" />
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
            <a id='wot-badge2' class='wot-badge' href='https://www.mywot.com/scorecard/comcash.io?wot_badge=2_white' target='_blank' >
                    <div class='wot-secured-container '>
                        <div class='wot-shield-background'></div>
                        <div class='wot-text-container'>
                            <p class='wot-secured-bold'>Verified Site</p>
                            <div class='wot-trusted-container'>
                                <div class='wot-trusted'>Trusted by</div>
                                <div class='wot-logo'></div>
                            </div>
                        </div>
                    </div>
                    <div class='wot-vertical'></div>
                    <p class='wot-report'>See Report</p>
                </a>
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
