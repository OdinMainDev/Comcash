@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencyWallets').select2({
            tags: true,
            tokenSeparators: [',', ' ', '\n'],
        });    
    </script>
@endsection

@section("css")
    <link rel="stylesheet" href="/admin/assets/vendors/select2/select2.min.css">
@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addCurrency")}}</h5>
                @else
                    <div class="d-flex align-items-start">
                        <img src="{{$model->image}}" class="wd-100 wd-sm-200 me-3">
                        <div>
                            <h5 class="mb-2">{{__("common.editCurrency")}}: {{$model->name}}</h5>
                        </div>
                    </div>
                @endif
				<form class="forms-sample" action="{{route("adminCurrencyProcess")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="currencyCode" class="form-label">{{__("common.currencyCode")}}</label>
                            <input type="text" class="form-control" id="currencyCode" name="currencyCode" autocomplete="off" placeholder="BTC" value="{{$model->name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tag" class="form-label">{{__("common.chooseTag")}}</label>
                            <select class="form-select" id="tag" name="tag">
                                <option value="fiat" @if($model->tag == "fiat") selected @endif>fiat</option>
                                <option value="crypto" @if($model->tag == "crypto") selected @endif>crypto</option>
                                <option value="cash" @if($model->tag == "cash") selected @endif>cash</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="image">{{__("common.image")}}</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="currencyUnits" class="form-label">{{__("common.currencyUnits")}}</label>
                            <input type="text" class="form-control" id="currencyUnits" name="currencyUnits" autocomplete="off" placeholder="2" value="{{$model->units}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="position" class="form-label">{{__("common.position")}}</label>
                            <input type="text" class="form-control" id="position" name="position" autocomplete="off" placeholder="1" value="{{$model->position}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="0" @if(!$model->status) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->status) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                    </div>

                    @include("admin.components.form.multilang_names", ['mlNames' => @$model->data['titles']])

                    <div class="row my-2">
                        <div class="col-12">
                            <label for="currencyWallets" class="form-label">{{__("common.currencyWallets")}}</label>
                            <select class="w-100 h-100" id="currencyWallets" name="currencyWallets[]" multiple="multiple">
                                @if(@$model->data && isset($model->data['wallets']) && is_array($model->data['wallets']))
                                    @foreach(@$model->data['wallets'] as $wallet)
                                        <option value="{{$wallet}}" selected>{{$wallet}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>

                    @if($model->id && isset($model->data['walletsAvail']) && is_array($model->data['walletsAvail']))
                        @foreach(@$model->data['walletsAvail'] as $wallet) 
                            <h5 class="mb-2">{{$wallet}}</h5>
                        @endif
                    @endif
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection