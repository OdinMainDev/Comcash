@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.viewUser")}}: {{$model->getUserCredentials()}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminUserProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off" placeholder="email" value="{{$model->email}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">{{__("common.phone")}}</label>
                            <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" placeholder="phone" value="{{$model->phone}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">{{__("common.first_name")}}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" autocomplete="off" placeholder="first_name" value="{{$model->first_name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="second_name" class="form-label">{{__("common.second_name")}}</label>
                            <input type="text" class="form-control" id="second_name" name="second_name" autocomplete="off" placeholder="second_name" value="{{$model->second_name}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">{{__("common.last_name")}}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" autocomplete="off" placeholder="last_name" value="{{$model->last_name}}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="passport" class="form-label">{{__("common.passport")}}</label>
                            <input type="text" class="form-control" id="passport" name="passport" autocomplete="off" placeholder="passport" value="{{$model->passport}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telegram" class="form-label">{{__("common.telegram")}}</label>
                            <input type="text" class="form-control" id="telegram" name="telegram" autocomplete="off" placeholder="telegram" value="{{$model->telegram}}">
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>

                <br><br>
                <form class="forms-sample" action="{{route("adminUserPasswordProcess")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">{{__("common.password")}}</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off" placeholder="*****">
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
                
                @can("handle-user-role")
                    <br><br><br>
                    <div class="d-flex align-items-start">
                        <div>
                            <h5 class="mb-2">{{__("common.setUserRole")}}: {{$model->email}}</h5>
                        </div>
                    </div>
                    <form class="forms-sample" action="{{route("adminUserRoleProcess")}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$model->id}}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="roleId" class="form-label">{{__("common.chooseRole")}}</label>
                                <select class="form-select" id="roleId" name="roleId">
                                    <option @if($userRole == "") selected @endif value="0" >-------------</option>
                                    @foreach($roles as $role) 
                                        <option @if($userRole == $role->name) selected @endif value="{{$role->id}}" >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
                    </form>
                @endcan
			</div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @can("handle-exchanges")
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{__("common.viewUserExchanges")}}: {{$model->getUserCredentials()}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php $dtRouteOverride = route("adminExchangeListProcess", [$model->id]); ?>
                            @include("admin.components.datatables.exchanges")
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                {{__("common.viewUserExchangesAffiliates")}}: {{$model->getUserCredentials()}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php $dtRouteOverride = route("adminExchangeListAffiliateProcess", [$model->id]); ?>
                            @include("admin.components.datatables.exchanges")
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>


@endsection

@section("js")
    <script src="/admin/assets/vendors/datatables.net/jquery.dataTables.js"></script>
@endsection