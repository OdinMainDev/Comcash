@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
    <script src="/admin/assets/vendors/select2/select2.min.js"></script>
    <script>
        $('#currencyWallets').select2({
            tags: true,
            tokenSeparators: [',', ' ', '\n'],
        });    
    </script>
@endsection

@section("css")
    <link rel="stylesheet" href="/admin/assets/vendors/select2/select2.min.css">
@endsection

@section("content")

<div class="row">
    <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column">
                    <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3 pt-3">
                        <div class="w-100">
                            <h6 class="text-body mb-2">utm_source:</h6>
                            <p class="text-body tx-13">{{$model->utm_source}}</p>
                        </div>
                    </a>
                    <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3 pt-3">
                        <div class="w-100">
                            <h6 class="text-body mb-2">utm_medium:</h6>
                            <p class="text-body tx-13">{{$model->utm_medium}}</p>
                        </div>
                    </a>
                    <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3 pt-3">
                        <div class="w-100">
                            <h6 class="text-body mb-2">utm_campaign:</h6>
                            <p class="text-body tx-13">{{$model->utm_campaign}}</p>
                        </div>
                    </a>
                    <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3 pt-3">
                        <div class="w-100">
                            <h6 class="text-body mb-2">utm_term:</h6>
                            <p class="text-body tx-13">{{$model->utm_term}}</p>
                        </div>
                    </a>
                    <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3 pt-3">
                        <div class="w-100">
                            <h6 class="text-body mb-2">utm_content:</h6>
                            <p class="text-body tx-13">{{$model->utm_content}}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div id="admPopularUtmsChart" data-sourceid="{{$model->id}}"></div>
			</div>
		</div>
    </div>
</div>
    
@endsection