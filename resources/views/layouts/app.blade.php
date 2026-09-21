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

    {{--
        Polices auto-hebergees dans public/fonts. Plus aucun appel a
        fonts.googleapis.com ni fonts.gstatic.com : la typographie tient donc
        sans reseau — en demonstration chez l'eleveuse comme sur une connexion
        mediocre. Les deux fichiers precharges sont ceux du premier ecran ;
        crossorigin est obligatoire meme en same-origin, une police etant
        toujours recuperee en mode CORS.
    --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/bodoni-moda-normal-400-800-latin.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/archivo-normal-300-latin.woff2') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">

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
