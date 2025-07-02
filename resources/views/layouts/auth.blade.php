<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title", "E-Com")</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Ecom" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    @yield("style")
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    @yield("content")
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
    @yield("script")
</body>
</html>