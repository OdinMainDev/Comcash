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
                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title1</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>
                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title2</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">New!</button>
                </div>
            </div>
            <div class="events__pagination">
                <div class="pagination">
                <div class="pagination__item pagination__prev">
                    <img src="/comcash/img/icons/prev.svg" alt="prev"/>
                </div>
                <div class="pagination__item active">
                    1
                </div>
                <div class="pagination__item">
                    2
                </div>
                <div class="pagination__item">
                    3
                </div>
                <div class="pagination__item pagination__next">
                    <img src="/comcash/img/icons/next.svg" alt="next"/>
                </div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection
