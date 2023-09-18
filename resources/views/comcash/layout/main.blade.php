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
		<script type="module" crossorigin src="/comcash/assets/cryptoForm.2aa130a4.js"></script>
  		<link rel="stylesheet" href="/comcash/assets/cryptoForm.fc2143ef.css">
		<link rel="stylesheet" href="/comcash/assets/custom.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
	</head>
	<body>
        @include('comcash.component.header_main')

		@yield("content")
        @guest
            @include('comcash.component.modal_auth')
        @endguest

		<script>
			window.language = "{{mb_strtolower(app()->getLocale())}}";
		</script>
        @vite("resources/js/comcash.js")

		@yield('js')
	</body>
</html>