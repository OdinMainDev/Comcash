@extends('comcash.layout.main')

@section('content')
<section class="review-section relative max-[620px]:mt-[40px] mt-[80px] mx-auto max-w-[1018px] overflow-hidden flex flex-col max-[1024px]:px-[20px]">
    <div class="flex flex-col items-center px-4 sm:px-6 md:px-10">
        <div class="w-full flex flex-col gap-[10px] text-[14px] text-white/40 transition-all duration-300 ease-in-out">
            <div data-form="register">
                <h2 class="text-[32px] font-bold mx-auto text-[#06AB6B] uppercase text-center">{{ __('front.createAccount') }}</h2>
                <p class="text-[#FFFFFF] text-[16px] text-center mb-[60px] max-[720px]:mb-[30px]">{{ __('front.registerWithEmail') }}</p>

                <form id="signup" action="{{route("registerPost")}}" class="backdrop-blur-xl rounded-lg space-y-6 w-full mx-auto max-w-[600px]">

                    <div class="relative w-full">
                        <input id="email" name="email" type="email" placeholder=" " required="" class="peer h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all">
                        <label for="email" class="pointer-events-none absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                            peer-placeholder-shown:top-[18px]
                            peer-placeholder-shown:text-base
                            peer-placeholder-shown:text-white/30
                            peer-focus:top-[8px]
                            peer-focus:text-sm
                            peer-focus:text-emerald-400
                            peer-[&amp;:not(:placeholder-shown)]:top-[8px]
                            peer-[&amp;:not(:placeholder-shown)]:text-sm
                            peer-[&amp;:not(:placeholder-shown)]:text-white">
                            E-mail
                        </label>
                    </div>

                    <div class="relative w-full js-pass-group">
                        <input
                            name="password"
                            type="password"
                            placeholder=" "
                            required
                            class="peer js-pass-input h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all" />
                        <label
                            class="pointer-events-none absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                    peer-placeholder-shown:top-[18px]
                                    peer-placeholder-shown:text-base
                                    peer-placeholder-shown:text-white/30
                                    peer-focus:top-[8px]
                                    peer-focus:text-sm
                                    peer-focus:text-emerald-400
                                    peer-[&:not(:placeholder-shown)]:top-[8px]
                                    peer-[&:not(:placeholder-shown)]:text-sm
                                    peer-[&:not(:placeholder-shown)]:text-white">
                            {{ __('front.password') }}
                        </label>

                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 js-pass-toggle invisible"
                            aria-label="Показать/скрыть пароль">
                            <span class="js-eye-show">
                                <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.00006 12.2475C7.20756 12.2475 5.75256 10.7925 5.75256 9C5.75256 7.2075 7.20756 5.7525 9.00006 5.7525C10.7926 5.7525 12.2476 7.2075 12.2476 9C12.2476 10.7925 10.7926 12.2475 9.00006 12.2475ZM9.00006 6.8775C7.83006 6.8775 6.87756 7.83 6.87756 9C6.87756 10.17 7.83006 11.1225 9.00006 11.1225C10.1701 11.1225 11.1226 10.17 11.1226 9C11.1226 7.83 10.1701 6.8775 9.00006 6.8775Z" fill="#06AB6B" />
                                    <path d="M8.99994 15.765C6.17994 15.765 3.51744 14.115 1.68744 11.25C0.892437 10.0125 0.892437 7.99502 1.68744 6.75002C3.52494 3.88502 6.18744 2.23502 8.99994 2.23502C11.8124 2.23502 14.4749 3.88502 16.3049 6.75002C17.0999 7.98752 17.0999 10.005 16.3049 11.25C14.4749 14.115 11.8124 15.765 8.99994 15.765ZM8.99994 3.36002C6.57744 3.36002 4.25994 4.81502 2.63994 7.35752C2.07744 8.23502 2.07744 9.76502 2.63994 10.6425C4.25994 13.185 6.57744 14.64 8.99994 14.64C11.4224 14.64 13.7399 13.185 15.3599 10.6425C15.9224 9.76502 15.9224 8.23502 15.3599 7.35752C13.7399 4.81502 11.4224 3.36002 8.99994 3.36002Z" fill="#06AB6B" />
                                </svg>
                            </span>
                            <span class="js-eye-hide hidden">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.10256 11.46C6.96006 11.46 6.81756 11.4075 6.70506 11.295C6.09006 10.68 5.75256 9.8625 5.75256 9C5.75256 7.2075 7.20756 5.7525 9.00006 5.7525C9.86256 5.7525 10.6801 6.09 11.2951 6.705C11.4001 6.81 11.4601 6.9525 11.4601 7.1025C11.4601 7.2525 11.4001 7.395 11.2951 7.5L7.50006 11.295C7.38756 11.4075 7.24506 11.46 7.10256 11.46ZM9.00006 6.8775C7.83006 6.8775 6.87756 7.83 6.87756 9C6.87756 9.375 6.97506 9.735 7.15506 10.05L10.0501 7.155C9.73506 6.975 9.37506 6.8775 9.00006 6.8775Z" fill="#666666" />
                                    <path d="M4.2 13.8825C4.0725 13.8825 3.9375 13.8375 3.8325 13.7475C3.03 13.065 2.31 12.225 1.695 11.25C0.900005 10.0125 0.900005 7.99502 1.695 6.75002C3.525 3.88502 6.1875 2.23502 9 2.23502C10.65 2.23502 12.2775 2.80502 13.7025 3.87752C13.95 4.06502 14.0025 4.41752 13.815 4.66502C13.6275 4.91252 13.275 4.96502 13.0275 4.77752C11.7975 3.84752 10.4025 3.36002 9 3.36002C6.5775 3.36002 4.26 4.81502 2.64 7.35752C2.0775 8.23502 2.0775 9.76502 2.64 10.6425C3.2025 11.52 3.8475 12.2775 4.56 12.8925C4.7925 13.095 4.8225 13.4475 4.62 13.6875C4.515 13.815 4.3575 13.8825 4.2 13.8825Z" fill="#666666" />
                                    <path d="M8.99992 15.765C8.00242 15.765 7.02742 15.5625 6.08992 15.165C5.80492 15.045 5.66992 14.715 5.78992 14.43C5.90992 14.145 6.23992 14.01 6.52492 14.13C7.31992 14.4675 8.15242 14.64 8.99242 14.64C11.4149 14.64 13.7324 13.185 15.3524 10.6425C15.9149 9.765 15.9149 8.235 15.3524 7.3575C15.1199 6.99 14.8649 6.6375 14.5949 6.3075C14.3999 6.0675 14.4374 5.715 14.6774 5.5125C14.9174 5.3175 15.2699 5.3475 15.4724 5.595C15.7649 5.955 16.0499 6.345 16.3049 6.75C17.0999 7.9875 17.0999 10.005 16.3049 11.25C14.4749 14.115 11.8124 15.765 8.99992 15.765Z" fill="#666666" />
                                    <path d="M9.51744 12.2025C9.25494 12.2025 9.01494 12.015 8.96244 11.745C8.90244 11.4375 9.10494 11.145 9.41244 11.0925C10.2374 10.9425 10.9274 10.2525 11.0774 9.42751C11.1374 9.12001 11.4299 8.92501 11.7374 8.97751C12.0449 9.03751 12.2474 9.33001 12.1874 9.63751C11.9474 10.935 10.9124 11.9625 9.62244 12.2025C9.58494 12.195 9.55494 12.2025 9.51744 12.2025Z" fill="#666666" />
                                    <path d="M1.49996 17.0625C1.35746 17.0625 1.21496 17.01 1.10246 16.8975C0.884956 16.68 0.884956 16.32 1.10246 16.1025L6.70496 10.5C6.92246 10.2825 7.28246 10.2825 7.49996 10.5C7.71746 10.7175 7.71746 11.0775 7.49996 11.295L1.89746 16.8975C1.78496 17.01 1.64246 17.0625 1.49996 17.0625Z" fill="#666666" />
                                    <path d="M10.8975 7.66502C10.755 7.66502 10.6125 7.61252 10.5 7.50002C10.2825 7.28252 10.2825 6.92252 10.5 6.70502L16.1025 1.10252C16.32 0.885017 16.68 0.885017 16.8975 1.10252C17.115 1.32002 17.115 1.68002 16.8975 1.89752L11.295 7.50002C11.1825 7.61252 11.04 7.66502 10.8975 7.66502Z" fill="#666666" />
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="relative w-full js-pass-group">
                        <input
                            name="repassword"
                            type="password"
                            placeholder=" "
                            required
                            class="peer js-pass-input h-[56px] w-full px-3 pt-5 pb-1 bg-transparent border border-white/10 rounded-md text-white placeholder-transparent focus:outline-none focus:border-emerald-500 transition-all" />
                        <label
                            class="pointer-events-none absolute left-3 top-[14px] text-white/40 text-sm transition-all duration-200
                                    peer-placeholder-shown:top-[18px]
                                    peer-placeholder-shown:text-base
                                    peer-placeholder-shown:text-white/30
                                    peer-focus:top-[8px]
                                    peer-focus:text-sm
                                    peer-focus:text-emerald-400
                                    peer-[&:not(:placeholder-shown)]:top-[8px]
                                    peer-[&:not(:placeholder-shown)]:text-sm
                                    peer-[&:not(:placeholder-shown)]:text-white">
                            {{ __('front.repeatPassword') }}
                        </label>

                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 js-pass-toggle invisible"
                            aria-label="Показать/скрыть пароль">
                            <span class="js-eye-show">
                                <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.00006 12.2475C7.20756 12.2475 5.75256 10.7925 5.75256 9C5.75256 7.2075 7.20756 5.7525 9.00006 5.7525C10.7926 5.7525 12.2476 7.2075 12.2476 9C12.2476 10.7925 10.7926 12.2475 9.00006 12.2475ZM9.00006 6.8775C7.83006 6.8775 6.87756 7.83 6.87756 9C6.87756 10.17 7.83006 11.1225 9.00006 11.1225C10.1701 11.1225 11.1226 10.17 11.1226 9C11.1226 7.83 10.1701 6.8775 9.00006 6.8775Z" fill="#06AB6B" />
                                    <path d="M8.99994 15.765C6.17994 15.765 3.51744 14.115 1.68744 11.25C0.892437 10.0125 0.892437 7.99502 1.68744 6.75002C3.52494 3.88502 6.18744 2.23502 8.99994 2.23502C11.8124 2.23502 14.4749 3.88502 16.3049 6.75002C17.0999 7.98752 17.0999 10.005 16.3049 11.25C14.4749 14.115 11.8124 15.765 8.99994 15.765ZM8.99994 3.36002C6.57744 3.36002 4.25994 4.81502 2.63994 7.35752C2.07744 8.23502 2.07744 9.76502 2.63994 10.6425C4.25994 13.185 6.57744 14.64 8.99994 14.64C11.4224 14.64 13.7399 13.185 15.3599 10.6425C15.9224 9.76502 15.9224 8.23502 15.3599 7.35752C13.7399 4.81502 11.4224 3.36002 8.99994 3.36002Z" fill="#06AB6B" />
                                </svg>
                            </span>
                            <span class="js-eye-hide hidden">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.10256 11.46C6.96006 11.46 6.81756 11.4075 6.70506 11.295C6.09006 10.68 5.75256 9.8625 5.75256 9C5.75256 7.2075 7.20756 5.7525 9.00006 5.7525C9.86256 5.7525 10.6801 6.09 11.2951 6.705C11.4001 6.81 11.4601 6.9525 11.4601 7.1025C11.4601 7.2525 11.4001 7.395 11.2951 7.5L7.50006 11.295C7.38756 11.4075 7.24506 11.46 7.10256 11.46ZM9.00006 6.8775C7.83006 6.8775 6.87756 7.83 6.87756 9C6.87756 9.375 6.97506 9.735 7.15506 10.05L10.0501 7.155C9.73506 6.975 9.37506 6.8775 9.00006 6.8775Z" fill="#666666" />
                                    <path d="M4.2 13.8825C4.0725 13.8825 3.9375 13.8375 3.8325 13.7475C3.03 13.065 2.31 12.225 1.695 11.25C0.900005 10.0125 0.900005 7.99502 1.695 6.75002C3.525 3.88502 6.1875 2.23502 9 2.23502C10.65 2.23502 12.2775 2.80502 13.7025 3.87752C13.95 4.06502 14.0025 4.41752 13.815 4.66502C13.6275 4.91252 13.275 4.96502 13.0275 4.77752C11.7975 3.84752 10.4025 3.36002 9 3.36002C6.5775 3.36002 4.26 4.81502 2.64 7.35752C2.0775 8.23502 2.0775 9.76502 2.64 10.6425C3.2025 11.52 3.8475 12.2775 4.56 12.8925C4.7925 13.095 4.8225 13.4475 4.62 13.6875C4.515 13.815 4.3575 13.8825 4.2 13.8825Z" fill="#666666" />
                                    <path d="M8.99992 15.765C8.00242 15.765 7.02742 15.5625 6.08992 15.165C5.80492 15.045 5.66992 14.715 5.78992 14.43C5.90992 14.145 6.23992 14.01 6.52492 14.13C7.31992 14.4675 8.15242 14.64 8.99242 14.64C11.4149 14.64 13.7324 13.185 15.3524 10.6425C15.9149 9.765 15.9149 8.235 15.3524 7.3575C15.1199 6.99 14.8649 6.6375 14.5949 6.3075C14.3999 6.0675 14.4374 5.715 14.6774 5.5125C14.9174 5.3175 15.2699 5.3475 15.4724 5.595C15.7649 5.955 16.0499 6.345 16.3049 6.75C17.0999 7.9875 17.0999 10.005 16.3049 11.25C14.4749 14.115 11.8124 15.765 8.99992 15.765Z" fill="#666666" />
                                    <path d="M9.51744 12.2025C9.25494 12.2025 9.01494 12.015 8.96244 11.745C8.90244 11.4375 9.10494 11.145 9.41244 11.0925C10.2374 10.9425 10.9274 10.2525 11.0774 9.42751C11.1374 9.12001 11.4299 8.92501 11.7374 8.97751C12.0449 9.03751 12.2474 9.33001 12.1874 9.63751C11.9474 10.935 10.9124 11.9625 9.62244 12.2025C9.58494 12.195 9.55494 12.2025 9.51744 12.2025Z" fill="#666666" />
                                    <path d="M1.49996 17.0625C1.35746 17.0625 1.21496 17.01 1.10246 16.8975C0.884956 16.68 0.884956 16.32 1.10246 16.1025L6.70496 10.5C6.92246 10.2825 7.28246 10.2825 7.49996 10.5C7.71746 10.7175 7.71746 11.0775 7.49996 11.295L1.89746 16.8975C1.78496 17.01 1.64246 17.0625 1.49996 17.0625Z" fill="#666666" />
                                    <path d="M10.8975 7.66502C10.755 7.66502 10.6125 7.61252 10.5 7.50002C10.2825 7.28252 10.2825 6.92252 10.5 6.70502L16.1025 1.10252C16.32 0.885017 16.68 0.885017 16.8975 1.10252C17.115 1.32002 17.115 1.68002 16.8975 1.89752L11.295 7.50002C11.1825 7.61252 11.04 7.66502 10.8975 7.66502Z" fill="#666666" />
                                </svg>
                            </span>
                        </button>
                    </div>

                    <button type="submit" class="w-full text-white py-3 rounded-full text-[18px] transition h-[62px] shadow-[0px_4px_20px_0px_#00000026] hover:opacity-90" style="background:linear-gradient(0deg,#009C74,#009C74),linear-gradient(95.62deg,#06AB6B 70.57%,#009C74 383.64%);">{{ __('front.continue') }}</button>
                </form>
                <p class="text-center text-[12px] text-white/40 mt-3">
                    {{ __('front.privacyPolicyAgreement') }}
                    <a href='{{route("comcashPage", ["rules"])}}' class="text-[#FFFFFF] hover:opacity-70 transition-opacity ml-1 underline decoration-[1.3px] underline-offset-[2px]">
                        {{ __('front.privacyPolicy') }}!
                    </a>
                </p>
            </div>
            <p class="text-center text-[16px] text-white mt-4">
                {{ __('front.alreadyHaveAccount') }}
                <a href="{{route("login")}}" class="text-[#06AB6B] hover:opacity-70 transition-opacity ml-1">
                    {{ __('front.loginToAccount') }}
                </a>
            </p>
        </div>


    </div>

</section>
@endsection