<div class="row">
    @if(isset($model))
        <div class="col-md-12 mb-3">
            <label for="name" class="form-label">{{__("common.name")}}</label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="BTC -> ETH" value="{{@$model->name}}">
        </div>
    @endif
    <div class="col-md-4 mb-3">
        <label for="position" class="form-label">{{__("common.position")}}</label>
        <input type="text" class="form-control" id="position" name="position" autocomplete="off" placeholder="5" value="{{@$model->position}}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="profit_percent" class="form-label">{{__("common.profit_percent")}}</label>
        <input type="text" class="form-control" id="profit_percent" name="profit_percent" autocomplete="off" placeholder="2.5" value="{{@$model->profit_percent}}">
    </div>
    <div class="col-md-4 mb-3">
        <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
        <select class="form-select" id="enabled" name="enabled">
            <option value="0" @if(isset($model) && !$model->status) selected @endif>{{__("common.enable0")}}</option>
            <option value="1" @if(!isset($model) || $model->status) selected @endif>{{__("common.enable1")}}</option>
        </select>
    </div>
</div>

@if(!isset($model))
    <div class="row">
        ДЛЯ МАССОВОГО ОБНОВЛЕНИЯ ПРЕДУСМОТРЕНЫ ТЕГИ: <br>
        &#123;&#123;currency_from&#125;&#125; <br>
        &#123;&#123;currency_to&#125;&#125; <br>
        &#123;&#123;currency_from_title&#125;&#125; <br>
        &#123;&#123;currency_to_title&#125;&#125; <br>
    </div>
@endif
@include("admin.components.form.multilang_names", ['mlNames' => @$model->data['titles']])
@include("admin.components.form.multilang_content", ['mlContent' => @$model->data['content'], "label" => __("common.directionDescription")])

<hr>
<h6 class="mb-2">SEO</h6>
@include("admin.components.form.multilang_seo_title", ['mlSeoTitles' => @$model->data['seo']['titles']])
@include("admin.components.form.multilang_seo_description", ['mlSeoDescriptions' => @$model->data['seo']['descriptions']])
@include("admin.components.form.multilang_seo_keyword", ['mlSeoKeywords' => @$model->data['seo']['keywords']])