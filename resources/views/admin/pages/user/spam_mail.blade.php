@extends("admin.layouts.dashboard")

@section("css")
    <style>
        .ck {
            color: #000 !important;
        }

        .ck * {
            color: #000 !important;
        }
    </style>
@endsection

@section("js")

    <script src="/admin/assets/vendors/prismjs/prism.js"></script>
    <script src="/admin/assets/vendors/clipboard/clipboard.min.js"></script>

    <script src="/admin/email/ckeditor.js"></script>
		<script>
			const watchdog = new CKSource.EditorWatchdog();
			
			window.watchdog = watchdog;
			
			watchdog.setCreator( ( element, config ) => {
				return CKSource.Editor
					.create( element, config )
					.then( editor => {
						return editor;
					} )
			} );
			
			watchdog.setDestructor( editor => {
				return editor.destroy();
			} );
			
			watchdog.on( 'error', handleError );
			
			watchdog
				.create( document.querySelector( '.editor' ), {
					licenseKey: '',
				} )
				.catch( handleError );
			
			function handleError( error ) {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: k1xroqk8si57-w0dl60rey6wv' );
				console.error( error );
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
                        <h5 class="mb-2">{{__("common.mailSpam")}}</h5>
                    </div>
                </div>
				<form class="forms-sample" action="{{route("adminUserSpamMailProcess")}}">
                    @csrf
                    <div class="row ">
                        <div class="col-md-12 mb-3">
                            <label for="subject" class="form-label">{{__("common.mailSubject")}}</label>
                            <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" placeholder="...">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="messageTg" class="form-label">{{__("common.mailTemplateBuilder")}}</label>
                            
                            <textarea class="editor" name="template">
                                
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
