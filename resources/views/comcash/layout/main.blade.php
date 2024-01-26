<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800;9..40,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

		<link rel="apple-touch-icon" sizes="120x120" href="/comcash/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/comcash/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/comcash/favicon-16x16.png">
		<link rel="manifest" href="/comcash/site.webmanifest">
		<link rel="mask-icon" href="/comcash/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		@include('comcash.layout.ads')
		@vite('resources/js/comcash/main.ts')
	</head>
	<body>
		@include('comcash.component.header_info')
        @include('comcash.component.header_main')

		@yield("content")

		@include('comcash.component.modal_auth')

		@include('comcash.component.footer_main')

		<script>
			window.language = "{{mb_strtolower(app()->getLocale())}}";
			window.isChristmasThemeComcash = "{{env('THEME_SUBNAME', false)}}" == "christmas" ? true : false;
		</script>
		@yield('js')
		<script src="//code.jivosite.com/widget/oirWWejdYl" async></script>
		<!-- Google Tag Manager --> 
		<script>
			(function(w,d,s,l,i,cid){
					w[l]=w[l]||[];
					w.pclick_client_id=cid;
					w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
					var f=d.getElementsByTagName(s)[0], j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:''; 
					j.async=true; j.src= '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-P23G9N', '92140');
		</script> 
		<!-- End Google Tag Manager -->
	</body>
</html>
