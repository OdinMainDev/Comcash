@extends('comcash.layout.main')

@section('content')
<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="flex flex-wrap max-[480px]:flex-col justify-between items-end w-full gap-4 mb-8">
        <div class="review-header text-white">
            <p class="text-[#06AB6B] font-semibold text-[32px]">ОТЗЫВЫ ПОЛЬЗОВАТЕЛЕЙ</p>
            <p class="text-[18px] font-normal">ОБ ОБМЕННИКЕ КРИПТЫ COMCASH</p>
        </div>
    </div>

    @if(isset($feedbacks) && count($feedbacks) > 0)
        <div class="swiper review-swiper w-full overflow-hidden max-[400px]:h-[1420px] max-[720px]:h-[1600px] max-h-[1074] pointer-events-none gap-[24px]">
            <div class="swiper-wrapper">
                @foreach($feedbacks as $item)
                    <div class="swiper-slide review-slide">
                        <div class="review-card bg-white/5 p-6 rounded-[8px] text-white shadow-md">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-[#06AB6B]">★★★★★</div>
                                <div class="text-[14px] text-white/20">{{date("H:i:s d.m.Y", $item->created_at->unix())}}</div>
                            </div>
                            <p class="text-[14px] mb-4">{{$item->text}}</p>
                            <span class="text-[14px] text-white/40">{{$item->name}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{ $feedbacks->withPath(route("comcashPage", ["reviews"]))->onEachSide(1)->links() }}


</section>
@endsection