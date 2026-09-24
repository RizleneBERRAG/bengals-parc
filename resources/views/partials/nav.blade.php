@php
    $tel    = \App\Models\Setting::get('contact.telephone', '06 24 48 89 36');
    $insta  = \App\Models\Setting::get('contact.instagram');
    $tiktok = \App\Models\Setting::get('contact.tiktok');
@endphp

<header class="nav" id="nav">
    <div class="wrap navin">
        <a class="brand" href="{{ route('home') }}">
            <b>Bengal's Parc</b>
            <small>Chatterie · L'Isle d'Abeau</small>
        </a>

        <nav class="menu" id="menu" aria-label="Navigation principale">
            <a href="{{ route('kittens.index') }}" @if(request()->routeIs('kittens.*')) aria-current="page" @endif>Nos chatons</a>
            <a href="{{ route('cats.index') }}"    @if(request()->routeIs('cats.*'))    aria-current="page" @endif>L'élevage</a>
            <a href="{{ route('breed') }}"         @if(request()->routeIs('breed'))     aria-current="page" @endif>Le Bengal</a>
            <a href="{{ route('gallery') }}"       @if(request()->routeIs('gallery'))   aria-current="page" @endif>Galerie</a>
            <a href="{{ route('adoption.create') }}" @if(request()->routeIs('adoption.*')) aria-current="page" @endif>Adopter</a>
            <a href="{{ route('faq') }}"           @if(request()->routeIs('faq'))       aria-current="page" @endif>Questions</a>
            <a href="{{ route('contact') }}"       @if(request()->routeIs('contact'))   aria-current="page" @endif>Contact</a>

            {{-- Pied du panneau, affiche seulement quand le menu EST un panneau.
                 Sous 1000px le bandeau masque le numero et les icones sociales :
                 sans ce bloc, le telephone — la facon dont on joint un elevage —
                 disparait de toute la navigation. --}}
            <div class="menu-pied">
                <a class="menu-appel" href="{{ \App\Models\Setting::telephoneLien() }}">
                    <span class="k">Appeler l'élevage</span>
                    <span class="v">{{ $tel }}</span>
                </a>
                @if($insta || $tiktok)
                    <div class="menu-reseaux">
                        @if($insta)
                            <a href="{{ $insta }}" target="_blank" rel="noopener noreferrer">Instagram</a>
                        @endif
                        @if($tiktok)
                            <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer">TikTok</a>
                        @endif
                    </div>
                @endif
            </div>
        </nav>

        <div class="navcta">
            @if($insta)
                <x-social-link :url="$insta" />
            @endif
            @if($tiktok)
                <x-social-link type="tiktok" :url="$tiktok" handle="@bengals.parc" />
            @endif
            <a class="tel" href="{{ \App\Models\Setting::telephoneLien() }}">{{ $tel }}</a>
            {{-- L'intitule suit aria-expanded, que le script tient deja a jour :
                 un seul etat a maintenir, jamais de bouton « Menu » sur un menu
                 ouvert. --}}
            <button class="burger" id="burger" type="button" aria-expanded="false" aria-controls="menu">
                <span class="b-ouvrir">Menu</span>
                <span class="b-fermer">Fermer</span>
            </button>
        </div>
    </div>

    {{-- Jauge de lecture : un filet de bronze sur le bord bas du bandeau, rempli
         par la position de la page. Purement decoratif, et absent des navigateurs
         qui ne connaissent pas animation-timeline. --}}
    <span id="jauge" aria-hidden="true"></span>
</header>
