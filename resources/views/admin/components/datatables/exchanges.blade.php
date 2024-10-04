<table class="table table-striped eaDatatable" data-list="" data-columns='[
    {"data": "id", "name": "id"},
    {"data": "status", "name": "status"},
    {"data": "currency_from", "name": "currency_from"},
    {"data": "currency_to", "name": "currency_to"},
    {"data": "data", "name": "data", "orderable": false, "searchable": false},
    {"data": "currency_to", "name": "is_new_client"},
    {"data": "currency_to", "name": "is_first_completed"},
    {"data": "hash", "name": "hash"},
    {"data": "created_at", "name": "created_at"},
    {"data": "action", "name": "action", "orderable": false, "searchable": false}
]'
@if(isset($dtRouteOverride)) data-model="{{$dtRouteOverride}}" @endif>
    <thead>
        @for ($i = 0; $i < 2; $i++)
            <tr>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-0" data-search="true" data-sort="true" scope="col">#</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-status" data-search="true" data-sort="true" scope="col" data-select-type="status">{{__("common.status")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="code_id">{{__("common.currencyFrom")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="code_id">{{__("common.currencyTo")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-data">{{__("common.data")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="enabled">is_new_client</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-currency" data-search="true" data-sort="true" scope="col" data-select-type="enabled">is_first_completed</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1 column-exch-hash" data-search="true" data-sort="true" scope="col">{{__("common.hash")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" data-search="true" data-sort="true" scope="col" data-datepicker="true">{{__("common.createdAt")}}</th>
                <th class="sort white-space-nowrap align-middle text-uppercase pl-1" scope="col">{{__("common.action")}}</th>
            </tr>
        @endfor
    </thead>
    <tbody class="list"></tbody>
</table>