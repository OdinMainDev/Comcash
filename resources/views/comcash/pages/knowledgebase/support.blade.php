@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="support__content">
            <p class="support__title">{{__("front.support")}}</p>
            <div class="support__row">
            <form class="support__form" action="{{route("comcashSupport")}}">
                <div class="support__form-row">
                    <div class="input-control">
                        <div class='label'>
                            <span>{{__("front.your name")}}</span>
                        </div>
                        <input type="text" name="name" @auth value="{{auth()->user()->first_name." ".auth()->user()->second_name." ".auth()->user()->last_name}}" @endauth class="input input--large">
                    </div>
                    
                    <div class="input-control">
                        <div class='label'>
                            <span>{{__("front.exchange id")}}</span>
                        </div>
                        <input type="text" name="exchange_id" class="input input--large">
                    </div>
                </div>
                <div class="input-control">
                    <div class='label'>
                        <span>Email</span>
                    </div>
                    <input type="email" name="email" @auth value="{{auth()->user()->email}}" @endauth class="input input--large">
                </div>
                <div class='label'>
                    <span>{{__("front.message")}}</span>
                </div>
                <textarea class="textarea" name="message"></textarea>

                <button class='support__btn button' type='submit'>{{__("front.send message")}}</button>
            </form>
            <div class="support__contacts">
                <p class="support__contacts-title">{{__("front.Would you like to contact us directly?")}}</p>
                <p class="support__contacts-subtitle">{{__("front.Use our contacts")}}</p>
                <a class="support__contacts-link">
                    <img src="/comcash/img/globus.svg" alt="">
                    <span>support@comcash.io</span>
                </a>
                <a class="support__contacts-link">
                    <img src="/comcash/img/globus.svg" alt="">
                    <span>support@comcash.io</span>
                </a>
            </div>

            </div>
        </div>
      </div>
</div>
@endsection