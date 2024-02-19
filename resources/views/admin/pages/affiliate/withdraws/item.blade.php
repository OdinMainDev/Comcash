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
                        <h5 class="mb-2">{{__("common.viewWithdrawAffiliate")}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminAffiliateWithdrawsProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row">
                       
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">{{__("common.status")}}</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" @if($model->status == 1) selected @endif>{{__("common.affstatus1")}}</option>
                                <option value="2" @if($model->status == 2) selected @endif>{{__("common.affstatus2")}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reason" class="form-label">{{__("common.decline_reason")}}</label>
                            <input type="text" class="form-control" id="reason" name="reason" autocomplete="off" placeholder="..." value="{{$model->reason}}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">{{__("common.addressToSendMoney")}}</label>
                            <input type="text" class="form-control" value="{{$model->address}}" disabled>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">{{__("common.amountToClient")}}</label>
                            <input type="text" class="form-control" value="{{$model->amount}}" disabled>
                        </div>
                       
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection