@extends('comcash.layout.main')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="tariffs__content">
            <div class="tariffs__header">
                <h1 class="tariffs__header-title">{{__("front.knowledge tariffs title")}}</h1>
            </div>

            <?php 
                echo \Illuminate\Support\Facades\Cache::get("comcash-view-tariffs", "loading");
            ?>

            <div class="tariffs__header">
                <h2 class="tariffs__header-title">{{__("front.knowledge tariffs title 2")}}</h2>
                <p class="tariffs__header-text">
                    {{__("front.knowledge tariffs description")}}
                </p>
            </div>

            <p class='tariffs__bottom'>
                {{__("front.knowledge tariffs footer 1")}} <a href='mailto:{{__("front.knowledge tariffs footer email")}}'>{{__("front.knowledge tariffs footer email")}}</a> {{__("front.knowledge tariffs footer 2")}}
            </p>
        </div>
      </div>
</div>
@endsection