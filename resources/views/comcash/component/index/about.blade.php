
<div class='about'>
    <div class='about__container'>
        <h2 class='about__title'>
            <?php
                $text = __("front.cleaningPageText1");
                $text = mb_strtoupper($text);
                $text = explode(" ", $text);

                $first = $text[0];
                $second = array_slice($text, 1, -2);
                $second = implode(" ", $second);
                $third = @$text[count($text) - 2];
                $fourth = end($text);
            ?>
            {{$first}} <span class="green">{{$second}}</span> {{$third}} <span class="green">{{$fourth}}</span>
        </h2>
        <iframe id="about_video" class="video-js about__video" width="1000" height="500" src="https://www.youtube.com/embed/bAofntH1j-E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
        <div class='about__body'>
            <div class="about__colums">
                <div class="about__colums-item">
                    {{__("front.cleaningPageText1")}}
                </div>
                <div class="about__colums-item">
                    {{__("front.cleaningPageText2")}}
                </div>
            </div>
            <img src="/comcash/img/clean_crypto.png" class="about__clean-img"/>
            <div class="about__colums">
                <div class="about__colums-item">
                    {{__("front.cleaningPageText3")}}
                </div>
                <div class="about__colums-item">
                    {{__("front.cleaningPageText4")}}
                </div>
            </div>
        </div>
    </div>
</div>
