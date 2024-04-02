@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="company__content">
            <div class="company__header">
            <p class="company__header-title">{{__("front.page_about_title")}}</p>
            <p class="company__header-text">{{__("front.page_about_desc_1")}}</p>
            </div>

            <div class='company__features'>
            <p class="company__features-title">{{__("front.page_about_title_2")}}</p>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-1'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_1_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_1_content")}}</p>
                </div>
                <div class='company__features-item company__features-item-2'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_2_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_2_content")}}</p>
                </div>
            </div>
            <div class='company__features-row'>
                <div class='company__features-item company__features-item-3'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_3_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_3_content")}}</p>
                </div>
                <div class='company__features-item company__features-item-4'>
                    <p class='company__features-item-title'>{{__("front.page_about_advantage_4_title")}}</p>
                    <p class='company__features-item-text'>{{__("front.page_about_advantage_4_content")}}</p>
                </div>
            </div>
            </div>

            <div class="company__about">
            <p class="company__about-title">{{__("front.page_about_title_3")}}</p>
            <p class="company__about-text">
                {{__("front.page_about_desc_2")}}
                <br/><br/>
                {{__("front.page_about_desc_3")}}
            </p>
            </div>

            <div class="company__products">
            <p class="company__products-title">{{__("front.page_about_title_4")}}</p>
            <div class="company__products-body">

                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_1_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_1_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="{{route("index")}}">{{__("front.page_about_product_try_it")}} &rarr;</a>
                </div>
                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_2_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_2_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="{{route("comcashPage", ["delivery"])}}">{{__("front.page_about_product_try_it")}} &rarr;</a>
                </div>
                <div class="company__products-item">
                    <div class="company__products-card">
                        <p class="company__products-card-title">
                            {{__("front.page_about_product_3_title")}}
                        </p>
                        <p class="company__products-card-text">
                            {{__("front.page_about_product_3_content")}}
                        </p>
                    </div>
                    <a class="company__products-btn" href="https://amlcheck.pw">{{__("front.page_about_product_try_it")}} &rarr;</a>
                </div>

            </div>

            </div>

            <div class="company__advantages">
                <div class="company__advantages-row">
                    <div class="company__advantages-item">
                        <p class="company__advantages-title">{{__("front.companyAdvantageTitle1")}}</p>
                        <p class="company__advantages-text">{{__("front.companyAdvantageText1")}}</p>
                    </div>
                    <div class="company__advantages-item">
                        <p class="company__advantages-title">{{__("front.companyAdvantageTitle2")}}</p>
                        <p class="company__advantages-text">
                            {{__("front.companyAdvantageText2_1")}}
                            {{__("front.companyAdvantageText2_2")}}
                            {{__("front.companyAdvantageText2_3")}}
                            {{__("front.companyAdvantageText2_4")}}
                        </p>
                    </div>
                </div>
                <div class="company__advantages-row">
                    <div class="company__advantages-item">
                        <p class="company__advantages-title">{{__("front.companyAdvantageTitle3")}}</p>
                        <p class="company__advantages-text">{{__("front.companyAdvantageText3")}}</p>
                    </div>
                </div>
            </div>

            <div class="company__faq accordion accordion--secondary">
                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle1")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText1")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle2")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText2")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle3")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText3")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle4")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText4")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle5")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText5")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle6")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText6")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle7")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText7")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.companyFaqTitle8")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class="accordion__text">
                        {{__("front.companyFaqText8")}}
                    </div>
                </div>
            </div>

        </div>
      </div>
</div>
@endsection
