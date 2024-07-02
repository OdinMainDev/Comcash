@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>

    <script src="//cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    @foreach(config()->get("app.languages") as $key => $lang)
        <?php 
            $lang = mb_strtolower($lang);
        ?>
        <script type="text/javascript">
            CKEDITOR.replace('mlContent{{$lang}}', {
                language: '{{mb_strtolower(app()->getLocale())}}',
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    @endforeach

    <script>
        if( $('.ckeditor').length > 0){
            $('form').on('submit', function(e){
                for (instance in CKEDITOR.instances) {
                    $('#' + instance).val(CKEDITOR.instances[instance].getData());
                }
            });
        }
    </script>

    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencyFrom').select2({
            ajax: {
                url: '/ru/panel/api/get/currencies',
                dataType: 'json'
            }
        });
        $('#currencyTo').select2({
            ajax: {
                url: '/ru/panel/api/get/currencies',
                dataType: 'json'
            }
        });
        $('#merchantFrom').select2({
            ajax: {
                url: '/ru/panel/api/get/merchants',
                dataType: 'json'
            }
        });
        $('#merchantTo').select2({
            ajax: {
                url: '/ru/panel/api/get/merchants',
                dataType: 'json'
            }
        });
        $('#merchantChangeFrom').select2({
            ajax: {
                url: '/ru/panel/api/get/merchants',
                dataType: 'json'
            }
        });
        $('#merchantChangeTo').select2({
            ajax: {
                url: '/ru/panel/api/get/merchants',
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
                
                <h5 class="mb-2">{{__("common.updateDirections")}}</h5>
				<form class="forms-sample" action="{{route("adminDirectionUpdateByCurrencyProcess")}}">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h6 class="">{{__("common.updateDirectionsFilters")}}</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="currencyFrom" class="form-label">{{__("common.currencyFrom")}}</label>
                            <select class="w-100 h-100" id="currencyFrom" name="currencyFrom[]" multiple="multiple">
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="merchantFrom" class="form-label">{{__("common.merchantFrom")}}</label>
                            <select class="form-select" name="merchantFrom" id="merchantFrom">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="currencyTo" class="form-label">{{__("common.currencyTo")}}</label>
                            <select class="form-select" id="currencyTo" name="currencyTo[]" multiple="multiple">
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="merchantTo" class="form-label">{{__("common.merchantTo")}}</label>
                            <select class="form-select" name="merchantTo" id="merchantTo">
                                <option disabled selected>{{__("common.notChoosen")}}</option>
                            </select>
                        </div>
                    </div>
                    @include("admin.pages.directions.item")
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection