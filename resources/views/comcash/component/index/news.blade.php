@if(isset($news) && count($news) > 0)
    <div class='news'>
        <div class='news__container'>
            <h3 class='news__title'>{{__("front.stay tuned")}}</h3>
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
<div class='welcome'>
    <div class='welcome__container'>
        <div class="welcome__panel-container">
            <div class="welcome__descr">
                <h1 class="welcome__descr-title">
                    <?php 
                        $text = __("front.indexSidePanelText1");
                        $text = explode(" ", $text);

                        $first = $text[0];
                        $second = array_slice($text, 1, -2);
                        $second = implode(" ", $second);
                        $third = @$text[count($text) - 2];
                        $fourth = end($text);
                    ?>
                    <span class="green">{{$first}}</span> {{$second}} <span class="green">{{$third}}</span> <span class="underline">{{$fourth}}</span>
                </h1>
                <ul class="welcome__descr-list">
                    <?php 
                        $text = __("front.indexSidePanelText3");
                        $text = explode(" ", $text);

                        $first = implode(" ", array_slice($text, 0, 2));
                        $second = @$text[2];
                        $third = implode(" ", array_slice($text, 3));

                    ?>
                    <li>
                        {{$first}} <span class="green">{{$second}}</span> {{$third}}
                    </li>
                    <?php 
                        $text = __("front.indexSidePanelText4");
                        $text = explode(" ", $text);

                        $first = implode(" ", array_slice($text, 0, 4));
                        $second = @$text[4];
                        $third = implode(" ", array_slice($text, 5, 2));
                        $fourth = @$text[7];
                        $fifth = implode(" ", array_slice($text, 8));

                    ?>
                    <li>                    
                        {{$first}} <span class="green">{{$second}}</span> {{$third}} 
                        <span class="green">{{$fourth}}</span> {{$fifth}}
                    </li>
                    <li>
                        {{__("front.indexSidePanelText5")}}
                    </li>
                </ul>
                <div class="welcome__descr-copyright">
                    {{__("front.indexSidePanelText6")}}
                </div>
                <div class="welcome__descr-copyright">Com<span class="green">CASH</span></div>
            </div>
        </div>
    </div>
</div>