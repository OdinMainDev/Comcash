@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="delivery__content">
            <div class="delivery__header">
                <p class="delivery__header-text">{{__("front.sitemap_page_title")}}</p>
                @foreach($directions as $direction)
                    <a href="{{route("exchgangePage", [$direction->currencyFrom->name,$direction->currencyTo->name])}}" class="delivery__header-text">
                        {{$direction->currencyFrom->name." -> ".$direction->currencyTo->name}}
                    </a>
                @endforeach
                @foreach($availPages as $page)
                    <a href="{{route("comcashPage", [$page])}}" class="delivery__header-text">
                        {{$page}}
                    </a>
                @endforeach
            </div>
      </div>
</div>
@endsection
