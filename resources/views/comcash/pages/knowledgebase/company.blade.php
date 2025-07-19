@extends('comcash.layout.main')

@section('content')
<div id="menuOverlay"
    class="fixed inset-0 bg-[#1E1E1E] z-40 flex flex-col items-center justify-start transition-opacity duration-300 opacity-0 pointer-events-none overflow-y-auto max-h-[calc(100%)-108px] top-[108px] max-h-[calc(100%-108px)]">
    <div id="overlayMenuItems" class="
      w-full grid max-[400px]:gap-[8px] gap-6 p-5
      max-[400px]:grid-cols-1 max-[400px]:justify-start
      max-[620px]:grid-cols-2 max-[620px]:justify-center
    "></div>
</div>

<section
    class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="mx-auto">
        <div class="flex max-[800px]:flex-col flex-row items-center items-start">
            <div class="min-[801px]:w-1/2 min-[1050px]:max-w-[400px] text-[14px] mb-8">
                <h2 class="text-[#06AB6B] text-[32px] font-bold mb-4">
                    {{__("front.page_about_title")}}
                </h2>
                <p class="mb-4">
                    {{__("front.aboutDesc1")}}
                    <span class="font-semibold">
                        {{__("front.aboutDesc2")}}
                    </span>, 
                    <span class="font-semibold">
                        {{__("front.aboutDesc3")}}
                    </span>
                    {{__("front.aboutAnd")}}
                    <span class="font-semibold">
                        {{__("front.aboutDesc4")}}
                    </span>
                    .
                </p>
                <p class="mb-4">
                    {{__("front.aboutDesc5")}}
                </p>
                <p>
                    {{__("front.aboutDesc6")}}
                </p>
            </div>
            <div class="w-full">
                <img src="/comcash/img/about.webp" alt="ComCash"
                    class="w-full h-auto min-[1050px]:h-[400px] min-[1050px]:w-[600px]">
            </div>
        </div>
        <div class="mt-12 grid grid-cols-2 max-[450px]:grid-cols-1 gap-10 p-[24px]">
            <div class="text-left flex flex-col gap-2">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.45013 20.2835C7.13347 20.2835 6.8168 20.1668 6.5668 19.9168L4.55014 17.9001L2.53346 19.9168C2.05013 20.4002 1.25013 20.4002 0.766797 19.9168C0.283464 19.4335 0.283464 18.6335 0.766797 18.1502L3.66679 15.2502C4.15013 14.7669 4.95014 14.7669 5.43347 15.2502L8.33347 18.1502C8.8168 18.6335 8.8168 19.4335 8.33347 19.9168C8.10013 20.1668 7.7668 20.2835 7.45013 20.2835Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M35.4329 25.1166C35.1163 25.1166 34.7996 24.9998 34.5496 24.7498L31.6496 21.8499C31.1663 21.3665 31.1663 20.5665 31.6496 20.0832C32.1329 19.5999 32.933 19.5999 33.4163 20.0832L35.4329 22.0999L37.4496 20.0832C37.9329 19.5999 38.7329 19.5999 39.2163 20.0832C39.6996 20.5665 39.6996 21.3665 39.2163 21.8499L36.3163 24.7498C36.0829 24.9832 35.7496 25.1166 35.4329 25.1166Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M35.4331 25.1168C34.7498 25.1168 34.1831 24.5502 34.1831 23.8668V20.0002C34.1831 12.1835 27.8164 5.81681 19.9998 5.81681C15.6831 5.81681 11.6498 7.75015 8.9331 11.1335C8.49976 11.6668 7.71642 11.7501 7.18309 11.3335C6.64976 10.9001 6.54977 10.1168 6.9831 9.5835C10.1664 5.60016 14.9164 3.3335 19.9998 3.3335C29.1998 3.3335 36.6831 10.8168 36.6831 20.0168V23.8835C36.6831 24.5502 36.1331 25.1168 35.4331 25.1168Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M20.0007 36.6833C10.8007 36.6833 3.31738 29.2 3.31738 20V16.1333C3.31738 15.45 3.88405 14.8833 4.56738 14.8833C5.25072 14.8833 5.81738 15.45 5.81738 16.1333V20C5.81738 27.8166 12.1841 34.1833 20.0007 34.1833C24.3174 34.1833 28.3507 32.25 31.0674 28.8667C31.5007 28.3333 32.2841 28.2333 32.8174 28.6667C33.3507 29.1 33.4507 29.8833 33.0174 30.4166C29.834 34.4 25.0841 36.6833 20.0007 36.6833Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M22.3 21.2498H15C14.3167 21.2498 13.75 20.6832 13.75 19.9998V14.1665C13.75 13.4832 14.3167 12.9165 15 12.9165H22.3C24.5167 12.9165 26.4667 14.8665 26.4667 17.0832C26.4667 19.3832 24.5833 21.2498 22.3 21.2498ZM16.25 18.7498H22.2833C23.2 18.7498 23.95 17.9998 23.95 17.0832C23.95 16.3332 23.2 15.4165 22.2833 15.4165H16.25V18.7498Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M23.3333 27.0833H15C14.3167 27.0833 13.75 26.5167 13.75 25.8333V20C13.75 19.3167 14.3167 18.75 15 18.75H23.3333C25.8667 18.75 27.9167 20.6167 27.9167 22.9167C27.9167 25.2167 25.8667 27.0833 23.3333 27.0833ZM16.25 24.5833H23.3333C24.4833 24.5833 25.4167 23.8333 25.4167 22.9167C25.4167 22 24.4833 21.25 23.3333 21.25H16.25V24.5833Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M19.666 30.0002C18.9827 30.0002 18.416 29.4335 18.416 28.7502V25.8335C18.416 25.1502 18.9827 24.5835 19.666 24.5835C20.3493 24.5835 20.916 25.1502 20.916 25.8335V28.7502C20.916 29.4335 20.3493 30.0002 19.666 30.0002Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M19.666 15.4167C18.9827 15.4167 18.416 14.85 18.416 14.1667V11.25C18.416 10.5667 18.9827 10 19.666 10C20.3493 10 20.916 10.5667 20.916 11.25V14.1667C20.916 14.85 20.3493 15.4167 19.666 15.4167Z"
                        fill="#06AB6B"></path>
                </svg>

                <h3 class="text-white text-[20px] max-[450px]:text-[18px]">
                    {{__("front.page_about_advantage_1_title")}}
                </h3>
                <p class="text-[14px] text-white/40 max-w-[440px]">
                    {{__("front.page_about_advantage_1_content")}}
                </p>
            </div>
            
            <div class="text-left flex flex-col gap-2">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.0003 37.9332C18.1837 37.9332 16.3837 37.3999 14.967 36.3499L7.80033 30.9999C5.90033 29.5832 4.41699 26.6332 4.41699 24.2666V11.8666C4.41699 9.2999 6.30033 6.56657 8.71699 5.66657L17.0337 2.5499C18.6837 1.93324 21.2837 1.93324 22.9337 2.5499L31.267 5.66657C33.6837 6.56657 35.567 9.2999 35.567 11.8666V24.2499C35.567 26.6166 34.0837 29.5666 32.1837 30.9832L25.017 36.3332C23.617 37.3999 21.817 37.9332 20.0003 37.9332ZM17.917 4.8999L9.60033 8.01657C8.16699 8.5499 6.91699 10.3499 6.91699 11.8832V24.2666C6.91699 25.8499 8.03366 28.0666 9.28366 28.9999L16.4503 34.3499C18.367 35.7832 21.617 35.7832 23.5337 34.3499L30.7003 28.9999C31.967 28.0499 33.067 25.8332 33.067 24.2666V11.8666C33.067 10.3499 31.817 8.5499 30.3837 7.9999L22.067 4.88324C20.967 4.48324 19.0337 4.48324 17.917 4.8999Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M20.0003 22.0832C17.467 22.0832 15.417 20.0332 15.417 17.4998C15.417 14.9665 17.467 12.9165 20.0003 12.9165C22.5337 12.9165 24.5837 14.9665 24.5837 17.4998C24.5837 20.0332 22.5337 22.0832 20.0003 22.0832ZM20.0003 15.4165C18.8503 15.4165 17.917 16.3498 17.917 17.4998C17.917 18.6498 18.8503 19.5832 20.0003 19.5832C21.1503 19.5832 22.0837 18.6498 22.0837 17.4998C22.0837 16.3498 21.1503 15.4165 20.0003 15.4165Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M20 27.0835C19.3167 27.0835 18.75 26.5168 18.75 25.8335V20.8335C18.75 20.1502 19.3167 19.5835 20 19.5835C20.6833 19.5835 21.25 20.1502 21.25 20.8335V25.8335C21.25 26.5168 20.6833 27.0835 20 27.0835Z"
                        fill="#06AB6B"></path>
                </svg>

                <h3 class="text-white text-[20px] max-[450px]:text-[18px]">
                    {{__("front.page_about_advantage_2_title")}}
                </h3>
                <p class="text-[14px] text-white/40 max-w-[440px]">
                    {{__("front.page_about_advantage_2_content")}}
                </p>
            </div>
            
            <div class="text-left flex flex-col gap-2">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.9997 37.9168C10.1163 37.9168 2.08301 29.8835 2.08301 20.0002C2.08301 10.1168 10.1163 2.0835 19.9997 2.0835C29.883 2.0835 37.9163 10.1168 37.9163 20.0002C37.9163 29.8835 29.883 37.9168 19.9997 37.9168ZM19.9997 4.5835C11.4997 4.5835 4.58301 11.5002 4.58301 20.0002C4.58301 28.5002 11.4997 35.4168 19.9997 35.4168C28.4997 35.4168 35.4163 28.5002 35.4163 20.0002C35.4163 11.5002 28.4997 4.5835 19.9997 4.5835Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M15.0004 36.25H13.3337C12.6504 36.25 12.0837 35.6833 12.0837 35C12.0837 34.3167 12.6171 33.7667 13.3004 33.75C10.6837 24.8167 10.6837 15.1833 13.3004 6.25C12.6171 6.23333 12.0837 5.68333 12.0837 5C12.0837 4.31667 12.6504 3.75 13.3337 3.75H15.0004C15.4004 3.75 15.7837 3.95 16.0171 4.26667C16.2504 4.6 16.3171 5.01667 16.1837 5.4C13.0504 14.8167 13.0504 25.1833 16.1837 34.6167C16.3171 35 16.2504 35.4167 16.0171 35.75C15.7837 36.05 15.4004 36.25 15.0004 36.25Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M25 36.25C24.8667 36.25 24.7333 36.2333 24.6 36.1833C23.95 35.9666 23.5833 35.25 23.8167 34.6C26.95 25.1833 26.95 14.8166 23.8167 5.38331C23.6 4.73331 23.95 4.01664 24.6 3.79997C25.2667 3.58331 25.9667 3.93331 26.1833 4.58331C29.5 14.5166 29.5 25.45 26.1833 35.3666C26.0167 35.9166 25.5167 36.25 25 36.25Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M20 28.6665C15.35 28.6665 10.7167 28.0165 6.25 26.6998C6.23333 27.3665 5.68333 27.9165 5 27.9165C4.31667 27.9165 3.75 27.3498 3.75 26.6665V24.9998C3.75 24.5998 3.95 24.2165 4.26667 23.9832C4.6 23.7498 5.01667 23.6832 5.4 23.8165C14.8167 26.9498 25.2 26.9498 34.6167 23.8165C35 23.6832 35.4167 23.7498 35.75 23.9832C36.0833 24.2165 36.2667 24.5998 36.2667 24.9998V26.6665C36.2667 27.3498 35.7 27.9165 35.0167 27.9165C34.3333 27.9165 33.7833 27.3832 33.7667 26.6998C29.2833 28.0165 24.65 28.6665 20 28.6665Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M35.0003 16.2499C34.867 16.2499 34.7336 16.2333 34.6003 16.1833C25.1836 13.0499 14.8003 13.0499 5.38362 16.1833C4.71696 16.3999 4.01696 16.0499 3.80029 15.3999C3.60029 14.7333 3.95029 14.0333 4.60029 13.8166C14.5336 10.4999 25.467 10.4999 35.3836 13.8166C36.0336 14.0333 36.4003 14.7499 36.167 15.3999C36.017 15.9166 35.517 16.2499 35.0003 16.2499Z"
                        fill="#06AB6B"></path>
                </svg>

                <h3 class="text-white text-[20px] max-[450px]:text-[18px]">
                    {{__("front.page_about_advantage_3_title")}}
                </h3>
                <p class="text-[14px] text-white/40 max-w-[440px]">
                    {{__("front.page_about_advantage_3_content")}}
                </p>
            </div>
            
            <div class="text-left flex flex-col gap-2">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.6163 37.2999C22.233 37.2999 21.8496 37.2333 21.483 37.0999C20.233 36.6333 19.433 35.4666 19.433 34.1333V23.3833H15.533C14.2663 23.3833 13.1663 22.6666 12.6496 21.5166C12.1329 20.3666 12.3329 19.0666 13.1663 18.1166L25.7829 3.78328C26.6663 2.78328 28.033 2.43328 29.283 2.91661C30.533 3.38328 31.3329 4.54994 31.3329 5.88328V16.6333H35.233C36.4996 16.6333 37.5996 17.3499 38.1163 18.4999C38.6329 19.6499 38.4329 20.9499 37.5996 21.8999L24.9829 36.2333C24.3663 36.9333 23.4996 37.2999 22.6163 37.2999ZM28.133 5.19994C27.983 5.19994 27.7996 5.24994 27.6496 5.43328L15.0329 19.7833C14.7663 20.0833 14.8663 20.3833 14.9163 20.4999C14.9663 20.6166 15.133 20.8999 15.533 20.8999H20.683C21.3663 20.8999 21.933 21.4666 21.933 22.1499V34.1499C21.933 34.5666 22.233 34.7333 22.3663 34.7833C22.4996 34.8333 22.8329 34.9166 23.0996 34.5999L35.7163 20.2499C35.9829 19.9499 35.8829 19.6499 35.8329 19.5333C35.7829 19.4166 35.6163 19.1333 35.2163 19.1333H30.0663C29.383 19.1333 28.8163 18.5666 28.8163 17.8833V5.88328C28.8163 5.46661 28.5163 5.29994 28.3829 5.24994C28.3329 5.21661 28.233 5.19994 28.133 5.19994Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M14.1667 7.9165H2.5C1.81667 7.9165 1.25 7.34984 1.25 6.6665C1.25 5.98317 1.81667 5.4165 2.5 5.4165H14.1667C14.85 5.4165 15.4167 5.98317 15.4167 6.6665C15.4167 7.34984 14.85 7.9165 14.1667 7.9165Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M12.5 34.5835H2.5C1.81667 34.5835 1.25 34.0168 1.25 33.3335C1.25 32.6502 1.81667 32.0835 2.5 32.0835H12.5C13.1833 32.0835 13.75 32.6502 13.75 33.3335C13.75 34.0168 13.1833 34.5835 12.5 34.5835Z"
                        fill="#06AB6B"></path>
                    <path
                        d="M7.5 21.25H2.5C1.81667 21.25 1.25 20.6833 1.25 20C1.25 19.3167 1.81667 18.75 2.5 18.75H7.5C8.18333 18.75 8.75 19.3167 8.75 20C8.75 20.6833 8.18333 21.25 7.5 21.25Z"
                        fill="#06AB6B"></path>
                </svg>

                <h3 class="text-white text-[20px] max-[450px]:text-[18px]">
                    {{__("front.page_about_advantage_4_title")}}
                </h3>
                <p class="text-[14px] text-white/40 max-w-[440px]">
                    {{__("front.page_about_advantage_4_content")}}
                </p>
            </div>
        </div>
    </div>
