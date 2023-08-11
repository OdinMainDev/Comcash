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
                    <h5 class="mb-2">{{__("common.addCurrency")}}</h5>
                @else
                    <div class="d-flex align-items-start">
                        <img src="/uploads/{{$model->image}}" class="wd-100 wd-sm-200 me-3">
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
                        <div class="col-md-12 mb-3">
                            <label for="currencyCode" class="form-label">{{__("common.currencyCode")}}</label>
                            <input type="text" class="form-control" id="currencyCode" name="currencyCode" autocomplete="off" placeholder="BTC" value="{{$model->name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="image">{{__("common.image")}}</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="currencyUnits" class="form-label">{{__("common.currencyUnits")}}</label>
                            <input type="text" class="form-control" id="currencyUnits" name="currencyUnits" autocomplete="off" placeholder="2" value="{{$model->units}}">
                        </div>
                    </div>

                    @include("admin.components.form.multilang_names", ['mlNames' => @$model->data['titles']])
                    
					<button type="submit" class="btn btn-primary me-2">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection