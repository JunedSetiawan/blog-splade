<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('icon/icon_abs.jpg') }}" type="image/x-icon">

    {{-- Htmx --}}
    <script src="https://unpkg.com/htmx.org@1.9.5"
        integrity="sha384-xcuj3WpfgjlKF+FXhSQFQ0ZNr39ln+hwjN3npfM9VBnUskLolQAcN80McRIVOPuO" crossorigin="anonymous"
        defer></script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @spladeHead
</head>

<body class="font-sans antialiased">
    @splade
</body>

</html>