@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="support__content">
            <p class="support__title">{{__("front.support")}}</p>
            <!-- <p class="support__text">{{__("front.page_support_desc_1")}}</p>
            <p class="support__text">{{__("front.page_support_desc_2")}}</p> -->
            <!-- <br/> -->
            <!-- <ul>
                <li>{{__("front.page_support_ul_1")}}</li>
                <li>{{__("front.page_support_ul_2")}}</li>
                <li>{{__("front.page_support_ul_3")}}</li>
                <li>{{__("front.page_support_ul_4")}}</li>
            </ul> -->
            <!-- <br/> -->
            <!-- <p class="support__text">{{__("front.page_support_desc_3")}}</p> -->
            <!-- <p class="support__text">{{__("front.page_support_desc_4")}}</p> -->
            <div class="support__row">
            <form class="support__form" action="{{route("comcashSupport")}}">
                @csrf
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
                <a class="support__contacts-link" href="https://t.me/comcash_exchange">
                    <img src="/comcash/img/icons/green-telegram.svg" alt="">
                    <span>@comcash_exchange</span>
                </a>
                <a class="support__contacts-link">
                    <img src="/comcash/img/icons/qtox.svg" alt="">
                    <span>qTox: 44F916D1AEA991BD510171AD4E48BCB80E34702A11FA9295E7C541FB67A32D762588CFCB44B9</span>
                </a>
                <a class="support__contacts-link">
                    <img src="/comcash/img/icons/jobber.svg" alt="">
                    <span>Jobber: Comcash@exploit.im</span>
                </a>
                <a class="support__contacts-link">
                    <img src="/comcash/img/icons/jobber.svg" alt="">
                    <span>Jobber: Comcash_support@exploit.im</span>
                </a>
            </div>

            </div>
        </div>
      </div>
</div>
@endsection