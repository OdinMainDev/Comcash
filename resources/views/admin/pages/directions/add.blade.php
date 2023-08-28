@extends("admin.layouts.dashboard")

@section("css")
    <link rel="stylesheet" href="/admin/assets/vendors/select2/select2.min.css">
@endsection

@section("js")
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencyFrom').select2({
            ajax: {
                url: '/panel/api/get/currencies',
                dataType: 'json'
            }
        });
        $('#currencyTo').select2({
            ajax: {
                url: '/panel/api/get/currencies',
                dataType: 'json'
            }
        });
        $('#merchantFrom').select2({
            ajax: {
                url: '/panel/api/get/merchants',
                dataType: 'json'
            }
        });
        $('#merchantTo').select2({
            ajax: {
                url: '/panel/api/get/merchants',
                dataType: 'json'
            }
        });
    </script>
@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h5 class="mb-2">{{__("common.addDirection")}}</h5>
				<form class="forms-sample" action="{{route("adminDirectionAddProcess")}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <label for="currencyFrom" class="form-label">{{__("common.currencyFrom")}}</label>
                            <select class="w-100 h-100" name="currencyFrom" id="currencyFrom">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="merchantFrom" class="form-label">{{__("common.merchantFrom")}}</label>
                            <select class="form-select" name="merchantFrom" id="merchantFrom">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="currencyTo" class="form-label">{{__("common.currencyTo")}}</label>
                            <select class="form-select" name="currencyTo" id="currencyTo">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="merchantTo" class="form-label">{{__("common.merchantTo")}}</label>
                            <select class="form-select" name="merchantTo" id="merchantTo">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
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