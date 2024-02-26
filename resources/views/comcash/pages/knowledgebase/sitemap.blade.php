@extends('comcash.layout.knowledgebase')
@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="sitemap__content">
            <div class="sitemap__header">
                <p class="sitemap__header-title">{{__("front.sitemap_page_title")}}</p>
            </div> 
            <div class="sitemap__list">
                <div class="sitemap__list-item">
                    @foreach($directions as $direction)
                        <a href="{{route("exchgangePage", [$direction->currencyFrom->name,$direction->currencyTo->name])}}" class="delivery__header-text">
                            {{$direction->currencyFrom->name." -> ".$direction->currencyTo->name}}
                        </a>
                    @endforeach
                </div>
                <!-- <div class="sitemap__list-item">
                    @foreach($availPages as $page)
                        <a href="{{route("comcashPage", [$page])}}" class="delivery__header-text">
                            {{$page}}
                        </a>
                    @endforeach
                </div> -->
            </div>   
      </div>
</div>
@endsection
