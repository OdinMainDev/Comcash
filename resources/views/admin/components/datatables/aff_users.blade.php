<table class="table table-striped eaDatatable" data-list="" data-columns='[
    {"data": "id", "name": "id", "orderable": false, "searchable": false},
    {"data": "user_id", "name": "user_id"},
    {"data": "created_at", "name": "created_at"}
]'
@if(isset($dtRouteOverride)) data-model="{{$dtRouteOverride}}" @endif>
    <thead>
        @for ($i = 0; $i < 2; $i++)
            <tr>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" scope="col">#</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col" data-search-type="user">{{__("common.user")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col" data-datepicker="true">{{__("common.createdAt")}}</th>
            </tr>
        @endfor
    </thead>
    <tbody class="list"></tbody>
</table>