</section>
<section
    class="relative max-[620px]:mt-[80px] max-[490px]:pb-20 max-[440px]:pb-[150px] max-[400px]:pb-[200px] mt-[120px] px-[20px]">
    <div class="mx-auto w-full max-w-[1018px] max-[720px]:max-h-[504px] max-[900px]:max-h-[404px] max-h-[304px]
        flex max-[720px]:flex-col flex-row items-start justify-between rounded-[20px]
        max-[550px]:bg-[linear-gradient(180deg,rgba(15,117,78,0.9)_28.46%,rgba(6,171,107,0)_96%)]
        bg-[linear-gradient(95.5deg,rgba(15,117,78,0.9)_28.46%,rgba(6,171,107,0)_96%)]
        backdrop-blur-[20px]">

        <div class="text-white flex flex-wrap z-10 gap-[4%] w-full max-[720px]:flex-col">

            <div class="flex-1 p-[24px] max-[720px]:pb-0 flex flex-col gap-[10px] order-1 max-[720px]:w-full">
                <h2 class="text-[20px] leading-tight mb-2">
                    {{__("front.page_about_title_3")}}
                </h2>
                <p class="text-[14px] leading-[160%] font-normal">
                    {{__("front.page_about_desc_2")}}
                </p>
                <p class="text-[14px] leading-[160%] font-normal">
                    {{__("front.page_about_desc_6")}}
                </p>
            </div>
            <div class="flex-1 p-[24px] order-2 max-[720px]:order-3 max-[720px]:w-full min-[720px]:mt-10">
                <p class="text-[14px] leading-[160%] font-normal">
                    {{__("front.page_about_desc_3_1")}}
                    <span class="text-[#06AB6B]">
                        {{__("front.page_about_desc_3_2")}}
                    </span>
                    {{__("front.page_about_desc_3_3")}}
                </p>
            </div>
        </div>
    </div>
