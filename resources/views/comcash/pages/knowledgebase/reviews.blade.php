@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="reviews__content">
            <div class="reviews__header">
            <p class="reviews__header-title">Отзывы</p>
            <p class="reviews__header-text">
                Не знаете, как выбрать обменник криптовалюты? Тогда ознакомьтесь с отзывами на сервис Comcash.io. Ежедневно
                сотни людей совершают обменные операции при помощи нашего сервиса. Мы гарантируем удобство, выгодные курсы,
                высокую скорость операций, безопасность и полную конфиденциальность. Чтобы вы были уверены в том, что
                сделали правильный выбор, мы рекомендуем прочитать отзывы на Comcash.io на этой странице.
                Ниже вы увидите самые свежие комментарии по работе нашего сервиса.
            </p>
            </div>
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

            {{ $feedbacks->onEachSide(1)->links() }}
        </div>
      </div>
</div>
@endsection
