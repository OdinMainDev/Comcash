@extends("admin.layouts.dashboard")
@section("content")
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Установить 2фа</h6>
                <form class="forms-sample" action="{{route("adminProfile2faProcess")}}">
                    <div class="mb-3">
                        <label class="form-label">Qr код для приложения</label>
                        <img src="{{$qrcode}}" class="wd-100 wd-sm-200 me-3">
                    </div>
                    <div class="mb-3">
                        <label for="otppassword" class="form-label">Введите одноразовый код для проверки</label>
                        <input type="text" class="form-control" id="otppassword" name="otppassword" autocomplete="off" placeholder="...">
                        <input type="hidden" id="otpsecret" name="otpsecret" autocomplete="off" value="{{$secret}}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Подтвердить</button>
                </form>

              </div>
            </div>
        </div>
    </div>
@endsection