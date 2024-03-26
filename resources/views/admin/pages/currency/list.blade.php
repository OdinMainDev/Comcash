@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="row my-3">
                    <a href="{{route("adminCurrenciesMassUpdate")}}" class="btn btn-primary mx-2">Изменить массово кошельки</a>
                    <a href="{{route("adminCurrencyRemoveWallets")}}" class="btn btn-danger mx-2" onclick="return confirm('Confirm action')">Удалить все кошельки ( адреса )</a>
                </div>
                <table class="table table-striped eaDatatable" data-list="" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "title", "name": "title"},
                    {"data": "name", "name": "name"},
                    {"data": "created_at", "name": "created_at"},
                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">{{__("common.name")}}</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">{{__("common.currencyCode")}}</th>
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