@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="row my-3">
                    <a href="{{route("adminExchangeSetClosedAll")}}" class="btn btn-danger mx-2" onclick="return confirm('Confirm action')">Удалить все открытые заявки</a>
                </div>
                <table class="table table-striped eaDatatable" data-list="" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "status", "name": "status"},
                    {"data": "currency_from", "name": "currency_from"},
                    {"data": "currency_to", "name": "currency_to"},
                    {"data": "data", "name": "data", "orderable": false, "searchable": false},
                    {"data": "hash", "name": "hash"},
                    {"data": "created_at", "name": "created_at"},
                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-0" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status" data-search="true" data-sort="true" scope="col" data-select-type="status">{{__("common.status")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="code_id">{{__("common.currencyFrom")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="code_id">{{__("common.currencyTo")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-data">{{__("common.data")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-hash" data-search="true" data-sort="true" scope="col">{{__("common.hash")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col" data-datepicker="true">{{__("common.createdAt")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" scope="col">{{__("common.action")}}</th>
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
@endsection