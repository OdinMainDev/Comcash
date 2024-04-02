@extends('comcash2.layout.main')

@section('content')
	@include("comcash2.component.index.exchange_panel")
	@include("comcash2.component.index.about")
	@include("comcash2.component.index.transactions")
	@include("comcash2.component.index.feedback")
	@include("comcash2.component.index.courier")
	@include("comcash2.component.index.news")
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection
