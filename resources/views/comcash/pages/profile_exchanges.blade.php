@extends('comcash.layout.main')

@section('content')
<div class="history">
    <div class="history__container">
        @include("comcash.component.profile_menu")
        <div class="history__content">
            <p class="history__title">{{__("front.exchanges history label")}}</p>
            <div class='history__table'>
                @foreach($exchanges as $row)
                    <div class='history__row'>
                        <div class='history__row-item'>{{$row->id}}</div>
                        <div class="history__row-wrap">
                            <div class='history__row-item history__row-item-label'>{{__("front.exchanges history you send")}}</div>
                            <div class='history__row-item'>
                                <img src='{{$row->currencyFrom ? $row->currencyFrom->image : "/comcash/img/logo.png"}}' alt='' />
                                <span>{{$row->currencyFrom ? $row->currencyFrom->getTitle() : ""}}</span>
                                <p class="history__row-item-value">{{@$row->data['amount_data']['amount_send']}}</p>
                            </div>
                        </div>
                        <div class="history__row-wrap">
                            <div class='history__row-item history__row-item-label '>{{__("front.exchanges history you receive")}}</div>
                            <div class='history__row-item'>
                                <img src='{{$row->currencyTo ? $row->currencyTo->image : "/comcash/img/logo.png"}}' alt='' />
                                <span>{{$row->currencyFrom ? $row->currencyFrom->getTitle() : ""}}</span>
                                <p class="history__row-item-value">{{@$row->data['amount_data']['amount_receive']}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const headerHeight = document.querySelector('header')?.offsetHeight;
          const footerHeight = document.querySelector('footer')?.offsetHeight;

          document.documentElement.style.setProperty('--height-header', headerHeight + 'px');
          document.documentElement.style.setProperty('--height-footer', footerHeight + 'px');
      });
  </script>
@endsection
