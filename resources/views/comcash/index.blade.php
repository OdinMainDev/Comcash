@extends('comcash.layout.main')

@section('content')
	<div class='welcome'>
		<div class='welcome__container'>
			<div class='welcome__top'>
				<div class='welcome__text'>
					<p class='welcome__title'>
						{!!__("front.comcash welcome title")!!}
					</p>
					<p class='welcome__subtitle'>
						{{__("front.comcash welcome 2")}}
					</p>
				</div>
				<div class='welcome__form crypto-form'>
					<div class='welcome__tabs'>
						<div class='welcome__tabs-btn active'
							onclick="window.openIndexExchangeTab(event, 'tab1')">{{__("front.exchange crypto")}}</div>
						<div class='welcome__tabs-btn'
							onclick="window.openIndexExchangeTab(event, 'tab2')">{{__("front.buy sell")}}</div>
					</div>
					<div class='welcome__tabs-body'>
						<div class='welcome__tabs-content active' data-tab='tab1'>
							<form method='POST' class="crypto-form__exchange-form" action="{{route("redirectToExchange")}}">
								@csrf
								<div class='label'>{{__("front.you send")}}</div>
								<div class='input-control'>
									<input type='text' class="input" id="cryptoYouSend" name="amount"/>
									<img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
									<div class="custom-select__select-container" id="cryptoYouSendSelect" data-currency="cryptoYouSendSelect">
										<div class="custom-select__select-label">{{__("front.choose currency")}}</div>
										<input class="custom-select__select-label-input" name="currency_from"/>
										<div class="custom-select__select-list hide">
											<div class="custom-select__search">
												<input class="custom-select__search-field"/>
											</div>
										</div>
									</div>
								</div>
								<div class="crypto-form__reverse">
									<span class='label__tarif'>>{{__("front.currency rate")}}: 0.0000</span>
								</div>
								<div class='label'>
									<span>{{__("front.you receive")}}</span>
								</div>
								<div class='input-control'>
									<input type='text' class='input' id="cryptoYouGet"/>
									<img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
									<div class="custom-select__select-container" id="cryptoYouGetSelect" data-currency="cryptoYouGetSelect">
										<div class="custom-select__select-label">{{__("front.choose currency")}}</div>
										<input class="custom-select__select-label-input" name="currency_to"/>
										<div class="custom-select__select-list hide">
											<div class="custom-select__search">
												<input class="custom-select__search-field"/>
											</div>
										</div>
									</div>
								</div>
								<button class='button button--auto' type='submit'>{{__("front.exchange")}}</button>
							</form>
						</div>
						<div class='welcome__tabs-content' data-tab='tab2'>
							<form action='POST' class="crypto-form__buy-and-sell-form">
								<div class='label'>You Pay</div>
								<div class='input-control'>
									<input type='number' class="input" id="cryptoYouPay" />
									<img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
									<div class="custom-select__select-container" id="cryptoYouPaySelect" data-currency="cryptoYouPaySelect">
										<div class="custom-select__select-label">
											Выберите крипту 
										</div>
										<div class="custom-select__select-list hide">
											<div class="custom-select__search">
												<input class="custom-select__search-field"/>
											</div>
										</div>
									</div>
								</div>
								<div class="crypto-form__switch-container">
									<div class="crypto-form__switch">
										<input type="checkbox" id="cryptoFormSwitch">
										<label for="cryptoFormSwitch" class="crypto-form__switch-item active">
											Sell
											<svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg" fill="#808086" class="fiat-buttons-swap__arrow-sell">
												<path d="M3.73358 12.7001C4.07748 13.1013 4.69817 13.1013 5.04208 12.7001L7.79082 9.4933C8.26994 8.93435 7.87278 8.07082 7.13658 8.07082L5.92858 8.07082L5.92859 1.22888C5.92859 0.752981 5.54279 0.367188 5.06689 0.367188L3.70882 0.367188C3.23292 0.367187 2.84713 0.75298 2.84713 1.22888L2.84713 8.07082H1.63924C0.903052 8.07082 0.505887 8.93433 0.984984 9.49329L3.73358 12.7001Z">
												</path>
											</svg>
										</label>
										<label for="cryptoFormSwitch" class="crypto-form__switch-item">
											Buy
											<svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg" fill="#808086" class="fiat-buttons-swap__arrow-buy">
												<path d="M3.73358 12.7001C4.07748 13.1013 4.69817 13.1013 5.04208 12.7001L7.79082 9.4933C8.26994 8.93435 7.87278 8.07082 7.13658 8.07082L5.92858 8.07082L5.92859 1.22888C5.92859 0.752981 5.54279 0.367188 5.06689 0.367188L3.70882 0.367188C3.23292 0.367187 2.84713 0.75298 2.84713 1.22888L2.84713 8.07082H1.63924C0.903052 8.07082 0.505887 8.93433 0.984984 9.49329L3.73358 12.7001Z">
												</path>
											</svg>
										</label>
									</div>
								</div>
								<div class='label'>
									<span>you get</span>
								</div>
								<div class='input-control'>
									<input type='number' class='input' id="cryptoYouBuy"/>
									<img src="/comcash/img/loader-gray.gif" class="crypto-form__select-loader"/>
									<div class="custom-select__select-container" id="cryptoYouBuySelect" data-currency="cryptoYouBuySelect">
										<div class="custom-select__select-label">
											Выберите крипту 
										</div>
										<div class="custom-select__select-list hide">
											<div class="custom-select__search">
												<input class="custom-select__search-field"/>
											</div>
										</div>
									</div>
								</div>
								<button
									class='button button--auto'
									type='submit'
									>Buy</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class='welcome__bottom'>
				<div class='welcome__bottom-text'>
					ПОКУПАЙТЕ КРИПТУ С ПОМОЩЬЮ
				</div>
				<div class='welcome__bottom-payments'>
					<img src='/comcash/img/sber.svg' alt='' />
					<img src='/comcash/img/tinkoff.svg' alt='' />
					<img src='/comcash/img/visa.svg' alt='' />
					<img src='/comcash/img/mastercard.svg' alt='' />
				</div>
			</div>
		</div>
	</div>
	<div class='about'>
		<div class='about__container'>
			<p class='about__title'>
				Как этим пользоваться?
			</p>
			<div class='about__body'>
				<div class='about__col'>
					<div class='about__item about__item-1'>
						<p class='about__item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
						<p class='about__item-text'>Наш сайт оборудован дополнительной
							системой защиты, для максимально безопасных сделок.
						</p>
					</div>
					<div class='about__item about__item-2'>
						<p class='about__item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
						<p class='about__item-text'>Наш сайт оборудован дополнительной
							системой защиты, для максимально безопасных сделок.
						</p>
					</div>
				</div>
				<div class='about__col'>
					<div class='about__screen'>
						<p class='about__screen-title'>МАКСИМАЛЬНОЕ УДОБСТВО</p>
						<p class='about__screen-text'>Наша платформа доступна из любого уголка
							планеты, на всех видах устройств.
						</p>
					</div>
				</div>
				<div class='about__col'>
					<div class='about__item about__item-3'>
						<p class='about__item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
						<p class='about__item-text'>Наш сайт оборудован дополнительной
							системой защиты, для максимально безопасных сделок.
						</p>
					</div>
					<div class='about__item about__item-4'>
						<p class='about__item-title'>ОТПРАВЛЯЙТЕ И ПОЛУЧАЙТЕ</p>
						<p class='about__item-text'>Наш сайт оборудован дополнительной
							системой защиты, для максимально безопасных сделок.
						</p>
					</div>
				</div>
			</div>
			<button class='about__btn button'>ПОСМОТРЕТЬ ТАРИФЫ</button>
		</div>
	</div>
	<div class='transactions'>
		<div class='transactions__container'>
			<p class='transactions__title'>Последние транзации</p>
			<div class='transactions__table'>
				<div class='transactions__header'>
					<div class='transactions__header-item'>#</div>
					<div class='transactions__header-item'>Name</div>
					<div class='transactions__header-item'>Quantity</div>
					<div class='transactions__header-item'>Name</div>
					<div class='transactions__header-item'>Quantity</div>
				</div>
				<div class='transactions__row'>
					<div class='transactions__row-item'>1111</div>
					<div class='transactions__row-item'>
						<img src='/comcash/img/sber-icon.svg'
							alt='' />
						<p>Sberbank</p>
						<span>RUB</span>
					</div>
					<div class='transactions__row-item'>9999</div>
					<div class='transactions__row-item'>
						<img src='/comcash/img/sber-icon.svg'
							alt='' />
						<p>Sberbank</p>
						<span>RUB</span>
					</div>
					<div class='transactions__row-item'>9999</div>
				</div>
				<div class='transactions__row'>
					<div class='transactions__row-item'>1111</div>
					<div class='transactions__row-item'>
						<img src='/comcash/img/sber-icon.svg'
							alt='' />
						<p>Sberbank</p>
						<span>RUB</span>
					</div>
					<div class='transactions__row-item'>9999</div>
					<div class='transactions__row-item'>
						<img src='/comcash/img/sber-icon.svg'
							alt='' />
						<p>Sberbank</p>
						<span>RUB</span>
					</div>
					<div class='transactions__row-item'>9999</div>
				</div>
			</div>
		</div>
	</div>
	<div class='feedback'>
		<div class='feedback__container'>
			<p class='feedback__title'>Что думают наши пользователи?
			</p>
			<div class="slider">
				<div>
					1
					your content your content your content your content your content your content your content your content your
					content your content your content your content your content your content your content your content your
					content your content your content your content your content your content
				</div>
				<div>2 your content your content your content your content your content your content your content your content
					your content your content your content your content your content your content your content your content your
					content your content your content your content your content your content
				</div>
				<div> 3your content your content your content your content your content your content your content your content
					your content your content your content your content your content your content your content your content your
					content your content your content your content your content your content
				</div>
				<div>4 your content your content your content your content your content your content your content your content
					your content your content your content your content your content your content your content your content your
					content your content your content your content your content your content
				</div>
			</div>
		</div>
	</div>
	<div class='courier'>
		<div class='courier__container'>
			<div class='courier__box'>
				<p class='courier__title'>
					<span>Надёжный</span>
					курьер
					<span>наличными</span>
				</p>
				<p class='courier__text'>
					Мгновенный обмен и быстрая сделка: наш курьер придет к вам с наличными
					за криптовалюту! Безопасность, комфорт и скорость - три ключевых
					преимущества нашего сервиса. Обменять криптовалюту на реальные деньги
					еще никогда не было так просто!
				</p>
			</div>
			<button class='courier__button button'>Попробовать</button>
		</div>
	</div>
	<div class='news'>
		<div class='news__container'>
			<p class='news__title'>ОСТАВАЙТЕСЬ В КУРСЕ СОБЫТИЙ</p>
			<div class='news__content'>
				<div class='news__card'>
					<p class='news__card-title'>Title</p>
					<p class='news__card-text'>Криптовалюта Polygon станет основным
						платежным средством для приобретения новых аватаров от Reddit.
					</p>
					<div class='news__card-footer'>
						<img src='/comcash/img/sber-icon.svg'
							alt=''
							class='news__card-footer-img' />
						<div class='news__card-footer-info'>
							<p class='news__card-footer-social'>REDDIT</p>
							<p class='news__card-footer-date'>AUGUST 2, 2022</p>
						</div>
					</div>
				</div>
				<div class='news__card'>
					<p class='news__card-title'>Title</p>
					<p class='news__card-text'>Криптовалюта Polygon станет основным
						платежным средством для приобретения новых аватаров от Reddit.
					</p>
					<div class='news__card-footer'>
						<img src='/comcash/img/sber-icon.svg'
							alt=''
							class='news__card-footer-img' />
						<div class='news__card-footer-info'>
							<p class='news__card-footer-social'>REDDIT</p>
							<p class='news__card-footer-date'>AUGUST 2, 2022</p>
						</div>
					</div>
				</div>
				<div class='news__card'>
					<p class='news__card-title'>Title</p>
					<p class='news__card-text'>Криптовалюта Polygon станет основным
						платежным средством для приобретения новых аватаров от Reddit.
					</p>
					<div class='news__card-footer'>
						<img src='/comcash/img/sber-icon.svg'
							alt=''
							class='news__card-footer-img' />
						<div class='news__card-footer-info'>
							<p class='news__card-footer-social'>REDDIT</p>
							<p class='news__card-footer-date'>AUGUST 2, 2022</p>
						</div>
					</div>
				</div>
				<div class='news__card'>
					<p class='news__card-title'>Title</p>
					<p class='news__card-text'>Криптовалюта Polygon станет основным
						платежным средством для приобретения новых аватаров от Reddit.
					</p>
					<div class='news__card-footer'>
						<img src='/comcash/img/sber-icon.svg'
							alt=''
							class='news__card-footer-img' />
						<div class='news__card-footer-info'>
							<p class='news__card-footer-social'>REDDIT</p>
							<p class='news__card-footer-date'>AUGUST 2, 2022</p>
						</div>
					</div>
				</div>
			</div>
			<button class='news__button button'>читать все новости</button>
		</div>
	</div>	
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection