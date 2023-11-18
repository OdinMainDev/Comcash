@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addFeedback")}}</h5>
                @else
                    <div class="d-flex align-items-start">

                            <h5 class="mb-2">{{__("common.editFeedback")}}: #{{$model->id}}</h5>
                        
                    </div>
                @endif
				<form class="forms-sample" action="{{route("adminFeedbackProcess")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">{{__("common.fullName")}}</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" autocomplete="off" placeholder="Иван иванов" value="{{$model->name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text" class="form-label">{{__("common.text")}}</label>
                            <input type="text" class="form-control" id="text" name="text" autocomplete="off" placeholder="Текст отзыва" value="{{$model->text}}">
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection