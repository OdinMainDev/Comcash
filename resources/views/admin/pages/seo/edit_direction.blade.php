@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>

    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
                
                <h5 class="mb-2">{{__("common.editDirection")}}</h5>
				<form class="forms-sample" action="{{route("adminSeoDirectionsProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    @include("admin.components.form.multilang_seo_title", ['mlSeoTitles' => @$model->data['seo']['titles']])
                    @include("admin.components.form.multilang_seo_description", ['mlSeoDescriptions' => @$model->data['seo']['descriptions']])
                    @include("admin.components.form.multilang_seo_keyword", ['mlSeoKeywords' => @$model->data['seo']['keywords']])
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection