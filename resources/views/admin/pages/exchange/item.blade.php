@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h5 class="mb-2">{{__("common.viewExchange")}}</h5>
                @if($model->status == 15)
                    <a href="{{route("adminExchangeRewithdraw", [$model->id])}}" class="btn btn-primary me-2">Повторить выплату</a>
                @endif
				<form class="forms-sample" action="{{route("adminCurrencyProcess")}}">
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