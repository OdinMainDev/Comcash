@if(isset($news) && count($news) > 0)
    <div class='news'>
        <div class='news__container'>
            <p class='news__title'>{{__("front.stay tuned")}}</p>
            <div class='news__content'>
                @foreach($news as $item)
                    <div class='news__card'>
                        <p class='news__card-title'>{{$item->getTitle()}}</p>
                        <p class='news__card-text'>{{ Str::limit(strip_tags($item->getContent()), 100, '...') }}
                        </p>
                        <div class='news__card-footer'>
                            <img src='/comcash/img/logo.png' alt='' class='news__card-footer-img'/>
                            <div class='news__card-footer-info'>
                                <p class='news__card-footer-social'>{{ucfirst(mb_strtolower(env("THEME_NAME", "Comcash")))}}</p>
                                <p class='news__card-footer-date'>{{$item->created_at}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{route("comcashPage", ["news"])}}" class='news__button button'>{{__("front.read all news")}}</a>
        </div>
    </div>
@endif