@extends('comcash.layout.main')

@section('content')

<div class="progress">
    <div class="progress__container">

      <p class="progress__title-mobile">{{__("front.exchange id")}} {{$exchange->id}}</p>

      <div class="progress__box">
        @if($exchange->currencyFrom->tag == "fiat")
            <img src="/comcash/img/icons/socials/youtube.svg"
                class="progress__box-img"
                alt="qr">
        @else
            @if(isset($exchange->data['merchant_from_data']['address']))
                <img src="https://chart.googleapis.com/chart?chs=224x224&cht=qr&chl={{$exchange->data['merchant_from_data']['address']}}&choe=UTF-8" class="progress__box-img" title="Link to Google.com" />
            @endif
        @endif
        <div class="progress__box-right">
          <div class='progress__box-label'>
            amount
          </div>
          <div class="progress__box-text">
            <span>0,00000001 </span>
            <span>BTC </span>
          </div>

          <div class='progress__box-label'>
            adress
          </div>
          <div class="progress__box-text">
            123123123123213123213
          </div>
        </div>
      </div>


      <div class="progress__timeline">
        <p class="progress__timeline-item  ">отправка вам</p>
        <p class="progress__timeline-item   ">Ожидание депозита</p>
        <p class="progress__timeline-item  ">обмен </p>
        <p class="progress__timeline-item   active">подтверждение</p>
      </div>

      <div class="progress__data">
        <p class="progress__data-label">you get</p>
        <p class="progress__data-text"> 15.245235 ETH</p>
      </div>

      <div class="progress__data">
        <p class="progress__data-label">receiver address</p>
        <p class="progress__data-text">123123123123213123213
          H</p>
      </div>

      <!-- <div class="progress__mail">
        <p class="progress__mail-title">Время ожидания</p>
        <div class="checkbox">
          <input type="checkbox"
                 id="switch"
                 class="checkbox" />
          <label for="switch"></label>
        </div>
      </div> -->

    </div>
  </div>

@endsection

@section("js")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headerHeight = document.querySelector('header')?.offsetHeight;
            const footerHeight = document.querySelector('footer')?.offsetHeight;

            document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
            document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
        });
    </script>
@endsection