<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Emails</title>
</head>
<body>
    @if($cache == "pending")
        <pre>Выгрузка</pre>
    @else
        <pre>{{$cache}}</pre>
    @endif
</body>
</html>