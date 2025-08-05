@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="company__content">
            <div class="company-form">
                <img class="company-form__logo" src="/comcash/img/logo.svg">
                <div class="company-form__descr">
                    {{__("front.anonymousFormDescription")}}
                </div>
                <form class="company-form__form">
                    <label class="company-form__label">
                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 1.99574C20 0.893521 19.1253 0 18.0464 0H1.9536C0.874654 0 0 0.893521 0 1.99574V15.0043C0 16.1065 0.874654 17 1.9536 17H18.0464C19.1253 17 20 16.1065 20 15.0043V1.99574ZM1.96407 1.59488H18.0617C18.2772 1.59488 18.4506 1.77042 18.4506 1.99053V2.00785L10.2888 10.3466C10.1892 10.4483 10.0734 10.4635 10.013 10.4635C9.95255 10.4635 9.83636 10.4483 9.73678 10.3466L1.57303 2.00671V1.99053C1.57303 1.77042 1.74862 1.59488 1.96407 1.59488ZM18.0617 15.4051H1.96407C1.74862 15.4051 1.57303 15.2229 1.57303 15.0028V4.26463L8.63189 11.4756C9.00087 11.8526 9.49154 12.0601 10.0134 12.0601C10.5352 12.0601 11.0249 11.8525 11.3939 11.4756L18.4506 4.26576V15.0028C18.4506 15.2229 18.2772 15.4051 18.0617 15.4051Z" fill="#0A9B72" />
                        </svg>
                        <input placeholder="Введите ваш jabber" class="company-form__input" name="contactjabber">
                    </label>
                    <label class="company-form__label">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.3 21.3998C5.83803 20.7972 8.35789 18.0243 9.09634 18.0243H16.9041C17.9742 18.0243 20.1586 20.3229 20.7 21.1331M24.2 12.9998C24.2 19.1854 19.1856 24.1998 13 24.1998C6.81441 24.1998 1.8 19.1854 1.8 12.9998C1.8 6.81422 6.81441 1.7998 13 1.7998C19.1856 1.7998 24.2 6.81422 24.2 12.9998ZM17.012 9.18242C17.012 7.04566 15.2082 5.2998 13.0003 5.2998C10.7926 5.2998 8.9887 7.04566 8.9887 9.18242C8.9887 11.3192 10.7926 13.065 13.0003 13.065C15.2081 13.065 17.012 11.3192 17.012 9.18242Z" stroke="#0A9B72" stroke-width="2" />
                        </svg>
                        <input placeholder="Введите ваш TOX" class="company-form__input" name="contacttox">
                    </label>
                    <button class="button w-[100%] h-[50px] mt-[20px]" type="submit" >{{__("front.contectUs")}}</button>
                </form>
            </div>
            @include("comcash.component.index.about")
        </div>
      </div>
</div>
@endsection
