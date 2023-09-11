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
				<div class='welcome__form'>
					<div class='welcome__tabs'>
						<div class='welcome__tabs-btn active'
							onclick="openTab(event, 'tab1')">{{__("front.exchange crypto")}}</div>
						<div class='welcome__tabs-btn'
							onclick="openTab(event, 'tab2')">{{__("front.buy sell")}}</div>
					</div>
					<div class='welcome__tabs-body'>
						<div class='welcome__tabs-content active'
							data-tab='tab1'>
							<form action='POST'>
								<div class='label'>{{__("front.you send")}}</div>
								<div class='input-control'>
									<input type='number' class='input' />
									<select class="select2 select2boxindex" name="currency_from" >
										<?php $count = 0;?>
										@foreach ($currencies as $key => $row)
											@if($row->tag == "crypto")
												<option value="{{$row->id}}" @if($count == 0) selected @endif data-image="{{$row->image}}">{{$row->name}}</option>
												<?php $count++; ?>
											@endif
										@endforeach
									</select>
								</div>
								<div class='label'>
									<span>you get</span>
									<span class='label__tarif'>Тут будет тариф обмена </span>
								</div>
								<div class='input-control'>
									<input type='number'
										class='input' />
									<select class="select2 select2boxindex" name="currency_to">
										<?php $count = 0;?>
										@foreach ($currencies as $key => $row)
											@if($row->tag == "crypto")
												<option value="{{$row->id}}" @if($count == 1) selected @endif data-image="{{$row->image}}">{{$row->name}}</option>
												<?php $count++; ?>
											@endif
										@endforeach
									</select>
								</div>
								<button class='button button--auto'
									type='submit'>exchange</button>
							</form>
						</div>
						<div class='welcome__tabs-content'
							data-tab='tab2'>
							<p>kek</p>
						</div>
					</div>
				</div>
			</div>
			<div class='welcome__bottom'>
				<div class='welcome__bottom-text'>
					ПОКУПАЙТЕ КРИПТУ С ПОМОЩЬЮ
				</div>
				<div class='welcome__bottom-payments'>
					<img src='/comcash/img/sber.svg'
						alt='' />
					<img src='/comcash/img/tinkoff.svg'
						alt='' />
					<img src='/comcash/img/visa.svg'
						alt='' />
					<img src='/comcash/img/mastercard.svg'
						alt='' />
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
	<footer class='footer'>
		<div class='footer__container'>
			<div class='footer__top'>
				<div class='footer__logo'>
					<img src='/comcash/img/logo.png'
						alt=''
						class='' />
					<p>Лучшая платформа на рынке</p>
				</div>
				<div class='footer__sitemap'>
					<div class='footer__sitemap-col'>
						<p class='footer__sitemap-title'>title</p>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
					</div>
					<div class='footer__sitemap-col'>
						<p class='footer__sitemap-title'>title</p>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
					</div>
					<div class='footer__sitemap-col'>
						<p class='footer__sitemap-title'>title</p>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
					</div>
					<div class='footer__sitemap-col'>
						<p class='footer__sitemap-title'>title</p>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
						<a href='#'
							class='footer__sitemap-link'>link</a>
					</div>
				</div>
			</div>
			<div class='footer__bottom'>
				<p class='footer__copyright'>© 2023 COMCASH. All Rights Reserved.</p>
				<div class='footer__socials'>
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
				</div>
			</div>
		</div>
	</footer>	
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection