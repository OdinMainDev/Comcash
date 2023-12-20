@extends('comcash.layout.main')

@section('content')
	@include("comcash.component.index.exchange_panel")
	@include("comcash.component.index.about")
	@include("comcash.component.index.transactions")
	@include("comcash.component.index.feedback")
	@include("comcash.component.index.courier")
	@include("comcash.component.index.news")
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection
