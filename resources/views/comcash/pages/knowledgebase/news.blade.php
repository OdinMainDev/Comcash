@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="events__content">
            <div class="events__header">
                <p class="events__header-title">Новости</p>
                <p class="events__header-text">В этом разделе мы предоставляем подробную информацию о нашей политике
                    безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для предотвращения
                    мошенничества и финансовых преступлений.</p>
            </div>

            <div class="slider events__slider">
            <div class="events__slider-content">
                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title1</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>
            </div>
            <div class="events__slider-content">
                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title2</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>

                <div class="events__slider-card">
                    <p class="events__slider-card-date">03.03.2033</p>
                    <p class="events__slider-card-title">Title</p>
                    <p class="events__slider-card-text"> предоставляем подробную информацию о нашей политике
                        безопасности, включая нашу систему проверки личности клиентов и мониторинга транзакций для
                        предотвращения</p>
                    <button class="button events__slider-card-btn">button</button>
                </div>
            </div>

            </div>

        </div>
      </div>
</div>
@endsection