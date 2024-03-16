@extends("admin.layouts.dashboard")

@section("js")

    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>

    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <script type="text/javascript">
        CKEDITOR.replace(document.getElementById("messageTg"), {
            language: '{{mb_strtolower(app()->getLocale())}}',
            enterMode : CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_BR,
            toolbar: [
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'document', items: [ 'Source' ] },
                { name: 'undo', items: [ 'Undo', 'Redo' ] },
            ],
            removeButtons: '', 
            allowedContent: 'b i u a[href];',
            disallowedContent: 'img; h1; h2; h3; h4; h5; h6; p; div;',
        });
    </script>

    <script>
        if( $('.ckeditor').length > 0){
            $('form').on('submit', function(e){
                for (instance in CKEDITOR.instances) {
                    $('#' + instance).val(CKEDITOR.instances[instance].getData());
                }
            });
        }
    </script>

@endsection

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h5 class="mb-2">{{__("common.telegramBotSpam")}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminUserSpamTgProcess")}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telegramId" class="form-label">{{__("common.chooseTgBot")}}</label>
                            <select class="form-select" id="telegramId" name="telegramId">
                                @foreach($bots as $bot)
                                    <option value="{{$bot->id}}">{{$bot->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="language" class="form-label">{{__("common.chooseLanguageToSpam")}}</label>
                            <select class="form-select" id="language" name="language">
                                <option value="all">{{__("common.spamToAllLanguages")}}</option>
                                @foreach(config()->get("app.languages") as $key => $lang)
                                    <option value="{{$lang}}">{{$lang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="messageTg" class="form-label">{{__("common.telegramMessageBuilder")}}</label>
                            <textarea class="form-control ckeditor" id="messageTg" name="messageTg">
                            </textarea>
                        </div>
                    </div>
					<button type="submit" class="btn btn-primary me-2">{{__("common.submit")}}</button>
				</form>
			</div>
		</div>
	</div>
</div>

    
@endsection
