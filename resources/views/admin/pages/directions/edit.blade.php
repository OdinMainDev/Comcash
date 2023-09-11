@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addBlog")}}</h5>
                @else
                    <h5 class="mb-2">{{__("common.editBlog")}}</h5>
                @endif
				<form class="forms-sample" action="{{route("adminDirectionProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">{{__("common.name")}}</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="BTC -> ETH" value="{{$model->name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="position" class="form-label">{{__("common.position")}}</label>
                            <input type="text" class="form-control" id="position" name="position" autocomplete="off" placeholder="5" value="{{$model->position}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="profit_percent" class="form-label">{{__("common.profit_percent")}}</label>
                            <input type="text" class="form-control" id="profit_percent" name="profit_percent" autocomplete="off" placeholder="2.5" value="{{$model->profit_percent}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="0" @if(!$model->status) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->status) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                    </div>
                    @include("admin.components.form.multilang_names", ['mlNames' => @$model->data['titles']])
                    @include("admin.components.form.multilang_content", ['mlContent' => @$model->data['content'], "label" => __("common.directionDescription")])
                    
                    <hr>
                    <h6 class="mb-2">SEO</h6>
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