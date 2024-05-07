@extends('comcash.layout.main')

@section('content')

<div class="exchange">
	<div class="exchange__container">
		<p class="exchange__title-mobile">{{__("front.exchangePageCreateNewExchange")}} {{$currencyFrom}} -> {{$currencyTo}}</p>
		<form action="{{route("exchgangeCreate")}}" class="exchange__form">
			@csrf
			<div class="exchange__main-form">
				<p class="exchange__title-mobile">{{__("front.exchangePageCreateNewExchange")}} {{$currencyFrom}} -> {{$currencyTo}}</p>
				<div id="currencyYouSend">
					<div class='label'>
						<span>{{__("front.exchangePageChooseCurrencyFrom")}}</span>
						<div class="exchange__limit">
							<span class="exchange__min">Min:
							<span>0</span>
							</span>
							<span class="exchange__max">Max:
							<span>0</span>
							</span>
						</div>
					</div>
					<div class='input-control' id="exchange-currency_from">
						<input type='text' class='input input--large' name="amount"/>
						<img src="/comcash/img/loader-gray.gif" class="custom-select__select-loader"/>
						<div class="custom-select__select-container light" data-currency="currencyYouSend">
							<div class="custom-select__select-label">
								{{__("front.exchangePageChooseCurrencyFrom")}}
							</div>
							<input class="custom-select__select-label-input" name="currency_from"/>
							<div class="custom-select__select-list-container hide">
								<div class="custom-select__select-list">
									<div class="custom-select__search">
										<input class="custom-select__search-field"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="exchange__text-warning">
						<b>{{mb_strtoupper(__("front.attention"))}}!</b> {{__("front.exchangeattentiontext")}} 
						<a class="green underline cursor-pointer" href="https://t.me/{{__('front.supportContactsTelegram')}}">Telegram</a>
					</div>
					<div class="exchange__card-number hide" id="exchange-from_card">
						<div class='label'>
							<span>{{__("front.exchangePageCardNumber")}}</span>
						</div>
						<input type="text" class="input input--large" name="from_card">
					</div>
					<div class="exchange__contact-item hide" id="exchange-from_address">
						<div class='label'>
							<span>{{__("front.exchangePageAddress")}}</span>
						</div>
						<input type="text" class="input input--large" name="from_address">
					</div>
				</div>
				<div class="exchange__info">
					<p class="exchange__info-text">{{__("front.exchangePageChoosenTariff")}}</p>
					<p class="exchange__info-text">{{__("front.exchangePageNoHiddenComissions")}}</p>
				</div>
				<div id="currencyYouGet">
					<div class='label'>
						<span>{{__("front.exchangePageChooseCurrencyTo")}}</span>
					</div>
					<div class='input-control' id="exchange-currency_to">
						<input type='text' class='input input--large'  name="amount_to"/>
						<img src="/comcash/img/loader-gray.gif" class="custom-select__select-loader"/>
						<div class="exchange__currency-lock">
							<svg width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg" fill="#BFBFC3" class="exchange__currency-lock_open">
								<path d="M8 15V12H10V15C10 15.5523 9.55229 16 9 16C8.44771 16 8 15.5523 8 15Z"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M9 0C6.23858 0 4 2.23858 4 5V7H2C0.895431 7 0 7.89543 0 9V17C0 19.2091 1.79086 21 4 21H14C16.2091 21 18 19.2091 18 17V9C18 7.89543 17.1046 7 16 7H6V5C6 3.34315 7.34315 2 9 2C10.0412 2 10.9585 2.53038 11.4965 3.3357L13.1607 2.22618C12.2641 0.883956 10.7353 0 9 0ZM2 17V9H16V17C16 18.1046 15.1046 19 14 19H4C2.89543 19 2 18.1046 2 17Z"></path>
							</svg>
							<svg width="18" height="21" viewBox="0 0 18 21" xmlns="http://www.w3.org/2000/svg" fill="#00C26F" class="exchange__currency-lock_close">
								<path d="M8 15V12H10V15C10 15.5523 9.55229 16 9 16C8.44771 16 8 15.5523 8 15Z"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4 5C4 2.23858 6.23858 0 9 0C11.7614 0 14 2.23842 14 4.99988V7H16C17.1046 7 18 7.89543 18 9V17C18 19.2091 16.2091 21 14 21H4C1.79086 21 0 19.2091 0 17V9C0 7.89543 0.895431 7 2 7H4V5ZM12 7H6V5C6 3.34315 7.34315 2 9 2C10.6569 2 12 3.34307 12 4.99988V7ZM2 9V17C2 18.1046 2.89543 19 4 19H14C15.1046 19 16 18.1046 16 17V9H2Z"></path>
							</svg>
						</div>
						<input name="reverse" class="hidden"/>
						<div class="custom-select__select-container light" data-currency="currencyYouGet">
							<div class="custom-select__select-label">
								{{__("front.exchangePageChooseCurrencyTo")}}
							</div>
							<input class="custom-select__select-label-input" name="currency_to"/>
							<div class="custom-select__select-list-container hide">
								<div class="custom-select__select-list">
									<div class="custom-select__search">
										<input class="custom-select__search-field"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="exchange__timer-conatiner">
						<span>{{__("front.exchangePageTimeUntilUpdate")}}</span>
						<span class="exchange__timer">00:00</span>
					</div>
					<div class="exchange__card-number hide" id="exchange-to_card">
						<div class='label'>
							<span>{{__("front.exchangePageCardNumberReceive")}}</span>
						</div>
						<input type="text" class="input input--large" name="to_card">
					</div>
					<div class="exchange__contact-item hide" id="exchange-to_address">
						<div class='label'>
							<span>{{__("front.exchangePageAddressReceive")}}</span>
						</div>
						<input type="text" class="input input--large" name="to_address">
					</div>
					<div class="exchange__contact-item hide" id="exchange-passport">
						<div class='label'>
							<span>{{__("front.exchangePageInputPassport")}}</span>
						</div>
						<input type="text" class="input input--large" name="passport">
					</div>
					<div class="exchange__contact-item hide" id="exchange-city">
						<div class='label'>
							<span>{{__("front.exchangePageInputCity")}}</span>
						</div>
						<input type="text" class="input input--large mb-[5px]" name="city">
						<a class="text-[12px] px-[20px] underline" href='{{route("comcashPage", ["delivery"])}}'>
							{{__("front.exchangeCitiesCash")}}
						</a>
					</div>
					<div class="exchange__contact">
						<div class="exchange__contact-item hide" id="exchange-email">
							<div class='label'>
								<span>Email</span>
							</div>
							<input type="text" class="input input--large" name="email" value="{{auth()->user() ? auth()->user()->email : ""}}">
						</div>
						<div class="exchange__contact-item hide" id="exchange-telegram">
							<div class='label'>
								<span>Telegram</span>
							</div>
							<input type="text" class="input input--large" name="telegram" value="{{auth()->user() ? auth()->user()->telegram : ""}}">
						</div>
					</div>
					<div class="exchange__contact">
						<div class="exchange__contact-item hide" id="exchange-phone">
							<div class='label'>
								<span>{{__("front.exchangePageInputPhone")}}</span>
							</div>
							<input type="text" class="input input--large" value="+" name="phone">
						</div>
						<div class="exchange__contact-item hide" id="exchange-bank">
							<div class='label'>
								<span>{{__("front.exchangePageInputBank")}}</span>
							</div>
							<input name="bank" type="text" class="input input--large" value="">
						</div>
					</div>
					<div class="exchange__name">
						<div class="exchange__name-item hide" id="exchange-first_name">
							<div class='label'>
								<span>{{__("front.exchangePageInputFirstName")}}</span>
							</div>
							<input name="first_name" type="text" class="input input--large" value="{{auth()->user() ? auth()->user()->first_name : ""}}">
						</div>
						<div class="exchange__name-item hide" id="exchange-last_name">
							<div class='label'>
								<span>{{__("front.exchangePageInputLastName")}}</span>
							</div>
							<input name="last_name" type="text" class="input input--large" value="{{auth()->user() ? auth()->user()->second_name : ""}}">
						</div>
						<div class="exchange__name-item hide" id="exchange-second_name">
							<div class='label'>
								<span>{{__("front.exchangePageInputSecondName")}}</span>
							</div>
							<input name="second_name" type="text" class="input input--large" value="{{auth()->user() ? auth()->user()->last_name : ""}}">
						</div>
					</div>
				</div>
				<a class='button button--auto exchange__button'>{{__("front.exchangePageContinue")}}</a>
				<p class='exchange__bottom'>
					{{__("front.exchangePageContinueText1")}} <a href=''>{{__("front.exchangePageContinueText2")}}</a> {{__("front.exchangePageContinueText3")}}
				</p>
			</div>
			<div class="validation hide">
				<div class="validation__container">
					<p class="validation__title-mobile">{{__("front.exchangePageCreateNewExchange")}} {{$currencyFrom}} -> {{$currencyTo}}</p>
					<p class="validation__title">{{__("front.exchangePageCheckYourData")}}
					</p>
					<div class='validation__label'>
						{{__("front.exchangePageCheckYouSend")}}
					</div>
					<div class="validation__output" id="validation__you-send">
						<span>0,00000001 </span>
						<span>BTC </span>
					</div>
					<p class="validation__caption validation__caption_send"></p>
					<div class='validation__label'>
						{{__("front.exchangePageCheckYouReceive")}}
					</div>
					<div class="validation__output" id="validation__you-get">
						<span>0,00000001 </span>
						<span>BTC </span>
					</div>
					
					<p class="validation__caption validation__caption_get"></p>
					<div class="validation__awaiting">
						<p class="validation__awaiting-title">{{__("front.exchangePageCheckTimeForPay")}}</p>
						<p class="validation__awaiting-time">{{__("front.exchangePageCheckTimeForPay2")}}</p>
					</div>
					<div class="validation__controls">
						<button id="validation__send" class='button button--auto validation__button' type="submit">{{__("front.exchangePageSubmit")}}</button>
						<a id="validation__back" class='button button--auto button--dark validation__button'>{{__("front.exchangePageBack")}}</a>
					</div>
					<p class='validation__bottom'>
						{{__("front.exchangePageContinueText1")}} <a href=''>{{__("front.exchangePageContinueText2")}}</a> {{__("front.exchangePageContinueText3")}}
					</p>
				</div>
			</div>

			<div class="exchange__cash-modal hide">
				<div class="exchange__cash-modal-container">
					<p class="exchange__cash-modal-title">{{__("front.exchangePageCashTitle")}}</p>
					<p class="exchange__cash-modal-subtitle">{{__("front.exchangePageCashDescription")}}</p>
					<svg class="mb-[40px]" width="100" height="100" viewBox="0 0 683 683" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M320.666 14.1355C288.666 16.6688 254.666 24.0021 226.799 34.5354C114.799 76.8021 35.3318 175.202 17.0652 294.003C13.3318 318.402 13.0652 360.802 16.3985 384.668C26.5318 455.868 59.0652 521.469 109.332 572.135C158.932 622.135 223.332 654.668 293.999 665.602C320.399 669.602 362.266 669.602 388.666 665.602C458.266 654.802 521.599 623.336 570.666 574.802C621.999 524.135 654.531 460.135 665.599 388.668C669.599 362.268 669.599 320.402 665.599 294.003C649.065 186.669 583.599 96.6688 486.532 48.0021C454.399 31.7354 421.866 21.7355 385.466 16.6688C370.399 14.6688 333.199 13.2021 320.666 14.1355ZM368.132 56.0021C421.066 61.2021 471.599 80.8021 514.132 112.802C527.199 122.535 550.799 145.335 562.132 158.935C603.732 208.802 627.999 275.868 627.999 341.335C627.999 396.002 610.666 453.868 580.666 498.668C551.332 542.535 511.732 577.202 465.332 599.602C399.066 631.602 322.266 636.536 251.999 613.336C209.599 599.336 174.666 578.135 142.799 547.336C117.466 522.803 98.5318 497.068 83.8652 467.202C36.5318 370.268 47.5985 255.335 112.799 168.535C122.532 155.468 145.332 131.868 158.932 120.535C215.999 72.8021 294.132 48.8021 368.132 56.0021Z" fill="white" />
						<path d="M228.001 219.868C215.334 224.001 204.401 234.268 200.668 245.468C197.868 253.868 197.868 264.935 200.801 273.735C203.868 282.935 215.334 294.401 224.668 297.735C244.668 304.668 266.801 295.601 276.001 276.668C280.801 266.801 280.534 251.335 275.601 241.735C268.134 227.468 256.134 219.601 240.668 219.068C235.601 218.935 229.868 219.201 228.001 219.868Z" fill="white" />
						<path d="M430.133 220.668C419.866 224.535 412.8 231.068 407.066 242.001C402.133 251.201 402 266.801 406.666 276.668C415.866 295.601 438 304.668 458 297.735C467.333 294.401 478.8 282.935 481.866 273.735C488.533 253.601 480.266 232.268 462.133 223.068C453.733 218.668 438.266 217.601 430.133 220.668Z" fill="white" />
						<path d="M353.851 504.999C399.584 501.933 440.384 483.533 471.984 451.933C489.051 434.866 504.518 411.666 504.518 403.266C504.384 397.533 499.584 388.866 494.918 385.933C489.318 382.599 479.051 382.333 473.584 385.666C471.318 386.866 465.851 393.666 461.051 400.733C445.318 424.733 420.117 444.999 394.117 454.733C375.584 461.666 362.518 463.933 340.517 463.933C318.517 463.933 305.451 461.666 286.917 454.733C260.651 444.866 235.717 424.733 219.717 400.466C210.251 386.066 206.384 382.999 197.184 382.999C182.517 382.999 173.183 396.866 178.517 410.599C181.717 419.266 195.584 438.199 207.851 450.599C239.184 482.599 277.717 500.599 323.184 504.599C338.117 505.933 341.317 505.933 353.851 504.999Z" fill="white" />
					</svg>
					<a href="/" class="button min-w-[200px]">{{__("front.exchangePageCashButton")}}</a>
				</div>
			</div>
		</form>
	</div>
	<div class="exchange__seo">
		<div class="seo_block">
			{!! @$direction->data['content'][mb_strtolower(app()->getLocale())] !!}
		</div>
	</div>

</div>

@endsection

@section("js")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headerHeight = document.querySelector('header')?.offsetHeight;
            const footerHeight = document.querySelector('footer')?.offsetHeight;

            document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
            document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
        });
    </script>
@endsection