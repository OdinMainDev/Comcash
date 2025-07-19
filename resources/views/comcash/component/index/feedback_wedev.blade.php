@if(isset($feedbacks) && count($feedbacks) > 0)
<section
    class="relative max-[620px]:mt-[60px] mt-[100px] mx-auto max-w-[1018px] overflow-hidden flex flex-col gap-[36px] max-[1024px]:px-[20px]">
    <div class="flex max-[480px]:flex-wrap justify-between items-end w-full">
        <div class="text-white gap-[4px]">
            <p class="text-[#06AB6B] font-semibold text-[32px]">
                {{__("front.Feedback Label")}}
            </p>
            <p class="text-[18px] font-normal">
                {{__("front.aboutExchangeFeedback")}}
            </p>
        </div>

        <div class="flex max-[480px]:mt-3 gap-[10px]">
            <button id="custom-prev"
                class="w-[44px] h-[44px] p-[10px] rounded-[4px] bg-white/5 flex items-center justify-center transition-all duration-300 text-white hover:opacity-80">
                <svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.09003 0.329981C8.28003 0.329981 8.47003 0.399981 8.62003 0.54998C8.91003 0.839981 8.91003 1.31998 8.62003 1.60998L2.10003 8.12998C1.62003 8.60998 1.62003 9.38998 2.10003 9.86998L8.62002 16.39C8.91002 16.68 8.91002 17.16 8.62002 17.45C8.33002 17.74 7.85002 17.74 7.56002 17.45L1.04002 10.93C0.530025 10.42 0.240025 9.72998 0.240025 8.99998C0.240025 8.26998 0.520025 7.57998 1.04003 7.06998L7.56003 0.54998C7.71003 0.409981 7.90003 0.329981 8.09003 0.329981Z"
                        fill="currentColor" />
                </svg>
            </button>
            <button id="custom-next"
                class="w-[44px] h-[44px] p-[10px] rounded-[4px] bg-gradient-to-r from-[#06AB6B] to-[#009C74] flex items-center justify-center transition-all duration-300 text-white hover:opacity-80">
                <svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.909975 17.67C0.719975 17.67 0.529976 17.6 0.379976 17.45C0.0899756 17.16 0.0899756 16.68 0.379976 16.39L6.89998 9.87002C7.37998 9.39002 7.37998 8.61002 6.89998 8.13002L0.379976 1.61002C0.0899756 1.32002 0.0899756 0.84002 0.379976 0.55002C0.669976 0.26002 1.14998 0.26002 1.43998 0.55002L7.95998 7.07002C8.46998 7.58002 8.75998 8.27002 8.75998 9.00002C8.75998 9.73002 8.47998 10.42 7.95998 10.93L1.43998 17.45C1.28998 17.59 1.09998 17.67 0.909975 17.67Z"
                        fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <div class="swiper feedbackSwiper w-full overflow-hidden max-[670px]:h-[600px] pointer-events-none">
        <div class="swiper-wrapper">

            @foreach($feedbacks as $item)
                <div class="swiper-slide min-w-[280px] min-[671px]:max-w-[320px] w-full swiper-slide-active">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-1 text-[#06AB6B] text-[18px]">
                                <!-- ★★★★★ -->
                                {{$item->stars}}
                            </div>
                            <p class="text-[14px] text-white/40">
                                {{$item->date}}
                            </p>
                        </div>
                        <p class="text-[14px] leading-[160%] font-normal">
                            {{$item->text}}
                        </p>
                        <p class="text-white/40 text-sm">
                            {{$item->nickname}}
                        </p>
                    </div>
                </div>
            @endforeach
         
        </div>
    </div>
</section>
@endif