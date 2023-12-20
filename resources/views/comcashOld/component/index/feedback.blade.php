@if(isset($feedbacks) && count($feedbacks) > 0)
    <div class='feedback'>
        <div class='feedback__container'>
            <p class='feedback__title'>{{__("front.Feedback Label")}}
            </p>
            <div class="slider">
                @foreach($feedbacks as $item)
                    <div>
                        <span>{{$item->name}}</span><br/>
                        {{$item->text}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif