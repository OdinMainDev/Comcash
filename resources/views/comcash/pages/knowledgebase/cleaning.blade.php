@extends('comcash.layout.main')

@section('content')


    <section
        class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
        <div class="flex justify-between items-start gap-[24px] flex-nowrap mx-auto max-w-[600px] w-full">
            <div
                class="flex flex-col gap-[4px] text-[14px] text-white/40 mb-6 transition-all duration-300 ease-in-out w-full">

                <h2 class="text-[32px] font-bold text-[#06AB6B] uppercase">Очистка</h2>
                <span class="text-[#FFFFFF] text-[16px]">Оставьте контакты, Ваш личный консьерж свяжется с вами.</span>
                <span class="text-[#FFFFFF] text-[16px]">Задача будет решена, независимо от суммы, направления и
                    рисков.</span>

                <div class="flex flex-nowrap
                  text-[#F1F1F1] text-[14px] my-[24px]" style="font-size: clamp(10px, 2.7vw, 14px);">

                    <p class="flex items-center gap-2 px-2 leading-tight max-[600px]:px-0 max-[719px]:flex">
                        <svg class="h-[17px] w-[17px] flex-shrink-0 max-[510px]:hidden" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M6 11.875C3.035 11.875 0.625 9.465 0.625 6.5C0.625 3.535 3.035 1.125 6 1.125C8.965 1.125 11.375 3.535 11.375 6.5C11.375 9.465 8.965 11.875 6 11.875ZM6 1.875C3.45 1.875 1.375 3.95 1.375 6.5C1.375 9.05 3.45 11.125 6 11.125C8.55 11.125 10.625 9.05 10.625 6.5C10.625 3.95 8.55 1.875 6 1.875Z"
                                fill="#F1F1F1"></path>
                            <path opacity="0.4"
                                d="M7.85501 8.465C7.79001 8.465 7.72501 8.45 7.66501 8.41L6.11501 7.485C5.73001 7.255 5.44501 6.75 5.44501 6.305V4.255C5.44501 4.05 5.61501 3.88 5.82001 3.88C6.02501 3.88 6.19501 4.05 6.19501 4.255V6.305C6.19501 6.485 6.34501 6.75 6.50001 6.84L8.05001 7.765C8.23001 7.87 8.28501 8.1 8.18001 8.28C8.10501 8.4 7.98001 8.465 7.85501 8.465Z"
                                fill="#F1F1F1"></path>
                        </svg>

                        <span>
                            Часы работы
                            <span class="flex-wrap text-[#06AB6B]">с&nbsp;12:00&nbsp;до&nbsp;00:00</span>
                        </span>
                    </p>

                    <div class="flex items-center justify-center px-2">
                        <svg width="1" height="12" viewBox="0 0 1 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="1" height="12" fill="white" fill-opacity="0.1"></rect>
                        </svg>
                    </div>

                    <p class="flex items-center gap-2 px-2 leading-tight max-[600px]:px-0 max-[719px]:flex">
                        <svg class="h-[17px] w-[17px] flex-shrink-0 max-[510px]:hidden" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M7.61997 11.875H4.37997C3.43497 11.875 2.74497 11.48 2.47997 10.8C2.20497 10.09 2.45997 9.21 3.11997 8.615L5.43997 6.5L3.11997 4.385C2.45997 3.79 2.20497 2.91 2.47997 2.2C2.74497 1.515 3.43497 1.125 4.37997 1.125H7.61997C8.56497 1.125 9.25497 1.52 9.51997 2.2C9.79497 2.91 9.53997 3.79 8.87997 4.385L6.55997 6.5L8.88497 8.615C9.53997 9.21 9.79997 10.09 9.52497 10.8C9.25497 11.48 8.56497 11.875 7.61997 11.875ZM5.99997 7.005L3.62497 9.165C3.20497 9.55 3.01997 10.11 3.17997 10.525C3.32997 10.91 3.75497 11.125 4.37997 11.125H7.61997C8.24497 11.125 8.66997 10.915 8.81997 10.525C8.97997 10.11 8.79997 9.55 8.37497 9.165L5.99997 7.005ZM4.37997 1.875C3.75497 1.875 3.32997 2.085 3.17997 2.475C3.01997 2.89 3.19997 3.45 3.62497 3.835L5.99997 5.995L8.37497 3.835C8.79497 3.45 8.97997 2.89 8.81997 2.475C8.66997 2.09 8.24497 1.875 7.61997 1.875H4.37997Z"
                                fill="#F1F1F1"></path>
                        </svg>

                        <span>
                            Обработка заявок
                            <span class="flex-wrap text-[#06AB6B]">до&nbsp;30&nbsp;минут</span>
                        </span>
                    </p>
                </div>
                <form class="company-form__form bg-[#1E1E1ECC] backdrop-blur-xl rounded-lg space-y-6 w-full mx-auto ">

                    <div class="relative w-full">
                        <input 
                            id="Jabber" 
                            type="Jabber" 
                            placeholder="Введите ваш jabber"
                            name="contactjabber"
                            required=""
                            class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">
                        <label for="Jabber" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                peer-placeholder-shown:top-[18px]
                                peer-placeholder-shown:text-base
                                peer-placeholder-shown:text-white/30
                                peer-focus:top-[8px]
                                peer-focus:text-sm
                                peer-focus:text-emerald-400
                                peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                                peer-[&amp;:not(:placeholder-shown)]:text-sm
                                peer-[&amp;:not(:placeholder-shown)]:text-white">
                            Введите Ваш Jabber
                        </label>
                    </div>

                    <div class="relative w-full">
                        <input 
                            id="TOX" 
                            name="contacttox"
                            type="TOX" 
                            placeholder="Введите ваш TOX" 
                            required=""
                            class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">
                        <label for="TOX" class="absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                    peer-placeholder-shown:top-[18px]
                                    peer-placeholder-shown:text-base
                                    peer-placeholder-shown:text-white/30
                                    peer-focus:top-[8px]
                                    peer-focus:text-sm
                                    peer-focus:text-emerald-400
                                    peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                                    peer-[&amp;:not(:placeholder-shown)]:text-sm
                                    peer-[&amp;:not(:placeholder-shown)]:text-white">
                            Введите Ваш TOX
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full text-white py-3 rounded-full text-[18px] transition h-[62px] shadow-[0px_4px_20px_0px_#00000026] hover:opacity-90"
                        style="background:linear-gradient(0deg,#009C74,#009C74),linear-gradient(95.62deg,#06AB6B 70.57%,#009C74 383.64%);">
                        ОТПРАВИТЬ СООБЩЕНИЕ
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include("comcash.component.index.about_wedev")
    @include("comcash.component.index.feedback_wedev")

@endsection