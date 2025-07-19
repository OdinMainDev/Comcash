@extends('comcash.layout.main')

@section('content')
	@if (true)
		@include("comcash.component.index.exchange_wedev_panel")
		@include("comcash.component.index.about_wedev")
		@include("comcash.component.index.feedback_wedev")
		@include("comcash.component.index.courier_wedev")
		@include("comcash.component.index.news_wedev")
	@else
		@include("comcash.component.index.anonymous")
		@include("comcash.component.index.exchange_panel")
		@include("comcash.component.index.about")
		<!-- @include("comcash.component.index.transactions") -->
		@include("comcash.component.index.description")
		@include("comcash.component.index.feedback")
		@include("comcash.component.index.courier")
		@include("comcash.component.index.news")
		@include("comcash3.component.index.advertising_banner")
	@endif
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection
