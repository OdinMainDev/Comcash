@extends("admin.layouts.dashboard")

@section("js")
    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>
@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                @if(!$model->id)
                    <h5 class="mb-2">{{__("common.addRole")}}</h5>
                @else
                    <div class="d-flex align-items-start">
                        <div>
                            <h5 class="mb-2">{{__("common.editRole")}}: {{$model->name}}</h5>
                        </div>
                    </div>
                @endif
				<form class="forms-sample" action="{{route("adminRoleProcess")}}">
                    @csrf
                    @if($model->id)
                        <input type="hidden" name="id" value="{{$model->id}}">
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">{{__("common.name")}}</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Merchant #1" value="{{$model->name}}">
                    </div>
                    <hr>
                    <h6 class="mb-2">{{__("common.choose_permissions")}}</h6>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission}}" @if(in_array($permission, $choosen_permissions)) checked @endif>
                                    {{$permission}}
                                    <i class="input-frame"></i></label>
                                </div>
                            </div>
                        @endforeach
                    </div>
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection