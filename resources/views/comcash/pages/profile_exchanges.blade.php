@extends('comcash.layout.main')

@section('content')
<section
    class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
    <h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
        {{__("front.client panel")}}
    </h2>
    <div class="flex max-[720px]:block">

        @include('comcash.component.profile_sidebar', [
        'active' => 'history'
        ])

        <div class="flex-1">

            <div id="tab-history" class="tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">{{__("front.personOperationHistoryLabel")}}</span>
                    <div class="flex-1 h-[1px] bg-[#06AB6B]"></div>
                </div>

                <div class="hidden max-[400px]:flex items-center justify-between mb-4">
                    <button class="back-to-main-tabs text-[#666666] text-[15px] uppercase">
                        <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.66667 1L0.999999 5L5.66666 9" stroke="white" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <p class="text-[16px] uppercase">
                        {{__("front.personOperationHistoryLabel")}}
                    </p>
                </div>
                <form class="flex flex-col gap-4">


                    <div class="hidden sm:grid grid-cols-[0.8fr_0.9fr_1.8fr_1.4fr_1fr] text-white/40 text-[12px] pl-4">
                        <div>{{__("front.date")}}</div>
                        <div>{{__("front.time")}}</div>
                        <div>{{__("front.sent")}}</div>
                        <div>{{__("front.received")}}</div>
                        <div>{{__("front.exchange_rate")}}</div>
                    </div>

                    @foreach($exchanges as $row)
                        <div
                            class="pl-4 py-3 flex flex-col gap-3 sm:grid sm:grid-cols-[0.75fr_0.8fr_1.8fr_1.4fr_1fr] sm:items-center sm:gap-2 border-b border-white/10">

                            <div class="text-white text-[14px] sm:block hidden">12.12.2024</div>
                            <div class="text-white text-[14px] sm:block hidden">13:44:56</div>

                            <div class=" flex justify-between sm:hidden text-white text-[14px]">
                                <span class="text-white/40 text-[12px]">{{__("front.date")}}</span>
                                <span>12.12.2024, 13:44:56</span>
                            </div>

                            <div class="text-white text-[14px]  flex justify-between items-center">
                                <span class="text-white/40 text-[12px] sm:hidden">{{__("front.time")}}</span>
                                <div class="flex items-center gap-2">
                                    <span class="bg-white/5 rounded-[12px] py-full px-[8px]">{{$row->currencyFrom ? $row->currencyFrom->getTitle() : ""}}</span>
                                    <span>{{@$row->data['amount_data']['amount_send']}}</span>
                                </div>
                            </div>

                            <div class="text-white text-[14px]  flex justify-between items-center">
                                <span class="text-white/40 text-[12px] sm:hidden">{{__("front.received")}}</span>
                                <div class="flex items-center gap-2">
                                    <span class="bg-white/5 rounded-[12px] py-full px-[8px]">{{$row->currencyTo ? $row->currencyTo->getTitle() : ""}}</span>
                                    <span>{{@$row->data['amount_data']['amount_receive']}}</span>
                                </div>
                            </div>

                            @if (false)
                                <div class="text-white text-[14px] flex justify-between items-center">
                                    <span class="text-white/40 text-[12px] sm:hidden">{{__("front.exchange_rate")}}</span>
                                    <span>0.7824</span>
                                </div>
                            @endif

                        </div>

                    @endforeach 
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