@extends('comcash3.layout.main')

@section('content')
    @include("comcash.component.index.anonymous")
	@include("comcash3.component.index.exchange_panel")
	@include("comcash3.component.index.about")
	<!-- @include("comcash3.component.index.transactions") -->
    @include("comcash.component.index.description")
	@include("comcash3.component.index.feedback")
	@include("comcash3.component.index.courier")
	@include("comcash3.component.index.news")
    @include("comcash3.component.index.advertising_banner")
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection
