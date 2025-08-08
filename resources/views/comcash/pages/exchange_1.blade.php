@extends('comcash.layout.main')

@section('content')

	<div class="default-form">
		<section
			class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto lg:h-[334px] flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[900px]">
			<div class="overflow-x-hidden absolute inset-0
						   bg-[url('/comcash/img/green_mesh.webp')] bg-auto bg-center
						   bg-cover left-0 right-0
						   z-0 pointer-events-none">
			</div>

			<div
				class="exchange-title text-white max-[400px]:text-[20px] text-3xl font-semibold leading-tight max-[720px]:text-center mb-8">
				<p>{{__("front.exchangeOur")}} <span class="text-[#06AB6B]"> {{__("front.indexExchangePanelScrollText")}}</span></p>
				<p>{{__("front.indexExchangePanelScrollText1")}}</p>
			</div>

			<form method="POST" class="exchange__form" action="{{route("exchgangeCreate")}}">
				@csrf
				<div class="exchange__main-form">
					<div
						class="relative flex-wrap gap-x-[min(36px,_1.5vw)] text-white max-[720px]:justify-center mb-8">

						<div
							class="relative flex flex-wrap gap-x-[min(36px,_1.5vw)] text-white max-[720px]:justify-center">

							<div
								id="currencyYouSend"
								class=" input-block min-[720px]:flex-1 border border-[#FFFFFF1A]/10 bg-[#1B1B1B] rounded-[10px] p-5 flex flex-col justify-between relative max-[720px]:mb-4 max-[720px]:w-full">
								
								<div
									class="absolute top-[-25px] max-[600px]:right-[-20px] right-[-25px] pointer-events-none select-none min-[720px]:hidden">
									<svg width="86" height="59" viewBox="0 0 86 59" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z"
											fill="#008D69"></path>
										<path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z"
											fill="#009C74"></path>
										<path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z"
											fill="#24DE96"></path>
										<path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z"
											fill="#009C74"></path>
										<path
											d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
											fill="#24DE96"></path>
										<path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z"
											fill="#14C37F"></path>
										<path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z"
											fill="#009C74"></path>
										<path
											d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
											fill="#14C37F"></path>
										<path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z"
											fill="#24DE96"></path>
										<path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z" fill="#009C74">
										</path>
										<path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z"
											fill="#007C5C"></path>
										<path
											d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
											fill="#008D69"></path>
										<path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74">
										</path>
										<path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z"
											fill="#24DE96"></path>
										<path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z"
											fill="#14C37F"></path>
										<path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z"
											fill="#008D69"></path>
										<path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z"
											fill="#24DE96"></path>
										<path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z"
											fill="#14C37F"></path>
										<path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z"
											fill="#008D69"></path>
										<path
											d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
											fill="#24DE96">
										</path>
										<path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z"
											fill="#009C74"></path>
										<path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z"
											fill="#008D69"></path>
										<path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z"
											fill="#009C74"></path>
										<path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z"
											fill="#14C37F"></path>
										<path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96">
										</path>
									</svg>
								</div>
								<p class="text-sm mb-2">{{__("front.youreceive")}}:</p>

												<!-- <div class="welcome-exchange__loading">
										<img src="/comcash/img/loader-gray.gif" alt="loader"/>
									</div> -->

								<div class="flex flex-wrap items-start gap-2 min-w-0 w-full" id="exchange-currency_from">
									<input name="amount" placeholder="0" id="inputAmount" data-focus-target=".input-block"
										type="text" placeholder="0.00" inputmode="decimal"
										class=" bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
										autocomplete="off" />

									<div
										class="custom-select__select-container  dropdown relative inline-block max-[820px]:min-w-[180px] min-w-[220px] max-w-full max-[410px]:w-full w-auto min-[810px]:mt-1" data-currency="currencyYouSend">

										<input class="hidden" name="currency_from">
										<button type="button" data-focus-target=".input-block"
											class=" dropdown-toggle transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] rounded-full bg-[#2A2A2A] text-white flex items-center justify-between hover:opacity-90">
											<div
												class="flex items-center gap-[12px]  custom-select__select-label">
												<img src="https://comcash.io/icons/Ethereum.png"
													class="w-5 h-5 rounded-full bg-green-500 " /></span>
												<span class="text-sm " data-label="">
													<div class="">---</div>
													<span class="text-[#FFFFFF66]/40">

													</span>
												</span>
											</div>
											<svg class=" dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
												viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor"
													stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</button>
										<div class="hidden custom-select__select-list-container ">
											<div
												class="custom-select__select-list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white max-h-[240px] overflow-y-scroll">

											</div>
										</div>


									</div>
								</div>

								<p
									class="max-[410px]:absolute max-[410px]:right-4 top-1/2 -translate-y-1/2 text-[14px] text-white/30 max-[410px]:text-[16px] max-[410px]:pb-4 min-[410px]:mt-6">
									≈
									<span id="usdFromHint">---</span>$
								</p>
							</div>


							<div
								class="flex items-center justify-center max-[400px]:left-1/2 max-[400px]:-translate-x-1/2 max-[720px]:absolute max-[720px]:top-[44%] max-[720px]:left-10 max-[720px]:rotate-90 z-10 reverse">
								<div id="switchButton" role="button" aria-label="Поменять направления" class="
										transition-all duration-300
										hover:scale-105 hover:drop-shadow-[0_0_12px_rgba(6,171,107,0.5)]
										cursor-pointer active:scale-95 ease-out
										w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
									<svg class="pointer-events-none" width="40" height="40" viewBox="0 0 40 40" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<rect width="40" height="40" rx="20" fill="url(#paint0_linear_74_2055)" />
										<rect width="40" height="40" rx="20" fill="url(#paint1_linear_74_2055)" />
										<path
											d="M23.49 28.76C23.3 28.76 23.11 28.69 22.96 28.54C22.67 28.25 22.67 27.77 22.96 27.48L27.97 22.47C28.26 22.18 28.74 22.18 29.03 22.47C29.32 22.76 29.32 23.24 29.03 23.53L24.02 28.54C23.87 28.68 23.68 28.76 23.49 28.76Z"
											fill="white" />
										<path
											d="M28.5 23.74H11.5C11.09 23.74 10.75 23.4 10.75 22.99C10.75 22.58 11.09 22.24 11.5 22.24H28.5C28.91 22.24 29.25 22.58 29.25 22.99C29.25 23.4 28.91 23.74 28.5 23.74Z"
											fill="white" />
										<path
											d="M11.5 17.76C11.31 17.76 11.12 17.69 10.97 17.54C10.68 17.25 10.68 16.77 10.97 16.48L15.98 11.47C16.27 11.18 16.75 11.18 17.04 11.47C17.33 11.76 17.33 12.24 17.04 12.53L12.03 17.54C11.89 17.68 11.69 17.76 11.5 17.76Z"
											fill="white" />
										<path
											d="M28.5 17.76H11.5C11.09 17.76 10.75 17.42 10.75 17.01C10.75 16.6 11.09 16.26 11.5 16.26H28.5C28.91 16.26 29.25 16.6 29.25 17.01C29.25 17.42 28.91 17.76 28.5 17.76Z"
											fill="white" />
										<defs>
											<linearGradient id="paint0_linear_74_2055" x1="-73.0756" y1="65.8286"
												x2="108.36" y2="67.8085" gradientUnits="userSpaceOnUse">
												<stop stop-color="#06AB6B" />
												<stop offset="0.723958" stop-color="#009C74" />
											</linearGradient>
											<linearGradient id="paint1_linear_74_2055" x1="28.9733" y1="20.6667"
												x2="165.207" y2="34.0766" gradientUnits="userSpaceOnUse">
												<stop stop-color="#06AB6B" />
												<stop offset="1" stop-color="#009C74" />
											</linearGradient>
										</defs>
									</svg>
								</div>
							</div>

							<div
								id="currencyYouGet"
								class=" output-block min-[720px]:flex-1 bg-[#1B1B1B] border border-[#FFFFFF1A]/10 rounded-[10px] p-5 flex flex-col justify-between relative max-[720px]:w-full">

								<div
									class="absolute top-[-25px] right-[-25px] pointer-events-none select-none max-[720px]:hidden">
									<svg width="86" height="59" viewBox="0 0 86 59" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M52.4243 7.78226L37 58.8281L53.8316 30.2355L52.4243 7.78226Z"
											fill="#008D69" />
										<path d="M53.8316 30.2355L64.0769 38.7672L37 58.8281L53.8316 30.2355Z"
											fill="#009C74" />
										<path d="M64.0769 38.7672L84.5113 33.7519L37 58.8281L64.0769 38.7672Z"
											fill="#24DE96" />
										<path d="M52.4243 7.78226L63.0918 16.4292L53.8316 30.2355L52.4243 7.78226Z"
											fill="#009C74" />
										<path
											d="M63.0917 16.4292L73.9281 25.1915L64.0769 38.7672L53.8315 30.2355L63.0917 16.4292Z"
											fill="#24DE96" />
										<path d="M73.9282 25.1915L84.5112 33.752L64.0769 38.7672L73.9282 25.1915Z"
											fill="#14C37F" />
										<path d="M73.9281 25.1915L79.3041 17.2363L84.5112 33.7519L73.9281 25.1915Z"
											fill="#009C74" />
										<path
											d="M73.7311 0L85.2993 8.7046L78.2345 13.8063L76.5739 8.35872L71.9579 8.27225L73.7311 0Z"
											fill="#14C37F" />
										<path d="M85.2994 8.70459L84.5113 33.7519L78.2346 13.8063L85.2994 8.70459Z"
											fill="#24DE96" />
										<path d="M52.4243 7.78226L73.7312 0L71.958 8.27225L52.4243 7.78226Z"
											fill="#009C74" />
										<path d="M52.4243 7.78226L68.4678 8.18578L63.0918 16.4292L52.4243 7.78226Z"
											fill="#007C5C" />
										<path
											d="M68.4678 8.18576L76.574 8.3587L79.3323 17.2362L73.9282 25.1914L63.0918 16.4292L68.4678 8.18576Z"
											fill="#008D69" />
										<path d="M0 25.0585L27.8044 53.7297L10.8653 26.2728L0 25.0585Z" fill="#009C74" />
										<path d="M10.8652 26.2728L21.0287 25.232L27.8044 53.7297L10.8652 26.2728Z"
											fill="#24DE96" />
										<path d="M21.0288 25.232L30.9987 22.4814L27.8045 53.7297L21.0288 25.232Z"
											fill="#14C37F" />
										<path d="M30.9987 22.4814L37 14.6011L27.8044 53.7297L30.9987 22.4814Z"
											fill="#008D69" />
										<path d="M28.0948 13.3125L30.9987 22.4814L37 14.6011L28.0948 13.3125Z"
											fill="#24DE96" />
										<path d="M28.0948 13.3125L24.949 19.136L30.9987 22.4814L28.0948 13.3125Z"
											fill="#14C37F" />
										<path d="M24.949 19.136L21.0288 25.232L30.9987 22.4814L24.949 19.136Z"
											fill="#008D69" />
										<path
											d="M21.0287 25.232L13.7449 20.598L16.6729 14.6011L24.9489 19.136L21.0287 25.232Z"
											fill="#24DE96" />
										<path d="M16.673 14.6011L28.0948 13.3125L24.949 19.136L16.673 14.6011Z"
											fill="#009C74" />
										<path d="M8.15503 16.6579L13.745 20.598L16.673 14.6011L8.15503 16.6579Z"
											fill="#008D69" />
										<path d="M13.7449 20.598L10.8652 26.2728L21.0287 25.232L13.7449 20.598Z"
											fill="#009C74" />
										<path d="M8.15503 16.6579L10.8653 26.2728L13.745 20.598L8.15503 16.6579Z"
											fill="#14C37F" />
										<path d="M8.155 16.6579L0 25.0586L10.8653 26.2728L8.155 16.6579Z" fill="#24DE96" />
									</svg>
								</div>
								<p class="text-sm mb-2">{{__("front.youreceive")}}:</p>

								<div id="exchange-currency_to" class="flex flex-wrap items-start gap-2 min-w-0 w-full">
									<input id="outputAmount" data-focus-target=".output-block" type="text"
										name="amount_to"
										inputmode="decimal" placeholder="0.00"
										class="bg-transparent text-[32px] font-light outline-none min-w-[100px] max-w-full flex-1 w-0"
										autocomplete="off" />
									<div
										class=" custom-select__select-container dropdown relative inline-block max-[820px]:min-w-[180px] min-w-[220px] max-w-full max-[410px]:w-full w-auto  min-[810px]:mt-1" data-currency="currencyYouGet">
										<input class="hidden" name="currency_to">
										<button type="button" data-focus-target=".output-block"
											class=" dropdown-toggle transition-all duration-200 ease-in-out w-full h-[40px] pr-[16px] pl-[12px] py-[8px] rounded-full bg-[#2A2A2A] text-white flex items-center justify-between hover:opacity-90">
											<div
												class="flex items-center gap-[12px] custom-select__select-label ">
												<img src="https://comcash.io/icons/Ethereum.png"
													class="w-5 h-5 rounded-full bg-green-500 " /></span>
												<span class="text-sm " data-label="">
													<div class="">---</div>
													<span class="text-[#FFFFFF66]/40">

													</span>
												</span>
											</div>
											<svg class=" dropdown-arrow w-[12px] h-[12px] transition-transform transform rotate-0 stroke-white"
												viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M2 3.33333L6 8L10 3.33333" stroke="currentColor"
													stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</button>
										<div class="hidden custom-select__select-list-container ">
											<div
												class="custom-select__select-list dropdown-menu absolute top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white max-h-[240px] overflow-y-scroll">
											</div>
										</div>
									</div>
								</div>


								<p
									class="max-[410px]:absolute max-[410px]:right-4 top-1/2 -translate-y-1/2 text-[14px] text-white/30 max-[410px]:text-[16px] max-[410px]:pb-4 min-[410px]:mt-6">
									≈
									<span id="usdToHint">---</span>$
								</p>
							</div>
						</div>
					</div>


					<div class="flex flex-col gap-[14px] mb-8">
						<div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">

							<div class="exchange__card-number hide" id="exchange-to_card">
								<input type="text" placeholder="{{__("front.exchangePageCardNumberReceive")}}"
									class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
									name="to_card">
							</div>

							<div class="exchange__contact-item hide" id="exchange-to_address">
								<input placeholder="{{__("front.exchangePageAddressReceive")}}" type="text"
									class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
									name="to_address">
							</div>

							<div class="exchange__contact-item hide" id="exchange-passport">
								<input placeholder="{{__("front.exchangePageInputPassport")}}" type="text"
									class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
									name="passport">
							</div>
							<div class="exchange__contact-item hide" id="exchange-city">
								<input placeholder="{{__("front.exchangePageInputCity")}}" type="text"
									class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
									name="city">
								<a class="text-[12px] px-[20px] underline" href='{{route("comcashPage", ["delivery"])}}'>
									{{__("front.exchangeCitiesCash")}}
								</a>
							</div>
							<div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1 exchange__contact">
								<div class="exchange__contact-item hide" id="exchange-email">
									<input placeholder="Email" type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										name="email" value="{{auth()->user() ? auth()->user()->email : ""}}">
								</div>
								<div class="exchange__contact-item hide" id="exchange-telegram">
									<input placeholder="Telegram" type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										name="telegram" value="{{auth()->user() ? auth()->user()->telegram : ""}}">
								</div>
							</div>
							<div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1 exchange__contact">
								<div class="exchange__contact-item hide" id="exchange-phone">
									<input placeholder="{{__("front.exchangePageInputPhone")}}" type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										value="+" name="phone">
								</div>
								<div class="exchange__contact-item hide" id="exchange-bank">
									<input placeholder="{{__("front.exchangePageInputBank")}}" name="bank" type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										value="">
								</div>
							</div>
							<div class="exchange__name">
								<div class="exchange__name-item hide" id="exchange-first_name">
									<input placeholder="{{__("front.exchangePageInputFirstName")}}" name="first_name"
										type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										value="{{auth()->user() ? auth()->user()->first_name : ""}}">
								</div>
								<div class="exchange__name-item hide" id="exchange-last_name">
									<input placeholder="{{__("front.exchangePageInputLastName")}}" name="last_name"
										type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										value="{{auth()->user() ? auth()->user()->second_name : ""}}">
								</div>
								<div class="exchange__name-item hide" id="exchange-second_name">
									<input placeholder="{{__("front.exchangePageInputSecondName")}}" name="second_name"
										type="text"
										class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded"
										value="{{auth()->user() ? auth()->user()->last_name : ""}}">
								</div>
							</div>

						</div>
					</div>

					<div class="flex flex-wrap justify-between items-center text-white text-sm">
						<div class="text-[24px] text-white">
							<div class="flex gap-2">
								<div class="flex flex-col items-start">
									<p class="_courseFrom"></p>
									<span class="courseTypeFrom text-[14px] text-white/40 pl-1 pt-1"></span>
								</div>
								<p>≈</p>
								<div class="flex flex-col items-start">
									<p class="_courseTo"></p>
									<span class="courseTypeTo text-[14px] text-white/40 pt-1"></span>
								</div>
							</div>
						</div>

						<div>
							<p class="text-[14px] opacity-40 max-[500px]:hidden max-w-[160px]">
								{{__("front.homePagePanelRatesInfo")}}
							</p>
						</div>

						<div class="flex items-center gap-[8px]">
							<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M11.7633 17.0625H6.9033C5.4858 17.0625 4.4508 16.47 4.0533 15.45C3.6408 14.385 4.0233 13.065 5.0133 12.1725L8.4933 9L5.0133 5.8275C4.0233 4.935 3.6408 3.615 4.0533 2.55C4.4508 1.5225 5.4858 0.9375 6.9033 0.9375H11.7633C13.1808 0.9375 14.2158 1.53 14.6133 2.55C15.0258 3.615 14.6433 4.935 13.6533 5.8275L10.1733 9L13.6608 12.1725C14.6433 13.065 15.0333 14.385 14.6208 15.45C14.2158 16.47 13.1808 17.0625 11.7633 17.0625ZM9.3333 9.7575L5.7708 12.9975C5.1408 13.575 4.8633 14.415 5.1033 15.0375C5.3283 15.615 5.9658 15.9375 6.9033 15.9375H11.7633C12.7008 15.9375 13.3383 15.6225 13.5633 15.0375C13.8033 14.415 13.5333 13.575 12.8958 12.9975L9.3333 9.7575ZM6.9033 2.0625C5.9658 2.0625 5.3283 2.3775 5.1033 2.9625C4.8633 3.585 5.1333 4.425 5.7708 5.0025L9.3333 8.2425L12.8958 5.0025C13.5258 4.425 13.8033 3.585 13.5633 2.9625C13.3383 2.385 12.7008 2.0625 11.7633 2.0625H6.9033Z"
									fill="#06AB6B"></path>
							</svg>
							<span class="exchangeTimer">00:00</span>
						</div>

						<div class="w-full min-[850px]:w-auto flex items-center px-2 flex-wrap justify-center">
							<div>
								<button class="exchange__button flex items-center justify-center h-[62px] max-[850px]:mt-6
													w-full
													min-[850px]:w-[362px] min-[850px]:grow
													bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
													text-white text-[18px] gap-[12px] px-6 py-2
													rounded-full shadow-[0px_4px_20px_#00000026]
													hover:opacity-90">
									{{__("front.exchange")}}
									<svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z"
											fill="white"></path>
										<path
											d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
											fill="currentColor"></path>
									</svg>
								</button>
							</div>
							<div class="flex justify-center">
								<p class="text-[12px] opacity-60 mt-4 min-[500px]:hidden whitespace-nowrap text-center">
									{{__("front.homePagePanelRatesInfo")}}
								</p>
							</div>

						</div>
					</div>

				</div>

				<section
					class="validation hide relative max-[720px]:max-w-[500px]  mx-auto mx-4 w-full max-w-[1018px] h-auto lg:h-[334px] flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[200px]">

					<div class="overflow-x-hidden absolute inset-0
												bg-[url('/comcash/img/green_mesh.webp')] bg-auto bg-center
												bg-cover left-0 right-0
												z-0 pointer-events-none">
					</div>

					<!-- STYLE MARK -->
					<div class="text-white max-[600px]:text-[20px] text-[24px] leading-tight max-[720px]:text-center mb-8">
						<span class="text-[#06AB6B] uppercase">{{__("front.please_check")}}</span>
						<p class="uppercase">{{__("front.check_input_data")}}</p>
					</div>


					<div class="grid grid-cols-1 min-[720px]:grid-cols-2 gap-4 text-white">

						<div class="flex flex-col gap-4">
							<div
								class="border border-[#FFFFFF1A]/10 bg-[#1E1E1E99]/60 backdrop-blur-xl rounded-[10px] p-[14px] flex flex-col justify-between h-[92px]">
								<p class="text-[14px] mb-2">{{__("front.exchangePageCheckYouSend")}}:</p>
								<div class="flex items-center justify-between" id="validation__you-send">
									<p id="validation__you-send-amount" class="text-[32px] leading-none"></p>
									<div class="flex items-center gap-[12px] min-w-[180px]">
										<img id="validation__you-send-currency-img" src="" class="w-5 h-5 rounded-full bg-green-500 " /></span>
										<span id="validation__you-send-currency" class="text-sm leading-none">
											<span class="text-[#FFFFFF66]/40">
											</span>
										</span>
									</div>
								</div>
							</div>

							<div
								class="border border-[#FFFFFF1A]/10 bg-[#1E1E1E99]/60 backdrop-blur-xl rounded-[10px] p-[14px] flex flex-col justify-between h-[92px]">
								<p class="text-[14px] mb-2">{{__("front.exchangePageCheckYouReceive")}}:</p>
								<div class="flex items-center justify-between" id="validation__you-get">
									<p id="validation__you-get-amount" class="text-[32px] leading-none"></p>
									<div class="flex items-center gap-[12px] min-w-[180px]">
										<img id="validation__you-get-currency-img" src="" class="w-5 h-5 rounded-full bg-green-500 " />
										<span id="validation__you-get-currency" class="text-sm leading-none"><span
												class="text-[#FFFFFF66]/40"></span></span>
									</div>
								</div>
							</div>
						</div>

						<div class="flex flex-col justify-between gap-4 h-full">

							<div class="flex justify-between items-center h-full text-white px-[14px]">
								<div class="flex gap-2 items-center text-[24px]">
									<div class="flex flex-col leading-none">
										<p class="_courseFrom"></p>
										<span class="text-[14px] text-white/40 pt-[2px]"></span>
									</div>
									<p class="leading-none">≈</p>
									<div class="flex flex-col leading-none">
										<p class="_courseTo"></p>
										<span class="text-[14px] text-white/40 pt-[2px]"></span>
									</div>
								</div>

								<div class="flex items-center gap-2">
									<svg width="18" height="19" viewBox="0 0 18 19" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M11.4301 17.5625H6.57011C5.15261 17.5625 4.11761 16.97 3.72011 15.95C3.30761 14.885 3.69011 13.565 4.68011 12.6725L8.16011 9.5L4.68011 6.3275C3.69011 5.435 3.30761 4.115 3.72011 3.05C4.11761 2.0225 5.15261 1.4375 6.57011 1.4375H11.4301C12.8476 1.4375 13.8826 2.03 14.2801 3.05C14.6926 4.115 14.3101 5.435 13.3201 6.3275L9.84011 9.5L13.3276 12.6725C14.3101 13.565 14.7001 14.885 14.2876 15.95C13.8826 16.97 12.8476 17.5625 11.4301 17.5625ZM9.00011 10.2575L5.43761 13.4975C4.80761 14.075 4.53011 14.915 4.77011 15.5375C4.99511 16.115 5.63261 16.4375 6.57011 16.4375H11.4301C12.3676 16.4375 13.0051 16.1225 13.2301 15.5375C13.4701 14.915 13.2001 14.075 12.5626 13.4975L9.00011 10.2575ZM6.57011 2.5625C5.63261 2.5625 4.99511 2.8775 4.77011 3.4625C4.53011 4.085 4.80011 4.925 5.43761 5.5025L9.00011 8.7425L12.5626 5.5025C13.1926 4.925 13.4701 4.085 13.2301 3.4625C13.0051 2.885 12.3676 2.5625 11.4301 2.5625H6.57011Z"
											fill="#06AB6B" />
									</svg>
									<div class="flex flex-col leading-none">
										<span class="text-sm text-white/40">{{__("front.exchangePageCheckTimeForPay")}}:</span>
										<span class="text-sm text-white">{{__("front.exchangePageCheckTimeForPay2")}}</span>
									</div>
								</div>
							</div>


							<div class="text-[14px] bg-white/5 text-white rounded-[20px] p-5 leading-snug">
								<p>{{__("front.warning_min_amount")}}</p>
								<p>{{__("front.funds_not_credited")}}
								<p>{{__("front.contact_support")}}
									<a href="https://t.me/{{__('front.supportContactsTelegram')}}"
										class="text-[#06AB6B] underline">
										Telegram
									</a>
								</p>
							</div>
						</div>

					</div>
					<div class="flex flex-col items-center gap-4 w-full mt-10">

						<div id="slider-wrapper"
							class="relative w-full max-w-[420px] h-[62px] bg-[#22302C] rounded-full overflow-hidden select-none">

							<div id="slider-overlay"
								class="absolute inset-0 flex items-center justify-center text-[18px] text-white pointer-events-none"
								style="
													background:
													linear-gradient(0deg,rgba(255,255,255,.1),rgba(255,255,255,.1)),
													linear-gradient(95.62deg,rgba(6,171,107,.1) 70.57%,rgba(0,156,116,.1) 383.64%);
													box-shadow:0 4px 20px #00000026;
													clip-path:inset(0 0 0 0);
												">
								{{__("front.pull_to_exchange")}}
							</div>

							<div id="slider-thumb" class="absolute left-0 top-0 w-[62px] h-[62px] rounded-full bg-[#06AB6B] flex items-center justify-center
														text-white text-xl z-10 transition-transform duration-300 shadow-md cursor-pointer">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M14.4301 18.82C14.2401 18.82 14.0501 18.75 13.9001 18.6C13.6101 18.31 13.6101 17.83 13.9001 17.54L19.4401 12L13.9001 6.46C13.6101 6.17 13.6101 5.69 13.9001 5.4C14.1901 5.11 14.6701 5.11 14.9601 5.4L21.0301 11.47C21.3201 11.76 21.3201 12.24 21.0301 12.53L14.9601 18.6C14.8101 18.75 14.6201 18.82 14.4301 18.82Z"
										fill="white" />
									<path
										d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
										fill="white" />
								</svg>
							</div>
						</div>


						<span class="text-white/40 text-center max-w-[420px] text-[14px]">
							{{__("front.agreement_notice")}} 
							<a href="#"
								class="underline text-white hover:opacity-70">{{__("front.terms_of_service")}}</a>.
						</span>


				</section>

			</form>

			<div
				
				data-expandable
				class=" relative block max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mx-auto pt-10 mx-4 w-full max-w-[1018px] h-auto flex flex-col gap-6 max-[1240px]:px-[20px]">

					<div id="text-wrapper"  data-wrapper class="overflow-hidden transition-all duration-700 ease-in-out max-h-[70px]">
						<div  data-expandable-inner id="text-inner" class="text-[#A5A5A5] text-[16px] leading-[24px]">
							Обмен USDT (TRC-20) на рубли через Систему Быстрых Платежей (СБП): Быстро, безопасно и без AML/KYC
							Преимущества обмена без AML и KYC. Обмен криптовалюты без AML и KYC проверок имеет множество
							преимуществ. Во-первых, это экономия времени: пользователю не нужно проходить длительные процедуры
							подтверждения личности. Во-вторых, это анонимность: данные экономия времени: пользователю не нужно
							проходить длительные процедуры подтверждения личности. Во-вторых, это анонимность: данные экономия
							времени: пользователю не нужно проходить длительные процедуры подтверждения личности. Во-вторых, это
							анонимность: данные
						</div>
					</div>
					<button id="toggle-button"
						data-expandable-toggle
						class="flex items-center gap-2 text-[16px] uppercase text-white transition-all duration-300 w-fit border-b border-[#06AB6B]">
						{{__("front.show_more")}}
						<svg data-expandable-arrow id="toggle-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M1 0.833334L5 5.5L9 0.833334" stroke="currentColor" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>

					</button>


				<div
					class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-[100px] text-white max-[500px]:text-[12px] text-[14px] transition-all duration-300 overflow-hidden pt-20">

					@foreach($seo_directions as $item)
						<a href="{{route("exchgangePage", [$item->currencyFrom->name, $item->currencyTo->name])}}"
							class="underline hover:opacity-70">
							{{__("front.seoExchangePage1")}} {{$item->currencyFrom->getTitle()}}
							{{__("front.seoExchangePage2")}} {{$item->currencyTo->getTitle()}} {{__("front.seoExchangePage3")}}
						</a>
					@endforeach
				</div>

			</div>
	</div>

	</section>


	<div class="exchange__cash-modal hide">
		<div
			class="absolute top-[-10%] inset-0 bg-[url('/comcash/img/green_mesh.webp')] bg-center bg-no-repeat z-0 pointer-events-none max-[500px]:hidden">
		</div>

		<section
			class="relative max-[720px]:max-w-[500px] max-[720px]:mt-[2rem] mt-[8rem] mx-auto mx-4 w-full max-w-[1018px] h-auto flex flex-col justify-between gap-8 lg:gap-[36px] max-[1240px]:px-[20px] min-[1024px]:mb-[80px]">

			<div class="relative flex items-center justify-center overflow-hidden">
				<div class="relative flex flex-col items-center justify-center text-center px-4 z-10">
					<img src="/comcash/img/icons/smile.gif" class="max-w-[200px] max-h-[200px] object-contain" />

					<h2 class="text-[#06AB6B] max-[500px]:text-[24px] text-[32px] font-bold uppercase mt-6">{{__(key: "front.exchangePageCashTitle")}}</h2>
					<p class="text-white max-[500px]:text-[14px] text-[16px] mt-2">{{__(key: "front.we_will_write_telegram")}}</p>
				</div>
			</div>
		</section>
	</div>

@endsection

@section("js")

	<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "Product",
					"name": "{{__("
					front.seoExchangePage1 ")}} {{$direction->currencyFrom->getTitle()}} {{__("
					front.seoExchangePage2 ")}} {{$direction->currencyTo->getTitle()}} {{__("
					front.seoExchangePage3 ")}}",
					"image": "https://comcash.io/{{$direction->currencyFrom->image ? $direction->currencyFrom->image : "
					https: //comcash.io/comcash/img/logo.svg"}}",
						"description": "{{__("
					front.seoExchangePage1 ")}} {{$direction->currencyFrom->getTitle()}} {{__("
					front.seoExchangePage2 ")}} {{$direction->currencyTo->getTitle()}} {{__("
					front.seoExchangePage3 ")}}",
					"sku": "{{$direction->currencyFrom->getTitle()}}-{{$direction->currencyTo->getTitle()}}-{{$direction->id}}",
					"offers": {
						"@type": "Offer",
						"priceCurrency": "{{$direction->currencyFrom->getTitle()}}",
						"price": "1",
						"itemCondition": "https://schema.org/NewCondition",
						"availability": "https://schema.org/InStock",
						"url": "{{route("exchgangePage", [$direction->currencyFrom->name, $direction->currencyTo->name])}}"
					}
				}
			</script>
@endsection