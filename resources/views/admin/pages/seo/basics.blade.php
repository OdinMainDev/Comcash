@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h4 class="mb-2">{{__("common.choose_page")}}</h4>
                @foreach($seoPages as $key => $value)
                    <a href="{{route("adminSeoPage", [$value])}}" class="btn btn-primary">{{__("common.".$value."_page")}}</a>
                @endforeach
                <!-- <a href="{{route("adminSeoPage", ["reset-password"])}}" class="btn btn-primary">{{__("common.reset-password_page")}}</a> -->
			</div>
		</div>
	</div>
</div>
    
@endsection