@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="news-item">
            <p class="news-item__title">{{$news->getTitle()}} ({{date("H:i:s d.m.Y", $news->created_at->unix())}})</p>
            <p class="news-item__text">
                {!! $news->getContent() !!}
            </p>
        </div>
        <a class="support__btn button" href="{{route('index')}}">{{__("front.returnToHomePage")}}</a>
      </div>
</div>
@endsection
