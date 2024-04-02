@if(isset($exchanges) && count($exchanges) > 0)
    <div class='transactions'>
        <div class='transactions__container'>
            <h3 class='transactions__title'>{{__("front.Last Transactions")}}</h3>
            <div class='transactions__table'>
                <div class='transactions__header'>
                    <div class='transactions__header-item'>#</div>
                    <div class='transactions__header-item'>{{__("front.Exchange")}}</div>
                    <div class='transactions__header-item'>{{__("front.Amount")}}</div>
                    <div class='transactions__header-item'>{{__("front.Receive")}}</div>
                    <div class='transactions__header-item'>{{__("front.Amount")}}</div>
                </div>
                @foreach($exchanges as $row)
                    <div class='transactions__row'>
                        <div class='transactions__row-item'>{{$row->id}}</div>
                        <div class='transactions__row-item'>
                            <img src='{{$row->currencyFrom ? $row->currencyFrom->image : "/comcash/img/logo.png"}}' alt='' />
                            <p>{{$row->currencyFrom ? $row->currencyFrom->getTitle() : ""}}</p>
                        </div>
                        <div class='transactions__row-item'>{{@$row->data['amount_data']['amount_send']}}</div>
                        <div class='transactions__row-item'>
                            <img src='{{$row->currencyTo ? $row->currencyTo->image : "/comcash/img/logo.png"}}' alt='' />
                            <p>{{$row->currencyTo ? $row->currencyTo->getTitle() : ""}}</p>
                        </div>
                        <div class='transactions__row-item'>{{@$row->data['amount_data']['amount_receive']}}</div>
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
@endif