</section>



<section
    class="relative mt-[100px] mx-auto max-w-[1018px] overflow-hidden flex flex-col gap-[36px] max-[1240px]:px-[20px]">
    <div class="flex max-[430px]:flex-wrap justify-between items-end w-full">
        <div class="text-white gap-[4px]">
            <p class="text-[#06AB6B] font-semibold text-[32px] uppercase">
                {{__("front.page_about_title_4")}}
            </p>
        </div>

    </div>

    <div class="flex min-[740px]-flex-col max-[740px]:flex-wrap gap-[20px]">

        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">
                    {{__("front.page_about_product_1_title")}}
                </h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">
                    {{__("front.page_about_product_1_content")}}
                </p>
            </div>
            <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">
                <a 
                    href="{{route("index")}}"
                    class="flex items-center justify-center h-[40px] max-[850px]:mt-6
                    w-full
                    min-[850px]:w-[217px] min-[850px]:grow
                    bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
                    text-white text-[16px] gap-[12px] px-[12px] py-[4px]
                    rounded-full shadow-[0px_4px_20px_#00000026]
                    hover:opacity-90 uppercase">
                    {{__("front.page_about_product_1_title")}}
                    <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z"
                            fill="white"></path>
                        <path
                            d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
                            fill="currentColor"></path>
                    </svg>
                </a>
            </div>

        </div>

        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">
                    {{__("front.page_about_product_2_title")}}
                </h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">
                    {{__("front.page_about_product_2_content")}}
                </p>
            </div>
            <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">
                <a 
                    href="{{route("comcashPage", ["delivery"])}}"
                    class="flex items-center justify-center h-[40px] max-[850px]:mt-6
                        w-full
                        min-[850px]:w-[217px] min-[850px]:grow
                        bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
                        text-white text-[16px] gap-[12px] px-[12px] py-[4px]
                        rounded-full shadow-[0px_4px_20px_#00000026]
                        hover:opacity-90 uppercase">
                    {{__("front.page_about_product_2_title")}}
                    <svg class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.43 18.82C14.24 18.82 14.05 18.75 13.9 18.6C13.61 18.31 13.61 17.83 13.9 17.54L19.44 12L13.9 6.46C13.61 6.17 13.61 5.69 13.9 5.4C14.19 5.11 14.67 5.11 14.96 5.4L21.03 11.47C21.32 11.76 21.32 12.24 21.03 12.53L14.96 18.6C14.81 18.75 14.62 18.82 14.43 18.82Z"
                            fill="white"></path>
                        <path
                            d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z"
                            fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">
                    {{__("front.page_about_product_3_title")}}
                </h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">
                    {{__("front.page_about_product_3_content")}}
                </p>
            </div>
            <div class="flex items-start gap-[12px] mt-[16px] text-[#777] text-[14px] leading-[140%]">




                <button 
                    href="https://amlcheck.pw"
                    class="flex items-center justify-center h-[40px] max-[850px]:mt-6
                            w-full
                            min-[850px]:w-[217px] min-[850px]:grow
                            bg-[linear-gradient(95.62deg,_#06AB6B_0%,_#009C74_100%)]
                            text-white text-[16px] gap-[12px] px-6 py-2
                            rounded-full shadow-[0px_4px_20px_#00000026]
                            hover:opacity-90 uppercase">

                        {{__("front.page_about_aml_check")}}

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
        </div>

    </div>
</section>

<section
    class="relative mt-[100px] mx-auto max-w-[1018px] overflow-hidden flex flex-col gap-[36px] max-[1240px]:px-[20px]">
    <div class="flex flex-wrap gap-[40px] p-[24px]">
        <div class="flex-1 min-w-[280px]">
            <h2 class="text-[20px] text-white font-semibold mb-2">
                {{__("front.page_about_title_5")}}
            </h2>
            <p class="text-[14px] text-white">
                {{__("front.companyAdvantageText1")}}
            </p>
        </div>
        <div class="flex-1 min-w-[280px]">
            <h2 class="text-[20px] text-white font-semibold mb-2">
                {{__("front.companyAdvantageTitle3")}}
            </h2>
            <p class="text-[14px] text-white">
                {{__("front.companyAdvantageText3")}}
            </p>
        </div>
    </div>
</section>

<section
    class="relative mt-[100px] mx-auto max-w-[1018px] overflow-hidden flex flex-col gap-[36px] max-[1240px]:px-[20px]">
    <div class="flex max-[430px]:flex-wrap justify-between items-end w-full">
        <div class="text-white gap-[4px]">
            <p class="text-[#06AB6B] font-semibold text-[32px] uppercase">
                {{__("front.companyAdvantageTitle2")}}
            </p>
        </div>

    </div>
    <p class="text-[14px] text-white w-full">
        {{__("front.companyAdvantageText1")}}
    </p>

    <div class="flex min-[740px]-flex-col max-[740px]:flex-wrap gap-[20px]">

        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[#06AB6B] text-[32px] leading-[140%] tracking-[0] mb-2 font-semibold">0.2%</h3>
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">С каждого обмена</h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">При общем объеме обменов
                    до $5000</p>
            </div>

        </div>

        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[#06AB6B] text-[32px] leading-[140%] tracking-[0] mb-2 font-semibold">0.2%</h3>
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">С каждого обмена</h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">При общем объеме обменов
                    до $5000</p>
            </div>

        </div>
        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[#06AB6B] text-[32px] leading-[140%] tracking-[0] mb-2 font-semibold">0.2%</h3>
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">С каждого обмена</h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">При общем объеме обменов
                    до $5000</p>
            </div>

        </div>
        <div class="bg-[#FFFFFF]/5 rounded-[10px] p-[24px] w-full flex flex-col justify-between backdrop-blur-[20px]">
            <div class="text-white">
                <h3 class="font-medium text-[#06AB6B] text-[32px] leading-[140%] tracking-[0] mb-2 font-semibold">0.2%</h3>
                <h3 class="font-medium text-[18px] leading-[140%] tracking-[0] mb-3">С каждого обмена</h3>
                <p class="text-[14px] font-normal text-white/70 leading-[160%] line-clamp-3 mb-3">При общем объеме обменов
                    до $5000</p>
            </div>

        </div>
    </div>
</section>
@endsection