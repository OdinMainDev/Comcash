<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800;9..40,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">
  <title>Document</title>
  <script type="module" crossorigin src="/comcash/assets/auth.d70e52c1.js"></script>
  <link rel="stylesheet" href="/comcash/assets/auth.ba7117eb.css">
</head>

<body>
  <div class="not-found">
    <div class="not-found__container">
      <p class="not-found__title">{{$status_code}}</p>
      <p class="not-found__subtitle">{{__("front.page temporarily not working!")}}</p>
      <a class='button' href="/">{{__("front.continue")}}</a>
    </div>

  </div>


</body>

</html>
