@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencies').select2({
            ajax: {
                url: '/ru/panel/api/get/currencies',
                dataType: 'json'
            }
        });
    </script>
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
                
                <h5 class="mb-2">{{__("common.updateCurrencies")}}</h5>
				<form class="forms-sample" action="{{route("adminCurrenciesMassUpdateProcess")}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="currencies" class="form-label">{{__("common.currencies")}}</label>
                            <select class="w-100 h-100" id="currencies" name="currencies[]" multiple="multiple">
                            </select>
                        </div>
                    </div>
                    
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
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection