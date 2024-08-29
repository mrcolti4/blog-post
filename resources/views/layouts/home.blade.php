<!doctype html>
<html class="dark h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mandali&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    @yield("head")
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="h-full bg-background font-Mandali relative text-text">

    <x-header/>
    @yield("content")
    @yield("scripts")
</body>
</html>
