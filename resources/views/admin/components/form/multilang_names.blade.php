<?php 
    $languages = config()->get("app.languages");
?>

<hr>
<h6 class="mb-2">{{__("common.translateNames")}}</h6>
<div class="mb-3">
    <ul class="nav nav-tabs" id="tabMultilangNames" role="tablist">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
                $lang_country = $lang;
                if($lang == "en"){
                    $lang_country = "us";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link @if($key == 0) active @endif" id="ml-names-{{$lang}}-tab" data-toggle="tab" href="#ml-names-{{$lang}}" role="tab" aria-controls="ml-names-{{$lang}}" aria-selected="true">
                    <i class="flag-icon flag-icon-{{$lang_country}} mt-1" title="{{$lang_country}}"></i>  {{mb_strtoupper($lang)}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content border border-top-0 p-3" id="tabMultilangNamesContent">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
            ?>
            <div class="tab-pane fade @if($key == 0) show active @endif" id="ml-names-{{$lang}}" role="tabpanel" aria-labelledby="ml-names-{{$lang}}-tab">
                <div class="mb-3">
                    <label for="mlName{{$lang}}" class="form-label">{{mb_strtoupper($lang)}}</label>
                    <input type="text" class="form-control" id="mlName{{$lang}}" name="mlName{{$lang}}" autocomplete="off" placeholder="..." value="{{isset($mlNames[$lang]) ? $mlNames[$lang] : ''}}">
                </div>
            </div>
        @endforeach
    </div>
</div>