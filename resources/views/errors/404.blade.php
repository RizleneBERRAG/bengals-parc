@extends('layouts.app')

@section('title', "Cette page n'existe pas")
@section('description', "La page demandée n'existe pas ou plus sur le site de l'élevage Bengal's Parc.")

@push('head')
    <meta name="robots" content="noindex">
@endpush

@php
    // Le visiteur arrive peut-être d'un vieux lien ou d'un résultat de recherche
    // périmé : si le premier segment correspond à une ancienne adresse connue, on
    // propose la bonne page au lieu de le laisser dans une impasse.
    $segment    = trim(request()->path(), '/');
    $suggestion = config('bengal.anciennes_urls')[$segment] ?? null;
@endphp

@section('content')

<section class="band">
    <div class="wrap" style="max-width:760px">
        <x-section-head
            niveau="1"
            eyebrow="Erreur 404"
            titre="Cette page n’existe pas"
            lede="Le lien est peut-être ancien, ou l’adresse comporte une erreur. Voici par où reprendre." />

        @if($suggestion)
            <p class="flash" style="margin-bottom:30px">
                Vous cherchiez sans doute
                <a href="{{ route($suggestion) }}">cette page</a> — l’adresse a changé depuis l’ancien site.
            </p>
        @endif

        <div class="cells">
            <a class="cell-b" href="{{ route('kittens.index') }}" style="text-decoration:none">
                <span class="n">Nos chatons</span>
                <p>La portée en cours, les fiches détaillées et les disponibilités.</p>
            </a>
            <a class="cell-b" href="{{ route('cats.index') }}" style="text-decoration:none">
                <span class="n">L’élevage</span>
                <p>Les reproducteurs, leurs pedigrees et leurs dépistages.</p>
            </a>
            <a class="cell-b" href="{{ route('adoption.create') }}" style="text-decoration:none">
                <span class="n">Adopter</span>
                <p>Le parcours en quatre étapes et la demande de pré-réservation.</p>
            </a>
            <a class="cell-b" href="{{ route('contact') }}" style="text-decoration:none">
                <span class="n">Nous joindre</span>
                <p>Par téléphone, par email, ou en venant nous voir sur rendez-vous.</p>
            </a>
        </div>

        <div class="btnrow" style="margin-top:34px">
            <a class="btn" href="{{ route('home') }}">Retour à l’accueil</a>
        </div>
    </div>
</section>

@endsection
