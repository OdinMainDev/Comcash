@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <table class="table table-striped eaDatatable" data-list="" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "status", "name": "status"},
                    {"data": "user_id", "name": "user_id"},
                    {"data": "currency", "name": "currency"},
                    {"data": "amount", "name": "amount"},
                    {"data": "created_at", "name": "created_at"},
                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col" data-select-type="status_withdraws">{{__("common.status")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">{{__("common.user_id")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="code_id">{{__("common.currency")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">{{__("common.amount")}}</th>
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