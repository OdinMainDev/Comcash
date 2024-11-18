@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/js/jquery.repeater.js"></script>
    <script>
        $(document).ready(function () {
            const formData = @json($settings);
            const repeaterContainer = $('.repeater');
            repeaterContainer.repeater({
                // isFirstItemUndeletable: true,
                // initEmpty: true,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('{{__("common.are_you_want_delete_element")}}')) {
                        $(this).slideUp(deleteElement);
                    }
                },
            });
            if (formData && formData.length > 0) {
                repeaterContainer.setList(formData);
            }
        });
    </script>
@endsection



@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.editRatesSettings")}}</h5>
                    </div>
                </div>
				<form class="forms-sample repeater" action="{{route("adminRatesSettingsProcess")}}">
                    @csrf
                    <div class="row" data-repeater-list="repeater">
                       
                        <div class="col-12 mb-3" data-repeater-item>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="amount" class="form-label">{{__("common.amountInUsd")}}</label>
                                    <input type="text" class="form-control" id="amount" name="amount" autocomplete="off" placeholder="50" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="fee" class="form-label">{{__("common.increaseProfitPercent")}}</label>
                                    <input type="text" class="form-control" id="fee" name="fee" autocomplete="off" placeholder="1" value="">
                                </div>
                            </div>
                            <input data-repeater-delete type="button" class="btn btn-danger me-2 my-2" value="{{__("common.delete")}}"/>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input data-repeater-create type="button" class="btn btn-info me-2" value="{{__("common.add_element")}}"/>
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection