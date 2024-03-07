@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencies').select2({
            ajax: {
                url: '/ru/panel/api/get/currencies',
                dataType: 'json'
            }
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
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.editAffiliateSettings")}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminAffiliateSettingsProcess")}}">
                    @csrf
                    <div class="row">
                       
                        <div class="col-md-3 mb-3">
                            <label for="percent" class="form-label">{{__("common.affiliatePercent")}}</label>
                            <input type="text" class="form-control" id="percent" name="percent" autocomplete="off" placeholder="0.5" value="{{$percent}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="minamount" class="form-label">{{__("common.affiliateMinAmount")}}</label>
                            <input type="text" class="form-control" id="minamount" name="minamount" autocomplete="off" placeholder="0.5" value="{{$minamount}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="currencies" class="form-label">{{__("common.affiliateAvailCurrencies")}}</label>
                            <select class="w-100 h-100" id="currencies" name="currencies[]" multiple="multiple">
                                @foreach($currencies as $key => $currency)
                                    <option value="{{$currency}}" selected>{{$key}}</option>
                                @endforeach
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