@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="faq__content">
            <div class="faq__bg"></div>
            <div class="faq__header">
            <p class="faq__header-title">{{__("front.faqPageTitle")}}</p>
            <div class="faq__title">{{__("front.faqPageText1")}}</div>
            <div class="faq__subtitle">{{__("front.faqPageText2")}}</div>

            <p class="faq__header-text">
                {{__("front.faqPageText3")}}
            </p>
            <div class="faq__subtitle">{{__("front.faqPageText4")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText5")}}
            </p>
            <div class="faq__title">{{__("front.faqPageText6")}}</div>
            <div class="faq__subtitle">{{__("front.faqPageText7")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText8")}}
            </p>
            <p class="faq__header-text">
                {{__("front.faqPageText9")}}
            </p>
            <div class="faq__subtitle">{{__("front.faqPageText10")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText11")}}
            </p>
            <div class="faq__subtitle">{{__("front.faqPageText12")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText13")}}
            </p>
            <p class="faq__header-text">
                {{__("front.faqPageText14")}}
            </p>
            <div class="faq__subtitle">{{__("front.faqPageText15")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText16")}}
            </p>
            <div class="faq__title">{{__("front.faqPageText17")}}</div>
            <div class="faq__subtitle">{{__("front.faqPageText18")}}</div>
            <p class="faq__header-text">
                {{__("front.faqPageText19")}}
            </p>
        </div>

            <div class="faq__accordion accordion accordion--secondary">
            <button class='accordion__button active'>
                <span>{{__("front.faqPageFaqTitle")}}</span>
            </button>
            <div class='accordion__content active'>
                <div class='accordion__text'>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText1")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText2")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText3")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText4")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText5")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText6")}}</p>
                </div>
            </div>

            <button class='accordion__button active'>
                <span>{{__("front.faqPageFaqTitle2")}}</span>
            </button>
            <div class='accordion__content'>
                <div class='accordion__text'>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText7")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText8")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText9")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText10")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText11")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText12")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText13")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText14")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText15")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText16")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText17")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText18")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText19")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText20")}}</p>
                </div>
            </div>

            <button class='accordion__button active'>
                <span>{{__("front.faqPageFaqTitle3")}}</span>

            </button>
            <div class='accordion__content'>
                <div class='accordion__text'>
                    <a  href="{{route("comcashPage", ["rules"])}}" class="faq__accordion-title">{{__("front.faqPageFaqText21")}}</a>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText22")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText23")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText24")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText25")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText26")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText27")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText28")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText29")}}</p>
                    <p class="faq__accordion-title">{{__("front.faqPageFaqText30")}}</p>
                    <p class="faq__accordion-text">{{__("front.faqPageFaqText31")}}</p>
                </div>
            </div>
            </div>
        </div>
      </div>
</div>
@endsection
