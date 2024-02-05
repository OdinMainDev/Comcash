@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="row my-3">
                    <a href="{{route("adminExchangeSetClosedAll")}}" class="btn btn-danger mx-2" onclick="return confirm('Confirm action')">{{__("common.removeAllOpenExchanges")}}</a>
                </div>
                @include("admin.components.datatables.exchanges")
			</div>
		</div>
	</div>
</div>
    
@endsection

@section("css")
@endsection

@section("js")
    <script src="/admin/assets/vendors/datatables.net/jquery.dataTables.js"></script>
@endsection