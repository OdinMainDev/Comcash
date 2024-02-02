@extends("admin.layouts.dashboard")

@section("content")

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
                <h4 class="mb-2">{{__("common.choose_page")}}</h4>
                <a href="{{route("adminSeoPage", ["index"])}}" class="btn btn-primary">{{__("common.index_page")}}</a>
                <a href="{{route("adminSeoPage", ["tariffs"])}}" class="btn btn-primary">{{__("common.tariffs_page")}}</a>
                <a href="{{route("adminSeoPage", ["delivery"])}}" class="btn btn-primary">{{__("common.delivery_page")}}</a>
                <a href="{{route("adminSeoPage", ["reviews"])}}" class="btn btn-primary">{{__("common.reviews_page")}}</a>
                <a href="{{route("adminSeoPage", ["news"])}}" class="btn btn-primary">{{__("common.news_page")}}</a>
                <a href="{{route("adminSeoPage", ["blog"])}}" class="btn btn-primary">{{__("common.blog_page")}}</a>
                <a href="{{route("adminSeoPage", ["support"])}}" class="btn btn-primary">{{__("common.support_page")}}</a>
                <a href="{{route("adminSeoPage", ["company"])}}" class="btn btn-primary">{{__("common.company_page")}}</a>
                <a href="{{route("adminSeoPage", ["faq"])}}" class="btn btn-primary">{{__("common.faq_page")}}</a>
                <a href="{{route("adminSeoPage", ["profile"])}}" class="btn btn-primary">{{__("common.profile_page")}}</a>
                <a href="{{route("adminSeoPage", ["login"])}}" class="btn btn-primary">{{__("common.login_page")}}</a>
                <a href="{{route("adminSeoPage", ["register"])}}" class="btn btn-primary">{{__("common.register_page")}}</a>
                <!-- <a href="{{route("adminSeoPage", ["reset-password"])}}" class="btn btn-primary">{{__("common.reset-password_page")}}</a> -->
			</div>
		</div>
	</div>
</div>
    
@endsection