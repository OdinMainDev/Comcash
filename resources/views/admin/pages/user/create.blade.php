@extends("admin.layouts.dashboard")
@section("content")
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Создать пользователя</h6>
                <form class="forms-sample" action="{{route("adminUserCreateProcess")}}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Введите email</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="example@mail.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Введите пароль</label>
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