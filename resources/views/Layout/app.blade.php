<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    @vite('resources/css/app.css')



</head>
<body class="bg-gray-50">

    @yield('content')

<script src="../../js/app.js"></script>
</body>
</html>

