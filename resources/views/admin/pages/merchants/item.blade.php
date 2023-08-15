@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addMerchant")}}</h5>
                @else
                    <div class="d-flex align-items-start">
                        <div>
                            <h5 class="mb-2">{{__("common.editMerchant")}}: {{$model->name}}</h5>
                        </div>
                    </div>
                @endif
				<form class="forms-sample" action="{{route("adminMerchantProcess")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">{{__("common.name")}}</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Merchant #1" value="{{$model->name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">{{__("common.merchantType")}}</label>
                            <select class="form-select" id="type" name="type">
                                @foreach(config()->get("app.merchants") as $value)
                                    <option value="{{$value}}" @if($model->type == $value) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="0" @if(!$model->status) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->status) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="auto" class="form-label">{{__("common.is_auto_merchant")}}</label>
                            <select class="form-select" id="auto" name="auto">
                                <option value="0" @if(!$model->is_auto) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->is_auto) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="apiKey" class="form-label">{{__("common.apiKey")}}</label>
                        <input type="text" class="form-control" id="apiKey" name="apiKey" autocomplete="off" placeholder="Merchant #1" value="{{$model->key}}">
                    </div>
                    <div class="mb-3">
                        <label for="apiSecret" class="form-label">{{__("common.apiSecret")}}</label>
                        <input type="text" class="form-control" id="apiSecret" name="apiSecret" autocomplete="off" placeholder="Merchant #1" value="{{$model->secret}}">
                    </div>
                    <div class="mb-3">
                        <label for="apiToken" class="form-label">{{__("common.apiToken")}}</label>
                        <input type="text" class="form-control" id="apiToken" name="apiToken" autocomplete="off" placeholder="Merchant #1" value="{{$model->token}}">
                    </div>
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection