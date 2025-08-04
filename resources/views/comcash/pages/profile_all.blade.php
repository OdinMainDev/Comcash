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


<div id="menuOverlay2"
    class="fixed inset-0 bg-[#202020] z-40 flex flex-col items-center justify-start transition-opacity duration-300 opacity-0 pointer-events-none overflow-y-auto top-[108px] max-h-[calc(100%)-108px]">
    <div id="overlaycpMenuItems" class="
      w-full grid max-[400px]:gap-[8px] gap-6 p-5 mt-4
      max-[400px]:grid-cols-1 max-[400px]:justify-start
    ">

        <button
            class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all whitespace-nowrap"
            data-tab="personal" data-active="false">
            <svg class="w-[18px] h-[18px] text-[#06AB6B]" viewBox="0 0 18 18" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.08999 10.1475C9.07499 10.1475 9.05249 10.1475 9.03749 10.1475C9.01499 10.1475 8.98499 10.1475 8.96249 10.1475C7.25999 10.095 5.98499 8.76749 5.98499 7.13249C5.98499 5.46749 7.34249 4.10999 9.00749 4.10999C10.6725 4.10999 12.03 5.46749 12.03 7.13249C12.0225 8.77499 10.74 10.095 9.11248 10.1475C9.09749 10.1475 9.09749 10.1475 9.08999 10.1475ZM8.99999 5.22749C7.94999 5.22749 7.10249 6.08249 7.10249 7.12499C7.10249 8.15249 7.90499 8.98499 8.92498 9.02249C8.94748 9.01499 9.02249 9.01499 9.09749 9.02249C10.1025 8.96999 10.89 8.14499 10.8975 7.12499C10.8975 6.08249 10.05 5.22749 8.99999 5.22749Z"
                    fill="currentColor" />
                <path
                    d="M9 17.0625C6.9825 17.0625 5.055 16.3125 3.5625 14.9475C3.4275 14.8275 3.3675 14.6475 3.3825 14.475C3.48 13.5825 4.035 12.75 4.9575 12.135C7.1925 10.65 10.815 10.65 13.0425 12.135C13.965 12.7575 14.52 13.5825 14.6175 14.475C14.64 14.655 14.5725 14.8275 14.4375 14.9475C12.945 16.3125 11.0175 17.0625 9 17.0625ZM4.56 14.325C5.805 15.3675 7.3725 15.9375 9 15.9375C10.6275 15.9375 12.195 15.3675 13.44 14.325C13.305 13.8675 12.945 13.425 12.4125 13.065C10.5675 11.835 7.44 11.835 5.58 13.065C5.0475 13.425 4.695 13.8675 4.56 14.325Z"
                    fill="currentColor" />
                <path
                    d="M9 17.0625C4.5525 17.0625 0.9375 13.4475 0.9375 9C0.9375 4.5525 4.5525 0.9375 9 0.9375C13.4475 0.9375 17.0625 4.5525 17.0625 9C17.0625 13.4475 13.4475 17.0625 9 17.0625ZM9 2.0625C5.175 2.0625 2.0625 5.175 2.0625 9C2.0625 12.825 5.175 15.9375 9 15.9375C12.825 15.9375 15.9375 12.825 15.9375 9C15.9375 5.175 12.825 2.0625 9 2.0625Z"
                    fill="currentColor" />
            </svg>
            <div class="flex items-center justify-between w-full">
                <span class="transition-colors">
                    {{__("front.personInfoLabel")}}
                </span>
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33333 9L6 5L1.33333 1" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <button
            class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all whitespace-nowrap"
            data-tab="history" data-active="false">
            <svg class="w-[18px] h-[18px] text-[#06AB6B]" viewBox="0 0 18 18" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9 13.3575H1.5C1.1925 13.3575 0.9375 13.1025 0.9375 12.795C0.9375 12.4875 1.1925 12.2325 1.5 12.2325H9C9.3075 12.2325 9.5625 12.4875 9.5625 12.795C9.5625 13.11 9.3075 13.3575 9 13.3575Z"
                    fill="currentColor" />
                <path
                    d="M7.33484 17.0625H3.1723C1.5298 17.0625 0.944824 16.485 0.944824 14.85V11.775C0.944824 10.14 1.5298 9.5625 3.1723 9.5625H7.33484C8.97734 9.5625 9.56232 10.14 9.56232 11.775V14.8575C9.56232 16.485 8.97734 17.0625 7.33484 17.0625ZM3.16479 10.6875C2.14479 10.6875 2.06232 10.77 2.06232 11.775V14.8575C2.06232 15.8625 2.14479 15.945 3.16479 15.945H7.32733C8.34733 15.945 8.42981 15.8625 8.42981 14.8575V11.775C8.42981 10.77 8.34733 10.6875 7.32733 10.6875H3.16479Z"
                    fill="currentColor" />
                <path
                    d="M11.2502 17.0625C11.0477 17.0625 10.8601 16.95 10.7626 16.7775C10.6651 16.5975 10.6651 16.3875 10.7701 16.2075L11.5576 14.895C11.7151 14.6325 12.0602 14.5425 12.3302 14.7C12.6002 14.8575 12.6827 15.2025 12.5252 15.4725L12.3227 15.81C14.3927 15.3225 15.9452 13.4625 15.9452 11.2425C15.9452 10.935 16.2002 10.68 16.5077 10.68C16.8152 10.68 17.0702 10.935 17.0702 11.2425C17.0627 14.4525 14.4527 17.0625 11.2502 17.0625Z"
                    fill="currentColor" />
                <path
                    d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75C0.9375 3.5475 3.5475 0.9375 6.75 0.9375C6.9525 0.9375 7.14002 1.05 7.23752 1.2225C7.33502 1.4025 7.33501 1.6125 7.23001 1.7925L6.44252 3.105C6.28502 3.3675 5.94 3.4575 5.67 3.3C5.4 3.1425 5.31749 2.7975 5.47499 2.5275L5.67751 2.19C3.60751 2.6775 2.05499 4.5375 2.05499 6.7575C2.06249 7.0575 1.8075 7.3125 1.5 7.3125Z"
                    fill="currentColor" />
                <path
                    d="M13.875 8.8125C11.7075 8.8125 9.9375 7.05 9.9375 4.875C9.9375 2.7 11.7 0.9375 13.875 0.9375C16.05 0.9375 17.8125 2.7 17.8125 4.875C17.8125 7.05 16.0425 8.8125 13.875 8.8125ZM13.875 2.0625C12.3225 2.0625 11.0625 3.3225 11.0625 4.875C11.0625 6.4275 12.3225 7.6875 13.875 7.6875C15.4275 7.6875 16.6875 6.4275 16.6875 4.875C16.6875 3.3225 15.4275 2.0625 13.875 2.0625Z"
                    fill="currentColor" />
            </svg>
            <div class="flex items-center justify-between w-full">
                <span class="transition-colors">
                    {{__("front.personOperationHistoryLabel")}}
                </span>
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33333 9L6 5L1.33333 1" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <button type="button"
            class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all whitespace-nowrap">
            <span class="flex items-center gap-[12px]">
                <svg class="w-[18px] h-[18px] text-[#06AB6B]" viewBox="0 0 18 18" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.86968 8.715C6.84718 8.715 6.83218 8.715 6.80968 8.715C6.77218 8.7075 6.71968 8.7075 6.67468 8.715C4.49968 8.6475 2.85718 6.9375 2.85718 4.83C2.85718 2.685 4.60468 0.9375 6.74968 0.9375C8.89468 0.9375 10.6422 2.685 10.6422 4.83C10.6347 6.9375 8.98468 8.6475 6.89218 8.715C6.88468 8.715 6.87718 8.715 6.86968 8.715ZM6.74968 2.0625C5.22718 2.0625 3.98218 3.3075 3.98218 4.83C3.98218 6.33 5.15218 7.5375 6.64468 7.59C6.68968 7.5825 6.78718 7.5825 6.88468 7.59C8.35468 7.5225 9.50968 6.315 9.51718 4.83C9.51718 3.3075 8.27218 2.0625 6.74968 2.0625Z"
                        fill="currentColor" />
                    <path
                        d="M12.4047 8.8125C12.3822 8.8125 12.3597 8.8125 12.3372 8.805C12.0297 8.835 11.7147 8.6175 11.6847 8.31C11.6547 8.0025 11.8422 7.725 12.1497 7.6875C12.2397 7.68 12.3372 7.68 12.4197 7.68C13.5147 7.62 14.3697 6.72 14.3697 5.6175C14.3697 4.4775 13.4472 3.555 12.3072 3.555C11.9997 3.5625 11.7447 3.3075 11.7447 3C11.7447 2.6925 11.9997 2.4375 12.3072 2.4375C14.0622 2.4375 15.4947 3.87 15.4947 5.625C15.4947 7.35 14.1447 8.745 12.4272 8.8125C12.4197 8.8125 12.4122 8.8125 12.4047 8.8125Z"
                        fill="currentColor" />
                    <path
                        d="M6.87721 16.9125C5.40721 16.9125 3.92971 16.5375 2.81221 15.7875C1.76971 15.0975 1.19971 14.1525 1.19971 13.125C1.19971 12.0975 1.76971 11.145 2.81221 10.4475C5.06221 8.955 8.70721 8.955 10.9422 10.4475C11.9772 11.1375 12.5547 12.0825 12.5547 13.11C12.5547 14.1375 11.9847 15.09 10.9422 15.7875C9.81721 16.5375 8.34721 16.9125 6.87721 16.9125ZM3.43471 11.3925C2.71471 11.8725 2.32471 12.4875 2.32471 13.1325C2.32471 13.77 2.72221 14.385 3.43471 14.8575C5.30221 16.11 8.45221 16.11 10.3197 14.8575C11.0397 14.3775 11.4297 13.7625 11.4297 13.1175C11.4297 12.48 11.0322 11.865 10.3197 11.3925C8.45221 10.1475 5.30221 10.1475 3.43471 11.3925Z"
                        fill="currentColor" />
                    <path
                        d="M13.7548 15.5625C13.4923 15.5625 13.2598 15.3825 13.2073 15.1125C13.1473 14.805 13.3423 14.5125 13.6423 14.445C14.1148 14.3475 14.5498 14.16 14.8873 13.8975C15.3148 13.575 15.5473 13.17 15.5473 12.7425C15.5473 12.315 15.3148 11.91 14.8948 11.595C14.5648 11.34 14.1523 11.16 13.6648 11.0475C13.3648 10.98 13.1698 10.68 13.2373 10.3725C13.3048 10.0725 13.6048 9.87751 13.9123 9.94501C14.5573 10.0875 15.1198 10.3425 15.5773 10.695C16.2748 11.22 16.6723 11.9625 16.6723 12.7425C16.6723 13.5225 16.2673 14.265 15.5698 14.7975C15.1048 15.1575 14.5198 15.42 13.8748 15.5475C13.8298 15.5625 13.7923 15.5625 13.7548 15.5625Z"
                        fill="currentColor" />
                </svg>
            </span>
            <div class="flex items-center justify-between w-full">
                <span class="transition-colors">
                    {{__("front.profile affiliate")}}
                </span>
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33333 9L6 5L1.33333 1" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <button
            class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all whitespace-nowrap"
            data-tab="security" data-active="false">
            <svg class="w-[18px] h-[18px] text-[#06AB6B]" viewBox="0 0 18 18" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.99989 17.0625C8.81989 17.0625 8.63989 17.0401 8.46739 16.9876C4.57489 15.9151 1.75488 12.2775 1.75488 8.33253V5.04002C1.75488 4.20002 2.36239 3.29256 3.14239 2.97006L7.31989 1.26004C8.40739 0.817537 9.59988 0.817537 10.6799 1.26004L14.8574 2.97006C15.6374 3.29256 16.2449 4.20002 16.2449 5.04002V8.33253C16.2449 12.27 13.4174 15.9076 9.53238 16.9876C9.35988 17.0401 9.17989 17.0625 8.99989 17.0625ZM8.99989 2.06254C8.57239 2.06254 8.15238 2.14505 7.74738 2.31005L3.56989 4.02003C3.20989 4.17003 2.87988 4.65753 2.87988 5.04753V8.34004C2.87988 11.7825 5.35489 14.9626 8.76739 15.9076C8.91739 15.9526 9.08238 15.9526 9.23238 15.9076C12.6449 14.9626 15.1199 11.7825 15.1199 8.34004V5.04753C15.1199 4.65753 14.7899 4.17003 14.4299 4.02003L10.2524 2.31005C9.8474 2.14505 9.42739 2.06254 8.99989 2.06254Z"
                    fill="currentColor" />
                <path
                    d="M9 9.9375C7.86 9.9375 6.9375 9.015 6.9375 7.875C6.9375 6.735 7.86 5.8125 9 5.8125C10.14 5.8125 11.0625 6.735 11.0625 7.875C11.0625 9.015 10.14 9.9375 9 9.9375ZM9 6.9375C8.4825 6.9375 8.0625 7.3575 8.0625 7.875C8.0625 8.3925 8.4825 8.8125 9 8.8125C9.5175 8.8125 9.9375 8.3925 9.9375 7.875C9.9375 7.3575 9.5175 6.9375 9 6.9375Z"
                    fill="currentColor" />
                <path
                    d="M9 12.1875C8.6925 12.1875 8.4375 11.9325 8.4375 11.625V9.375C8.4375 9.0675 8.6925 8.8125 9 8.8125C9.3075 8.8125 9.5625 9.0675 9.5625 9.375V11.625C9.5625 11.9325 9.3075 12.1875 9 12.1875Z"
                    fill="currentColor" />
            </svg>
            <div class="flex items-center justify-between w-full">
                <span class="transition-colors">
                    {{__("front.security")}}
                </span>
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33333 9L6 5L1.33333 1" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <button
            class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all whitespace-nowrap"
            data-tab="2fa" data-active="false">
            <svg class="w-[18px] h-[18px] text-[#06AB6B]" viewBox="0 0 18 18" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75V4.875C0.9375 2.7 2.7075 0.9375 4.875 0.9375H6.75C7.0575 0.9375 7.3125 1.1925 7.3125 1.5C7.3125 1.8075 7.0575 2.0625 6.75 2.0625H4.875C3.3225 2.0625 2.0625 3.3225 2.0625 4.875V6.75C2.0625 7.0575 1.8075 7.3125 1.5 7.3125Z"
                    fill="currentColor" />
                <path
                    d="M16.5 7.3125C16.1925 7.3125 15.9375 7.0575 15.9375 6.75V4.875C15.9375 3.3225 14.6775 2.0625 13.125 2.0625H11.25C10.9425 2.0625 10.6875 1.8075 10.6875 1.5C10.6875 1.1925 10.9425 0.9375 11.25 0.9375H13.125C15.2925 0.9375 17.0625 2.7 17.0625 4.875V6.75C17.0625 7.0575 16.8075 7.3125 16.5 7.3125Z"
                    fill="currentColor" />
                <path
                    d="M13.125 17.0625H12C11.6925 17.0625 11.4375 16.8075 11.4375 16.5C11.4375 16.1925 11.6925 15.9375 12 15.9375H13.125C14.6775 15.9375 15.9375 14.6775 15.9375 13.125V12C15.9375 11.6925 16.1925 11.4375 16.5 11.4375C16.8075 11.4375 17.0625 11.6925 17.0625 12V13.125C17.0625 15.3 15.2925 17.0625 13.125 17.0625Z"
                    fill="currentColor" />
                <path
                    d="M6.75 17.0625H4.875C2.7075 17.0625 0.9375 15.3 0.9375 13.125V11.25C0.9375 10.9425 1.1925 10.6875 1.5 10.6875C1.8075 10.6875 2.0625 10.9425 2.0625 11.25V13.125C2.0625 14.6775 3.3225 15.9375 4.875 15.9375H6.75C7.0575 15.9375 7.3125 16.1925 7.3125 16.5C7.3125 16.8075 7.0575 17.0625 6.75 17.0625Z"
                    fill="currentColor" />
                <path
                    d="M10.5 13.6875H7.5C5.685 13.6875 4.6875 12.69 4.6875 10.875V7.125C4.6875 5.31 5.685 4.3125 7.5 4.3125H10.5C12.315 4.3125 13.3125 5.31 13.3125 7.125V10.875C13.3125 12.69 12.315 13.6875 10.5 13.6875ZM7.5 5.4375C6.315 5.4375 5.8125 5.94 5.8125 7.125V10.875C5.8125 12.06 6.315 12.5625 7.5 12.5625H10.5C11.685 12.5625 12.1875 12.06 12.1875 10.875V7.125C12.1875 5.94 11.685 5.4375 10.5 5.4375H7.5Z"
                    fill="currentColor" />
                <path
                    d="M14.25 9.5625H3.75C3.4425 9.5625 3.1875 9.3075 3.1875 9C3.1875 8.6925 3.4425 8.4375 3.75 8.4375H14.25C14.5575 8.4375 14.8125 8.6925 14.8125 9C14.8125 9.3075 14.5575 9.5625 14.25 9.5625Z"
                    fill="currentColor" />
            </svg>
            <div class="flex items-center justify-between w-full">
                <span class="transition-colors">
                    {{__("front.personDoubleAuthLabel")}}
                </span>
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33333 9L6 5L1.33333 1" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </button>
        <button class="tab-btn ml-10 mr-auto text-white/40 text-[16px] hover:text-white/70 mt-20" data-tab="logout">
            {{__("front.log out")}}
        </button>
    </div>
</div>

<section
    class="text-white py-10 relative max-w-[1018px] mx-auto max-[620px]:px-[20px] max-[1024px]:px-[20px] min-[620px]:mt-10">
    <h2 class="text-[#06AB6B] text-[32px] font-bold mb-8 uppercase max-[400px]:hidden">
        {{__("front.client panel")}}
    </h2>
    <div class="flex max-[720px]:block">

        <aside class="w-[30%] min-w-[267px] pr-10 max-[720px]:hidden">
            <ul class="flex flex-col gap-[10px]">
                <li>
                    <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                       data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                       hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="personal"
                        data-active="true">
                        <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                       group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                            viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.08999 10.1475C9.07499 10.1475 9.05249 10.1475 9.03749 10.1475C9.01499 10.1475 8.98499 10.1475 8.96249 10.1475C7.25999 10.095 5.98499 8.76749 5.98499 7.13249C5.98499 5.46749 7.34249 4.10999 9.00749 4.10999C10.6725 4.10999 12.03 5.46749 12.03 7.13249C12.0225 8.77499 10.74 10.095 9.11248 10.1475C9.09749 10.1475 9.09749 10.1475 9.08999 10.1475ZM8.99999 5.22749C7.94999 5.22749 7.10249 6.08249 7.10249 7.12499C7.10249 8.15249 7.90499 8.98499 8.92498 9.02249C8.94748 9.01499 9.02249 9.01499 9.09749 9.02249C10.1025 8.96999 10.89 8.14499 10.8975 7.12499C10.8975 6.08249 10.05 5.22749 8.99999 5.22749Z"
                                fill="currentColor" />
                            <path
                                d="M9 17.0625C6.9825 17.0625 5.055 16.3125 3.5625 14.9475C3.4275 14.8275 3.3675 14.6475 3.3825 14.475C3.48 13.5825 4.035 12.75 4.9575 12.135C7.1925 10.65 10.815 10.65 13.0425 12.135C13.965 12.7575 14.52 13.5825 14.6175 14.475C14.64 14.655 14.5725 14.8275 14.4375 14.9475C12.945 16.3125 11.0175 17.0625 9 17.0625ZM4.56 14.325C5.805 15.3675 7.3725 15.9375 9 15.9375C10.6275 15.9375 12.195 15.3675 13.44 14.325C13.305 13.8675 12.945 13.425 12.4125 13.065C10.5675 11.835 7.44 11.835 5.58 13.065C5.0475 13.425 4.695 13.8675 4.56 14.325Z"
                                fill="currentColor" />
                            <path
                                d="M9 17.0625C4.5525 17.0625 0.9375 13.4475 0.9375 9C0.9375 4.5525 4.5525 0.9375 9 0.9375C13.4475 0.9375 17.0625 4.5525 17.0625 9C17.0625 13.4475 13.4475 17.0625 9 17.0625ZM9 2.0625C5.175 2.0625 2.0625 5.175 2.0625 9C2.0625 12.825 5.175 15.9375 9 15.9375C12.825 15.9375 15.9375 12.825 15.9375 9C15.9375 5.175 12.825 2.0625 9 2.0625Z"
                                fill="currentColor" />
                        </svg>
                        <span class="transition-colors">
                            {{__("front.personInfoLabel")}}
                        </span>
                    </button>
                </li>
                <li>
                    <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="history" data-active="false">
                        <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                       group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                            viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 13.3575H1.5C1.1925 13.3575 0.9375 13.1025 0.9375 12.795C0.9375 12.4875 1.1925 12.2325 1.5 12.2325H9C9.3075 12.2325 9.5625 12.4875 9.5625 12.795C9.5625 13.11 9.3075 13.3575 9 13.3575Z"
                                fill="currentColor" />
                            <path
                                d="M7.33484 17.0625H3.1723C1.5298 17.0625 0.944824 16.485 0.944824 14.85V11.775C0.944824 10.14 1.5298 9.5625 3.1723 9.5625H7.33484C8.97734 9.5625 9.56232 10.14 9.56232 11.775V14.8575C9.56232 16.485 8.97734 17.0625 7.33484 17.0625ZM3.16479 10.6875C2.14479 10.6875 2.06232 10.77 2.06232 11.775V14.8575C2.06232 15.8625 2.14479 15.945 3.16479 15.945H7.32733C8.34733 15.945 8.42981 15.8625 8.42981 14.8575V11.775C8.42981 10.77 8.34733 10.6875 7.32733 10.6875H3.16479Z"
                                fill="currentColor" />
                            <path
                                d="M11.2502 17.0625C11.0477 17.0625 10.8601 16.95 10.7626 16.7775C10.6651 16.5975 10.6651 16.3875 10.7701 16.2075L11.5576 14.895C11.7151 14.6325 12.0602 14.5425 12.3302 14.7C12.6002 14.8575 12.6827 15.2025 12.5252 15.4725L12.3227 15.81C14.3927 15.3225 15.9452 13.4625 15.9452 11.2425C15.9452 10.935 16.2002 10.68 16.5077 10.68C16.8152 10.68 17.0702 10.935 17.0702 11.2425C17.0627 14.4525 14.4527 17.0625 11.2502 17.0625Z"
                                fill="currentColor" />
                            <path
                                d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75C0.9375 3.5475 3.5475 0.9375 6.75 0.9375C6.9525 0.9375 7.14002 1.05 7.23752 1.2225C7.33502 1.4025 7.33501 1.6125 7.23001 1.7925L6.44252 3.105C6.28502 3.3675 5.94 3.4575 5.67 3.3C5.4 3.1425 5.31749 2.7975 5.47499 2.5275L5.67751 2.19C3.60751 2.6775 2.05499 4.5375 2.05499 6.7575C2.06249 7.0575 1.8075 7.3125 1.5 7.3125Z"
                                fill="currentColor" />
                            <path
                                d="M13.875 8.8125C11.7075 8.8125 9.9375 7.05 9.9375 4.875C9.9375 2.7 11.7 0.9375 13.875 0.9375C16.05 0.9375 17.8125 2.7 17.8125 4.875C17.8125 7.05 16.0425 8.8125 13.875 8.8125ZM13.875 2.0625C12.3225 2.0625 11.0625 3.3225 11.0625 4.875C11.0625 6.4275 12.3225 7.6875 13.875 7.6875C15.4275 7.6875 16.6875 6.4275 16.6875 4.875C16.6875 3.3225 15.4275 2.0625 13.875 2.0625Z"
                                fill="currentColor" />
                        </svg>
                        <span class="transition-colors">
                            {{__("front.personOperationHistoryLabel")}}
                        </span>
                    </button>
                </li>
                <li class="relative">
                    <button id="partners-toggle" type="button" class="tab-btn group flex items-center justify-between w-full gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                   hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap">
                        <span class="flex items-center gap-[12px]">
                            <svg id="partners-icon" class="w-[18px] h-[18px] transition-colors text-[#666666]
                       group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                                viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.86968 8.715C6.84718 8.715 6.83218 8.715 6.80968 8.715C6.77218 8.7075 6.71968 8.7075 6.67468 8.715C4.49968 8.6475 2.85718 6.9375 2.85718 4.83C2.85718 2.685 4.60468 0.9375 6.74968 0.9375C8.89468 0.9375 10.6422 2.685 10.6422 4.83C10.6347 6.9375 8.98468 8.6475 6.89218 8.715C6.88468 8.715 6.87718 8.715 6.86968 8.715ZM6.74968 2.0625C5.22718 2.0625 3.98218 3.3075 3.98218 4.83C3.98218 6.33 5.15218 7.5375 6.64468 7.59C6.68968 7.5825 6.78718 7.5825 6.88468 7.59C8.35468 7.5225 9.50968 6.315 9.51718 4.83C9.51718 3.3075 8.27218 2.0625 6.74968 2.0625Z"
                                    fill="currentColor" />
                                <path
                                    d="M12.4047 8.8125C12.3822 8.8125 12.3597 8.8125 12.3372 8.805C12.0297 8.835 11.7147 8.6175 11.6847 8.31C11.6547 8.0025 11.8422 7.725 12.1497 7.6875C12.2397 7.68 12.3372 7.68 12.4197 7.68C13.5147 7.62 14.3697 6.72 14.3697 5.6175C14.3697 4.4775 13.4472 3.555 12.3072 3.555C11.9997 3.5625 11.7447 3.3075 11.7447 3C11.7447 2.6925 11.9997 2.4375 12.3072 2.4375C14.0622 2.4375 15.4947 3.87 15.4947 5.625C15.4947 7.35 14.1447 8.745 12.4272 8.8125C12.4197 8.8125 12.4122 8.8125 12.4047 8.8125Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.87721 16.9125C5.40721 16.9125 3.92971 16.5375 2.81221 15.7875C1.76971 15.0975 1.19971 14.1525 1.19971 13.125C1.19971 12.0975 1.76971 11.145 2.81221 10.4475C5.06221 8.955 8.70721 8.955 10.9422 10.4475C11.9772 11.1375 12.5547 12.0825 12.5547 13.11C12.5547 14.1375 11.9847 15.09 10.9422 15.7875C9.81721 16.5375 8.34721 16.9125 6.87721 16.9125ZM3.43471 11.3925C2.71471 11.8725 2.32471 12.4875 2.32471 13.1325C2.32471 13.77 2.72221 14.385 3.43471 14.8575C5.30221 16.11 8.45221 16.11 10.3197 14.8575C11.0397 14.3775 11.4297 13.7625 11.4297 13.1175C11.4297 12.48 11.0322 11.865 10.3197 11.3925C8.45221 10.1475 5.30221 10.1475 3.43471 11.3925Z"
                                    fill="currentColor" />
                                <path
                                    d="M13.7548 15.5625C13.4923 15.5625 13.2598 15.3825 13.2073 15.1125C13.1473 14.805 13.3423 14.5125 13.6423 14.445C14.1148 14.3475 14.5498 14.16 14.8873 13.8975C15.3148 13.575 15.5473 13.17 15.5473 12.7425C15.5473 12.315 15.3148 11.91 14.8948 11.595C14.5648 11.34 14.1523 11.16 13.6648 11.0475C13.3648 10.98 13.1698 10.68 13.2373 10.3725C13.3048 10.0725 13.6048 9.87751 13.9123 9.94501C14.5573 10.0875 15.1198 10.3425 15.5773 10.695C16.2748 11.22 16.6723 11.9625 16.6723 12.7425C16.6723 13.5225 16.2673 14.265 15.5698 14.7975C15.1048 15.1575 14.5198 15.42 13.8748 15.5475C13.8298 15.5625 13.7923 15.5625 13.7548 15.5625Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="transition-colors">
                                {{__("front.profile affiliate")}}
                            </span>
                        </span>
                        <svg class="w-[12px] h-[12px] transform transition-transform duration-200" id="arrow-icon"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Подменю с data-tab -->
                    <ul id="partners-submenu"
                        class="hidden mt-2 ml-[40px] flex-col gap-2 text-[15px] text-white transition-all">
                        <li>
                            <button
                                class="tab-btn submenu-item py-2 transition-colors hover:opacity-70 data-[active=true]:text-[#06AB6B]"
                                data-tab="companies">
                                {{__("front.affiliate my campaigns")}}
                            </button>
                        </li>
                        <li>
                            <button
                                class="tab-btn submenu-item py-2 transition-colors hover:opacity-70 data-[active=true]:text-[#06AB6B]"
                                data-tab="affiliates">
                                {{__("front.affiliate my exchanges")}}
                            </button>
                        </li>
                        <li>
                            <button
                                class="tab-btn submenu-item py-2 transition-colors hover:opacity-70 data-[active=true]:text-[#06AB6B]"
                                data-tab="balance">
                                {{__("front.affiliate my balance")}}
                            </button>
                        </li>
                    </ul>
                </li>

                <li>
                    <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="security" data-active="false">
                        <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                       group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                            viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.99989 17.0625C8.81989 17.0625 8.63989 17.0401 8.46739 16.9876C4.57489 15.9151 1.75488 12.2775 1.75488 8.33253V5.04002C1.75488 4.20002 2.36239 3.29256 3.14239 2.97006L7.31989 1.26004C8.40739 0.817537 9.59988 0.817537 10.6799 1.26004L14.8574 2.97006C15.6374 3.29256 16.2449 4.20002 16.2449 5.04002V8.33253C16.2449 12.27 13.4174 15.9076 9.53238 16.9876C9.35988 17.0401 9.17989 17.0625 8.99989 17.0625ZM8.99989 2.06254C8.57239 2.06254 8.15238 2.14505 7.74738 2.31005L3.56989 4.02003C3.20989 4.17003 2.87988 4.65753 2.87988 5.04753V8.34004C2.87988 11.7825 5.35489 14.9626 8.76739 15.9076C8.91739 15.9526 9.08238 15.9526 9.23238 15.9076C12.6449 14.9626 15.1199 11.7825 15.1199 8.34004V5.04753C15.1199 4.65753 14.7899 4.17003 14.4299 4.02003L10.2524 2.31005C9.8474 2.14505 9.42739 2.06254 8.99989 2.06254Z"
                                fill="currentColor" />
                            <path
                                d="M9 9.9375C7.86 9.9375 6.9375 9.015 6.9375 7.875C6.9375 6.735 7.86 5.8125 9 5.8125C10.14 5.8125 11.0625 6.735 11.0625 7.875C11.0625 9.015 10.14 9.9375 9 9.9375ZM9 6.9375C8.4825 6.9375 8.0625 7.3575 8.0625 7.875C8.0625 8.3925 8.4825 8.8125 9 8.8125C9.5175 8.8125 9.9375 8.3925 9.9375 7.875C9.9375 7.3575 9.5175 6.9375 9 6.9375Z"
                                fill="currentColor" />
                            <path
                                d="M9 12.1875C8.6925 12.1875 8.4375 11.9325 8.4375 11.625V9.375C8.4375 9.0675 8.6925 8.8125 9 8.8125C9.3075 8.8125 9.5625 9.0675 9.5625 9.375V11.625C9.5625 11.9325 9.3075 12.1875 9 12.1875Z"
                                fill="currentColor" />
                        </svg>
                        <span class="transition-colors">
                            {{__("front.security")}}
                        </span>
                    </button>
                </li>
                <li>
                    <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="2fa" data-active="false">
                        <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                       group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                            viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75V4.875C0.9375 2.7 2.7075 0.9375 4.875 0.9375H6.75C7.0575 0.9375 7.3125 1.1925 7.3125 1.5C7.3125 1.8075 7.0575 2.0625 6.75 2.0625H4.875C3.3225 2.0625 2.0625 3.3225 2.0625 4.875V6.75C2.0625 7.0575 1.8075 7.3125 1.5 7.3125Z"
                                fill="currentColor" />
                            <path
                                d="M16.5 7.3125C16.1925 7.3125 15.9375 7.0575 15.9375 6.75V4.875C15.9375 3.3225 14.6775 2.0625 13.125 2.0625H11.25C10.9425 2.0625 10.6875 1.8075 10.6875 1.5C10.6875 1.1925 10.9425 0.9375 11.25 0.9375H13.125C15.2925 0.9375 17.0625 2.7 17.0625 4.875V6.75C17.0625 7.0575 16.8075 7.3125 16.5 7.3125Z"
                                fill="currentColor" />
                            <path
                                d="M13.125 17.0625H12C11.6925 17.0625 11.4375 16.8075 11.4375 16.5C11.4375 16.1925 11.6925 15.9375 12 15.9375H13.125C14.6775 15.9375 15.9375 14.6775 15.9375 13.125V12C15.9375 11.6925 16.1925 11.4375 16.5 11.4375C16.8075 11.4375 17.0625 11.6925 17.0625 12V13.125C17.0625 15.3 15.2925 17.0625 13.125 17.0625Z"
                                fill="currentColor" />
                            <path
                                d="M6.75 17.0625H4.875C2.7075 17.0625 0.9375 15.3 0.9375 13.125V11.25C0.9375 10.9425 1.1925 10.6875 1.5 10.6875C1.8075 10.6875 2.0625 10.9425 2.0625 11.25V13.125C2.0625 14.6775 3.3225 15.9375 4.875 15.9375H6.75C7.0575 15.9375 7.3125 16.1925 7.3125 16.5C7.3125 16.8075 7.0575 17.0625 6.75 17.0625Z"
                                fill="currentColor" />
                            <path
                                d="M10.5 13.6875H7.5C5.685 13.6875 4.6875 12.69 4.6875 10.875V7.125C4.6875 5.31 5.685 4.3125 7.5 4.3125H10.5C12.315 4.3125 13.3125 5.31 13.3125 7.125V10.875C13.3125 12.69 12.315 13.6875 10.5 13.6875ZM7.5 5.4375C6.315 5.4375 5.8125 5.94 5.8125 7.125V10.875C5.8125 12.06 6.315 12.5625 7.5 12.5625H10.5C11.685 12.5625 12.1875 12.06 12.1875 10.875V7.125C12.1875 5.94 11.685 5.4375 10.5 5.4375H7.5Z"
                                fill="currentColor" />
                            <path
                                d="M14.25 9.5625H3.75C3.4425 9.5625 3.1875 9.3075 3.1875 9C3.1875 8.6925 3.4425 8.4375 3.75 8.4375H14.25C14.5575 8.4375 14.8125 8.6925 14.8125 9C14.8125 9.3075 14.5575 9.5625 14.25 9.5625Z"
                                fill="currentColor" />
                        </svg>
                        <span class="transition-colors">
                            {{__("front.personDoubleAuthLabel")}}
                        </span>
                    </button>
                </li>
                <li>
                    <button class="tab-btn text-white/40 text-[16px] hover:text-white/70 pl-10"
                        data-tab="logout">
                        {{__("front.log out")}}
                    </button>
                </li>
            </ul>
        </aside>

        <div id="tabs-wrapper"
            class="hidden max-[720px]:flex max-[500px]:hidden overflow-x-auto scrollbar-none cursor-grab active:cursor-grabbing select-none space-x-4 mb-6 pb-2">
            <div id="default-tabs" class="flex">
                <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                   data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                   hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="personal" data-active="true">
                    <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                   group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                        viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.08999 10.1475C9.07499 10.1475 9.05249 10.1475 9.03749 10.1475C9.01499 10.1475 8.98499 10.1475 8.96249 10.1475C7.25999 10.095 5.98499 8.76749 5.98499 7.13249C5.98499 5.46749 7.34249 4.10999 9.00749 4.10999C10.6725 4.10999 12.03 5.46749 12.03 7.13249C12.0225 8.77499 10.74 10.095 9.11248 10.1475C9.09749 10.1475 9.09749 10.1475 9.08999 10.1475ZM8.99999 5.22749C7.94999 5.22749 7.10249 6.08249 7.10249 7.12499C7.10249 8.15249 7.90499 8.98499 8.92498 9.02249C8.94748 9.01499 9.02249 9.01499 9.09749 9.02249C10.1025 8.96999 10.89 8.14499 10.8975 7.12499C10.8975 6.08249 10.05 5.22749 8.99999 5.22749Z"
                            fill="currentColor" />
                        <path
                            d="M9 17.0625C6.9825 17.0625 5.055 16.3125 3.5625 14.9475C3.4275 14.8275 3.3675 14.6475 3.3825 14.475C3.48 13.5825 4.035 12.75 4.9575 12.135C7.1925 10.65 10.815 10.65 13.0425 12.135C13.965 12.7575 14.52 13.5825 14.6175 14.475C14.64 14.655 14.5725 14.8275 14.4375 14.9475C12.945 16.3125 11.0175 17.0625 9 17.0625ZM4.56 14.325C5.805 15.3675 7.3725 15.9375 9 15.9375C10.6275 15.9375 12.195 15.3675 13.44 14.325C13.305 13.8675 12.945 13.425 12.4125 13.065C10.5675 11.835 7.44 11.835 5.58 13.065C5.0475 13.425 4.695 13.8675 4.56 14.325Z"
                            fill="currentColor" />
                        <path
                            d="M9 17.0625C4.5525 17.0625 0.9375 13.4475 0.9375 9C0.9375 4.5525 4.5525 0.9375 9 0.9375C13.4475 0.9375 17.0625 4.5525 17.0625 9C17.0625 13.4475 13.4475 17.0625 9 17.0625ZM9 2.0625C5.175 2.0625 2.0625 5.175 2.0625 9C2.0625 12.825 5.175 15.9375 9 15.9375C12.825 15.9375 15.9375 12.825 15.9375 9C15.9375 5.175 12.825 2.0625 9 2.0625Z"
                            fill="currentColor" />
                    </svg>
                    <span class="transition-colors">
                        {{__("front.personInfoLabel")}}
                    </span>
                </button>
                <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                 data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                 hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="history" data-active="false">
                    <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                   group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                        viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 13.3575H1.5C1.1925 13.3575 0.9375 13.1025 0.9375 12.795C0.9375 12.4875 1.1925 12.2325 1.5 12.2325H9C9.3075 12.2325 9.5625 12.4875 9.5625 12.795C9.5625 13.11 9.3075 13.3575 9 13.3575Z"
                            fill="currentColor" />
                        <path
                            d="M7.33484 17.0625H3.1723C1.5298 17.0625 0.944824 16.485 0.944824 14.85V11.775C0.944824 10.14 1.5298 9.5625 3.1723 9.5625H7.33484C8.97734 9.5625 9.56232 10.14 9.56232 11.775V14.8575C9.56232 16.485 8.97734 17.0625 7.33484 17.0625ZM3.16479 10.6875C2.14479 10.6875 2.06232 10.77 2.06232 11.775V14.8575C2.06232 15.8625 2.14479 15.945 3.16479 15.945H7.32733C8.34733 15.945 8.42981 15.8625 8.42981 14.8575V11.775C8.42981 10.77 8.34733 10.6875 7.32733 10.6875H3.16479Z"
                            fill="currentColor" />
                        <path
                            d="M11.2502 17.0625C11.0477 17.0625 10.8601 16.95 10.7626 16.7775C10.6651 16.5975 10.6651 16.3875 10.7701 16.2075L11.5576 14.895C11.7151 14.6325 12.0602 14.5425 12.3302 14.7C12.6002 14.8575 12.6827 15.2025 12.5252 15.4725L12.3227 15.81C14.3927 15.3225 15.9452 13.4625 15.9452 11.2425C15.9452 10.935 16.2002 10.68 16.5077 10.68C16.8152 10.68 17.0702 10.935 17.0702 11.2425C17.0627 14.4525 14.4527 17.0625 11.2502 17.0625Z"
                            fill="currentColor" />
                        <path
                            d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75C0.9375 3.5475 3.5475 0.9375 6.75 0.9375C6.9525 0.9375 7.14002 1.05 7.23752 1.2225C7.33502 1.4025 7.33501 1.6125 7.23001 1.7925L6.44252 3.105C6.28502 3.3675 5.94 3.4575 5.67 3.3C5.4 3.1425 5.31749 2.7975 5.47499 2.5275L5.67751 2.19C3.60751 2.6775 2.05499 4.5375 2.05499 6.7575C2.06249 7.0575 1.8075 7.3125 1.5 7.3125Z"
                            fill="currentColor" />
                        <path
                            d="M13.875 8.8125C11.7075 8.8125 9.9375 7.05 9.9375 4.875C9.9375 2.7 11.7 0.9375 13.875 0.9375C16.05 0.9375 17.8125 2.7 17.8125 4.875C17.8125 7.05 16.0425 8.8125 13.875 8.8125ZM13.875 2.0625C12.3225 2.0625 11.0625 3.3225 11.0625 4.875C11.0625 6.4275 12.3225 7.6875 13.875 7.6875C15.4275 7.6875 16.6875 6.4275 16.6875 4.875C16.6875 3.3225 15.4275 2.0625 13.875 2.0625Z"
                            fill="currentColor" />
                    </svg>
                    <span class="transition-colors">
                        {{__("front.personOperationHistoryLabel")}}
                    </span>
                </button>
                <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                 data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                 hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="partners" data-active="false"
                    id="partners-toggle-mobile">
                    <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                   group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                        viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.86968 8.715C6.84718 8.715 6.83218 8.715 6.80968 8.715C6.77218 8.7075 6.71968 8.7075 6.67468 8.715C4.49968 8.6475 2.85718 6.9375 2.85718 4.83C2.85718 2.685 4.60468 0.9375 6.74968 0.9375C8.89468 0.9375 10.6422 2.685 10.6422 4.83C10.6347 6.9375 8.98468 8.6475 6.89218 8.715C6.88468 8.715 6.87718 8.715 6.86968 8.715ZM6.74968 2.0625C5.22718 2.0625 3.98218 3.3075 3.98218 4.83C3.98218 6.33 5.15218 7.5375 6.64468 7.59C6.68968 7.5825 6.78718 7.5825 6.88468 7.59C8.35468 7.5225 9.50968 6.315 9.51718 4.83C9.51718 3.3075 8.27218 2.0625 6.74968 2.0625Z"
                            fill="currentColor" />
                        <path
                            d="M12.4047 8.8125C12.3822 8.8125 12.3597 8.8125 12.3372 8.805C12.0297 8.835 11.7147 8.6175 11.6847 8.31C11.6547 8.0025 11.8422 7.725 12.1497 7.6875C12.2397 7.68 12.3372 7.68 12.4197 7.68C13.5147 7.62 14.3697 6.72 14.3697 5.6175C14.3697 4.4775 13.4472 3.555 12.3072 3.555C11.9997 3.5625 11.7447 3.3075 11.7447 3C11.7447 2.6925 11.9997 2.4375 12.3072 2.4375C14.0622 2.4375 15.4947 3.87 15.4947 5.625C15.4947 7.35 14.1447 8.745 12.4272 8.8125C12.4197 8.8125 12.4122 8.8125 12.4047 8.8125Z"
                            fill="currentColor" />
                        <path
                            d="M6.87721 16.9125C5.40721 16.9125 3.92971 16.5375 2.81221 15.7875C1.76971 15.0975 1.19971 14.1525 1.19971 13.125C1.19971 12.0975 1.76971 11.145 2.81221 10.4475C5.06221 8.955 8.70721 8.955 10.9422 10.4475C11.9772 11.1375 12.5547 12.0825 12.5547 13.11C12.5547 14.1375 11.9847 15.09 10.9422 15.7875C9.81721 16.5375 8.34721 16.9125 6.87721 16.9125ZM3.43471 11.3925C2.71471 11.8725 2.32471 12.4875 2.32471 13.1325C2.32471 13.77 2.72221 14.385 3.43471 14.8575C5.30221 16.11 8.45221 16.11 10.3197 14.8575C11.0397 14.3775 11.4297 13.7625 11.4297 13.1175C11.4297 12.48 11.0322 11.865 10.3197 11.3925C8.45221 10.1475 5.30221 10.1475 3.43471 11.3925Z"
                            fill="currentColor" />
                        <path
                            d="M13.7548 15.5625C13.4923 15.5625 13.2598 15.3825 13.2073 15.1125C13.1473 14.805 13.3423 14.5125 13.6423 14.445C14.1148 14.3475 14.5498 14.16 14.8873 13.8975C15.3148 13.575 15.5473 13.17 15.5473 12.7425C15.5473 12.315 15.3148 11.91 14.8948 11.595C14.5648 11.34 14.1523 11.16 13.6648 11.0475C13.3648 10.98 13.1698 10.68 13.2373 10.3725C13.3048 10.0725 13.6048 9.87751 13.9123 9.94501C14.5573 10.0875 15.1198 10.3425 15.5773 10.695C16.2748 11.22 16.6723 11.9625 16.6723 12.7425C16.6723 13.5225 16.2673 14.265 15.5698 14.7975C15.1048 15.1575 14.5198 15.42 13.8748 15.5475C13.8298 15.5625 13.7923 15.5625 13.7548 15.5625Z"
                            fill="currentColor" />
                    </svg>
                    <span class="transition-colors">
                        {{__("front.profile affiliate")}}
                    </span>
                </button>
                <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                 data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                 hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="security" data-active="false">
                    <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                   group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                        viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.99989 17.0625C8.81989 17.0625 8.63989 17.0401 8.46739 16.9876C4.57489 15.9151 1.75488 12.2775 1.75488 8.33253V5.04002C1.75488 4.20002 2.36239 3.29256 3.14239 2.97006L7.31989 1.26004C8.40739 0.817537 9.59988 0.817537 10.6799 1.26004L14.8574 2.97006C15.6374 3.29256 16.2449 4.20002 16.2449 5.04002V8.33253C16.2449 12.27 13.4174 15.9076 9.53238 16.9876C9.35988 17.0401 9.17989 17.0625 8.99989 17.0625ZM8.99989 2.06254C8.57239 2.06254 8.15238 2.14505 7.74738 2.31005L3.56989 4.02003C3.20989 4.17003 2.87988 4.65753 2.87988 5.04753V8.34004C2.87988 11.7825 5.35489 14.9626 8.76739 15.9076C8.91739 15.9526 9.08238 15.9526 9.23238 15.9076C12.6449 14.9626 15.1199 11.7825 15.1199 8.34004V5.04753C15.1199 4.65753 14.7899 4.17003 14.4299 4.02003L10.2524 2.31005C9.8474 2.14505 9.42739 2.06254 8.99989 2.06254Z"
                            fill="currentColor" />
                        <path
                            d="M9 9.9375C7.86 9.9375 6.9375 9.015 6.9375 7.875C6.9375 6.735 7.86 5.8125 9 5.8125C10.14 5.8125 11.0625 6.735 11.0625 7.875C11.0625 9.015 10.14 9.9375 9 9.9375ZM9 6.9375C8.4825 6.9375 8.0625 7.3575 8.0625 7.875C8.0625 8.3925 8.4825 8.8125 9 8.8125C9.5175 8.8125 9.9375 8.3925 9.9375 7.875C9.9375 7.3575 9.5175 6.9375 9 6.9375Z"
                            fill="currentColor" />
                        <path
                            d="M9 12.1875C8.6925 12.1875 8.4375 11.9325 8.4375 11.625V9.375C8.4375 9.0675 8.6925 8.8125 9 8.8125C9.3075 8.8125 9.5625 9.0675 9.5625 9.375V11.625C9.5625 11.9325 9.3075 12.1875 9 12.1875Z"
                            fill="currentColor" />
                    </svg>
                    <span class="transition-colors">
                        {{__("front.security")}}
                    </span>
                </button>
                <button class="tab-btn group flex items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                 data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                 hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="2fa" data-active="false">
                    <svg class="w-[18px] h-[18px] transition-colors text-[#666666]
                   group-data-[active=true]:text-white group-hover:text-white duration-200 group-hover:scale-110"
                        viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.5 7.3125C1.1925 7.3125 0.9375 7.0575 0.9375 6.75V4.875C0.9375 2.7 2.7075 0.9375 4.875 0.9375H6.75C7.0575 0.9375 7.3125 1.1925 7.3125 1.5C7.3125 1.8075 7.0575 2.0625 6.75 2.0625H4.875C3.3225 2.0625 2.0625 3.3225 2.0625 4.875V6.75C2.0625 7.0575 1.8075 7.3125 1.5 7.3125Z"
                            fill="currentColor" />
                        <path
                            d="M16.5 7.3125C16.1925 7.3125 15.9375 7.0575 15.9375 6.75V4.875C15.9375 3.3225 14.6775 2.0625 13.125 2.0625H11.25C10.9425 2.0625 10.6875 1.8075 10.6875 1.5C10.6875 1.1925 10.9425 0.9375 11.25 0.9375H13.125C15.2925 0.9375 17.0625 2.7 17.0625 4.875V6.75C17.0625 7.0575 16.8075 7.3125 16.5 7.3125Z"
                            fill="currentColor" />
                        <path
                            d="M13.125 17.0625H12C11.6925 17.0625 11.4375 16.8075 11.4375 16.5C11.4375 16.1925 11.6925 15.9375 12 15.9375H13.125C14.6775 15.9375 15.9375 14.6775 15.9375 13.125V12C15.9375 11.6925 16.1925 11.4375 16.5 11.4375C16.8075 11.4375 17.0625 11.6925 17.0625 12V13.125C17.0625 15.3 15.2925 17.0625 13.125 17.0625Z"
                            fill="currentColor" />
                        <path
                            d="M6.75 17.0625H4.875C2.7075 17.0625 0.9375 15.3 0.9375 13.125V11.25C0.9375 10.9425 1.1925 10.6875 1.5 10.6875C1.8075 10.6875 2.0625 10.9425 2.0625 11.25V13.125C2.0625 14.6775 3.3225 15.9375 4.875 15.9375H6.75C7.0575 15.9375 7.3125 16.1925 7.3125 16.5C7.3125 16.8075 7.0575 17.0625 6.75 17.0625Z"
                            fill="currentColor" />
                        <path
                            d="M10.5 13.6875H7.5C5.685 13.6875 4.6875 12.69 4.6875 10.875V7.125C4.6875 5.31 5.685 4.3125 7.5 4.3125H10.5C12.315 4.3125 13.3125 5.31 13.3125 7.125V10.875C13.3125 12.69 12.315 13.6875 10.5 13.6875ZM7.5 5.4375C6.315 5.4375 5.8125 5.94 5.8125 7.125V10.875C5.8125 12.06 6.315 12.5625 7.5 12.5625H10.5C11.685 12.5625 12.1875 12.06 12.1875 10.875V7.125C12.1875 5.94 11.685 5.4375 10.5 5.4375H7.5Z"
                            fill="currentColor" />
                        <path
                            d="M14.25 9.5625H3.75C3.4425 9.5625 3.1875 9.3075 3.1875 9C3.1875 8.6925 3.4425 8.4375 3.75 8.4375H14.25C14.5575 8.4375 14.8125 8.6925 14.8125 9C14.8125 9.3075 14.5575 9.5625 14.25 9.5625Z"
                            fill="currentColor" />
                    </svg>
                    <span class="transition-colors">
                        {{__("front.personDoubleAuthLabel")}}
                    </span>
                </button>
                <button class="tab-btn text-white/40 text-[16px] hover:text-white/70 pl-10" data-tab="logout">
                    {{__("front.log out")}}
                </button>
            </div>
            <div id="partner-tabs" class="hidden flex">
                <button
                    class="back-to-main-tabs tab-btn flex gap-[8px] flex-shrink-0 text-white text-[16px] px-[12px] py-[8px] bg-[#1e1e1e] rounded hover:bg-[#2a2a2a] whitespace-nowrap">
                    <svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.66667 8L3 12L7.66666 16" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    {{__("front.back")}}
                </button>

                <button class="tab-btn submenu-item group flex-shrink-0 items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="companies">

                    {{__("front.affiliate my campaigns")}}
                </button>

                <button class="tab-btn submenu-item group flex-shrink-0 items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="affiliates">

                    {{__("front.affiliate my exchanges")}}
                </button>

                <button class="tab-btn submenu-item group flex-shrink-0 items-center gap-[12px] py-[8px] px-[12px] text-[16px] text-white transition-all
                     data-[active=true]:bg-[#26A17B] data-[active=true]:rounded-[100px]
                     hover:bg-white/5 hover:rounded-[100px] whitespace-nowrap" data-tab="balance">

                    {{__("front.affiliate my balance")}}
                </button>
            </div>
        </div>

        <div class="flex-1">

            <div id="tab-personal" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">
                        {{__("front.personInfoLabel")}}
                    </span>
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
                        {{__("front.personInfoLabel")}}
                    </p>
                </div>
                <form class="flex flex-col gap-[14px]">
                    <div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
                        <div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1">
                            <input type="text" placeholder="Ваше имя"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                            <input type="text" placeholder="Ваше отчество"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <input type="text" placeholder="Ваша фамилия"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        <input type="email" placeholder="E-mail"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        <div class="grid grid-cols-2 gap-4 max-[620px]:grid-cols-1">
                            <input type="text" placeholder="Номер телефона"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                            <input type="text" placeholder="Telegram"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <input type="text" placeholder="Паспорт"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                    </div>

                    <div class="flex justify-center mt-2">
                        <button type="submit"
                            class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
                            style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
                            {{__("front.save")}}
                        </button>
                    </div>
                </form>
            </div>
            <div id="tab-security" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span
                        class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">
                        {{__("front.security")}}
                    </span>
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
                        {{__("front.security")}}
                    </p>
                </div>
                <form class="flex flex-col gap-[14px]">
                    <div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
                        <input type="text" placeholder="Ваш пароль"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        <input type="text" placeholder="Введите новй пароль"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        <input type="text" placeholder="Повторите новый пароль"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                    </div>

                    <div class="flex justify-center mt-2">
                        <button type="submit"
                            class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
                            style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
                            {{__("front.save")}}
                        </button>
                    </div>
                </form>
            </div>
            <div id="tab-2fa" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">
                        {{__("front.personDoubleAuthLabel")}}
                    </span>
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
                        {{__("front.personDoubleAuthLabel")}}
                    </p>
                </div>
                <form class="flex flex-col gap-[14px]">
                    <div
                        class="grid max-[900px]:grid-cols-[50%_50%] grid-cols-[60%_40%] max-[500px]:grid-cols-1 p-[24px] rounded-[20px] bg-white/5 items-center">
                        <p class="mb-2 text-[16px] min-[500px]:hidden">QR-код для подключения двойной аутентификации</p>
                        <div class="w-full max-[500px]:order-2 max-[500px]:mt-2 max-[500px]:self-stretch">
                            <p class="mb-2 text-[16px] max-[500px]:hidden">
                                QR-код для подключения двойной аутентификации
                            </p>
                            <input type="text" placeholder="Одноразовый пароль"
                                class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded focus:border-[#06AB6B] outline-none">
                        </div>
                        <div class="max-[500px]:justify-self-center justify-self-end">
                            <svg class="w-full max-w-[196px] h-auto" width="196" height="196" viewBox="0 0 196 196" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="196" height="195.992" rx="10" fill="white" />
                                <path
                                    d="M14.0185 14.0113C27.3417 13.9924 40.6611 14.0113 53.9805 14.0038C54.0145 27.3307 53.9881 40.6615 53.9956 53.9885C40.6686 53.9771 27.3379 54.0074 14.0109 53.9734C14.0185 40.6539 13.9996 27.3345 14.0185 14.0113ZM19.5374 19.5302C19.5525 29.2308 19.5109 38.9352 19.56 48.6358C29.2493 48.6207 38.9385 48.6433 48.6278 48.6207C48.6505 38.9314 48.6278 29.2422 48.6429 19.5529C38.9423 19.5038 29.238 19.5453 19.5374 19.5302Z"
                                    fill="black" />
                                <path
                                    d="M71.682 25.6044C71.6593 21.7363 71.648 17.8681 71.6858 14C73.6992 14.0113 75.7126 13.9962 77.726 14.0113C77.7411 17.8719 77.7373 21.7325 77.7298 25.5969C75.7126 25.6082 73.6954 25.5969 71.682 25.6044Z"
                                    fill="black" />
                                <path
                                    d="M83.1088 14.0038C90.7733 14.0038 98.4416 14.0076 106.11 14.0038C106.136 15.8472 106.106 17.6906 106.14 19.534C108.15 19.5302 110.159 19.5302 112.173 19.534C112.211 17.6906 112.18 15.8472 112.203 14.0038C119.871 14.0038 127.54 14.0076 135.208 14.0038C135.242 27.3308 135.212 40.6615 135.223 53.9885C133.436 53.9885 131.649 53.9885 129.863 53.9885C129.863 46.3164 129.859 38.6443 129.863 30.9723C127.838 30.9534 125.813 30.9647 123.789 30.9609C123.789 29.1779 123.789 27.395 123.792 25.6158C117.903 25.5893 112.014 25.6082 106.125 25.6044C106.121 29.4121 106.125 33.2199 106.121 37.0313C108.146 37.0313 110.167 37.0313 112.192 37.0313C112.192 38.8748 112.199 40.7182 112.184 42.5616C108.388 42.5616 104.595 42.554 100.799 42.5654C100.735 40.7257 100.776 38.8823 100.761 37.0427C98.7362 37.02 96.7153 37.0351 94.6905 37.0313C94.6905 35.0066 94.6905 32.9857 94.6905 30.9609C96.7153 30.9534 98.74 30.976 100.765 30.942C100.761 29.1704 100.761 27.395 100.769 25.6233C98.74 25.5818 96.7153 25.6082 94.6905 25.6007C94.6905 27.3874 94.6905 29.1704 94.6905 30.9534C92.8509 30.9685 91.0075 30.9571 89.1641 30.9685C89.1641 32.9894 89.1641 35.0104 89.1641 37.0313C87.1431 37.0313 85.1184 37.0313 83.0937 37.0313C83.0937 33.2199 83.0937 29.4121 83.0937 25.6044C85.1146 25.6044 87.1318 25.6007 89.1527 25.6044C89.1754 23.5797 89.1603 21.555 89.1641 19.5302C87.1469 19.534 85.1297 19.5302 83.1125 19.534C83.0823 17.6906 83.0861 15.8472 83.1088 14.0038ZM123.789 19.5302C123.792 21.555 123.785 23.5797 123.8 25.6044C125.817 25.5969 127.838 25.612 129.855 25.5931C129.866 23.5797 129.855 21.5625 129.866 19.5491C127.842 19.5151 125.813 19.5378 123.789 19.5302Z"
                                    fill="black" />
                                <path
                                    d="M141.301 14.0076C154.862 14.0076 168.42 13.9962 181.981 14.0113C182 27.3345 181.981 40.6539 181.989 53.9734C168.424 54.0036 154.855 53.9847 141.29 53.9847C141.301 40.6577 141.275 27.3345 141.301 14.0076ZM146.816 19.5302C146.82 22.1405 146.816 24.747 146.82 27.3534C146.816 28.8644 146.816 30.3754 146.82 31.8864C146.813 34.7762 146.82 37.666 146.816 40.5595C146.82 41.5719 146.813 42.588 146.82 43.6004C146.813 44.3559 146.824 45.1152 146.816 45.8706C146.813 46.7924 146.824 47.7141 146.847 48.6358C156.457 48.632 166.066 48.6169 175.676 48.6433L175.605 48.3071L175.933 48.3525C175.899 38.7576 175.922 29.1591 175.922 19.5642C166.221 19.4887 156.517 19.5529 146.816 19.5302Z"
                                    fill="black" />
                                <path
                                    d="M60.066 19.5378C61.8528 19.5265 63.6395 19.534 65.4263 19.5302C65.4603 21.2754 65.3016 23.032 65.5887 24.7583C65.5169 24.9736 65.3734 25.4005 65.3016 25.6158C63.5602 25.5893 61.8188 25.6044 60.0736 25.6007C60.0584 23.5797 60.0698 21.5588 60.066 19.5378Z"
                                    fill="black" />
                                <path
                                    d="M25.6079 25.6007C31.2628 25.6233 36.9177 25.5629 42.5688 25.6347C42.5688 31.1876 42.5537 36.7367 42.5802 42.2896L42.2364 42.2254L42.2969 42.5729C36.7439 42.5465 31.191 42.5616 25.6419 42.5653C25.5701 36.9104 25.6306 31.2556 25.6079 25.6007Z"
                                    fill="black" />
                                <path
                                    d="M152.887 25.6006C158.485 25.6044 164.083 25.6044 169.678 25.6006C169.655 31.2555 169.727 36.9104 169.64 42.5653C164.068 42.554 158.496 42.5578 152.924 42.5653C152.841 36.9104 152.913 31.2555 152.887 25.6006Z"
                                    fill="black" />
                                <path
                                    d="M60.0663 30.9647C65.9554 30.9609 71.8483 30.9496 77.7374 30.9722C77.7374 32.9856 77.7336 35.0028 77.7374 37.0162C75.7164 37.0427 73.6992 37.0313 71.6783 37.0275C71.633 40.4839 71.7085 43.9441 71.6443 47.4005C71.5725 47.6952 71.4327 48.2845 71.361 48.5791C73.4877 48.632 75.6144 48.6358 77.7374 48.6358C77.7336 50.4225 77.7374 52.2055 77.7374 53.9885C79.5203 53.9885 81.3071 53.9885 83.0938 53.9885C83.0901 57.8528 83.1127 61.7134 83.0825 65.5778C82.701 65.5853 81.9379 65.6005 81.5564 65.608L81.5866 65.4078C80.7669 65.4154 79.9434 65.4191 79.1237 65.3965C78.7913 65.4116 78.1264 65.4418 77.794 65.4569C77.6505 69.5404 77.7865 73.6352 77.7298 77.7224C75.7126 77.7337 73.6955 77.7224 71.6821 77.73C71.6594 73.6238 71.6443 69.5177 71.6896 65.4154C73.0306 65.4229 74.3754 65.4191 75.7202 65.4154C76.3964 65.4154 77.0725 65.4154 77.7525 65.4154C77.7223 63.6324 77.7411 61.8494 77.7336 60.0702C75.7126 60.0513 73.6917 60.0627 71.6707 60.0589C71.6632 61.8381 71.6632 63.6173 71.6707 65.4002C70.1673 65.4267 68.6487 65.3398 67.1642 65.6269L67.2926 65.3965C67.0169 65.4002 66.4653 65.4078 66.1934 65.4116C65.9969 65.5022 65.6116 65.6798 65.419 65.7704C65.4228 66.5599 65.4265 67.3532 65.4265 68.1427C65.4303 69.7217 65.3359 71.3158 65.6456 72.8797L65.4077 72.8457C65.4303 73.7976 65.4228 74.7533 65.4265 75.7052C65.4152 77.7186 65.4492 79.732 65.4039 81.7454C65.419 82.0703 65.4568 82.7162 65.4719 83.0411C69.5591 83.1582 73.6501 83.0411 77.7374 83.0978C77.7374 85.1112 77.7336 87.1283 77.7374 89.1455C73.6275 89.1644 69.5176 89.1682 65.4039 89.1417C65.419 88.4429 65.4303 87.7478 65.4416 87.0528C65.4228 85.7269 65.419 84.401 65.4341 83.0751C63.6436 83.0978 61.8568 83.0864 60.0663 83.0827C60.0663 79.2749 60.0663 75.4672 60.0663 71.6558C58.0416 71.4707 55.8544 72.0751 53.943 71.2893C54.0148 69.4006 54.0374 67.5081 53.9619 65.6193C52.9684 65.1925 51.8276 65.506 50.7737 65.4267C50.0597 65.4191 49.3458 65.4191 48.6318 65.4078C48.6432 63.6248 48.6318 61.8419 48.6432 60.0589C54.2376 60.0627 59.8321 60.0589 65.4265 60.0589C65.4265 58.597 65.4303 57.1389 65.4152 55.677C65.4228 55.1066 65.4303 54.5362 65.4454 53.9658C63.6511 54.0073 61.8606 53.9847 60.0663 53.9847C60.0663 50.177 60.0701 46.3693 60.0663 42.5653C61.8379 42.5578 63.6133 42.554 65.3888 42.5653C65.453 40.7182 65.4265 38.8747 65.4114 37.0275C63.6285 37.0313 61.8493 37.0313 60.0663 37.0275C60.0663 35.0066 60.0663 32.9856 60.0663 30.9647ZM65.4265 48.666C65.4265 49.5008 65.4265 50.3356 65.4039 51.1705C65.4719 51.6502 65.5399 52.1299 65.6154 52.6135C65.6003 52.961 65.5776 53.656 65.5663 54.0073C67.5986 53.9658 69.6347 54.0111 71.6669 53.9696C71.6745 52.2546 71.6292 50.5434 71.7085 48.8322C69.6384 48.4544 67.5193 48.6698 65.4265 48.666Z"
                                    fill="black" />
                                <path
                                    d="M112.192 30.9609C113.93 30.9571 115.668 30.9722 117.402 30.9458C117.481 31.0591 117.636 31.282 117.715 31.3915C117.405 33.2538 117.609 35.1426 117.549 37.02C119.521 37.0389 121.489 37.0389 123.461 37.0162C123.548 37.122 123.718 37.326 123.804 37.4317C123.793 46.8264 123.759 56.2247 123.823 65.6193C121.761 65.4607 119.6 65.1094 117.591 65.7327C117.489 67.7083 117.587 69.6915 117.541 71.6709C115.766 71.6444 113.987 71.6595 112.211 71.6595C112.2 67.9387 112.143 64.2141 112.242 60.4971C111.819 60.2893 111.411 59.9456 110.904 60.0589C109.31 60.04 107.716 60.0702 106.122 60.0589C106.122 56.2512 106.122 52.4397 106.122 48.632C108.143 48.6282 110.168 48.6282 112.189 48.632C112.196 46.6073 112.192 44.5825 112.192 42.5616C113.964 42.5616 115.74 42.554 117.515 42.5653C117.583 40.7219 117.549 38.8747 117.545 37.0276C115.758 37.0313 113.975 37.0313 112.192 37.0313C112.192 35.0066 112.192 32.9856 112.192 30.9609ZM112.192 48.632C112.23 52.5266 112.113 56.4249 112.276 60.3158C113.968 59.7869 115.8 60.1722 117.557 60.0589C117.553 59.0314 117.557 58.0039 117.534 56.9765L117.738 57.0029C117.738 56.7196 117.738 56.1567 117.738 55.8772L117.534 55.8999C117.575 53.4747 117.541 51.0534 117.553 48.6282C115.766 48.632 113.979 48.6282 112.192 48.632Z"
                                    fill="black" />
                                <path
                                    d="M77.7334 42.5578C81.5449 42.5616 85.3564 42.5616 89.1641 42.5578C89.1641 46.3693 89.1641 50.1808 89.1641 53.9885C87.1393 53.9885 85.1184 53.9885 83.0936 53.9885C83.0936 52.2017 83.0936 50.415 83.0936 48.6282C81.3107 48.632 79.5277 48.6282 77.7447 48.632C77.7296 46.6073 77.7372 44.5825 77.7334 42.5578Z"
                                    fill="black" />
                                <path
                                    d="M94.6914 48.6282C96.7161 48.6358 98.7446 48.6093 100.769 48.6546C100.762 52.4472 100.762 56.2436 100.769 60.04C98.7409 60.0778 96.7161 60.0513 94.6914 60.0589C94.6914 56.2512 94.6914 52.4397 94.6914 48.6282Z"
                                    fill="black" />
                                <path
                                    d="M14.0116 60.0702C23.4855 60.0475 32.9595 60.0589 42.4334 60.0664C42.6827 61.8267 42.5241 63.6097 42.5732 65.3814C40.8771 65.4418 39.181 65.4191 37.4887 65.4116C37.3716 65.4985 37.1411 65.6722 37.0278 65.7591C37.0467 69.7481 37.0467 73.7409 37.024 77.73C35.0069 77.7262 32.9859 77.73 30.9687 77.73C30.9687 79.5129 30.9687 81.2997 30.9687 83.0864C34.8255 83.1242 38.6861 83.0147 42.5392 83.1431C42.6109 85.1414 42.5429 87.1435 42.5694 89.1455C40.726 89.1682 38.8863 89.1493 37.0429 89.1644C37.0316 91.004 37.0505 92.8437 37.0278 94.6871C35.0144 94.672 32.9972 94.7211 30.9876 94.6455C30.9536 92.8135 30.9763 90.9852 30.9612 89.1569C29.1782 89.1569 27.3914 89.1569 25.6085 89.1569C25.6123 83.3244 25.6085 77.492 25.6085 71.6595C27.3877 71.6595 29.1669 71.6558 30.9461 71.6595C30.9838 69.6121 30.9763 67.5647 30.9536 65.5173C28.3774 65.3096 25.786 65.4682 23.206 65.4191C21.9481 65.4191 20.6902 65.4191 19.4323 65.4154C18.5484 65.4154 17.6682 65.4191 16.7843 65.4191C15.8588 65.4191 14.9333 65.4154 14.0078 65.3965C14.0154 63.6211 14.0116 61.8456 14.0116 60.0702Z"
                                    fill="black" />
                                <path
                                    d="M129.867 65.4003C129.859 63.6173 129.859 61.8381 129.867 60.0589C133.675 60.0589 137.482 60.0589 141.29 60.0589C141.294 61.8419 141.294 63.6248 141.29 65.4078C143.133 65.4154 144.977 65.4494 146.824 65.3776C146.816 64.4106 146.816 63.4473 146.82 62.484C146.816 61.6757 146.82 60.8673 146.824 60.0551C148.845 60.0664 150.866 60.0438 152.887 60.074C152.887 61.857 152.887 63.6362 152.891 65.4191C154.674 65.4191 156.46 65.4191 158.247 65.4191C158.247 63.6324 158.243 61.8456 158.251 60.0589C160.272 60.0589 162.293 60.0589 164.318 60.0589C164.352 63.8024 164.253 67.5496 164.37 71.2931C162.448 72.0637 160.272 71.4782 158.247 71.6595C158.251 73.6805 158.24 75.7052 158.258 77.73C160.279 77.7262 162.297 77.73 164.318 77.73C164.306 75.7279 164.363 73.7258 164.272 71.7275C166.059 71.5349 167.868 71.7087 169.666 71.6709C169.685 73.6881 169.689 75.709 169.663 77.73C167.88 77.7262 166.097 77.73 164.318 77.73C164.321 79.5129 164.318 81.2997 164.318 83.0864C166.104 83.0864 167.891 83.0864 169.678 83.0864C169.678 85.1112 169.678 87.1321 169.678 89.1569C165.87 89.1569 162.062 89.1606 158.255 89.1569C158.247 91.0003 158.232 92.8437 158.274 94.6833C162.074 94.6833 165.878 94.6871 169.678 94.6833C169.674 96.7081 169.693 98.7366 169.663 100.761C167.88 100.754 166.1 100.758 164.318 100.758C164.321 104.569 164.318 108.377 164.318 112.184C166.104 112.184 167.891 112.184 169.678 112.184C169.678 113.971 169.678 115.758 169.678 117.545C167.891 117.545 166.104 117.545 164.321 117.545C164.318 115.758 164.318 113.971 164.318 112.184C162.297 112.184 160.272 112.184 158.251 112.184C158.258 116.053 158.224 119.917 158.27 123.785C160.287 123.781 162.304 123.785 164.321 123.781C164.321 125.806 164.31 127.831 164.329 129.855C166.108 129.855 167.887 129.852 169.666 129.859C169.685 127.846 169.682 125.832 169.674 123.819C171.755 123.759 173.841 123.766 175.922 123.815C175.914 125.693 175.907 127.566 175.926 129.44C175.835 129.55 175.654 129.761 175.563 129.867C173.599 129.848 171.638 129.844 169.678 129.871C169.682 131.65 169.678 133.433 169.678 135.216C165.87 135.216 162.059 135.216 158.247 135.216C158.247 137.237 158.247 139.261 158.247 141.282C162.055 141.282 165.863 141.286 169.67 141.282C169.682 143.148 169.685 145.015 169.659 146.884C169.077 146.835 168.495 146.801 167.917 146.771C165.893 146.843 163.868 146.801 161.847 146.809C161.205 146.813 160.566 146.813 159.932 146.816C159.369 146.813 158.806 146.813 158.243 146.813C158.258 148.837 158.232 150.858 158.266 152.883C162.062 152.883 165.855 152.875 169.651 152.887C169.75 150.749 169.5 148.588 169.946 146.48C171.177 147.092 172.594 146.714 173.912 146.801C176.606 146.828 179.299 146.786 181.992 146.832C181.989 148.732 181.973 150.628 182 152.528C181.906 152.622 181.713 152.804 181.618 152.894C179.715 152.868 177.814 152.887 175.918 152.883C175.918 154.666 175.914 156.453 175.918 158.24C177.939 158.243 179.964 158.228 181.989 158.255C181.985 160.268 181.985 162.281 181.989 164.295C179.968 164.325 177.943 164.306 175.918 164.31C175.922 168.087 175.899 171.865 175.93 175.642L175.59 175.582L175.65 175.922C173.659 175.903 171.665 175.892 169.674 175.933C169.678 177.95 169.693 179.968 169.659 181.985C167.883 181.973 166.108 181.981 164.333 181.981C164.31 179.956 164.321 177.932 164.318 175.911C166.097 175.911 167.876 175.903 169.655 175.914C169.685 173.833 169.704 171.748 169.64 169.666C167.865 169.674 166.093 169.67 164.318 169.67C164.155 167.967 164.65 166.123 164.072 164.506C162.187 164.064 160.181 164.427 158.247 164.314C158.247 166.097 158.247 167.883 158.247 169.67C160.268 169.67 162.289 169.67 164.314 169.67C164.321 171.752 164.321 173.829 164.314 175.911C162.293 175.907 160.272 175.911 158.251 175.907C158.243 177.932 158.262 179.956 158.236 181.981C156.457 181.977 154.681 181.977 152.91 181.985C152.876 179.964 152.891 177.943 152.894 175.926C150.866 175.892 148.837 175.926 146.809 175.899C146.832 177.822 146.801 179.749 146.835 181.675L146.51 181.652L146.59 181.992C144.826 181.966 143.065 181.985 141.301 181.977C141.282 179.956 141.298 177.935 141.29 175.914C143.096 175.914 144.901 175.88 146.703 175.945L146.416 175.533L146.854 175.752C146.794 174.011 146.824 172.265 146.82 170.524C146.816 170.022 146.82 169.519 146.824 169.02C146.745 166.92 146.998 164.793 146.616 162.716L146.832 162.878C146.786 161.333 146.911 159.781 146.673 158.247C141.067 158.232 135.465 158.243 129.863 158.24C129.863 156.46 129.859 154.677 129.867 152.898C127.838 152.864 125.814 152.887 123.789 152.883C123.626 154.67 124.174 156.608 123.43 158.292C119.687 158.175 115.939 158.274 112.192 158.24C112.192 156.453 112.192 154.666 112.192 152.883C113.971 152.883 115.747 152.875 117.526 152.887C117.575 150.873 117.548 148.864 117.545 146.854C118.708 146.801 119.872 146.805 121.039 146.805C123.188 146.816 125.334 146.813 127.483 146.809C128.005 146.809 128.526 146.816 129.047 146.828C129.255 146.745 129.67 146.582 129.878 146.503C129.844 140.958 129.867 135.416 129.867 129.871C125.836 129.844 121.806 129.848 117.775 129.867L117.862 129.527L117.541 129.546C117.545 128.851 117.548 128.156 117.552 127.464C117.552 126.237 117.552 125.009 117.552 123.781C115.765 123.785 113.979 123.781 112.192 123.785C112.188 125.81 112.203 127.835 112.177 129.859C110.16 129.852 108.143 129.855 106.122 129.855C106.125 131.642 106.122 133.425 106.125 135.212C108.146 135.212 110.171 135.212 112.192 135.212C112.192 137.237 112.192 139.261 112.192 141.286C110.171 141.282 108.15 141.282 106.129 141.282C106.122 143.073 106.125 144.86 106.125 146.65C106.881 146.643 107.636 146.639 108.392 146.624L108.365 146.839C109.476 146.82 110.594 146.832 111.693 146.639C111.822 146.711 112.079 146.854 112.203 146.922C112.181 148.909 112.203 150.896 112.188 152.883C106.363 152.883 100.542 152.875 94.7211 152.887C94.6682 150.862 94.6985 148.834 94.6909 146.809C96.6136 146.816 98.5364 146.798 100.463 146.824L100.436 146.495L100.776 146.575C100.75 142.793 100.769 139.012 100.765 135.231C98.7404 135.201 96.7156 135.22 94.6909 135.216C94.6909 133.433 94.6909 131.654 94.6947 129.871C92.8513 129.844 91.0079 129.852 89.1644 129.867C89.1644 131.646 89.1644 133.433 89.1644 135.216C87.1397 135.216 85.1188 135.216 83.094 135.216C83.094 131.404 83.094 127.593 83.094 123.785C85.1074 123.781 87.1246 123.778 89.138 123.785C89.1795 121.704 89.1833 119.622 89.1342 117.541C87.6081 117.545 86.0782 117.556 84.5521 117.526L84.571 117.802C84.0724 117.684 83.5775 117.571 83.0827 117.458C83.1054 115.701 83.0902 113.941 83.094 112.184C79.2863 112.184 75.4786 112.188 71.6671 112.184C71.6633 113.971 71.6671 115.758 71.6633 117.548C72.5095 117.537 73.3557 117.548 74.2056 117.541C75.2368 117.545 76.2681 117.545 77.2994 117.537C77.4127 117.628 77.6356 117.809 77.7489 117.9C77.7224 125.693 77.7413 133.486 77.7375 141.279C75.7128 141.286 73.6881 141.282 71.6671 141.286C71.6671 137.482 71.6633 133.682 71.6709 129.882C69.6877 129.837 67.7083 129.848 65.7289 129.867C65.6496 129.663 65.4909 129.251 65.4154 129.043C65.4418 127.124 65.4192 125.205 65.4305 123.286C65.4229 122.036 65.4192 120.782 65.4343 119.528C65.4267 118.863 65.4041 118.202 65.3814 117.541C63.6097 117.586 61.823 117.416 60.0665 117.718C60.0589 119.739 60.0891 121.764 60.0438 123.785C56.2474 123.781 52.4511 123.781 48.6547 123.785C48.6358 121.704 48.6094 119.622 48.6736 117.541C50.449 117.548 52.2244 117.545 53.996 117.545C53.9923 115.758 53.9998 113.971 53.9923 112.184C52.2093 112.184 50.4225 112.184 48.6358 112.184C48.6396 110.163 48.6396 108.139 48.6358 106.114C52.4473 106.114 56.255 106.114 60.0665 106.114C59.9418 104.429 60.3422 102.646 59.8398 101.026C59.7152 100.965 59.4621 100.837 59.3374 100.776C55.779 100.735 52.2206 100.758 48.6622 100.769C48.6396 98.8574 48.5942 96.9423 48.6698 95.0309C48.7416 94.9402 48.8813 94.7589 48.9531 94.6682C52.655 94.6984 56.357 94.6795 60.0589 94.6871C60.074 92.8437 60.0589 91.0003 60.074 89.1606C61.8532 89.1569 63.6362 89.1531 65.4154 89.1644C65.4229 90.9587 65.4532 92.753 65.3889 94.5473L65.8347 94.2829L65.5438 94.7211C73.4161 94.6342 81.2922 94.7098 89.1644 94.6833C89.1569 96.7081 89.1833 98.7328 89.1455 100.761C87.1284 100.754 85.1112 100.758 83.094 100.758C83.0978 104.565 83.094 108.377 83.094 112.184C88.9831 112.196 94.876 112.166 100.765 112.2C100.765 113.982 100.765 115.762 100.761 117.545C101.857 117.545 102.952 117.545 104.044 117.541C104.739 117.541 105.43 117.545 106.125 117.545C106.137 113.975 106.091 110.401 106.14 106.832C106.19 106.707 106.292 106.458 106.341 106.333C108.214 105.838 110.254 106.246 112.192 106.114C112.192 108.139 112.192 110.16 112.192 112.184C116.06 112.184 119.925 112.192 123.793 112.177C123.789 110.156 123.793 108.135 123.789 106.114C125.814 106.118 127.838 106.103 129.863 106.129C129.859 108.146 129.863 110.163 129.863 112.181C127.838 112.188 125.814 112.184 123.793 112.184C123.808 116.053 123.751 119.921 123.823 123.789C129.644 123.778 135.469 123.785 141.294 123.781C141.294 125.806 141.282 127.827 141.301 129.852C145.049 129.867 148.796 129.833 152.543 129.871C152.634 129.772 152.815 129.58 152.902 129.482C152.876 127.589 152.891 125.7 152.894 123.808C150.881 123.762 148.871 123.785 146.858 123.789C146.854 123.521 146.843 122.98 146.839 122.712L146.575 122.716C146.662 122.18 146.748 121.639 146.839 121.103C146.805 119.83 146.816 118.557 146.82 117.28C146.816 115.58 146.816 113.884 146.824 112.184C148.845 112.181 150.87 112.203 152.891 112.166C152.887 110.148 152.891 108.131 152.891 106.114C154.674 106.114 156.46 106.114 158.247 106.114C158.247 104.327 158.247 102.54 158.247 100.758C156.468 100.758 154.689 100.754 152.913 100.761C152.872 98.7441 152.891 96.7269 152.894 94.7135C148.951 94.6531 145.007 94.6984 141.063 94.6871C137.342 94.6833 133.618 94.6795 129.897 94.6871C129.837 92.8437 129.867 91.0003 129.867 89.1569C135.442 89.1682 141.018 89.1418 146.594 89.1682C146.673 88.7338 146.756 88.2994 146.839 87.865C146.828 87.3399 146.816 86.811 146.813 86.286C146.816 85.5305 146.816 84.7712 146.82 84.0157C146.816 82.8107 146.809 81.6057 146.835 80.4006L146.578 80.4082C146.669 79.732 146.771 79.0596 146.854 78.3835C146.839 78.221 146.809 77.8962 146.794 77.7337C148.8 77.7224 150.809 77.7337 152.815 77.7224C152.959 75.7128 152.86 73.6956 152.891 71.686C147.002 71.6256 141.112 71.6747 135.22 71.6595C135.22 73.6805 135.231 75.7052 135.208 77.73C133.429 77.7262 131.65 77.7262 129.871 77.73C129.859 75.7128 129.859 73.6956 129.867 71.6784C127.846 71.6444 125.821 71.652 123.8 71.6671C123.793 69.6537 123.766 67.6365 123.823 65.6193L123.827 65.438C125.84 65.3927 127.853 65.4418 129.867 65.4003ZM60.0665 94.6871C60.0854 96.4776 60.0325 98.2682 60.0778 100.059C60.1609 100.157 60.3309 100.357 60.414 100.455C61.9061 101.143 63.7608 100.565 65.3965 100.761C65.4078 100.225 65.4192 99.6923 65.4305 99.1596C65.4229 97.6638 65.4192 96.1679 65.4343 94.6758C63.6437 94.6909 61.857 94.6795 60.0665 94.6871ZM60.0665 106.118C60.0665 108.139 60.0665 110.16 60.0665 112.181C63.9346 112.184 67.799 112.192 71.6671 112.181C71.6671 110.163 71.6633 108.15 71.6671 106.137C67.799 106.091 63.9346 106.129 60.0665 106.118ZM94.6909 123.781C94.6947 125.806 94.6833 127.831 94.706 129.859C98.5099 129.852 102.318 129.855 106.122 129.855C106.122 127.831 106.122 125.806 106.122 123.785C102.314 123.781 98.5024 123.785 94.6909 123.781ZM135.223 135.216C135.231 141.105 135.201 146.994 135.238 152.883C140.995 152.887 146.752 152.868 152.505 152.894C152.604 152.796 152.804 152.6 152.902 152.502C152.876 146.745 152.894 140.988 152.891 135.231C147.002 135.193 141.112 135.223 135.223 135.216ZM152.891 164.314C154.674 164.31 156.46 164.31 158.247 164.31C158.247 162.289 158.247 160.264 158.247 158.24C156.46 158.24 154.674 158.24 152.891 158.24C152.887 160.264 152.887 162.289 152.891 164.314ZM164.321 158.243C164.352 160.2 164.231 162.161 164.401 164.114C164.469 164.178 164.601 164.302 164.665 164.367C166.335 164.283 168.008 164.314 169.678 164.314C169.678 162.289 169.678 160.264 169.678 158.24C167.891 158.243 166.104 158.24 164.321 158.243ZM152.906 175.914C154.685 175.907 156.468 175.911 158.247 175.911C158.247 173.829 158.247 171.752 158.247 169.67C156.472 169.67 154.7 169.674 152.925 169.666C152.86 171.748 152.883 173.829 152.906 175.914Z"
                                    fill="black" />
                                <path
                                    d="M169.677 60.0816C171.672 60.0589 173.666 60.0249 175.661 60.0778C175.718 60.1722 175.831 60.3611 175.891 60.4555C175.967 64.097 175.876 67.7461 175.929 71.3876L175.589 71.3309L175.665 71.6709C173.663 71.6482 171.664 71.6558 169.666 71.6709C169.692 67.8065 169.674 63.9422 169.677 60.0816Z"
                                    fill="black" />
                                <path
                                    d="M83.1549 65.4607C84.5828 65.37 86.022 65.3814 87.4537 65.5136C87.7181 65.4871 88.2545 65.4342 88.5227 65.4078C89.282 65.4456 90.045 65.4531 90.8118 65.4305C91.3256 65.4229 91.8393 65.4191 92.3568 65.4153C93.1161 65.4191 93.8792 65.4191 94.6384 65.4191C94.9104 65.4191 95.4468 65.4191 95.7188 65.4191C96.9238 65.4191 98.1326 65.4267 99.3414 65.4002L99.3225 65.6042C99.6021 65.6042 100.165 65.6042 100.448 65.6042L100.444 65.4002C102.337 65.4796 104.241 65.2794 106.122 65.5816C106.122 69.631 106.137 73.6805 106.114 77.73C102.307 77.7262 98.499 77.73 94.6913 77.7262C94.6913 79.5129 94.6913 81.2997 94.6913 83.0826C92.8479 83.094 91.0083 83.0826 89.1649 83.094C89.1649 85.1149 89.1649 87.1359 89.1649 89.1568C87.1401 89.1568 85.1192 89.1568 83.0944 89.1568C83.0944 85.3491 83.0944 81.5377 83.0944 77.73C85.1116 77.73 87.1326 77.7262 89.1535 77.73C89.1762 75.7052 89.1611 73.6805 89.1649 71.6558C87.1477 71.6595 85.1305 71.6558 83.1133 71.6595C83.1133 69.5932 83.0227 67.5232 83.1549 65.4607Z"
                                    fill="black" />
                                <path
                                    d="M14.0078 71.6784C15.855 71.6482 17.6984 71.6406 19.5456 71.686C19.5418 73.5709 19.5267 75.4559 19.5532 77.3409C19.4625 77.4429 19.2812 77.6431 19.1905 77.7413C17.468 77.7148 15.7455 77.7375 14.0191 77.7186C14.004 75.7052 14.0191 73.6918 14.0078 71.6784Z"
                                    fill="black" />
                                <path
                                    d="M117.541 71.6709C119.627 71.652 121.716 71.652 123.801 71.6671C123.786 73.688 123.782 75.709 123.808 77.7337C125.825 77.7262 127.846 77.7224 129.864 77.7375C129.864 81.5414 129.864 85.3454 129.864 89.1531C127.843 89.1606 125.818 89.1568 123.797 89.1568C123.786 94.808 123.793 100.463 123.789 106.114C121.712 106.11 119.63 106.14 117.549 106.088C117.549 102.786 117.568 99.4845 117.538 96.183L117.813 96.3227C117.696 95.7674 117.583 95.2159 117.477 94.6644C115.713 94.7022 113.953 94.6795 112.192 94.6871C112.189 96.708 112.208 98.7328 112.174 100.758C110.156 100.754 108.139 100.758 106.122 100.758C106.001 102.457 106.394 104.259 105.903 105.895C105.778 105.944 105.529 106.046 105.404 106.099C101.835 106.144 98.2611 106.103 94.6914 106.114C94.6914 104.327 94.6914 102.54 94.6914 100.758C96.5915 100.761 98.4916 100.742 100.392 100.769C100.486 100.674 100.682 100.478 100.777 100.384C100.75 98.4835 100.769 96.5834 100.766 94.6833C104.57 94.6871 108.377 94.6833 112.185 94.6833C112.2 92.8437 112.192 91.0003 112.192 89.1568C106.356 89.1568 100.524 89.1568 94.6914 89.1568C94.6914 87.1359 94.6914 85.1112 94.6914 83.0864C100.524 83.0864 106.36 83.0864 112.192 83.0864C112.192 85.1112 112.192 87.1321 112.192 89.1568C116.061 89.1531 119.925 89.1682 123.793 89.1493C123.789 87.1321 123.789 85.1225 123.793 83.1091C121.716 83.06 119.634 83.1204 117.557 83.06C117.541 79.2636 117.572 75.4672 117.541 71.6709Z"
                                    fill="black" />
                                <path
                                    d="M48.64 71.6558C50.2719 71.6482 51.9038 71.6936 53.5357 71.6142C54.4914 73.469 53.785 75.7128 53.9852 77.73C52.206 77.73 50.4306 77.7262 48.6514 77.73C48.6249 75.7052 48.64 73.6805 48.64 71.6558Z"
                                    fill="black" />
                                <path
                                    d="M175.914 77.73C177.939 77.7338 179.964 77.7149 181.988 77.7451C181.984 79.5205 181.984 81.2959 181.988 83.0713C179.964 83.1016 177.939 83.0827 175.918 83.0902C175.914 81.2997 175.918 79.513 175.914 77.73Z"
                                    fill="black" />
                                <path
                                    d="M48.6391 89.1493C48.6353 87.1283 48.6353 85.1074 48.6391 83.0864C50.4221 83.0864 52.2088 83.0864 53.9956 83.0864C53.9956 85.1112 53.9956 87.1321 53.9956 89.1568C52.2126 89.1568 50.4259 89.1568 48.6429 89.1568C48.522 90.9285 48.8809 92.787 48.4427 94.5058C48.1858 94.5624 47.6721 94.6758 47.4152 94.7324C45.8098 94.6455 44.2006 94.6909 42.5914 94.6909C42.546 92.8437 42.5687 91.0003 42.5725 89.1568C44.5934 89.1568 46.6182 89.1606 48.6391 89.1493Z"
                                    fill="black" />
                                <path
                                    d="M14.0151 89.1682C15.8585 89.1531 17.6982 89.1493 19.5378 89.172C19.5454 91.0116 19.5227 92.8475 19.5605 94.6871C21.5776 94.6833 23.5948 94.672 25.612 94.7022C25.6044 96.7156 25.6195 98.7328 25.5969 100.75C23.5835 100.761 21.5663 100.75 19.5529 100.761C19.5302 98.7403 19.5378 96.7232 19.5454 94.7022C17.8493 94.672 16.1494 94.6795 14.4533 94.6909C14.34 94.5964 14.1133 94.4113 14 94.3169C14.0227 92.6019 14.0076 90.8832 14.0151 89.1682Z"
                                    fill="black" />
                                <path
                                    d="M175.956 94.6909C175.888 92.8437 175.918 91.0003 175.93 89.1531C177.947 89.1644 179.964 89.1455 181.985 89.1682C181.992 90.8832 181.977 92.6019 182 94.3169C181.887 94.4113 181.66 94.5964 181.547 94.6909C179.681 94.6795 177.818 94.6833 175.956 94.6909Z"
                                    fill="black" />
                                <path
                                    d="M37.0352 94.6909C38.8823 94.6833 40.7258 94.6644 42.5729 94.7098C42.5616 98.5024 42.5654 102.299 42.5692 106.091C40.7258 106.133 38.8823 106.118 37.0389 106.106C37.0389 102.303 37.0427 98.4986 37.0352 94.6909Z"
                                    fill="black" />
                                <path
                                    d="M14.0078 100.776C15.855 100.746 17.6984 100.75 19.5418 100.773C19.5381 112.245 19.5381 123.721 19.5418 135.193C17.6984 135.227 15.855 135.22 14.0116 135.201C14.0116 123.725 14.0154 112.249 14.0078 100.776Z"
                                    fill="black" />
                                <path
                                    d="M135.22 100.758C137.244 100.754 139.269 100.758 141.294 100.758C141.29 102.541 141.29 104.327 141.29 106.118C139.269 106.114 137.244 106.118 135.22 106.118C135.22 104.331 135.22 102.544 135.22 100.758Z"
                                    fill="black" />
                                <path
                                    d="M169.674 100.776C173.78 100.746 177.886 100.746 181.992 100.776C181.985 102.552 181.985 104.327 181.988 106.103C179.964 106.129 177.939 106.11 175.914 106.118C175.918 108.131 175.91 110.145 175.918 112.158C173.84 112.207 171.759 112.184 169.678 112.177C169.678 108.377 169.681 104.577 169.674 100.776Z"
                                    fill="black" />
                                <path
                                    d="M25.6382 123.785C25.5739 117.896 25.6268 112.003 25.6117 106.114C27.3947 106.114 29.1815 106.114 30.9682 106.114C30.9682 108.139 30.9682 110.16 30.9682 112.184C32.9929 112.184 35.0139 112.184 37.0348 112.184C37.0386 113.971 37.0386 115.758 37.0386 117.545C35.0177 117.594 32.9816 117.409 30.9758 117.692C30.9569 119.724 30.9946 121.757 30.9455 123.785C29.1739 123.781 27.406 123.781 25.6382 123.785Z"
                                    fill="black" />
                                <path
                                    d="M129.863 117.545C129.863 115.758 129.863 113.971 129.863 112.184C133.671 112.184 137.479 112.184 141.29 112.184C141.294 113.971 141.29 115.758 141.294 117.545C139.832 117.545 138.37 117.545 136.908 117.545C134.559 117.545 132.209 117.545 129.863 117.545Z"
                                    fill="black" />
                                <path
                                    d="M42.565 123.781C44.5897 123.785 46.6144 123.774 48.6392 123.796C48.4956 125.791 48.964 127.884 48.3294 129.803C50.2182 129.84 52.1069 129.874 53.9956 129.856C53.9956 131.642 53.9956 133.429 53.9956 135.216C52.2089 135.216 50.4221 135.216 48.6354 135.216C48.4616 133.429 49.0509 131.48 48.2388 129.822C46.3538 129.89 44.4688 129.837 42.5839 129.859C42.5499 127.835 42.5725 125.806 42.565 123.781Z"
                                    fill="black" />
                                <path
                                    d="M60.066 135.216C61.8528 135.212 63.6395 135.212 65.4263 135.212C65.4187 137.157 65.4452 139.103 65.4036 141.052C65.4149 141.823 65.4489 142.597 65.5736 143.364C65.532 143.624 65.4527 144.15 65.4112 144.41C65.4225 145.211 65.4187 146.016 65.3847 146.82C64.1533 146.805 62.918 146.866 61.6979 146.684C61.407 146.733 60.8253 146.832 60.5344 146.881C60.4136 146.782 60.1718 146.586 60.0547 146.492C60.0811 142.733 60.0585 138.974 60.066 135.216Z"
                                    fill="black" />
                                <path
                                    d="M117.549 141.252C117.602 139.243 117.428 137.222 117.681 135.22C119.717 135.212 121.757 135.197 123.793 135.235C123.789 137.24 123.789 139.25 123.793 141.256C121.712 141.298 119.63 141.301 117.549 141.252Z"
                                    fill="black" />
                                <path
                                    d="M14.0148 141.294C27.3418 141.267 40.665 141.294 53.992 141.282C53.992 154.847 54.0108 168.416 53.9806 181.981C40.6612 181.97 27.3418 181.992 14.0186 181.973C14.0035 168.412 14.0148 154.855 14.0148 141.294ZM19.53 146.907C19.5715 156.574 19.4884 166.244 19.5715 175.914C29.1663 175.914 38.7649 175.892 48.3597 175.926L48.3144 175.597L48.6506 175.673C48.6204 166.059 48.643 156.445 48.643 146.835C45.5039 146.794 42.3686 146.801 39.2333 146.832L39.2635 146.628C38.9802 146.628 38.4098 146.628 38.1265 146.628L38.1492 146.832C34.9308 146.79 31.7123 146.82 28.4939 146.813C25.6948 146.722 22.8692 147.001 20.0852 146.639C19.9493 146.707 19.6697 146.839 19.53 146.907Z"
                                    fill="black" />
                                <path
                                    d="M77.7412 141.282C81.5451 141.282 85.3528 141.286 89.1568 141.282C89.1643 143.126 89.187 144.969 89.1341 146.813C87.1207 146.809 85.1073 146.813 83.0939 146.813C83.1279 150.465 83.0335 154.122 83.1506 157.775C83.0901 157.866 82.973 158.047 82.9126 158.138C79.1729 158.372 75.4143 158.179 71.6632 158.24C71.6292 161.904 71.7463 165.572 71.6028 169.232C71.7501 169.444 71.8937 169.655 72.0448 169.87C73.7749 169.515 75.5503 169.727 77.3068 169.663C77.4163 169.753 77.6392 169.931 77.7488 170.022C77.7299 171.869 77.7261 173.716 77.7488 175.563C77.643 175.654 77.4315 175.831 77.3257 175.922C75.4483 175.899 73.5746 175.907 71.6972 175.914C71.6406 174.222 71.6708 172.526 71.6784 170.834C71.8332 170.339 71.5461 169.78 71.0475 169.666C69.4232 169.648 67.7989 169.693 66.1783 169.659C65.9857 169.75 65.6079 169.935 65.4153 170.025C65.4266 174.011 65.4455 177.996 65.4039 181.985C63.6285 181.977 61.8531 181.981 60.0777 181.981C60.0512 172.28 60.0739 162.584 60.0664 152.887C63.8476 152.883 67.6289 152.864 71.4139 152.894L71.3497 152.562L71.6821 152.619C71.6519 150.681 71.6708 148.747 71.6632 146.809C73.2913 146.813 74.9194 146.798 76.5475 146.824C76.9479 146.726 77.3484 146.635 77.7488 146.544C77.7261 144.788 77.7374 143.035 77.7412 141.282Z"
                                    fill="black" />
                                <path
                                    d="M141.297 141.29C143.027 141.279 144.757 141.294 146.491 141.271C146.574 141.384 146.744 141.607 146.831 141.721C146.82 142.257 146.816 142.797 146.816 143.337C146.816 143.609 146.816 144.153 146.816 144.425C146.816 144.965 146.824 145.502 146.831 146.042C146.737 146.242 146.548 146.635 146.453 146.832C145.921 146.816 145.388 146.809 144.856 146.805C143.813 146.809 142.767 146.809 141.724 146.824C141.615 146.737 141.392 146.567 141.278 146.484C141.301 144.75 141.286 143.02 141.297 141.29Z"
                                    fill="black" />
                                <path
                                    d="M25.6084 152.879C31.2633 152.906 36.9182 152.834 42.5731 152.917C42.5655 158.489 42.5618 164.061 42.5731 169.632C36.9182 169.719 31.2633 169.648 25.6084 169.67C25.6122 164.076 25.6122 158.477 25.6084 152.879Z"
                                    fill="black" />
                                <path
                                    d="M83.3088 158.47C83.4637 158.413 83.7772 158.292 83.9321 158.236C93.3531 158.243 102.77 158.236 112.191 158.24C112.191 160.264 112.191 162.285 112.191 164.31C110.171 164.31 108.146 164.31 106.125 164.31C105.981 166.085 106.431 168.008 105.868 169.685C102.158 169.663 98.4452 169.678 94.7319 169.666C94.6602 171.748 94.6866 173.833 94.713 175.914C98.5283 175.964 102.362 175.794 106.166 175.99C106.079 177.984 106.151 179.983 106.11 181.981C102.31 181.981 98.5132 181.973 94.713 181.985C94.6753 179.968 94.6942 177.95 94.6979 175.933C92.8507 175.892 91.0073 175.907 89.1639 175.922C89.1601 177.939 89.179 179.96 89.1488 181.985C87.1354 181.977 85.122 181.981 83.1086 181.981C83.0897 177.879 83.0746 173.773 83.1162 169.67C85.1333 169.674 87.1467 169.67 89.1639 169.67C89.1639 167.883 89.1639 166.097 89.1639 164.31C87.1392 164.31 85.1144 164.31 83.0935 164.31C83.237 162.376 82.8026 160.344 83.3088 158.47Z"
                                    fill="black" />
                                <path
                                    d="M123.792 164.287C123.857 162.259 123.656 160.215 123.868 158.198C125.866 158.281 127.864 158.224 129.863 158.24C129.866 162.047 129.855 165.851 129.866 169.659C125.76 169.663 121.654 169.716 117.548 169.632C117.593 167.857 117.431 166.074 117.707 164.314C119.735 164.299 121.764 164.333 123.792 164.287Z"
                                    fill="black" />
                                <path
                                    d="M135.223 164.31C137.244 164.31 139.265 164.31 141.29 164.31C141.286 168.178 141.301 172.042 141.282 175.911C137.478 175.907 133.678 175.907 129.878 175.911C129.855 173.829 129.851 171.748 129.878 169.67C131.657 169.674 133.44 169.67 135.223 169.67C135.219 167.883 135.219 166.097 135.223 164.31Z"
                                    fill="black" />
                                <path
                                    d="M106.371 169.829C108.267 169.466 110.239 169.768 112.165 169.67C112.214 171.748 112.188 173.829 112.188 175.911C110.163 175.722 107.987 176.315 106.072 175.552C106.329 173.663 105.785 171.627 106.371 169.829Z"
                                    fill="black" />
                                <path
                                    d="M112.192 175.911C113.979 175.907 115.765 175.911 117.552 175.907C117.545 177.932 117.571 179.96 117.53 181.985C115.754 181.977 113.979 181.981 112.203 181.981C112.181 179.956 112.196 177.932 112.192 175.911Z"
                                    fill="black" />
                                <path
                                    d="M123.789 175.911C125.814 175.911 127.839 175.899 129.867 175.918C129.859 177.935 129.871 179.953 129.856 181.973C127.839 181.989 125.825 181.973 123.812 181.985C123.774 179.956 123.797 177.932 123.789 175.911Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex justify-center mt-2">
                        <button type="submit"
                            class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
                            style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
                            {{__("front.save")}}
                        </button>
                    </div>
                </form>
            </div>


            <div id="tab-history" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1"> {{__("front.personOperationHistoryLabel")}}</span>
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

                    <!-- для >640px -->
                    <div class="hidden sm:grid grid-cols-[0.8fr_0.9fr_1.8fr_1.4fr_1fr] text-white/40 text-[12px] pl-4">
                        <div>Дата</div>
                        <div>Время</div>
                        <div>Отправлено</div>
                        <div>Получено</div>
                        <div>Курс обмена</div>
                    </div>

                    <!-- Один элемент истории -->
                    <div
                        class="pl-4 py-3 flex flex-col gap-3 sm:grid sm:grid-cols-[0.75fr_0.8fr_1.8fr_1.4fr_1fr] sm:items-center sm:gap-2 border-b border-white/10">

                        <div class="text-white text-[14px] sm:block hidden">12.12.2024</div>
                        <div class="text-white text-[14px] sm:block hidden">13:44:56</div>

                        <div class=" flex justify-between sm:hidden text-white text-[14px]">
                            <span class="text-white/40 text-[12px]">Дата</span>
                            <span>12.12.2024, 13:44:56</span>
                        </div>

                        <!-- Отправлено -->
                        <div class="text-white text-[14px]  flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Отправлено</span>
                            <div class="flex items-center gap-2">
                                <span class="bg-white/5 rounded-[12px] py-full px-[8px]">USDT</span>
                                <span>1920.00</span>
                            </div>
                        </div>

                        <!-- Получено -->
                        <div class="text-white text-[14px]  flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Получено</span>
                            <div class="flex items-center gap-2">
                                <span class="bg-white/5 rounded-[12px] py-full px-[8px]">EUR</span>
                                <span>1615.844422</span>
                            </div>
                        </div>

                        <!-- Курс обмена -->
                        <div class="text-white text-[14px] flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Курс обмена</span>
                            <span>0.7824</span>
                        </div>

                    </div>
                </form>
            </div>


            <div id="tab-balance" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">{{__("front.affiliate my balance")}}</span>
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

            <div id="tab-companies" class="hidden tab-content">
                <div class="max-[400px]:hidden flex items-center mb-6">
                    <span class="text-white uppercase text-[18px] leading-[140%] whitespace-nowrap mr-4 ml-1">Мои
                        компании</span>
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
                <form class="flex flex-col gap-[14px]">
                    <!-- Форма создания -->
                    <div class="p-[24px] rounded-[20px] bg-white/5 flex flex-col gap-[14px]">
                        <p>{{__("front.add_new_campaign")}}</p>
                        <input type="text" placeholder="Название компании"
                            class="w-full p-3 backdrop-blur-xl bg-[#1E1E1ECC]/80 border border-white/10 placeholder:text-white/40 text-white rounded">
                        <div class="flex justify-start mt-2">
                            <button type="submit"
                                class="max-w-[362px] w-full text-white text-[18px] font-medium rounded-full h-[48px] transition hover:opacity-90"
                                style="background: linear-gradient(95.62deg, #06AB6B 70.57%, #009C74 383.64%);">
                                Создать
                            </button>
                        </div>
                    </div>

                    <div
                        class="grid sm:grid-cols-[0.4fr_0.8fr_0.8fr_1fr] text-white text-[14px] gap-y-3 border-t border-white/10 pt-4">

                        <!-- Заголовки (только sm+) -->
                        <div class="hidden sm:block text-white/40 text-[12px]">Компания</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Зарегистрировалось</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Сделок завершено</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Ссылка</div>

                        <!-- Строка 1 -->
                        <!-- Компания -->
                        <div class="flex justify-between items-center sm:block">
                            <span class="text-white/40 text-[12px] sm:hidden">Компания</span>
                            <span class="uppercase">name1</span>
                        </div>

                        <!-- Зарегистрировалось -->
                        <div class="flex justify-between items-center sm:block">
                            <span class="text-white/40 text-[12px] sm:hidden">Зарегистрировалось</span>
                            <span class="uppercase">12</span>
                        </div>

                        <!-- Сделок завершено -->
                        <div class="flex justify-between items-center sm:block">
                            <span class="text-white/40 text-[12px] sm:hidden">Сделок завершено</span>
                            <span class="uppercase">0</span>
                        </div>

                        <!-- Ссылка -->
                        <div
                            class="text-white text-[14px] flex justify-between items-center max-[450px]:flex-wrap max-[450px]:gap-2">
                            <span class="text-white/40 text-[12px] sm:hidden ">Ссылка</span>
                            <div class="flex items-center gap-2 max-[450px]:flex-wrap max-[450px]:min-w-0 relative group">
                                <a href="#" onclick="copyToClipboard(this)"
                                    class="uppercase text-[14px] text-[#06AB6B] hover:opacity-70 max-[900px]:break-all max-[450px]:flex-1 relative">
                                    https://comcash.io/ru/a9b2...6a3c917959
                                    <span
                                        class="tooltip absolute bottom-full mb-1 left-1/2 -translate-x-1/2 text-[12px] bg-black text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                        Скопировано
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>


                </form>
            </div>

            <div id="tab-affiliates" class="hidden tab-content">
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

                        <!-- Заголовки (только sm+) -->
                        <div class="hidden sm:block text-white/40 text-[12px]">Компания</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Дата</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Отправлено</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Получено</div>
                        <div class="hidden sm:block text-white/40 text-[12px]">Статус</div>


                        <!-- Компания -->
                        <div class="flex justify-between items-center sm:block">
                            <span class="text-white/40 text-[12px] sm:hidden">Компания</span>
                            <span class="uppercase">name1</span>
                        </div>

                        <!-- Зарегистрировалось -->
                        <div class="flex justify-between items-center sm:block">
                            <span class="text-white/40 text-[12px] sm:hidden">Дата</span>
                            <div class="flex flex-wrap break-all">
                                <span class="uppercase">12.12.2024</span>
                                <span class="uppercase">13:44:56</span>
                            </div>

                        </div>

                        <!-- Отправлено -->
                        <div class="text-white text-[14px]  flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Отправлено</span>
                            <div class="flex items-center gap-2">
                                <span class="bg-white/5 rounded-[12px] py-full px-[8px]">USDT</span>
                                <span>1920.00</span>
                            </div>
                        </div>

                        <!-- Получено -->
                        <div class="text-white text-[14px]  flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Статус</span>
                            <div class="flex items-center gap-2">
                                <span class="bg-white/5 rounded-[12px] py-full px-[8px]">EUR</span>
                                <span>1615.844422</span>
                            </div>
                        </div>

                        <!-- Получено -->
                        <div class="text-white text-[14px]  flex justify-between items-center">
                            <span class="text-white/40 text-[12px] sm:hidden">Получено</span>
                            <div class="flex items-center gap-2">
                                <span class="uppercase text-[14px] text-[#06AB6B]">Успешно</span>
                            </div>
                        </div>

                    </div>


                </form>
            </div>

            <div id="tab-logout" class="tab-content hidden">
                {{__("front.log out")}}...
            </div>
        </div>
    </div>
</section>
<script>
    function copyToClipboard(el) {
        const text = el.textContent.trim();
        navigator.clipboard.writeText(text).then(() => {
            const tooltip = el.querySelector('.tooltip');
            if (tooltip) {
                tooltip.style.opacity = '1';
                setTimeout(() => {
                    tooltip.style.opacity = '0';
                }, 1500);
            }
        });
    }
</script>

<script>
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    const partnersToggle = document.getElementById('partners-toggle');
    const submenu = document.getElementById('partners-submenu');
    const arrow = document.getElementById('arrow-icon');
    const partnersIcon = document.getElementById('partners-icon');
    const balanceButton = document.querySelector('[data-tab="balance"]');

    const submenuItems = submenu.querySelectorAll('.tab-btn');

    const partnersSubmenuScreen = document.getElementById('partners-submenu-screen');
    const backFromSubmenu = document.getElementById('back-from-submenu');
    const partnersToggleMobile = document.getElementById('partners-toggle-mobile');


    // При нажатии на "Партнёрская программа" в мобилке — показываем "экран"
    partnersToggleMobile.addEventListener('click', (e) => {
        if (window.innerWidth <= 500) {
            e.stopPropagation();
            partnersSubmenuScreen.classList.remove('hidden');
        } else {
            submenu.classList.remove('hidden'); // десктоп
            arrow.classList.add('rotate-180');
            partnersToggle.classList.add('bg-white/5', 'rounded-[100px]');
            partnersIcon.classList.add('text-white', 'scale-110', 'duration-200');
            partnersMenuShown = true;
            activateTab(balanceButton);
        }
    });

    // Назад
    backFromSubmenu.addEventListener('click', () => {
        partnersSubmenuScreen.classList.add('hidden');
    });

    // Клик по подпункту — активирует и скрывает меню
    document.querySelectorAll('.submenu-item').forEach(item => {
        item.addEventListener('click', () => {
            partnersSubmenuScreen.classList.add('hidden');
            activateTab(item);
        });
    });



    let partnersMenuShown = false;

    // Сброс активных состояний
    function resetActiveState(except = null) {
        tabButtons.forEach(b => {
            if (b !== except) b.removeAttribute('data-active');
        });

        const isSubItem = Array.from(submenuItems).includes(except);

        if (except !== partnersToggle && !isSubItem) {
            partnersToggle.classList.remove('bg-white/5', 'rounded-[100px]');
            partnersIcon.classList.remove('text-white', 'scale-110', 'duration-200');
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
            partnersMenuShown = false;
        }
    }

    // Активация таба
    function activateTab(button) {
        const target = button.dataset.tab;
        if (!target) return;

        tabContents.forEach(tc => tc.classList.add('hidden'));
        const targetTab = document.getElementById(`tab-${target}`);
        if (targetTab) targetTab.classList.remove('hidden');

        // Сбросить только те кнопки, у которых такой же data-tab
        tabButtons.forEach(b => {
            if (b.dataset.tab === target) {
                b.setAttribute('data-active', 'true');
            } else {
                b.removeAttribute('data-active');
            }
        });

        // UI-сброс подменю
        const isSubItem = Array.from(submenuItems).includes(button);
        if (button !== partnersToggle && !isSubItem) {
            partnersToggle.classList.remove('bg-white/5', 'rounded-[100px]');
            partnersIcon.classList.remove('text-white', 'scale-110', 'duration-200');
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
            partnersMenuShown = false;
        }
    }


    // Клики по tab-кнопкам (исключая toggle)
    tabButtons.forEach(btn => {
        if (btn.id === 'partners-toggle') return;
        btn.addEventListener('click', () => activateTab(btn));
    });

    // Клик по "Партнёрская программа"
    partnersToggle.addEventListener('click', e => {
        e.stopPropagation();

        if (!partnersMenuShown) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            partnersToggle.classList.add('bg-white/5', 'rounded-[100px]');
            partnersIcon.classList.add('text-white', 'scale-110', 'duration-200');
            partnersMenuShown = true;

            activateTab(balanceButton);
        }
    });

    const defaultTab = document.querySelector('[data-tab="personal"]');
    if (defaultTab) activateTab(defaultTab);
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const desktopToggle = document.getElementById('partners-toggle');
        const mobileToggle = document.getElementById('partners-toggle-mobile');
        const submenu = document.getElementById('partners-submenu');
        const arrow = document.getElementById('arrow-icon');
        const toggleIcon = document.getElementById('partners-icon');

        const defaultTabs = document.getElementById('default-tabs');
        const partnerTabs = document.getElementById('partner-tabs');

        const tabButtons = document.querySelectorAll('.tab-btn[data-tab]');
        const subTabKeys = ['companies', 'affiliates', 'balance'];
        const defaultPersonal = document.querySelector('.tab-btn[data-tab="personal"]');
        const defaultBalance = document.querySelector('.tab-btn[data-tab="balance"]');

        let submenuIsOpen = false;

        function getCurrentActiveTabKey() {
            const activeBtn = document.querySelector('.tab-btn[data-tab][data-active="true"]');
            return activeBtn?.getAttribute('data-tab') || null;
        }

        function updatePartnersToggleUI(activeTab) {
            const isSubTab = subTabKeys.includes(activeTab);

            if (isSubTab && submenuIsOpen) {
                desktopToggle?.classList.add('bg-white/5', 'rounded-[100px]');
                toggleIcon?.classList.add('scale-110', 'duration-200', 'text-white');
            } else {
                desktopToggle?.classList.remove('bg-white/5', 'rounded-[100px]');
                toggleIcon?.classList.remove('scale-110', 'duration-200', 'text-white');
            }
        }

        function activateTab(targetBtn) {
            const tabKey = targetBtn?.getAttribute('data-tab');
            if (!tabKey) return;

            tabButtons.forEach(btn => {
                const isMatch = btn.getAttribute('data-tab') === tabKey;

                if (isMatch) {
                    btn.setAttribute('data-active', 'true');
                    btn.classList.add('text-[#06AB6B]');
                } else {
                    btn.removeAttribute('data-active');
                    btn.classList.remove('text-[#06AB6B]');
                }
            });

            updatePartnersToggleUI(tabKey);
        }

        function toggleSubmenuVisibility() {
            const wasHidden = submenu.classList.contains('hidden');
            submenu.classList.toggle('hidden');
            submenuIsOpen = wasHidden;
            arrow?.classList.toggle('rotate-180', wasHidden);

            if (wasHidden) {
                const currentActive = getCurrentActiveTabKey();
                const isSubTabActive = subTabKeys.includes(currentActive);
                if (!isSubTabActive && defaultBalance) {
                    activateTab(defaultBalance);
                } else {
                    updatePartnersToggleUI(currentActive);
                }
            } else {
                updatePartnersToggleUI(null);
            }
        }

        // Первичный запуск: personal
        if (defaultPersonal) activateTab(defaultPersonal);

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => activateTab(btn));
        });

        desktopToggle?.addEventListener('click', toggleSubmenuVisibility);

        mobileToggle?.addEventListener('click', () => {
            defaultTabs?.classList.add('hidden');
            partnerTabs?.classList.remove('hidden');
            toggleSubmenuVisibility();
        });

        document.querySelectorAll('.back-to-main-tabs').forEach(btn => {
            btn.addEventListener('click', () => {
                partnerTabs?.classList.add('hidden');
                defaultTabs?.classList.remove('hidden');
                submenu?.classList.add('hidden');
                submenuIsOpen = false;
                arrow?.classList.remove('rotate-180');
                updatePartnersToggleUI(null);
            });
        });
    });
