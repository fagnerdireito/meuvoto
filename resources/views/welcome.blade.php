<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meu Voto</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(to right, #24e2dd, #0675d8);
            background-size: 100% 100%;
            background-position: top;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50"></body>

<div class="bg-cover_ h-screen bg-center bg-no-repeat" style="background-image: url('{{ asset('Home.png') }}');">

</div>

</html>
