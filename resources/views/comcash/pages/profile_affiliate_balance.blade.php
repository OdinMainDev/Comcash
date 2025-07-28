@extends('comcash.layout.main')

@section('content')

<section
	class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
	<h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
		{{__("front.client panel")}}
	</h2>
	<div class="flex max-[720px]:block">

		@include('comcash.component.profile_sidebar', [
		'active' => 'affiliate',
		'sub' => "balance"
		])

		<div class="flex-1">
			<div id="tab-balance" class="tab-content">
				<div class="max-[400px]:hidden flex items-center mb-6">
					<span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">Мой
						баланс</span>
					<div class="flex-1 h-[1px] bg-[#06AB6B]"></div>
				</div>
				<div class="hidden max-[400px]:flex items-start justify-between mb-4">
					<button class="back-to-main-tabs text-[#666666] text-[15px] uppercase">
						<svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg"
							class="mt-[6px]">
							<path d="M5.66667 1L0.999999 5L5.66666 9" stroke="white" stroke-linecap="round"
								stroke-linejoin="round"></path>
						</svg>
					</button>
					<div class="flex flex-col">
						<p class="text-[16px] uppercase">
							{{__("front.profile affiliate")}}
						</p>
						<p class="text-[14px] text-[#666666] uppercase text-end">
							{{__("front.affiliate my balance")}}
						</p>
					</div>
				</div>

				<div
					class="rounded-[12px] h-[116px] max-[400px]:h-[92px] p-[24px] flex items-center justify-between text-white backdrop-blur-[20px]"
					style="background: linear-gradient(95.5deg, rgba(15, 117, 78, 0.9) 28.46%, rgba(6, 171, 107, 0) 96%);">
					<div>
						<p class="text-[14px] mb-1">Ваш баланс</p>
						<p class="text-[32px] leading-none">5,924.12413</p>
					</div>
					<p class="text-white/30 text-[14px] mt-auto self-end">USDT</p>
				</div>

				<form class="flex flex-col gap-[14px] mt-[24px]">
					<div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
						<p class="text-[16px]">Создайте выплату</p>

						<input type="text" placeholder="Введите сумму выплаты"
							class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
						<input type="text" placeholder="Введите сумму выплаты"
							class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
						<input type="text" placeholder="Адрес выплаты"
							class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
						<div class="flex justify-start mt-2">
							<button type="submit"
								class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90 uppercase"
								style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
								Вывести средства
							</button>
						</div>
					</div>

					<h2 class="text-[18px] py-[24px] uppercase">
						{{__("front.personOperationHistoryLabel")}}
					</h2>
					<form class="flex flex-col gap-4">

						<!-- для >640px -->
						<div class="hidden sm:grid grid-cols-[1fr_0.9fr_0.8fr_1fr_1fr] text-white/40 text-[12px]">
							<div>Дата</div>
							<div>Операция</div>
							<div>Сумма</div>
							<div>Баланс</div>
							<div>Адрес</div>
						</div>

						<!-- истории -->
						<div
							class="py-3 flex flex-col gap-3 sm:grid sm:grid-cols-[1fr_0.8fr_0.8fr_1fr_1fr] sm:items-center sm:gap-2 border-b border-white/10">

							<div class="text-white text-[14px] sm:block hidden">12.12.2024, 13:44:56</div>

							<!-- Дата -->
							<div class=" flex justify-between sm:hidden text-white text-[14px]">
								<span class="text-white/40 text-[12px]">Дата</span>
								<span>12.12.2024, 13:44:56</span>
							</div>

							<!-- Операция -->
							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">Операция</span>
								<div class="flex items-center gap-2">
									<span class="uppercase text-[14px]">Поступлениe</span>
								</div>
							</div>

							<!-- Сумма -->
							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">Сумма</span>
								<div class="flex items-center gap-2">
									<span class="bg-white/5 rounded-[12px] py-full px-[8px]">EUR</span>
									<span class="text-[#06AB6B]">1615.00</span>
								</div>
							</div>

							<!-- Баланс -->
							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">Баланс</span>
								<div class="flex items-center gap-2">
									<span class="bg-white/5 rounded-[12px] py-full px-[8px]">EUR</span>
									<span>5720.001235</span>
								</div>
							</div>

							<!-- Адрес -->
							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">Адрес</span>
								<div class="flex items-center gap-2">
									<span class="uppercase">0x7d7...fC5a</span>
								</div>
							</div>

						</div>
					</form>

				</form>
			</div>
		</div>
	</div>
</section>
@endsection


@section('js')
@if(isset($auth_modal) && $auth_modal)
<script>
	window.openAuthModal = true;
</script>
@endif
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const headerHeight = document.querySelector('header')?.offsetHeight;
		const footerHeight = document.querySelector('footer')?.offsetHeight;

		document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
		document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
	});
</script>
@endsection