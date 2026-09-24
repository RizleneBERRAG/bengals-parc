@php
    $tel   = \App\Models\Setting::get('contact.telephone', '06 24 48 89 36');
    $insta = \App\Models\Setting::get('contact.instagram');
@endphp

<header class="nav" id="nav">
    <div class="wrap navin">
        <a class="brand" href="{{ route('home') }}">
            <b>Bengal's Parc</b>
            <small>Chatterie · L'Isle d'Abeau</small>
        </a>

        <nav class="menu" id="menu">
            <a href="{{ route('kittens.index') }}" @if(request()->routeIs('kittens.*')) aria-current="page" @endif>Nos chatons</a>
            <a href="{{ route('cats.index') }}"    @if(request()->routeIs('cats.*'))    aria-current="page" @endif>L'élevage</a>
            <a href="{{ route('breed') }}"         @if(request()->routeIs('breed'))     aria-current="page" @endif>Le Bengal</a>
            <a href="{{ route('gallery') }}"       @if(request()->routeIs('gallery'))   aria-current="page" @endif>Galerie</a>
            <a href="{{ route('adoption.create') }}" @if(request()->routeIs('adoption.*')) aria-current="page" @endif>Adopter</a>
            <a href="{{ route('faq') }}"           @if(request()->routeIs('faq'))       aria-current="page" @endif>Questions</a>
            <a href="{{ route('contact') }}"       @if(request()->routeIs('contact'))   aria-current="page" @endif>Contact</a>
            @if($insta)
                {{-- L'icône du bandeau est masquée sous 1000px : on garde l'entrée ici. --}}
                <a class="menu-insta" href="{{ $insta }}" target="_blank" rel="noopener noreferrer">Instagram</a>
            @endif
        </nav>

        <div class="navcta">
            @if($insta)
                <x-social-link :url="$insta" />
            @endif
            <a class="tel" href="{{ \App\Models\Setting::telephoneLien() }}">{{ $tel }}</a>
            <button class="burger" id="burger" type="button" aria-expanded="false" aria-controls="menu">Menu</button>
        </div>
    </div>

    {{-- Jauge de lecture : un filet de bronze sur le bord bas du bandeau, rempli
         par la position de la page. Purement decoratif, et absent des navigateurs
         qui ne connaissent pas animation-timeline. --}}
    <span id="jauge" aria-hidden="true"></span>
</header>
