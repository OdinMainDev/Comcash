@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <table class="table table-striped eaDatatable" data-list="" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "utm_source", "name": "utm_source"},
                    {"data": "utm_medium", "name": "utm_medium"},
                    {"data": "utm_campaign", "name": "utm_campaign"},
                    {"data": "utm_term", "name": "utm_term"},
                    {"data": "utm_content", "name": "utm_content"},
                    {"data": "completed_utm_exchanges_count", "name": "completed_utm_exchanges_count", "orderable": true, "searchable": false},
                    {"data": "utm_exchanges_count", "name": "utm_exchanges_count", "orderable": true, "searchable": false},
                    {"data": "created_at", "name": "created_at"},
                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">utm_source</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">utm_medium</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">utm_campaign</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">utm_term</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">utm_content</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-sort="true" scope="col">{{__("common.affTable_profitable_transactions")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-sort="true" scope="col">{{__("common.affTable_total_transactions")}}</th>
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