@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h5 class="mb-2">{{__("common.importLanguages")}}</h5>
				<form class="forms-sample" action="{{route("adminProcessLanguageImport")}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">{{__("common.chooseLanguage")}}</label>
                            <select class="form-select" id="language" name="language">
                                @foreach(config("app.languages") as $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="csv">CSV</label>
                            <input class="form-control" type="file" id="csv" name="csv">
                        </div>
                    </div>
                    
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>
    
@endsection