@if(isset($feedbacks) && count($feedbacks) > 0)
    <div class='feedback'>
        <div class='feedback__container'>
            <h3 class='feedback__title'>{{__("front.Feedback Label")}}</h3>
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