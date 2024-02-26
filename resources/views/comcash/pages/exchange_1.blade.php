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
						<input type='text' class='input input--large'/>
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
					<div class="exchange__contact">
						<div class="exchange__contact-item hide" id="exchange-phone">
							<div class='label'>
								<span>{{__("front.exchangePageInputPhone")}}</span>
							</div>
							<input type="text" class="input input--large" value="+" name="phone">
						</div>
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
		</form>
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