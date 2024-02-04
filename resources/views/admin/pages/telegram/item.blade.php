@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addTelegramBot")}}</h5>
                @else
                    <h5 class="mb-2">{{__("common.editTelegramBot")}}: {{$model->username}}</h5>
                @endif
				<form class="forms-sample" action="{{route("adminTelegramBotProcess")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="username" class="form-label">{{__("common.telegramUsername")}}</label>
                            <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="..." value="{{$model->username}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="token" class="form-label">{{__("common.telegramToken")}}</label>
                            <input type="text" class="form-control" id="token" name="token" autocomplete="off" placeholder="..." value="{{$model->token}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="enabled" class="form-label">{{__("common.enabled")}}</label>
                            <select class="form-select" id="enabled" name="enabled">
                                <option value="0" @if(!$model->status) selected @endif>{{__("common.enable0")}}</option>
                                <option value="1" @if($model->status) selected @endif>{{__("common.enable1")}}</option>
                            </select>
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection