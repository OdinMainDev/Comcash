<?php 
    $languages = config()->get("app.languages");
?>

<hr>
<h6 class="mb-2">{{__("common.translateTitles")}}</h6>
<div class="mb-3">
    <ul class="nav nav-tabs" id="tabMultilangTitles" role="tablist">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
                $lang_country = $lang;
                if($lang == "en"){
                    $lang_country = "us";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link @if($key == 0) active @endif" id="ml-titles-{{$lang}}-tab" data-toggle="tab" href="#ml-titles-{{$lang}}" role="tab" aria-controls="ml-titles-{{$lang}}" aria-selected="true">
                    <i class="flag-icon flag-icon-{{$lang_country}} mt-1" title="{{$lang_country}}"></i>  {{mb_strtoupper($lang)}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content border border-top-0 p-3" id="tabMultilangTitlesContent">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
            ?>
            <div class="tab-pane fade @if($key == 0) show active @endif" id="ml-titles-{{$lang}}" role="tabpanel" aria-labelledby="ml-titles-{{$lang}}-tab">
                <div class="mb-3">
                    <label for="mlTitle{{$lang}}" class="form-label">{{mb_strtoupper($lang)}}</label>
                    <input type="text" class="form-control" id="mlTitle{{$lang}}" name="mlTitle{{$lang}}" autocomplete="off" placeholder="..." value="{{isset($mlTitles[$lang]) ? $mlTitles[$lang] : ''}}">
                </div>
            </div>
        @endforeach
    </div>
</div>