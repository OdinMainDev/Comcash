<div class="row">
    @if(!isset($model))
        <div class="col-12 mb-2">
            <h6 class="">{{__("common.updateDirectionsChooseMerchants")}}</h6>
        </div>
    @endif
    <div class="col-md-6 mb-3">
        <label for="merchantChangeFrom" class="form-label">{{__("common.merchantFrom")}}</label>
        <select class="form-select" name="merchantChangeFrom" id="merchantChangeFrom">
            @if(isset($model))
                <option value="{{$model->merchant_from}}" selected>{{"(".$model->merchant_from.") ".$model->merchantFrom->name}}</option>
            @else
                <option disabled selected>{{__("common.notChoosen")}}</option>
            @endif
        </select>
    </div>
    <div class="col-md-6 mb-5">
        <label for="merchantChangeTo" class="form-label">{{__("common.merchantTo")}}</label>
        <select class="form-select" name="merchantChangeTo" id="merchantChangeTo">
            @if(isset($model))
                <option value="{{$model->merchant_to}}" selected>{{"(".$model->merchant_to.") ".$model->merchantTo->name}}</option>
            @else
                <option disabled selected>{{__("common.notChoosen")}}</option>
            @endif
        </select>
    </div>
</div>
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
            @if(!isset($model))
                <option value="666" selected>------------</option>
            @endif
            <option value="0" @if(isset($model) && !$model->status) selected @endif>{{__("common.enable0")}}</option>
            <option value="1" @if(isset($model) && $model->status) selected @endif>{{__("common.enable1")}}</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="min_amount_usd" class="form-label">{{__("common.min_amount_usd")}}</label>
        <input type="text" class="form-control" id="min_amount_usd" name="min_amount_usd" autocomplete="off" placeholder="50" value="{{@$model->data['min_amount_usd']}}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="max_amount_usd" class="form-label">{{__("common.max_amount_usd")}}</label>
        <input type="text" class="form-control" id="max_amount_usd" name="max_amount_usd" autocomplete="off" placeholder="50000" value="{{@$model->data['max_amount_usd']}}">
    </div>
</div>

@if(!isset($model))
    <div class="row mt-5 pt-5 mb-2">
        <div class="col-md-4">
            <label for="withChangeFromAllTexts" class="form-label">Заменять старые текста</label>
            <select class="form-select" id="withChangeFromAllTexts" name="withChangeFromAllTexts">
                @if(!isset($model))
                    <option value="666" selected>------------</option>
                @endif
                <option value="0" @if(isset($model) && !$model->status) selected @endif>{{__("common.enable0")}}</option>
                <option value="1" @if(isset($model) && $model->status) selected @endif>{{__("common.enable1")}}</option>
            </select>
        </div>
        <div class="col-md-8">
            <p>ДЛЯ МАССОВОГО ОБНОВЛЕНИЯ ПРЕДУСМОТРЕНЫ ТЕГИ:</p>
            <p>&#123;&#123;currency_from&#125;&#125;</p>
            <p>&#123;&#123;currency_to&#125;&#125;</p>
            <p>&#123;&#123;currency_from_title&#125;&#125;</p>
            <p>&#123;&#123;currency_to_title&#125;&#125;</p>
        </div>
    </div>
@endif
@include("admin.components.form.multilang_names", ['mlNames' => @$model->data['titles']])
@include("admin.components.form.multilang_content", ['mlContent' => @$model->data['content'], "label" => __("common.directionDescription")])

<hr>
<h6 class="mb-2">SEO</h6>
@include("admin.components.form.multilang_seo_title", ['mlSeoTitles' => @$model->data['seo']['titles']])
@include("admin.components.form.multilang_seo_description", ['mlSeoDescriptions' => @$model->data['seo']['descriptions']])
@include("admin.components.form.multilang_seo_keyword", ['mlSeoKeywords' => @$model->data['seo']['keywords']])