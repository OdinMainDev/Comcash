@extends('comcash.layout.main')

@section('content')

<div id="partners-submenu-screen"
	class="hidden bg-[#1E1E1E] fixed inset-0 z-50 flex flex-col px-6 pt-4 max-[720px]:top-[120px] top-[80px] max-h-[calc(100%)-80px]">
	<div class="flex items-center justify-between mb-4">
		<button id="back-from-submenu" class="text-[#666666] text-[15px] uppercase">
			<svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.66667 1L0.999999 5L5.66666 9" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
		</button>
		<p class="text-[#666666] text-[15px] uppercase">
			{{__("front.profile affiliate")}}
		</p>
	</div>

	<button class="tab-btn submenu-item py-2 text-[16px] text-white flex items-center justify-between w-full"
		data-tab="companies">
		<span>
			{{__("front.affiliate my campaigns")}}
		</span>
		<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M3.33333 10L8 6L3.33333 2" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
	</button>
	<button class="tab-btn submenu-item py-2 text-[16px] text-white flex items-center justify-between w-full"
		data-tab="affiliates">
		<span>
			{{__("front.affiliate my exchanges")}}
		</span>
		<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M3.33333 10L8 6L3.33333 2" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
	</button>
	<button class="tab-btn submenu-item py-2 text-[16px] text-white flex items-center justify-between w-full"
		data-tab="balance">
		<span>
			{{__("front.affiliate my balance")}}
		</span>
		<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M3.33333 10L8 6L3.33333 2" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
		</svg>
	</button>
</div>

<section
	class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
	<h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
		{{__("front.client panel")}}
	</h2>
	<div class="flex max-[720px]:block">

		@include('comcash.component.profile_sidebar', [
		'active' => 'affiliate',
		'sub' => "companies"
		])

		<div class="flex-1">

			<div id="tab-companies" class=" tab-content">
				<div class="max-[400px]:hidden flex items-center mb-6">
					<span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">{{__("front.affiliate my campaigns")}}</span>
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
							{{__("front.affiliate my campaigns")}}
						</p>
					</div>
				</div>
				<form action="{{route("myprofileAffiliatePost")}}" class="flex flex-col gap-[14px]">
					@csrf
					<div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
						<p>{{__("front.add_new_campaign")}}</p>
						<input 
							type="text" 
							placeholder="{{__("front.affiliate campaign name")}}" 
							name="name" 
							id="name"
							class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
						<div class="flex justify-start mt-2">
							<button type="submit"
								class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
								style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
								{{__("front.create")}}
							</button>
						</div>
					</div>

					<div
						class="grid sm:grid-cols-[0.4fr_0.8fr_0.8fr_1fr] text-white text-[14px] gap-y-3 border-t border-white/10 pt-4">

						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.campaign")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__(key: "front.registered")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__(key: "front.deals_completed")}}</div>
						<div class="hidden sm:block text-white/40 text-[12px]">{{__("front.link")}}</div>

						@foreach($campaigns as $campaign)
							<div class="flex justify-between items-center sm:block">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.campaign")}}</span>
								<span class="uppercase">{{$campaign->name}}</span>
							</div>

							<div class="flex justify-between items-center sm:block">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.registered")}}</span>
								<span class="uppercase">{{$campaign->registered_users}}</span>
							</div>

							<div class="flex justify-between items-center sm:block">
								<span class="text-white/40 text-[12px] sm:hidden">{{__("front.deals_completed")}}</span>
								<span class="uppercase">{{$campaign->profitable_transactions}}</span>
							</div>

							<div
								class="text-white text-[14px] flex justify-between items-center max-[450px]:flex-wrap max-[450px]:gap-2">
								<span class="text-white/40 text-[12px] sm:hidden ">{{__("front.link")}}</span>
								<div class="copy-to-clipboard flex items-center gap-2 max-[450px]:flex-wrap max-[450px]:min-w-0 relative group">
									<a href="#"
										class="uppercase text-[14px] text-[#06AB6B] hover:opacity-70 max-[900px]:break-all max-[450px]:flex-1 relative truncate w-64">
										{{route("checkAffiliate", ["hash" => $campaign->hash])}}
										<span
											class="hidden tooltip absolute bottom-full mb-1 left-1/2 -translate-x-1/2 text-[12px] bg-black text-white px-2 py-1 rounded group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
											{{__("front.copied")}}
										</span>
									</a>
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