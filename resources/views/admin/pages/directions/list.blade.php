@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="row my-3">
                    <a href="{{route("adminDirectionAdd")}}" class="btn btn-primary mx-2">Добавить новые направления</a>
                    <a href="{{route("adminDirectionUpdateByCurrency")}}" class="btn btn-primary mx-2">Изменить массово направления</a>
                    <a href="{{route("adminDirectionRemoveAll")}}" class="btn btn-danger mx-2" onclick="return confirm('Confirm action')">Удалить все направления</a>
                </div>
                <table class="table table-striped table-sm fs--1 mb-0 leads-table eaDatatable" data-list="" data-columns='[
                    {"data": "id", "name": "id"},
                    {"data": "name", "name": "name"},
                    {"data": "created_at", "name": "created_at"},
                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
                ]'>
                    <thead>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">#</th>
                                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col">{{__("common.name")}}</th>
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