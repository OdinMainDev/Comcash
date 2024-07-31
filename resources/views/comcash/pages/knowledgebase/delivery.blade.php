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
        <p class='delivery__bottom'>
            {{__("front.deliveryFooter1")}} <a href='mailto:{{__("front.deliveryFooter2")}}'>{{__("front.deliveryFooter2")}}</a> {{__("front.deliveryFooter3")}}
        </p>
      </div>
</div>
@endsection
