<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>@yield('title', "Bengal's Parc") — Élevage de Bengal à L'Isle d'Abeau, près de Lyon</title>
    <meta name="description" content="@yield('description', "Élevage familial de chats Bengal à L'Isle d'Abeau (38), à 20 minutes de Lyon. Chatons inscrits au LOOF, parents testés, socialisation en famille.")">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Bengal's Parc">
    <meta property="og:title" content="@yield('title', "Bengal's Parc")">
    <meta property="og:description" content="@yield('description', "Élevage familial de chats Bengal près de Lyon.")">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..800;1,6..96,400..600&family=Archivo:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    @stack('schema')
</head>
<body>
    <div id="grain" aria-hidden="true"></div>

    @include('partials.nav')

    <main id="app">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
