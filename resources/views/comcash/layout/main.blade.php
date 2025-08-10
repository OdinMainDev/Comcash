<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="preconnect" href="https://fonts.cloudflare.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

	<link rel="apple-touch-icon" sizes="120x120" href="/comcash/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/comcash/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/comcash/favicon-16x16.png">
	<link rel="manifest" href="/comcash/site.webmanifest">
	<link rel="mask-icon" href="/comcash/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta name="wot-verification" content="58070758d61d5f95c7da" />
	{!! SEO::generate() !!}
	@include('comcash.layout.ads')
	@if(env("THEME_NAME", "comcash") == "comcash")
	@vite('resources/js/comcash/main.ts')
	@elseif(env("THEME_NAME", "comcash") == "comcash2")
	@vite('resources/js/comcash/main2.ts')
	@else
	@vite('resources/js/comcash/main3.ts')
	@endif
	@yield('css')

	<link rel="stylesheet" href="https://fonts.cloudflare.com/css2?family=Inter:wght@200,300,400;500,600;600&display=swap">
	<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="relative min-h-screen overflow-y-auto overflow-x-hidden flex justify-center bg-[#202020] font-[Inter,sans-serif]">
	<div class="star-container" id="stars"></div>

	<div class="relative z-10 w-full max-w-[1440px] text-white">

		@if (true)
			@include('comcash.component.header_wedev_main')
			@yield("content")
			@include('comcash.component.footer_wedev_main')
		@else
			@include('comcash.component.header_info')
			@include('comcash.component.header_main')
			@yield("content")
			@include('comcash.component.modal_auth')
			@include('comcash.component.footer_main')
		@endif

		@yield('js')
	</div>
</body>

</html>