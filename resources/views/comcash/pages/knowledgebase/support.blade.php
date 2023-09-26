@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="support__content">
            <p class="support__title">Support</p>
            <div class="support__row">
            <form action=""
                    class="support__form">
                <div class="support__form-row">
                <div class="input-control">
                    <div class='label'>
                    <span>name</span>
                    </div>
                    <input type="text"
                        class="input input--large">
                </div>
                <div class="input-control">
                    <div class='label'>
                    <span>email</span>
                    </div>
                    <input type="text"
                        class="input input--large">
                </div>
                </div>
                <div class="support__form-row">
                <div class="input-control">
                    <div class='label'>
                    <span>exchange id</span>
                    </div>
                    <input type="text"
                        class="input input--large">
                </div>
                <div class="input-control">
                    <div class='label'>
                    <span>reason</span>
                    </div>
                    <input type="text"
                        class="input input--large">
                </div>
                </div>

                <div class='label'>
                <span>message</span>
                </div>
                <textarea class="textarea"></textarea>

                <button class='support__btn button'
                        type='submit'>Sign in</button>
            </form>
            <div class="support__contacts">
                <p class="support__contacts-title">Хотите связаться с нами напрямую?
                </p>
                <p class="support__contacts-subtitle">
                Воспользуйтесь нашими контактами
                </p>
                <a class="support__contacts-link">
                <img src="/comcash/img/globus.svg"
                    alt="">
                <span>support@comcash.io</span>
                </a>
                <a class="support__contacts-link">
                <img src="/comcash/img/globus.svg"
                    alt="">
                <span>support@comcash.io</span>
                </a>
            </div>

            </div>
        </div>
      </div>
</div>
@endsection