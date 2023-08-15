@extends("admin.layouts.dashboard")
@section("content")
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Изменить пароль</h6>
                <form class="forms-sample" action="{{route("adminProfileProcess")}}">
                    <div class="mb-3">
                        <label for="oldpassword" class="form-label">Старый пароль</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" autocomplete="off" placeholder="********">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Введите новый пароль</label>
                        <input type="password" class="form-control" id="password" name="password"  autocomplete="off" placeholder="********">
                    </div>
                    <div class="mb-3">
                        <label for="repassword" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="repassword" name="repassword" autocomplete="off" placeholder="********">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Подтвердить</button>
                </form>

              </div>
            </div>
        </div>
    </div>
@endsection