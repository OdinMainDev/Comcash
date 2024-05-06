@extends('comcash.layout.knowledgebase')

@section('content')
<div class="info">
    <div class="info__container">
        @include("comcash.component.knowledge_menu")
        <div class="reviews__content">
            <div class="reviews__header">
                <p class="reviews__header-title">{{__("front.reviewsPageTitle")}}</p>
                <!-- <p class="reviews__header-text">
                    {{__("front.reviewsPageText")}}
                </p> -->
            </div>
            <div class="reviews__links">
                <div class="reviews__links-title">
                    Мониторинги и отзывы о нас:
                </div>
                <div class="reviews__links-list">
                    <a class="reviews__links-item" href="https://kurs.expert/ru/obmennik/comcash-io/feedbacks.html#stat">
                        https://kurs.expert/ru/obmennik/comcash-io/feedbacks.html#stat
                    </a>
                    <a class="reviews__links-item" href="https://antiswap.info/exchanger/ComCASH-otzyvy">
                        https://antiswap.info/exchanger/ComCASH-otzyvy
                    </a>
                    <a class="reviews__links-item" href="https://change.pro/exchangers/comcash">
                        https://change.pro/exchangers/comcash
                    </a>
                    <a class="reviews__links-item" href="https://www.okchanger.ru/exchangers/Comcash-io">
                        https://www.okchanger.ru/exchangers/Comcash-io
                    </a>
                    <a class="reviews__links-item" href="https://pro-obmen.ru/comcash#comments">
                        https://pro-obmen.ru/comcash#comments
                    </a>
                </div>
            </div>
            <div class="reviews__links">
                <div class="reviews__links-title">
                    Генеральные форумы:
                </div>
                <div class="reviews__links-list">
                    <a class="reviews__links-item" href="https://www.mywot.com/ru/user/8992061/ratings">
                        https://www.mywot.com/ru/user/8992061/ratings
                    </a>
                    <a class="reviews__links-item" href="https://forum.bits.media/index.php?/topic/234739-comcashio-безопасный-и-анонимный-обмен-криптовалют/#comment-2382429">
                        https://forum.bits.media/index.php?/topic/234739-comcashio-безопасный-и-анонимный-обмен-криптовалют/#comment-2382429
                    </a>
                    <a class="reviews__links-item" href="https://mmgp.com/threads/comcash-io-anonimnyj-obmennik.705047/">
                        https://mmgp.com/threads/comcash-io-anonimnyj-obmennik.705047/
                    </a>
                    <a class="reviews__links-item" href="https://bitcointalk.org/index.php">
                        https://bitcointalk.org/index.php
                    </a>
                    <a class="reviews__links-item" href="https://cryptotalk.org/topic/369354-comcashio-%D0%B0%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD%D0%BD%D0%B8%D0%BA/?tab=comments#comment-17731345">
                        https://cryptotalk.org/topic/369354-comcashio-%D0%B0%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD%D0%BD%D0%B8%D0%BA/?tab=comments#comment-17731345
                    </a>
                </div>
            </div>
            <div class="reviews__links">
                <div class="reviews__links-title">
                    Все форумы:
                </div>
                <div class="reviews__links-list">
                    <a class="reviews__links-item" href="https://zismo.biz/topic/1127812-comcashio-anonimnyj-obmen-i-chistka-kripty-bez-amlkyc/#entry19078800">
                        https://zismo.biz/topic/1127812-comcashio-anonimnyj-obmen-i-chistka-kripty-bez-amlkyc/#entry19078800
                    </a>
                    <a class="reviews__links-item" href="https://at.dublikat.club/threads/anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.196065/">
                        https://at.dublikat.club/threads/anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.196065/
                    </a>
                    <a class="reviews__links-item" href="https://cvvp.ro/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.32868/">
                        https://cvvp.ro/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.32868/
                    </a>
                    <a class="reviews__links-item" href="https://www.legalizer.cc/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.573034/">
                        https://www.legalizer.cc/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.573034/
                    </a>
                    <a class="reviews__links-item" href="https://zhyk.org/forum/showthread.php?p=6095627#post6095627">
                        https://zhyk.org/forum/showthread.php?p=6095627#post6095627
                    </a>
                    <a class="reviews__links-item" href="https://gofuckbiz.com/showthread.php?p=1343704#post1343704">
                        https://gofuckbiz.com/showthread.php?p=1343704#post1343704
                    </a>
                    <a class="reviews__links-item" href="https://itnull.info/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.3802/">
                        https://itnull.info/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.3802/
                    </a>
                    <a class="reviews__links-item" href="https://mipped.com/f/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.273885/">
                        https://mipped.com/f/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.273885/
                    </a>
                    <a class="reviews__links-item" href="https://wmasteru.org/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.33894/">
                        https://wmasteru.org/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.33894/
                    </a>
                    <a class="reviews__links-item" href="https://hard-tm.su/threads/38189/">
                        https://hard-tm.su/threads/38189/
                    </a>
                    <a class="reviews__links-item" href="https://instagramforum.ru/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.172423/">
                        https://instagramforum.ru/threads/comcash-io-%D0%90%D0%BD%D0%BE%D0%BD%D0%B8%D0%BC%D0%BD%D1%8B%D0%B9-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD-%D0%B8-%D1%87%D0%B8%D1%81%D1%82%D0%BA%D0%B0-%D0%BA%D1%80%D0%B8%D0%BF%D1%82%D1%8B-%D0%B1%D0%B5%D0%B7-aml-kyc.172423/
                    </a>
                    <a class="reviews__links-item" href="https://s2.vsemmoney.com/topic/157730-comcashio-anonimnyy-obmen-i-chistka-kripty-bez-amlkyc/">
                        https://s2.vsemmoney.com/topic/157730-comcashio-anonimnyy-obmen-i-chistka-kripty-bez-amlkyc/
                    </a>
                    <a class="reviews__links-item" href="https://megatop.biz/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.30077/">
                        https://megatop.biz/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.30077/
                    </a>
                    <a class="reviews__links-item" href="https://blb.team/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.5302/">
                        https://blb.team/threads/comcash-io-anonimnyj-obmen-i-chistka-kripty-bez-aml-kyc.5302/
                    </a>
                    <a class="reviews__links-item" href="https://cybhack.net/threads/2141/">
                        https://cybhack.net/threads/2141/
                    </a>
                    <a class="reviews__links-item" href="https://mehack.su/threads/6627/">
                        https://mehack.su/threads/6627/
                    </a>
                    <a class="reviews__links-item" href="https://h0t.cc/index.php?/topic/19991-comcashio-anonimnyy-obmen-i-chistka-kripty-bez-amlkyc/">
                        https://h0t.cc/index.php?/topic/19991-comcashio-anonimnyy-obmen-i-chistka-kripty-bez-amlkyc/
                    </a>
                </div>

            </div>
            <!-- <div class="reviews__form">
                <div class='label'>
                        <span>{{__("front.message")}}</span>
                    </div>
                    <textarea class="textarea" name="message"></textarea>
                    <button class='support__btn button' type='submit'>{{__("front.send message")}}</button>

                </div> -->
            <!-- <div class="reviews__slider-content">
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

            {{ $feedbacks->withPath(route("comcashPage", ["reviews"]))->onEachSide(1)->links() }} -->
        </div>
      </div>
</div>
@endsection
