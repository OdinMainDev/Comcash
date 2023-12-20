@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="events__content">
            <div class="events__header">
                <p class="events__header-title">{{__("front.page_news_title")}}</p>
                <p class="events__header-text">{{__("front.page_news_desc_1")}}</p>
                <br/>
                <p class="events__header-text">{{__("front.page_news_desc_2")}}</p>
            </div>

            <div class="events__slider-content">
                @if(isset($news) && count($news) > 0)
                    @foreach($news as $key => $item)
                        <div class="events__slider-card">
                            <p class="events__slider-card-date">{{date("H:i:s d.m.Y", $item->created_at->unix())}}</p>
                            <p class="events__slider-card-title">{{$item->getTitle()}}</p>
                            <p class="events__slider-card-text"> {{ Str::limit(strip_tags($item->getContent()), 100, '...') }}</p>
                            <a class="button events__slider-card-btn" href="{{route('comcashNewsItem', [$item->id])}}">{{__("front.read")}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
            
            {{ $news->onEachSide(1)->links() }}
        </div>
      </div>
</div>
@endsection