</script>

<script>
    const scrollContainer = document.querySelector('.scrollable-tabs');

    let isDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.classList.add('active');
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.classList.remove('active');
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.classList.remove('active');
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 1.5;
        scrollContainer.scrollLeft = scrollLeft - walk;
    });
</script>

<script>
    const overlay = document.getElementById('menuOverlay2');
    const tabBtns = Array.from(document.querySelectorAll('.tab-btn'));

    function openOverlay() {
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100', 'pointer-events-auto');
        document.documentElement.classList.add('overflow-hidden');
    }

    function closeOverlay() {
        overlay.classList.remove('opacity-100', 'pointer-events-auto');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        document.documentElement.classList.remove('overflow-hidden');
    }

    function evaluateOverlay() {
        if (window.innerWidth <= 400) {
            openOverlay();
        } else {
            closeOverlay();
        }
    }

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const isActive = btn.dataset.active === 'true';
            tabBtns.forEach(b => b.dataset.active = 'false');
            btn.dataset.active = isActive ? 'false' : 'true';

            if (window.innerWidth <= 400) {
                closeOverlay(); // Скрываем после выбора
            }
        });
    });

    document.querySelectorAll('.back-to-main-tabs').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('partner-tabs')?.classList.add('hidden');
            document.getElementById('default-tabs')?.classList.remove('hidden');
            document.getElementById('partners-submenu')?.classList.add('hidden');
            document.getElementById('arrow-icon')?.classList.remove('rotate-180');

            if (window.innerWidth <= 400) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                document.documentElement.classList.add('overflow-hidden');
            }
        });
    });


    window.addEventListener('resize', evaluateOverlay);
    document.addEventListener('DOMContentLoaded', evaluateOverlay);
</script>
@endsection


@section('js')
@if(isset($auth_modal) && $auth_modal)
<script>
    window.openAuthModal = true;
</script>
@endif
@endsection