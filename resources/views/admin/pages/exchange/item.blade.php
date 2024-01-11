@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h5 class="mb-2">{{__("common.viewExchange")}}</h5>
                @if(in_array($model->status, [15, 4]))
                    @if($model->merchant_type_from != "manualcrypto" && $model->merchant_type_from != "manualfiat")
                        <a href="{{route("adminExchangeRewithdraw", [$model->id])}}" class="btn btn-primary me-2">Повторить выплату</a>
                    @endif
                    <a href="{{route("adminExchangeSetWithdraw", [$model->id])}}" class="btn btn-primary me-2">Установить статус выплата начата</a>
                    <a href="{{route("adminExchangeSetWithdrawComplete", [$model->id])}}" class="btn btn-primary me-2">Установить статус выплачено</a>
                @endif

                @if($model->status == 0 && ($model->merchant_type_from == "manualcrypto" || $model->merchant_type_from == "manualfiat"))
                    <a href="{{route("adminExchangeSetPaid", [$model->id])}}" class="btn btn-primary me-2">Установить статус оплачено</a>
                @endif

                @if($model->status == 1 && ($model->merchant_type_from == "manualcrypto" || $model->merchant_type_from == "manualfiat"))
                    <a href="{{route("adminExchangeSetWithdraw", [$model->id])}}" class="btn btn-primary me-2">Установить статус выплата начата</a>
                @endif

				<form class="forms-sample" action="{{route("adminExchangeEditPost")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Data</label>
                            <textarea class="form-control text-white" rows="5" disabled="">{{json_encode($model->data)}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        @if(@$model->data['request_data']['to_address'])
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Кошелек получения</label>
                                <input type="text" class="form-control" id="to_address" name="to_address"  value="{{$model->data['request_data']['to_address']}}">
                            </div>
                        @endif
                        @if(@$model->data['request_data']['to_card'])
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Кошелек получения</label>
                                <input type="text" class="form-control" id="to_card" name="to_card"  value="{{$model->data['request_data']['to_card']}}">
                            </div>
                        @endif
                    </div>

                    @if(@$model->merchant_type_from == "manualcrypto")
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Введите кошелек, на который пользователь должен отправить средства</label>
                                <input type="text" class="form-control" id="manualcrypto" name="manualcrypto"  value="{{@$model->data['merchant_from_data']['address']}}">
                            </div>
                        </div>
                    @endif

                    @if(@$model->merchant_type_from == "manualfiat")
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Введите номер карты, на который пользователь должен отправить средства</label>
                                <input type="text" class="form-control" id="manualfiat" name="manualfiat"  value="{{@$model->data['merchant_from_data']['address']}}">
                            </div>
                        </div>
                    @endif

                 
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>

    <div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h5 class="mb-2">{{__("common.logs")}}</h5>
                <table class="table table-striped eaDatatable" data-list="" data-model="{{route("adminExchangeLogs", [$model->id])}}" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "action", "name": "action"},
                    {"data": "url", "name": "url"},
                    {"data": "request", "name": "request", "orderable": false, "searchable": false},
                    {"data": "response", "name": "response", "orderable": false, "searchable": false},
                    {"data": "created_at", "name": "created_at"}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-0" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status" data-search="true" data-sort="true" scope="col">{{__("common.action")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status" data-search="true" data-sort="true" scope="col">{{__("common.url")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status">{{__("common.request")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status">{{__("common.response")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-hash" data-search="true" data-sort="true" scope="col">{{__("common.createdAt")}}</th>
                            </tr>
                        @endfor
                    </thead>
                    <tbody class="list"></tbody>
                </table>
				
			</div>
		</div>
	</div>
</div>
    
@endsection

@section("css")
@endsection

@section("js")
    <script src="/admin/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
@endsection