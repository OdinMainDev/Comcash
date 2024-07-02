<div class="main-banner"  id="main-banner">
    <div class="main-banner__content">
        <div class="main-banner__close" id="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFF"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        </div>
        <div class="main-banner__text">
            <div>
                <span>
                    {{__("front.banner_index_1")}}
                </span>
            </div>
            <div>
                <span>
                <?php
                    $text = __("front.banner_index_2");
                    $text = mb_strtoupper($text);
                    $text = explode(" ", $text);
                    $first = array_slice($text, 0, 4);
                    $second = array_slice($text, 4, 2);
                    $third = array_slice($text, 5);

                ?>
                    {{implode(" ", $first)}} 
                    <span class="green">{{implode(" ", $second)}}</span> 
                    {{implode(" ", $third)}}
                    
                </span>
            </div>
        </div>
        <div class="main-banner__footer">
            <div>
            <?php
                    $text = __("front.banner_index_3");
                    $text = mb_strtoupper($text);
                    $textExploaded = explode(" ", $text);
                    $lastWord = end($textExploaded);
                    $text = str_replace($lastWord, "", $text)
                ?>
                {{$text}} <a href="{{route('comcashPage',[ 'name' => 'reputation' ])}}" class="green underline">{{$lastWord}}</a>
            </div>
            <div>
                {{__("front.banner_index_4")}} Com<span class="green">Cash</span>
            </div>
        </div>
    </div>
</div>
