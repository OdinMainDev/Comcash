<div class='welcome'>
    <div class='welcome__container'>
        <div class="welcome__panel-container-second">
            <form class="welcome-exchange" action="{{route("redirectToExchange")}}">
                <div class="welcome-exchange__header">
                    <div class="welcome-exchange__title">
                        Обмен Tether ERC20 USDT на Тинькофф RUB
                    </div>
                    <div class="welcome-exchange__timer-container">
                        <div class="welcome-exchange__timer-text">
                            <div class="welcome-exchange__block-title">
                                Курс: 1 USDT = 92.75 RUB
                            </div>
                            <div class="welcome-exchange__block-subtitle">
                                Курс зафиксируется после создания заявки
                            </div>
                        </div>
                        <div class="welcome-exchange__timer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 39 40" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.54512 33.9999C9.55655 34 9.56799 34 9.57944 34H30.4206C30.432 34 30.4434 34 30.4549 33.9999H9.54512ZM9.40558 33.9968C6.95699 33.9054 5 31.8915 5 29.4206C5 27.7468 5.91318 26.2063 7.3816 25.403L19.5 18.7735V25.6301L9.56895 30.419C9.39604 30.5024 9.28613 30.6774 9.28613 30.8694V33.8499C9.28613 33.9222 9.33739 33.9827 9.40558 33.9968ZM19.5612 18.26L7.3816 11.597C6.78762 11.2721 6.28449 10.8265 5.8959 10.3003L20 16.7777L34.1041 10.3003C33.7155 10.8265 33.2124 11.2721 32.6184 11.597L20.4388 18.26C20.3538 18.105 20.1892 17.9999 20 17.9999C19.8108 17.9999 19.6462 18.105 19.5612 18.26ZM20.5 18.7735L32.6184 25.403C34.0868 26.2063 35 27.7468 35 29.4206C35 31.8912 33.0436 33.9048 30.5954 33.9967C30.6635 33.9825 30.7147 33.9222 30.7147 33.8499V30.8694C30.7147 30.6774 30.6048 30.5024 30.4319 30.419L20.5 25.6297V18.7735ZM34.375 9.88885H5.62496C5.22269 9.20003 5 8.40599 5 7.57944C5 5.05028 7.05028 3 9.57944 3H30.4206C32.9497 3 35 5.05028 35 7.57944C35 8.40599 34.7773 9.20003 34.375 9.88885Z" fill="#009C74"/>
                                <path d="M20 18.5L32.6184 25.403C34.0868 26.2063 35 27.7468 35 29.4206V29.4206C35 31.9497 32.9497 34 30.4206 34H9.57944C7.05028 34 5 31.9497 5 29.4206V29.4206C5 27.7468 5.91318 26.2063 7.3816 25.403L20 18.5ZM20 18.5L32.6184 11.597C34.0868 10.7937 35 9.25323 35 7.57944V7.57944C35 5.05028 32.9497 3 30.4206 3H9.57944C7.05028 3 5 5.05028 5 7.57944V7.57944C5 9.25323 5.91318 10.7937 7.3816 11.597L20 18.5Z" stroke="#009C74" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="welcome-exchange__timer-clock">
                                00:00
                            </div>
                        </div>
                    </div>
                </div>
                <div class="welcome-exchange__body">
                    <div class="welcome-exchange__block bottom exchnage-panel-left" >
                        <div class="welcome-exchange__block-subtitle mb-[10px]">
                            Вы отправляете <span>Tether ERC20 USDT</span>
                        </div>
                        <input class="welcome-exchange__input" type="number" name="amount" placeholder="Min amount:0">
                        <div class="welcome-exchange__select">
                            <input class="hidden" name="currency_from">
                            <div class="welcome-exchange__select-selected">
                                <div class="welcome-exchange__select-selected-value flex items-center gap-[10px] mr-[20px]">
                                    <img src="https://comcash.io/icons/Ethereum.png" class="welcome-exchange__img"/>
                                    <div class="welcome-exchange__name">Тинькофф(RUB)</div>
                                </div>
                                <div class="welcome-exchange__arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 28 14" fill="none">
                                        <path d="M26 2L14 12L2 2" stroke="#CFCFCF" stroke-width="3" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="welcome-exchange__select-list">
                                <div class="welcome-exchange__select-header">
                                    <div class="welcome-exchange__select-close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M18 6L6 18" stroke="#CFCFCF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 6L18 18" stroke="#CFCFCF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input class="welcome-exchange__select-search" placeholder="Поиск">
                                    <div class="welcome-exchange__filter">
                                        <div class="welcome-exchange__filter-item active">Все</div>
                                        <div class="welcome-exchange__filter-item">Карты</div>
                                        <div class="welcome-exchange__filter-item">Крипта</div>
                                    </div>
                                </div>
                                <div class="welcome-exchange__list">
                                    <div class="welcome-exchange__list-item active">
                                        <div class="flex items-center gap-[10px]">
                                            <img src="https://comcash.io/icons/Ethereum.png" class="welcome-exchange__img"/>
                                            <div class="welcome-exchange__name">Тинькофф(RUB)</div>
                                        </div>
                                        <div class="welcome-exchange__list-check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 28 28" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 28C21.732 28 28 21.732 28 14C28 6.26801 21.732 0 14 0C6.26801 0 0 6.26801 0 14C0 21.732 6.26801 28 14 28ZM20.9909 9.97352C21.3444 9.54924 21.2871 8.91868 20.8628 8.56511C20.4386 8.21155 19.808 8.26887 19.4544 8.69315L13.0787 16.344C12.732 16.7601 12.5371 16.9904 12.3815 17.132L12.3755 17.1374L12.3691 17.1325C12.2013 17.0057 11.9863 16.7939 11.6034 16.411L8.48532 13.2929C8.09479 12.9024 7.46163 12.9024 7.07111 13.2929C6.68058 13.6834 6.68058 14.3166 7.07111 14.7071L10.1892 17.8252L10.23 17.866L10.23 17.866C10.5565 18.1926 10.8706 18.5068 11.1628 18.7278C11.4902 18.9754 11.9189 19.2081 12.4683 19.1832C13.0177 19.1583 13.4236 18.8876 13.7272 18.6115C13.9982 18.365 14.2826 18.0236 14.5781 17.6688L14.5782 17.6688L14.6151 17.6244L20.9909 9.97352Z" fill="#009C74"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-exchange__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 30 30" fill="none">
                            <g opacity="0.84992">
                                <path d="M22.857 6.40091C21.5657 4.47826 19.823 3.09231 17.867 2.43221C15.9111 1.77212 13.837 1.87006 11.9279 2.71267C10.0189 3.55527 8.36794 5.10149 7.20038 7.14022C6.03282 9.17904 5.40562 11.611 5.4043 14.1042V17.4119" stroke="white" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.53516 24.4351C9.88938 26.1989 11.6432 27.4224 13.5695 27.9472C15.4959 28.4719 17.506 28.2738 19.3397 27.3784C21.1733 26.483 22.7461 24.9316 23.8543 22.9251C24.9625 20.9186 25.5552 18.5493 25.5555 16.1241V13.9219" stroke="white" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.86532 11.9953C9.85968 12.1279 9.82403 12.2567 9.76052 12.3685L5.58579 19.638C5.47063 19.8377 5.28106 19.9519 5.08222 19.939C4.88338 19.9262 4.70456 19.7884 4.60701 19.575L1.07333 11.8089C0.970916 11.5829 0.975772 11.3059 1.08793 11.086C1.19935 10.8652 1.39877 10.7375 1.60917 10.751L9.31759 11.2476C9.528 11.2612 9.71547 11.4138 9.80751 11.6477C9.85149 11.7579 9.87035 11.8779 9.86532 11.9953Z" fill="white"/>
                                <path d="M20.8675 18.6148C20.8712 18.4838 20.9046 18.356 20.9657 18.2444L24.9827 10.9838C25.0935 10.7844 25.279 10.6678 25.4753 10.6762C25.6717 10.6846 25.85 10.8168 25.9492 11.0253L29.5444 18.6126C29.6486 18.8335 29.6477 19.1069 29.5401 19.3261C29.4333 19.5463 29.2383 19.6766 29.0306 19.6676L21.4184 19.3409C21.2107 19.332 21.0235 19.1853 20.9295 18.9565C20.8845 18.8488 20.8642 18.7308 20.8675 18.6148Z" fill="white"/>
                            </g>
                        </svg>
                    </div>
                    <div class="welcome-exchange__block top exchnage-panel-right">
                        <div class="welcome-exchange__block-subtitle mb-[10px]">
                            Вы получаете<span>Тинькофф RUB</span>
                        </div>
                        <input class="welcome-exchange__input" placeholder="Min amount: 0" >
                        <div class="welcome-exchange__select">
                            <input class="hidden" name="currency_from" >
                            <div class="welcome-exchange__select-selected">
                                <div class="welcome-exchange__select-selected-value flex items-center gap-[10px] mr-[20px]">
                                    <img src="https://comcash.io/icons/Ethereum.png" class="welcome-exchange__img"/>
                                    <div class="welcome-exchange__name">Тинькофф(RUB)</div>
                                </div>
                                <div class="welcome-exchange__arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 28 14" fill="none">
                                        <path d="M26 2L14 12L2 2" stroke="#CFCFCF" stroke-width="3" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="welcome-exchange__select-list">
                                <div class="welcome-exchange__select-header">
                                    <div class="welcome-exchange__select-close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M18 6L6 18" stroke="#CFCFCF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 6L18 18" stroke="#CFCFCF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input class="welcome-exchange__select-search" placeholder="Поиск">
                                    <div class="welcome-exchange__filter">
                                        <div class="welcome-exchange__filter-item active">Все</div>
                                        <div class="welcome-exchange__filter-item">Карты</div>
                                        <div class="welcome-exchange__filter-item">Крипта</div>
                                    </div>
                                </div>
                                <div class="welcome-exchange__list">
                                    <div class="welcome-exchange__list-item active">
                                        <div class="flex items-center gap-[10px]">
                                            <img src="https://comcash.io/icons/Ethereum.png" class="welcome-exchange__img"/>
                                            <div class="welcome-exchange__name">Тинькофф(RUB)</div>
                                        </div>
                                        <div class="welcome-exchange__list-check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 28 28" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 28C21.732 28 28 21.732 28 14C28 6.26801 21.732 0 14 0C6.26801 0 0 6.26801 0 14C0 21.732 6.26801 28 14 28ZM20.9909 9.97352C21.3444 9.54924 21.2871 8.91868 20.8628 8.56511C20.4386 8.21155 19.808 8.26887 19.4544 8.69315L13.0787 16.344C12.732 16.7601 12.5371 16.9904 12.3815 17.132L12.3755 17.1374L12.3691 17.1325C12.2013 17.0057 11.9863 16.7939 11.6034 16.411L8.48532 13.2929C8.09479 12.9024 7.46163 12.9024 7.07111 13.2929C6.68058 13.6834 6.68058 14.3166 7.07111 14.7071L10.1892 17.8252L10.23 17.866L10.23 17.866C10.5565 18.1926 10.8706 18.5068 11.1628 18.7278C11.4902 18.9754 11.9189 19.2081 12.4683 19.1832C13.0177 19.1583 13.4236 18.8876 13.7272 18.6115C13.9982 18.365 14.2826 18.0236 14.5781 17.6688L14.5782 17.6688L14.6151 17.6244L20.9909 9.97352Z" fill="#009C74"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="welcome__descr-container">
                <div class="welcome__descr">
                    <h1 class="welcome__descr-title">
                        <?php 
                            $text = __("front.indexSidePanelText1");
                            $text = explode(" ", $text);

                            $first = $text[0];
                            $second = array_slice($text, 1, -2);
                            $second = implode(" ", $second);
                            $third = @$text[count($text) - 2];
                            $fourth = end($text);
                        ?>
                        <span class="green">{{$first}}</span> {{$second}} <span class="green">{{$third}}</span> <span class="underline">{{$fourth}}</span>
                    </h1>
                    <ul class="welcome__descr-list">
                        <?php 
                            $text = __("front.indexSidePanelText3");
                            $text = explode(" ", $text);

                            $first = implode(" ", array_slice($text, 0, 2));
                            $second = @$text[2];
                            $third = implode(" ", array_slice($text, 3));

                        ?>
                        <li>
                            {{$first}} <span class="green">{{$second}}</span> {{$third}}
                        </li>
                        <?php 
                            $text = __("front.indexSidePanelText4");
                            $text = explode(" ", $text);

                            $first = implode(" ", array_slice($text, 0, 4));
                            $second = @$text[4];
                            $third = implode(" ", array_slice($text, 5, 2));
                            $fourth = @$text[7];
                            $fifth = implode(" ", array_slice($text, 8));

                        ?>
                        <li>                    
                            {{$first}} <span class="green">{{$second}}</span> {{$third}} 
                            <span class="green">{{$fourth}}</span> {{$fifth}}
                        </li>
                        <li>
                            {{__("front.indexSidePanelText5")}}
                        </li>
                    </ul>
                    <div class="welcome__descr-copyright">
                        {{__("front.indexSidePanelText6")}}
                    </div>
                    <div class="welcome__descr-copyright">Com<span class="green">CASH</span></div>
                </div>
                <img src="/comcash/img/kyc-cross.svg" class="welcome__security-image big">
            </div>  
        </div>
    </div>
    <!-- <div class='welcome__banner'>
        <div class="welcome__banner-arrow welcome__banner-arrow_left">
            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="48" viewBox="0 0 27 48" fill="none">
                <path d="M26.0115 5.76149C27.3295 4.44347 27.3295 2.30653 26.0115 0.988515C24.6935 -0.329505 22.5565 -0.329505 21.2385 0.988515L0.988514 21.2385C-0.329504 22.5565 -0.329504 24.6935 0.988514 26.0115L21.2385 46.2615C22.5565 47.5795 24.6935 47.5795 26.0115 46.2615C27.3295 44.9435 27.3295 42.8065 26.0115 41.4885L8.14797 23.625L26.0115 5.76149Z" fill="white"/>
            </svg>
        </div>
        <div class="welcome__banner-arrow welcome__banner-arrow_right">
            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="48" viewBox="0 0 27 48" fill="none">
                <path d="M26.0115 5.76149C27.3295 4.44347 27.3295 2.30653 26.0115 0.988515C24.6935 -0.329505 22.5565 -0.329505 21.2385 0.988515L0.988514 21.2385C-0.329504 22.5565 -0.329504 24.6935 0.988514 26.0115L21.2385 46.2615C22.5565 47.5795 24.6935 47.5795 26.0115 46.2615C27.3295 44.9435 27.3295 42.8065 26.0115 41.4885L8.14797 23.625L26.0115 5.76149Z" fill="white"/>
            </svg>
        </div>
        <div class="welcome__banner-title">
            {{__("front.indexSidePanelTitle1")}} <span>{{__("front.indexSidePanelTitle2")}}</span> {{__("front.indexSidePanelTitle3")}}
        </div>
        <div class="welcome__banner-text">
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText1")}}
            </div>
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText2")}}
            </div>
            <div class="welcome__banner-text-item">
                {{__("front.indexSidePanelText3")}}
            </div>
        </div>
        <div class="welcome__banner-text">
            {{__("front.indexSidePanelText4")}}
        </div>
        <div class="welcome__banner-text">
            {{__("front.indexSidePanelText5")}}<br>
            {{__("front.indexSidePanelText6")}}<br>
            {{__("front.indexSidePanelText7")}} Com<span>CASH</span>
        </div>
    </div> -->
    <div class='welcome__container'>
        <div class='welcome__bottom'>
            <div class='welcome__bottom-payments'>
                <img src='/comcash/img/sber.svg' alt='' />
                <img src='/comcash/img/tinkoff.svg' alt='' />
                <img src='/comcash/img/visa.svg' alt='' />
                <img src='/comcash/img/mastercard.svg' alt='' />
                <img src='/comcash/img/mir.svg' alt='' />

            </div>
        </div>
    </div>
</div>