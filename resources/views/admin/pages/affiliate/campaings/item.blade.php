@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencyWallets').select2({
            tags: true,
        });
    </script>
    <script src="/admin/assets/vendors/datatables.net/jquery.dataTables.js"></script>
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
                        <h5 class="mb-2">{{__("common.editAffiliateCampaign")}}: {{$model->name}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminAffiliateCampaignProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row">
                       
                        <div class="col-md-12 mb-3">
                            <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="0" @if(!$model->status) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->status) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                       
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.viewUserAffiliateUsers")}}</h5>
                    </div>
                </div>
                <?php $dtRouteOverride = route("adminAffiliateCampaignsUsers", [$model->id]); ?>
                @include("admin.components.datatables.aff_users")
			</div>
		</div>
	</div>
</div>
    
@endsection