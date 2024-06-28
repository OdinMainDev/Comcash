@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			
			<div class="card-body">
				<div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.editAffiliateCampaign")}}: {{$campaign->name}}</h5>
                    </div>
                </div>
				<?php $dtRouteOverride = route("adminAffiliateCampaignsExchangesProcess", [$model->id]); ?>
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