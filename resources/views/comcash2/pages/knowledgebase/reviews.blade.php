@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="reviews__content">
            <div class="reviews__header">
                <p class="reviews__header-title">{{__("front.reviewsPageTitle")}}</p>
                <p class="reviews__header-text">
                    {{__("front.reviewsPageText")}}
                </p>
            </div>
            <!-- <div class="reviews__form">
                <div class='label'>
                        <span>{{__("front.message")}}</span>
                    </div>
                    <textarea class="textarea" name="message"></textarea>
                    <button class='support__btn button' type='submit'>{{__("front.send message")}}</button>

                </div> -->
            <div class="reviews__slider-content">
                @if(isset($feedbacks) && count($feedbacks) > 0)
                    @foreach($feedbacks as $item)
                        <div class="reviews__slider-card">
                            <p class="reviews__slider-card-date">{{date("H:i:s d.m.Y", $item->created_at->unix())}}</p>
                            <p class="reviews__slider-card-title">{{$item->name}}</p>
                            <p class="reviews__slider-card-text"> {{$item->text}}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            {{ $feedbacks->withPath(route("comcashPage", ["reviews"]))->onEachSide(1)->links() }}
        </div>
      </div>
</div>
@endsection
