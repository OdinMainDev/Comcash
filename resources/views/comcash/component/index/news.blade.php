@if(isset($news) && count($news) > 0)
    <div class='news'>
        <div class='news__container'>
            <p class='news__title'>{{__("front.stay tuned")}}</p>
            <div class='news__content'>
                @foreach($news as $key => $item)
                    @if($key <= 3)
                        <div class='news__card'>
                            <a class='news__card-title' href="{{route('comcashNewsItem', [$item->id])}}">{!! $item->getTitle() !!}</a>
                            <p class='news__card-text'>{!!  Str::limit(html_entity_decode(strip_tags($item->getContent())), 100, '...') !!}</p>
                            <div class='news__card-footer'>
                                <img src='/comcash/img/logo.png' alt='' class='news__card-footer-img'/>
                                <div class='news__card-footer-info'>
                                    <p class='news__card-footer-social'>{!! ucfirst(mb_strtolower(env("THEME_NAME", "Comcash"))) !!}</p>
                                    <p class='news__card-footer-date'>{{date("H:i:s d.m.Y", $item->created_at->unix())}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <a href="{{route("comcashPage", ["news"])}}" class='news__button button button_big'>{{__("front.read all news")}}</a>
        </div>
    </div>
@endif