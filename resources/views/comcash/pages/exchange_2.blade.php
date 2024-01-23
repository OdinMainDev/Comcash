<?php $show = false; ?>

@extends('comcash.layout.main')

@section('content')
	@if($exchange->status >= 10)
        <div class="progress">
            <div class="progress__container">

            <p class="progress__title-mobile">Ошибка</p>

            <p class="progress__title">
                Ошибка
            </p>

            <div class="progress__box">
                <div class="progress__box-right">
                    <div class="progress__error">
                        <img src="/comcash/img/icons/sad-face.svg" class="progress__error-img" alt="sad-face"/>
                        <div class="progress__error-text">
							При обмене произошла ошибка создайте новую заявку или обратитесь к поддержке
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
	@else
		@if($exchange->currencyFrom->tag == "fiat")
			@if(isset($exchange->data['merchant_from_data']['url']))
				<?php $show = true; ?>
			@endif
		@else
			@if(isset($exchange->data['merchant_from_data']['address']))
				<?php $show = true; ?>
			@endif
		@endif
	@endif

	@if(!$show)
		@if($exchange->status < 10)
            <div class="progress">
                <div class="progress__container">

                <div class="progress__box">
                    <div class="progress__box-right">
                        <div class="progress__preparation">
                            <div class="progress__preparation-text" id="needRefreshPageId">
                                Подготовка обмена!
                            </div>
                            <div class="progress__preparation-img"></div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
		@endif
	@else
		<div class="progress" id="needCheckStatusExchange">
			<div class="progress__container">
				<p class="progress__title-mobile">{{__("front.exchange id")}} {{$exchange->id}}</p>
				<p class="progress__title">Выплата производится в автоматическом режиме в течении 30 минут</p>
				<div class="progress__box">
					@if($exchange->currencyFrom->tag == "crypto")
						<img src="https://chart.googleapis.com/chart?chs=224x224&cht=qr&chl={{$exchange->data['merchant_from_data']['address']}}&choe=UTF-8" class="progress__box-img" title="Link to Google.com" />
					@endif
					<div class="progress__box-right">
						@if($exchange->status != 5)
							<div class='progress__box-label'>
								Сумма
							</div>
							<div class="progress__flex">
								<div class="progress__box-text">
									<span class="value">{{$exchange->data['amount_data']['amount_send']}}</span>
									&nbsp;
									<span>{{$exchange->data['amount_data']['currency_from_name']}}</span>
								</div>
								<div class="progress__copy">
									<svg fill="#FFF" xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 330 330">
										<path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15
											c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95
											c-8.284,0-15,6.716-15,15v165H50V30z"/>
										<path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
										<path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
										<path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z"/>
									</svg>
								</div>
							</div>
							@if($exchange->currencyFrom->tag == "crypto")
								<div class='progress__box-label'>
									Адрес
								</div>
								<div class="progress__flex">
									<div class="progress__box-text">
										<span class="value">{{$exchange->data['merchant_from_data']['address']}}</span>
									</div>
									<div class="progress__copy">
										<svg fill="#FFF" xmlns="http://www.w3.org/2000/svg"
											viewBox="0 0 330 330">
											<path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15
												c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95
												c-8.284,0-15,6.716-15,15v165H50V30z"/>
											<path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
											<path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
											<path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z"/>
										</svg>
									</div>
								</div>
							@else
								<div class='progress__box-label'>
									<a class="button button--auto exchange__button" href="{{$exchange->data['merchant_from_data']['url']}}">{{__("front.gotopay")}}</a>
								</div>
							@endif
							<div class='progress__box-label'>
								<a class="button button--auto exchange__button" href="{{ route("exchgangeIPaid", [$exchange->hash])}}">{{__("front.ipaid")}}</a>
							</div>
						@else
							<div class="progress__error">
								<img src="/comcash/img/icons/smile-face.svg" class="progress__error-img" alt="sad-face"/>
								<div class="progress__error-text">
									{{__("front.exchangecompletetext")}}
								</div>
							</div>
						@endif
					</div>
				</div>
				@if($exchange->merchant_type_from != "manualcrypto" && $exchange->merchant_type_from != "manualfiat")
					<div class="progress__timeline">
						<p class="progress__timeline-item @if($exchange->status < 2) active @endif">{{__("front.exchangestatus0")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 2) active @endif">{{__("front.exchangestatus2")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 3) active @endif">{{__("front.exchangestatus3")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 4) active @endif">{{__("front.exchangestatus4")}}</p>
					</div>
				@else
					<div class="progress__timeline">
						<p class="progress__timeline-item @if($exchange->status == 0) active @endif">{{__("front.exchangestatus0")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 1) active @endif">{{__("front.exchangestatus2")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 2) active @endif">{{__("front.exchangestatus3")}}</p>
						<p class="progress__timeline-item @if($exchange->status == 4) active @endif">{{__("front.exchangestatus4")}}</p>
					</div>
				@endif
				<div class="progress__data-container">
					<div class="progress__data">
						<p class="progress__data-label">{{__("front.exchangestatus0")}}</p>
						<p class="progress__data-text"> {{$exchange->data['amount_data']['amount_receive']}} {{$exchange->data['amount_data']['currency_to_name']}}</p>
					</div>
					@if($exchange->currencyTo->tag == "crypto")
						<div class="progress__data">
							<p class="progress__data-label">{{__("front.addressreceive")}}</p>
							<p class="progress__data-text"> {{$exchange->data['request_data']['to_address']}}</p>
						</div>
					@else
						<div class="progress__data">
							<p class="progress__data-label">{{__("front.cardreceive")}}</p>
							<p class="progress__data-text"> {{$exchange->data['request_data']['to_card']}}</p>
						</div>
					@endif
				</div>
				<!-- <div class="progress__mail">
					<p class="progress__mail-title">Время ожидания</p>
					<div class="checkbox">
					<input type="checkbox"
							id="switch"
							class="checkbox" />
					<label for="switch"></label>
					</div>
					</div> -->
			</div>
		</div>
	@endif

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

	<script>
		window.exchangeStatus = parseInt("{{$exchange->status}}");
		window.exchangeHash = "{{$exchange->hash}}";
	</script>
@endsection
