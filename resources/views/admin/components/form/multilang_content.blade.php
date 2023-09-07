<?php 
    $languages = config()->get("app.languages");
?>

<hr>
<h6 class="mb-2">{{__("common.translateContents")}}</h6>
<div class="mb-3">
    <ul class="nav nav-tabs" id="tabMultilangContents" role="tablist">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
                $lang_country = $lang;
                if($lang == "en"){
                    $lang_country = "us";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link @if($key == 0) active @endif" id="ml-contents-{{$lang}}-tab" data-toggle="tab" href="#ml-contents-{{$lang}}" role="tab" aria-controls="ml-contents-{{$lang}}" aria-selected="true">
                    <i class="flag-icon flag-icon-{{$lang_country}} mt-1" title="{{$lang_country}}"></i>  {{mb_strtoupper($lang)}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content border border-top-0 p-3" id="tabMultilangContentsContent">
        @foreach($languages as $key => $lang)
            <?php 
                $lang = mb_strtolower($lang);
            ?>
            <div class="tab-pane fade @if($key == 0) show active @endif" id="ml-contents-{{$lang}}" role="tabpanel" aria-labelledby="ml-contents-{{$lang}}-tab">
                <div class="mb-3">
                    <label for="mlContent{{$lang}}" class="form-label">{{mb_strtoupper($lang)}}</label>
                    <textarea class="form-control ckeditor" id="mlContent{{$lang}}" name="mlContent{{$lang}}">
                        {{isset($mlContent[$lang]) ? $mlContent[$lang] : ''}}
                    </textarea>
                </div>
            </div>
        @endforeach
    </div>
</div>