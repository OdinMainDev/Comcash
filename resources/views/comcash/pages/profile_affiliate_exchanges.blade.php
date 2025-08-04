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
		'sub' => "affiliates"
		])

		<div class="flex-1">

			<div id="tab-affiliates" class="tab-content">
				<div class="max-[400px]:hidden flex items-center mb-6">
					<span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">{{__("front.affiliate my exchanges")}}</span>
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
							{{__("front.affiliate my exchanges")}}
						</p>
					</div>
				</div>
				<form class="flex flex-col gap-[14px]">

					<div
						class="grid sm:grid-cols-[0.8fr_0.8fr_1.6fr_1.6fr_1fr] text-white text-[14px] gap-y-3 pt-4 border-b border-white/10">
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.campaign")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.date")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.sent")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.received")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.status")}}</div>


						@foreach($exchanges as $exchange)
							<div class="flex justify-between items-center sm:block">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.campaign")}}</span>
								<span class="uppercase">{{$exchange->user_credential}}</span>
							</div>

							<div class="flex justify-between items-center sm:block">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.date")}}</span>
								<div class="flex flex-wrap break-all">
									<span class="uppercase">12.12.2024</span>
									<span class="uppercase">13:44:56</span>
								</div>

							</div>

							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.sent")}}</span>
								<div class="flex items-center gap-2">
									<span class="bg-white/5 rounded-[12px] py-full px-[8px]">USDT</span>
									<span>{{$exchange->amount}}</span>
								</div>
							</div>

							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.status")}}</span>
								<div class="flex items-center gap-2">
									<span class="bg-white/5 rounded-[12px] py-full px-[8px]">EUR</span>
									<span>{{sprintf("%.12f", $exchange->amount_earned)}}</span>
								</div>
							</div>

							<div class="text-white text-[14px]  flex justify-between items-center">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.received")}}</span>
								<div class="flex items-center gap-2">
									<span class="uppercase text-[14px] text-[#06AB6B]">Успешно</span>
								</div>
							</div>
						@endforeach
					</div>


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