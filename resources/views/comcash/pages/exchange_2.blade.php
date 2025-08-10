<?php $show = false; ?>

@extends('comcash.layout.main', ['withoud_ads' => true])

@section('content')
	@if($exchange->status >= 10)
		<div class="progress">
			<div class="progress__container">

				<p class="progress__title-mobile">{{__("front.exchangePage2ErrorTitle")}}</p>

				<p class="progress__title">
					{{__("front.exchangePage2ErrorDesctription")}}
				</p>
				<div class="progress__box">
					<div class="progress__box-right">
						<div class="progress__error">
							<img src="/comcash/img/icons/sad-face.svg" class="progress__error-img" alt="sad-face" />
							<div class="progress__error-text">
								{{__("front.exchangePage2ErrorDesctription2")}}
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
		@elseif($exchange->currencyFrom->tag == "cash")
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
			<div data-form="wait">
				<div
					class="absolute top-[-10%] inset-0 bg-[url('/comcash/img/green_mesh.webp')] bg-center bg-no-repeat z-0 pointer-events-none max-[500px]:hidden">
				</div>

				<section
					class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">

					<div class="relative flex items-center justify-center overflow-hidden">
						<div class="relative flex flex-col items-center justify-center text-center px-4 z-10">
							<img src="/comcash/img/icons/wired.gif" class="max-w-[200px] max-h-[200px] object-contain" />

							<h2 id="needRefreshPageId"
								class="text-[#06AB6B] max-[500px]:text-[24px] text-[32px] font-bold uppercase mt-6">{{__("front.exchangePage2ExchangePreparing")}}</h2>
							<p class="text-white max-[500px]:text-[14px] text-[16px] mt-2">{{__("front.creating_deal")}}</p>
						</div>
					</div>


				</section>
			</div>
		@endif
	@else
		@if ($exchange->status == 4)
			<div data-form="step2">
				<section
					class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto lg:h-[334px] flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">

					<div
						class="flex flex-col items-center text-center min-[800px]:flex-row min-[800px]:items-start min-[800px]:text-left justify-between gap-8 mb-4">
						<div class="flex flex-col">
							<h2 class="text-[#06AB6B] text-[24px] uppercase">{{__("front.payout_processing")}}</h2>
							<p class="text-white/80 text-[18px] mt-2">{{__("front.payout_auto_notice")}}</p>
							<p class="text-[#06AB6B] text-[18px]">{{__("front.within_30_minutes")}}</p>
						</div>

						<div class="flex justify-between items-center max-w-[508px] w-full text-xs text-white/60">
							<div class="flex flex-col items-center text-white max-[450px]:hidden">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.waiting_for_payment")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2"></div>
							<div class="flex flex-col items-center">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.checking_funds")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2"></div>
							<div class="flex flex-col items-center">
								<svg style="animation: spin 2s linear infinite reverse;" class="w-[52px] h-[52px] animate-spin"
									viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<defs>
										<clipPath id="clip3">
											<path
												d="M50.05 26C51.127 26 52.0076 25.1256 51.9269 24.0517C51.5404 18.9074 49.6302 13.9779 46.4182 9.90356C42.8027 5.31723 37.7483 2.08173 32.0696 0.718382C26.3909 -0.64496 20.4185 -0.0567342 15.1148 2.38828C9.81121 4.83329 5.48518 8.99269 2.83383 14.1962C0.182485 19.3998 -0.639763 25.3445 0.499582 31.0723C1.63893 36.8002 4.67351 41.9777 9.11435 45.7706C13.5552 49.5634 19.1437 51.7507 24.9792 51.98C30.1634 52.1836 35.2743 50.8316 39.6632 48.1205C40.5795 47.5545 40.7692 46.3281 40.1362 45.4569C39.5032 44.5856 38.2876 44.4007 37.3639 44.9545C33.6898 47.1573 29.4408 48.2522 25.1324 48.083C20.1721 47.8881 15.4219 46.0289 11.6472 42.805C7.87248 39.5811 5.29309 35.1802 4.32464 30.3115C3.3562 25.4428 4.05511 20.3898 6.30876 15.9668C8.5624 11.5438 12.2395 8.00829 16.7476 5.93003C21.2557 3.85178 26.3322 3.35178 31.1591 4.51062C35.9861 5.66947 40.2823 8.41965 43.3555 12.318C46.0249 15.7042 47.6366 19.7853 48.014 24.0524C48.1089 25.1252 48.973 26 50.05 26Z" />
										</clipPath>
									</defs>

									<foreignObject x="0" y="0" width="52" height="52" clip-path="url(#clip3)">
										<div xmlns="http://www.w3.org/1999/xhtml"
											style="width: 100%; height: 100%; background: conic-gradient(from 165deg at 51% 46%, #06AB6B 0deg, rgba(34, 34, 34, 0.5) 300deg, #06AB6B 360deg);">
										</div>
									</foreignObject>
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.processing_payout")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2 max-[450px]:hidden"></div>
							<div class="flex flex-col items-center">
								<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52.5 26C52.5 40.3594 40.8594 52 26.5 52C12.1406 52 0.5 40.3594 0.5 26C0.5 11.6406 12.1406 0 26.5 0C40.8594 0 52.5 11.6406 52.5 26ZM4.4 26C4.4 38.2055 14.2945 48.1 26.5 48.1C38.7055 48.1 48.6 38.2055 48.6 26C48.6 13.7945 38.7055 3.9 26.5 3.9C14.2945 3.9 4.4 13.7945 4.4 26Z"
										fill="#444444" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.confirming_payout")}}</span>
							</div>
						</div>
					</div>
					<div class="bg-white/5 rounded-[20px] p-[24px] flex flex-col min-[720px]:flex-row items-start gap-6">
						<div
							class="w-[160px] h-[160px] flex-shrink-0 rounded bg-white flex items-center justify-center overflow-hidden p-2 bg-white rounded-[10px]">

							@if($exchange->currencyFrom->tag == "crypto")
								<img src="https://api.qrserver.com/v1/create-qr-code/?data={{$exchange->data['merchant_from_data']['address']}}"
									class="w-full h-full object-contain" title="Link to Google.com" />
							@endif

						</div>


						<div class="flex-1 text-sm">
							<div class="mb-4">
								<p class="text-white/40 text-[14px] mb-3">{{__("front.exchangePage2AmountSend")}}:</p>
								<p class="text-[28px] flex items-center gap-2 mb-3">
									{{$exchange->data['amount_data']['amount_send']}}
									<button  class="copy-to-clipboard relative hover:opacity-70" data-copy-text="{{$exchange->data['amount_data']['amount_send']}}">
										<div class="tooltip  absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-1 text-xs bg-black text-white rounded opacity-0 transition-opacity pointer-events-none"
											role="tooltip">{{__("front.copied")}}</div>

										<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M8.325 17.0625H5.175C2.2425 17.0625 0.9375 15.7575 0.9375 12.825V9.675C0.9375 6.7425 2.2425 5.4375 5.175 5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V12.825C12.5625 15.7575 11.2575 17.0625 8.325 17.0625ZM5.175 6.5625C2.85 6.5625 2.0625 7.35 2.0625 9.675V12.825C2.0625 15.15 2.85 15.9375 5.175 15.9375H8.325C10.65 15.9375 11.4375 15.15 11.4375 12.825V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H5.175Z"
												fill="#06AB6B"></path>
											<path
												d="M12.825 12.5625H12C11.6925 12.5625 11.4375 12.3075 11.4375 12V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H6C5.6925 6.5625 5.4375 6.3075 5.4375 6V5.175C5.4375 2.2425 6.7425 0.9375 9.675 0.9375H12.825C15.7575 0.9375 17.0625 2.2425 17.0625 5.175V8.325C17.0625 11.2575 15.7575 12.5625 12.825 12.5625ZM12.5625 11.4375H12.825C15.15 11.4375 15.9375 10.65 15.9375 8.325V5.175C15.9375 2.85 15.15 2.0625 12.825 2.0625H9.675C7.35 2.0625 6.5625 2.85 6.5625 5.175V5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V11.4375Z"
												fill="#06AB6B"></path>
										</svg>
									</button>
								</p>
								<div class="text-xs text-white/50 mt-1 flex items-center gap-3">
									<span class="w-[24px] h-[24px] bg-green-500 rounded-full"></span>
									<span class="flex items-baseline gap-2 text-white">
										
										<span class="text-[16px]">{{$exchange->data['amount_data']['currency_from_name']}}</span>
										<span class="text-white/40 text-[14px]"></span>
									</span>
								</div>
							</div>

							@if($exchange->currencyFrom->tag == "crypto")
								<div>
									<p class="text-white/40 mb-3">{{__("front.exchangePage2CryptoAddress")}}:</p>
									<p class="break-all text-white flex items-center gap-2 text-sm">
										{{$exchange->data['merchant_from_data']['address']}}
										<button  class="copy-to-clipboard relative hover:opacity-70"
											data-copy-text="{{$exchange->data['merchant_from_data']['address']}}">
											<div class="tooltip absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-1 text-xs bg-black text-white rounded opacity-0 transition-opacity pointer-events-none whitespace-nowrap"
												role="tooltip">{{__("front.copied")}}</div>

											<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M8.325 17.0625H5.175C2.2425 17.0625 0.9375 15.7575 0.9375 12.825V9.675C0.9375 6.7425 2.2425 5.4375 5.175 5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V12.825C12.5625 15.7575 11.2575 17.0625 8.325 17.0625ZM5.175 6.5625C2.85 6.5625 2.0625 7.35 2.0625 9.675V12.825C2.0625 15.15 2.85 15.9375 5.175 15.9375H8.325C10.65 15.9375 11.4375 15.15 11.4375 12.825V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H5.175Z"
													fill="#06AB6B"></path>
												<path
													d="M12.825 12.5625H12C11.6925 12.5625 11.4375 12.3075 11.4375 12V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H6C5.6925 6.5625 5.4375 6.3075 5.4375 6V5.175C5.4375 2.2425 6.7425 0.9375 9.675 0.9375H12.825C15.7575 0.9375 17.0625 2.2425 17.0625 5.175V8.325C17.0625 11.2575 15.7575 12.5625 12.825 12.5625ZM12.5625 11.4375H12.825C15.15 11.4375 15.9375 10.65 15.9375 8.325V5.175C15.9375 2.85 15.15 2.0625 12.825 2.0625H9.675C7.35 2.0625 6.5625 2.85 6.5625 5.175V5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V11.4375Z"
													fill="#06AB6B"></path>
											</svg>
										</button>
									</p>
								</div>
							@else
								<div>

									<a class="text-white/40 mb-3"
										href="{{$exchange->data['merchant_from_data']['url']}}">{{__("front.gotopay")}}</a>
								</div>
							@endif

							@if($exchange->merchant_type_from == "manualcrypto" || $exchange->merchant_type_from == "manualfiat")
								@if($exchange->status == 0)

									<!-- STYLE MARK -->
									<div>
										<a class="text-white/40 mb-3 exchange__button"
											href="{{ route("exchgangeIPaid", [$exchange->hash])}}">{{__("front.ipaid")}}</a>
									</div>
								@endif
							@endif
						</div>


					</div>

					<div
						class="grid grid-cols-1 min-[770px]:[grid-template-columns:0.5fr_0.2fr_0.5fr] text-[18px] gap-x-4 sm:gap-x-20 gap-y-4 px-4 sm:px-[24px] items-center">
						<div>
							<span class="text-white/40 text-[14px]">
								{{__("front.youreceive")}}
							</span><br>{{$exchange->data['amount_data']['amount_receive']}}
							{{$exchange->data['amount_data']['currency_to_name']}}
						</div>

						@if($exchange->currencyTo->tag == "crypto")
							<div>
								<span class="text-white/40 text-[14px]">{{__("front.addressreceive")}}</span><br>
								<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_address']}}</p>
							</div>
						@else

							@if(isset($exchange->data['request_data']['to_card']))
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.cardreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_card']}}</p>
								</div>
							@else
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.phonesbpreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{@$exchange->data['request_data']['phone']}}</p>
								</div>
							@endif
						@endif

						<div>
							<span class="text-white/40 text-[14px]">{{__("front.exchange id")}}</span><br>{{$exchange->id}}
						</div>
					</div>




				</section>
			</div>
		@elseif($exchange->status != 5)
			<div data-form="step2">
				<section
					class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto lg:h-[334px] flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">

					<div
						class="flex flex-col items-center text-center min-[800px]:flex-row min-[800px]:items-start min-[800px]:text-left justify-between gap-8 mb-4">
						<div class="flex flex-col">
							<h2 class="text-[#06AB6B] text-[24px] uppercase">{{__("front.make_payment")}}</h2>
							<p class="text-white/80 text-[18px] mt-2">{{__("front.payout_auto_notice")}}</p>
							<p class="text-[#06AB6B] text-[18px]">{{__("front.within_30_minutes")}}</p>
						</div>

						<div class="flex justify-between items-center max-w-[508px] w-full text-xs text-white/60">
							<div class="flex flex-col items-center text-white">
								<svg style="animation: spin 2s linear infinite reverse;" class="w-[52px] h-[52px] animate-spin"
									viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<defs>
										<clipPath id="clip">
											<path
												d="M50.05 26C51.127 26 52.0076 25.1256 51.9269 24.0517C51.5404 18.9074 49.6302 13.9779 46.4182 9.90356C42.8027 5.31723 37.7483 2.08173 32.0696 0.718382C26.3909 -0.64496 20.4185 -0.0567342 15.1148 2.38828C9.81121 4.83329 5.48518 8.99269 2.83383 14.1962C0.182485 19.3998 -0.639763 25.3445 0.499582 31.0723C1.63893 36.8002 4.67351 41.9777 9.11435 45.7706C13.5552 49.5634 19.1437 51.7507 24.9792 51.98C30.1634 52.1836 35.2743 50.8316 39.6632 48.1205C40.5795 47.5545 40.7692 46.3281 40.1362 45.4569C39.5032 44.5856 38.2876 44.4007 37.3639 44.9545C33.6898 47.1573 29.4408 48.2522 25.1324 48.083C20.1721 47.8881 15.4219 46.0289 11.6472 42.805C7.87248 39.5811 5.29309 35.1802 4.32464 30.3115C3.3562 25.4428 4.05511 20.3898 6.30876 15.9668C8.5624 11.5438 12.2395 8.00829 16.7476 5.93003C21.2557 3.85178 26.3322 3.35178 31.1591 4.51062C35.9861 5.66947 40.2823 8.41965 43.3555 12.318C46.0249 15.7042 47.6366 19.7853 48.014 24.0524C48.1089 25.1252 48.973 26 50.05 26Z" />
										</clipPath>
									</defs>

									<foreignObject x="0" y="0" width="52" height="52" clip-path="url(#clip)">
										<div xmlns="http://www.w3.org/1999/xhtml"
											style="width: 100%; height: 100%; background: conic-gradient(from 165deg at 51% 46%, #06AB6B 0deg, rgba(34, 34, 34, 0.5) 300deg, #06AB6B 360deg);">
										</div>
									</foreignObject>
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.waiting_for_payment")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2"></div>
							<div class="flex flex-col items-center">
								<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52.5 26C52.5 40.3594 40.8594 52 26.5 52C12.1406 52 0.5 40.3594 0.5 26C0.5 11.6406 12.1406 0 26.5 0C40.8594 0 52.5 11.6406 52.5 26ZM4.4 26C4.4 38.2055 14.2945 48.1 26.5 48.1C38.7055 48.1 48.6 38.2055 48.6 26C48.6 13.7945 38.7055 3.9 26.5 3.9C14.2945 3.9 4.4 13.7945 4.4 26Z"
										fill="#444444" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.checking_funds")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2"></div>
							<div class="flex flex-col items-center">
								<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52.5 26C52.5 40.3594 40.8594 52 26.5 52C12.1406 52 0.5 40.3594 0.5 26C0.5 11.6406 12.1406 0 26.5 0C40.8594 0 52.5 11.6406 52.5 26ZM4.4 26C4.4 38.2055 14.2945 48.1 26.5 48.1C38.7055 48.1 48.6 38.2055 48.6 26C48.6 13.7945 38.7055 3.9 26.5 3.9C14.2945 3.9 4.4 13.7945 4.4 26Z"
										fill="#444444" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.processing_payout")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2 max-[450px]:hidden"></div>
							<div class="flex flex-col items-center max-[450px]:hidden">
								<svg width="53" height="52" viewBox="0 0 53 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52.5 26C52.5 40.3594 40.8594 52 26.5 52C12.1406 52 0.5 40.3594 0.5 26C0.5 11.6406 12.1406 0 26.5 0C40.8594 0 52.5 11.6406 52.5 26ZM4.4 26C4.4 38.2055 14.2945 48.1 26.5 48.1C38.7055 48.1 48.6 38.2055 48.6 26C48.6 13.7945 38.7055 3.9 26.5 3.9C14.2945 3.9 4.4 13.7945 4.4 26Z"
										fill="#444444" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.confirming_payout")}}</span>
							</div>
						</div>
					</div>
					<div class="bg-white/5 rounded-[20px] p-[24px] flex flex-col min-[720px]:flex-row items-start gap-6">
						<div
							class="w-[160px] h-[160px] flex-shrink-0 rounded bg-white flex items-center justify-center overflow-hidden p-2 bg-white rounded-[10px]">

							@if($exchange->currencyFrom->tag == "crypto")
								<img src="https://api.qrserver.com/v1/create-qr-code/?data={{$exchange->data['merchant_from_data']['address']}}"
									class="w-full h-full object-contain" title="Link to Google.com" />
							@endif

						</div>

						<div class="w-full flex flex-col">
							<div class="flex-1 text-sm">
								<div class="mb-4">
									<p class="text-white/40 text-[14px] mb-3">{{__("front.exchangePage2AmountSend")}}:</p>
									<p class="text-[28px] flex items-center gap-2 mb-3">
										{{$exchange->data['amount_data']['amount_send']}}
										<button  class="copy-to-clipboard relative hover:opacity-70" data-copy-text="{{$exchange->data['amount_data']['amount_send']}}">
											<div class="tooltip absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-1 text-xs bg-black text-white rounded opacity-0 transition-opacity pointer-events-none"
												role="tooltip">{{__("front.copied")}}</div>

											<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M8.325 17.0625H5.175C2.2425 17.0625 0.9375 15.7575 0.9375 12.825V9.675C0.9375 6.7425 2.2425 5.4375 5.175 5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V12.825C12.5625 15.7575 11.2575 17.0625 8.325 17.0625ZM5.175 6.5625C2.85 6.5625 2.0625 7.35 2.0625 9.675V12.825C2.0625 15.15 2.85 15.9375 5.175 15.9375H8.325C10.65 15.9375 11.4375 15.15 11.4375 12.825V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H5.175Z"
													fill="#06AB6B"></path>
												<path
													d="M12.825 12.5625H12C11.6925 12.5625 11.4375 12.3075 11.4375 12V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H6C5.6925 6.5625 5.4375 6.3075 5.4375 6V5.175C5.4375 2.2425 6.7425 0.9375 9.675 0.9375H12.825C15.7575 0.9375 17.0625 2.2425 17.0625 5.175V8.325C17.0625 11.2575 15.7575 12.5625 12.825 12.5625ZM12.5625 11.4375H12.825C15.15 11.4375 15.9375 10.65 15.9375 8.325V5.175C15.9375 2.85 15.15 2.0625 12.825 2.0625H9.675C7.35 2.0625 6.5625 2.85 6.5625 5.175V5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V11.4375Z"
													fill="#06AB6B"></path>
											</svg>
										</button>
									</p>
									<div class="text-xs text-white/50 mt-1 flex items-center gap-3">
										<span class="w-[24px] h-[24px] bg-green-500 rounded-full"></span>
										<span class="flex items-baseline gap-2 text-white">
											<span class="text-[16px]">{{$exchange->data['amount_data']['currency_from_name']}}</span>
											<span class="text-white/40 text-[14px]"></span>
										</span>
									</div>
								</div>

								@if($exchange->currencyFrom->tag == "crypto")
									<div>
										<p class="text-white/40 mb-3">{{__("front.exchangePage2CryptoAddress")}}:</p>
										<p class="break-all text-white flex items-center gap-2 text-sm">
											{{$exchange->data['merchant_from_data']['address']}}
											<button  class="copy-to-clipboard relative hover:opacity-70"
												data-copy-text="{{$exchange->data['merchant_from_data']['address']}}">
												<div class="tooltip absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-1 text-xs bg-black text-white rounded opacity-0 transition-opacity pointer-events-none whitespace-nowrap"
													role="tooltip">{{__("front.copied")}}</div>

												<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M8.325 17.0625H5.175C2.2425 17.0625 0.9375 15.7575 0.9375 12.825V9.675C0.9375 6.7425 2.2425 5.4375 5.175 5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V12.825C12.5625 15.7575 11.2575 17.0625 8.325 17.0625ZM5.175 6.5625C2.85 6.5625 2.0625 7.35 2.0625 9.675V12.825C2.0625 15.15 2.85 15.9375 5.175 15.9375H8.325C10.65 15.9375 11.4375 15.15 11.4375 12.825V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H5.175Z"
														fill="#06AB6B"></path>
													<path
														d="M12.825 12.5625H12C11.6925 12.5625 11.4375 12.3075 11.4375 12V9.675C11.4375 7.35 10.65 6.5625 8.325 6.5625H6C5.6925 6.5625 5.4375 6.3075 5.4375 6V5.175C5.4375 2.2425 6.7425 0.9375 9.675 0.9375H12.825C15.7575 0.9375 17.0625 2.2425 17.0625 5.175V8.325C17.0625 11.2575 15.7575 12.5625 12.825 12.5625ZM12.5625 11.4375H12.825C15.15 11.4375 15.9375 10.65 15.9375 8.325V5.175C15.9375 2.85 15.15 2.0625 12.825 2.0625H9.675C7.35 2.0625 6.5625 2.85 6.5625 5.175V5.4375H8.325C11.2575 5.4375 12.5625 6.7425 12.5625 9.675V11.4375Z"
														fill="#06AB6B"></path>
												</svg>
											</button>
										</p>
									</div>
								@else
									<div>
										<a class="text-white/40 mb-3"
											href="{{$exchange->data['merchant_from_data']['url']}}">{{__("front.gotopay")}}</a>
									</div>
								@endif

								@if($exchange->merchant_type_from == "manualcrypto" || $exchange->merchant_type_from == "manualfiat")
									@if($exchange->status == 0)

										<!-- STYLE MARK -->
										<div>
											<a class="flex items-center max-w-[440px] justify-center h-[62px] max-[850px]:mt-6
													w-full min-[850px]:grow cursor-point
													bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
													text-white text-[18px] gap-[12px] px-6 py-2
													rounded-full shadow-[0px_4px_20px_#00000026]
													hover:opacity-90 z-[19] uppercase mt-10 exchange__button"
												href="{{ route("exchgangeIPaid", [$exchange->hash])}}">{{__("front.ipaid")}}</a>
										</div>
									@endif
								@endif
							</div>
						</div>


					</div>

					<div
						class="grid grid-cols-1 min-[770px]:[grid-template-columns:0.5fr_0.2fr_0.5fr] text-[18px] gap-x-4 sm:gap-x-20 gap-y-4 px-4 sm:px-[24px] items-center">
						<div>
							<span class="text-white/40 text-[14px]">
								{{__("front.youreceive")}}
							</span><br>{{$exchange->data['amount_data']['amount_receive']}}
							{{$exchange->data['amount_data']['currency_to_name']}}
						</div>

						@if($exchange->currencyTo->tag == "crypto")
							<div>
								<span class="text-white/40 text-[14px]">{{__("front.addressreceive")}}</span><br>
								<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_address']}}</p>
							</div>
						@else

							@if(isset($exchange->data['request_data']['to_card']))
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.cardreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_card']}}</p>
								</div>
							@else
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.phonesbpreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{@$exchange->data['request_data']['phone']}}</p>
								</div>
							@endif
						@endif

						<div>
							<span class="text-white/40 text-[14px]">{{__("front.exchange id")}}</span><br>{{$exchange->id}}
						</div>
					</div>




				</section>
			</div>
		@else
			<div data-form="step5">
				<section
					class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">
					<div
						class="flex flex-col items-center text-center min-[800px]:flex-row min-[800px]:items-start min-[800px]:text-left justify-between gap-8">
						<div class="flex flex-col">
							<h2 class="text-[#06AB6B] text-[24px] uppercase">{{__("front.exchange_successful")}}</h2>
							<p class="text-white/80 text-[18px] mt-2">{{__("front.check_funds_arrival")}}</p>
						</div>

						<div class="flex justify-between items-center max-w-[508px] w-full text-xs text-white/60">
							<div class="flex flex-col items-center text-white max-[450px]:hidden">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.waiting_for_payment")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2 max-[450px]:hidden"></div>
							<div class="flex flex-col items-center">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.checking_funds")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2"></div>
							<div class="flex flex-col items-center">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.processing_payout")}}</span>
							</div>
							<div class="w-[33px] h-[2px] border-[1.5px] opacity-20 mx-2 max-[450px]:hidden"></div>
							<div class="flex flex-col items-center">
								<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M52 26C52 40.3594 40.3594 52 26 52C11.6406 52 0 40.3594 0 26C0 11.6406 11.6406 0 26 0C40.3594 0 52 11.6406 52 26ZM3.9 26C3.9 38.2055 13.7945 48.1 26 48.1C38.2055 48.1 48.1 38.2055 48.1 26C48.1 13.7945 38.2055 3.9 26 3.9C13.7945 3.9 3.9 13.7945 3.9 26Z"
										fill="#06AB6B" />
									<path
										d="M23.0165 33C22.5963 33 22.1971 32.8326 21.903 32.5396L15.957 26.617C15.3477 26.0101 15.3477 25.0056 15.957 24.3987C16.5663 23.7918 17.5748 23.7918 18.1841 24.3987L23.0165 29.2121L33.8159 18.4552C34.4252 17.8483 35.4337 17.8483 36.043 18.4552C36.6523 19.0621 36.6523 20.0666 36.043 20.6735L24.1301 32.5396C23.8359 32.8326 23.4367 33 23.0165 33Z"
										fill="#06AB6B" />
								</svg>
								<span class="mt-2 text-center text-[14px] text-white">{{__("front.confirming_payout")}}</span>
							</div>
						</div>
					</div>

					<div
						class="grid grid-cols-1 min-[770px]:[grid-template-columns:0.5fr_0.2fr_0.5fr] text-[18px] gap-x-4 sm:gap-x-20 gap-y-4 px-4 sm:px-[24px] items-center bg-white/5 rounded-[20px] p-[24px]">
						<div>
							<span class="text-white/40 text-[14px]">
								{{__("front.youreceive")}}
							</span><br>{{$exchange->data['amount_data']['amount_receive']}}
							{{$exchange->data['amount_data']['currency_to_name']}}
						</div>
						@if($exchange->currencyTo->tag == "crypto")
							<div>
								<span class="text-white/40 text-[14px]">{{__("front.addressreceive")}}</span><br>
								<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_address']}}</p>
							</div>
						@else

							@if(isset($exchange->data['request_data']['to_card']))
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.cardreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{$exchange->data['request_data']['to_card']}}</p>
								</div>
							@else
								<div>
									<span class="text-white/40 text-[14px]">{{__("front.phonesbpreceive")}}</span><br>
									<p class="max-[450px]:break-all">{{@$exchange->data['request_data']['phone']}}</p>
								</div>
							@endif
						@endif

						<div>
							<span class="text-white/40 text-[14px]">{{__("front.exchange id")}}</span><br>{{$exchange->id}}
						</div>
					</div>
				</section>
			</div>
			@if (false)
				<div class="progress__error">
					<img src="/comcash/img/icons/smile-face.svg" class="progress__error-img" alt="sad-face" />
					<div class="progress__error-text">
						{{__("front.exchangecompletetext")}}
					</div>
				</div>
			@endif

		@endif
	@endif

@endsection

@section("css")
	<meta name="robots" content="noindex, nofollow">
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

		switch (window.exchangeStatus) {
			case 0:
				window.updateYMForm("openExchangeStatusCreated");
				break;
			case 1:
				window.updateYMForm("openExchangeStatusCheckPaid");
				break;
			case 2:
				window.updateYMForm("openExchangeStatusSuccessPaid");
				break;
			case 4:
				window.updateYMForm("openExchangeStatusStartWithdraw");
				break;
			case 5:
				window.updateYMForm("openExchangeStatusCompleted");
				break;
		}
	</script>
@endsection