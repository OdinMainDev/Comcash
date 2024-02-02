@extends("admin.layouts.dashboard")


@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form class="forms-sample" action="{{route("adminSeoProcessing")}}">
					<h4 class="mb-2">{{__("common.seo_configure_page")}}: {{__("common.".$pagename."_page")}}</h4>
					<input type="hidden" name="pagename" id="pagename" value="{{$pagename}}">
					@include("admin.components.form.multilang_seo_title", ['mlSeoTitles' => @$model->value[$pagename]['titles']])
					@include("admin.components.form.multilang_seo_description", ['mlSeoDescriptions' => @$model->value[$pagename]['descriptions']])
					@include("admin.components.form.multilang_seo_keyword", ['mlSeoKeywords' => @$model->value[$pagename]['keywords']])
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection