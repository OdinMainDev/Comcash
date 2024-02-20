@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h4 class="mb-2">{{__("common.choose_email")}}</h4>
                @foreach($emails as $key => $value)
                    <a href="{{route("adminViewEmailTemplate", [$value])}}" class="btn btn-primary">{{$value}}</a>
                @endforeach
			</div>
		</div>
	</div>
</div>
    
@endsection