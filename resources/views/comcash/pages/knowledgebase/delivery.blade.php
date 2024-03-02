@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="delivery__content">
            <div class="delivery__header">
                <p class="delivery__header-title">{{__("front.page_delivery_title")}}</p>
                <p class="delivery__header-text">{{__("front.page_delivery_description")}}</p>
            </div>

            <div class='delivery__features'>
                <p class="delivery__features-title">{{__("front.page_delivery_title2")}}</p>
                <div class='delivery__features-row'>
                    <div class='delivery__features-item'>
                        <div class="delivery__features-item-number">1</div>
                        <p class='delivery__features-item-title'>{{__("front.page_delivery_advantage_1_title")}}</p>
                        <p class='delivery__features-item-text'>{{__("front.page_delivery_advantage_1_content")}}</p>
                    </div>
                    <div class='delivery__features-item'>
                        <div class="delivery__features-item-number">2</div>
                        <p class='delivery__features-item-title'>{{__("front.page_delivery_advantage_2_title")}}</p>
                        <p class='delivery__features-item-text'>{{__("front.page_delivery_advantage_2_content")}}</p>
                    </div>
                    <div class='delivery__features-item'>
                        <div class="delivery__features-item-number">3</div>
                        <p class='delivery__features-item-title'>{{__("front.page_delivery_advantage_3_title")}}</p>
                        <p class='delivery__features-item-text'>{{__("front.page_delivery_advantage_3_content")}}</p>
                    </div>
                </div>
            </div>

            <p class="delivery__accordion-title">{{__("front.deliveryFaqTitle")}} </p>
            <div class="delivery__accordion accordion accordion--secondary">

                <button class='accordion__button'>
                    <span>{{__("front.deliveryFaqTitle1")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class='accordion__text'>
                        {{__("front.deliveryFaqText1")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.deliveryFaqTitle2")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class='accordion__text'>
                        {{__("front.deliveryFaqText2")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.deliveryFaqTitle3")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class='accordion__text'>
                        {{__("front.deliveryFaqText3")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.deliveryFaqTitle4")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class='accordion__text'>
                        {{__("front.deliveryFaqText4")}}
                    </div>
                </div>

                <button class='accordion__button'>
                    <span>{{__("front.deliveryFaqTitle5")}}</span>
                </button>
                <div class='accordion__content'>
                    <div class='accordion__text'>
                        {{__("front.deliveryFaqText5")}}
                    </div>
                </div>
            </div>


        <p class='delivery__bottom'>
            {{__("front.deliveryFooter1")}} <a href='mailto:{{__("front.deliveryFooter2")}}'>{{__("front.deliveryFooter2")}}</a> {{__("front.deliveryFooter3")}}
        </p>
      </div>
</div>
@endsection
