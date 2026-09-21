@extends('layouts.app')

@section('title', "Élevage de chats Bengal près de Lyon")
@section('description', "Chatons Bengal inscrits au LOOF à L'Isle d'Abeau (38), à 20 minutes de Lyon. Parents testés HCM, PK-Def et PRA-b, chatons élevés en famille, cédés identifiés et vaccinés.")

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'LocalBusiness',
    'name'     => "Bengal's Parc",
    'description' => "Élevage familial de chats Bengal à L'Isle d'Abeau, près de Lyon.",
    'url'      => route('home'),
    'telephone' => \App\Models\Setting::get('contact.telephone'),
    'email'     => \App\Models\Setting::get('contact.email'),
    'address'  => [
        '@type' => 'PostalAddress',
        'addressLocality' => \App\Models\Setting::get('elevage.ville'),
        'postalCode'      => \App\Models\Setting::get('elevage.code_postal'),
        'addressRegion'   => \App\Models\Setting::get('elevage.departement'),
        'addressCountry'  => 'FR',
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush

@section('content')

<section class="hero">
    <div class="bg"><img src="{{ asset('images/cats/hero-duo.webp') }}" alt="Deux Bengals de la chatterie installés sur un plaid, robes brown tabby rosetted et spotted" width="1448" height="1086" fetchpriority="high"></div>
    <div class="scrim"></div>
    <div class="inner wrap">
        <span class="eyebrow">Chatterie Bengal's Parc · L'Isle d'Abeau (38) · Chatons LOOF</span>
        <h1>Le léopard tient<br><em>dans un salon.</em></h1>
        <p class="lede">
            Élevage familial de chats Bengal à vingt minutes de Lyon. Une à deux portées par an,
            élevées au milieu de la maison, parents testés, chatons inscrits au LOOF et cédés
            identifiés, vaccinés et sous contrat.
        </p>
        <div class="btnrow">
            <a class="btn" href="{{ route('kittens.index') }}">
                @if($nbDispo > 0) Voir les {{ $nbDispo }} chatons disponibles @else Voir la portée en cours @endif
            </a>
            <a class="btn ghost" href="{{ route('adoption.create') }}">Le parcours d'adoption</a>
        </div>
    </div>
    <div class="photocred">À LA MAISON<br>Brown tabby rosetted et spotted</div>
</section>

@if($portee)
<div class="livestrip">
    <div class="wrap in">
        <span class="pulse"></span>
        <span class="mono" style="color:var(--ivory-dim)">{{ $portee->code }} · {{ $portee->pere?->nom }} × {{ $portee->mere?->nom }}</span>
        <span>
            <strong>{{ $nbDispo }} chaton{{ $nbDispo > 1 ? 's' : '' }} disponible{{ $nbDispo > 1 ? 's' : '' }}</strong>
            <span style="color:var(--ivory-dim)">— né{{ $portee->nb_chatons > 1 ? 's' : '' }} le {{ $portee->date_naissance->translatedFormat('j F Y') }},
            départs possibles depuis le {{ $portee->date_disponibilite?->translatedFormat('j F Y') }}</span>
        </span>
        <a class="tlink" href="{{ route('kittens.index') }}">Voir la portée</a>
    </div>
</div>
@endif

<div class="band tight" style="padding-block:clamp(26px,3vw,40px)">
    <x-photo-strip titre="La vie à l'élevage" />
</div>

@if($chatons->isNotEmpty())
<section class="band">
    <div class="wrap">
        <x-section-head
            eyebrow="Portée en cours"
            titre="La {{ \Illuminate\Support\Str::lower($portee->code) }} est arrivée"
            lede="{{ $portee->nb_chatons }} chatons nés le {{ $portee->date_naissance->translatedFormat('j F Y') }} de {{ $portee->pere?->nom }} et {{ $portee->mere?->nom }}. Chaque chaton a sa fiche : robe, sexe, poids, numéro d'identification, suivi vétérinaire et statut mis à jour en direct." />

        <div class="grid">
            @foreach($chatons as $chaton)
                <x-kitten-card :chaton="$chaton" />
            @endforeach
        </div>

        <div class="btnrow" style="margin-top:36px">
            <a class="btn ghost" href="{{ route('kittens.index') }}">Toutes les portées</a>
        </div>
    </div>
</section>
@endif

<section class="band ink2">
    <div class="wrap">
        <div class="two off">
            <div class="overlap">
                <figure class="a figure"><img src="{{ asset('images/cats/couple.webp') }}" alt="Uzumaki et Uanna, couple de Bengals" loading="lazy"></figure>
                <figure class="b figure"><img src="{{ asset('images/cats/chatons-pile.webp') }}" alt="Chatons Bengal endormis" loading="lazy"></figure>
            </div>
            <div class="stack">
                <span class="eyebrow">Notre façon de faire</span>
                <p class="quote">« Un chaton ne se commande pas en trois clics. »</p>
                <p class="lede">
                    Nous ne faisons pas de volume. Une à deux portées par an, élevées dans la maison,
                    au milieu des enfants, du chien et de l'aspirateur. Personne ne part avant douze
                    semaines, personne ne part sans que sa famille soit venue le voir.
                </p>
                <a class="tlink" href="{{ route('cats.index') }}">Découvrir l'élevage</a>
            </div>
        </div>
    </div>
</section>

<section class="band paper">
    <div class="wrap">
        <x-section-head
            eyebrow="Ce qui change tout"
            titre="Quatre engagements, pas des promesses"
            lede="Ce que nous tenons avant même que vous nous contactiez — et que vous pouvez vérifier sur ce site." />

        <div class="cells">
            <div class="cell-b"><span class="n">ENGAGEMENT 01</span><h3>Parents testés</h3><p>HCM par échographie cardiaque, PK-Def et PRA-b par test ADN, dépistage FIV/FeLV. Les résultats sont publiés sur la fiche de chaque reproducteur, pas promis au téléphone.</p></div>
            <div class="cell-b"><span class="n">ENGAGEMENT 02</span><h3>Élevés au salon</h3><p>Aucune cage, aucune pièce à part. Les chatons grandissent avec les bruits de la maison, les enfants, le chien, la machine à laver et les visites.</p></div>
            <div class="cell-b"><span class="n">ENGAGEMENT 03</span><h3>Jamais avant douze semaines</h3><p>Départ à partir de trois mois, identifiés, primo-vaccinés et rappelés, avec un certificat vétérinaire de bonne santé de moins de huit jours.</p></div>
            <div class="cell-b"><span class="n">ENGAGEMENT 04</span><h3>Repris à vie</h3><p>Nous restons joignables après le départ. La reprise du chat est écrite au contrat si votre situation change, quel que soit son âge.</p></div>
        </div>
    </div>
</section>

<section class="band">
    <div class="wrap">
        <x-section-head
            eyebrow="La lignée"
            titre="Nos reproducteurs"
            lede="Chaque fiche affiche la robe, le pedigree et les résultats de dépistage." />
        <div class="repros">
            @foreach($chats as $chat)
                <x-cat-card :chat="$chat" />
            @endforeach
        </div>
    </div>
</section>

<x-photo-band image="images/cats/banner-petits.webp"
              legende="Portée X — quatre paires d’yeux sur le même point"
              hauteur="52vh" />

<section class="band ink2">
    <div class="wrap">
        <div class="two rev">
            <figure class="figure">
                <img src="{{ asset('images/cats/wild.webp') }}" alt="Bengal adulte au repos dans la végétation" loading="lazy">
                <figcaption>Uzumaki — fin d'après-midi au jardin</figcaption>
            </figure>
            <div class="stack">
                <span class="eyebrow">La race</span>
                <h2>Un chat sauvage d'apparence,<br>un chat de famille de caractère</h2>
                <p class="lede">
                    Le Bengal descend d'un croisement entre le chat léopard du Bengale et des chats
                    domestiques, fixé en Californie par Jean S. Mill dans les années 1960 et reconnu
                    en 1983. De son ancêtre il garde la robe — rosettes, glitter, ligne dorsale — et
                    l'énergie. Le reste est un chat de compagnie bavard, joueur et franchement collant.
                </p>
                <a class="tlink" href="{{ route('breed') }}">Apprendre à lire une robe</a>
            </div>
        </div>
    </div>
</section>

@if($photos->isNotEmpty())
<section class="band">
    <div class="wrap">
        <x-section-head eyebrow="La maison" titre="Ils grandissent ici" />
        <div class="masonry" id="mas">
            @foreach($photos as $photo)
                <figure data-full="{{ asset($photo->chemin) }}" data-legende="{{ $photo->legende }}">
                    <img src="{{ asset($photo->chemin) }}" alt="{{ $photo->alt }}" loading="lazy">
                    <figcaption>{{ $photo->legende }}</figcaption>
                </figure>
            @endforeach
        </div>
        <div class="btnrow" style="margin-top:30px">
            <a class="btn ghost" href="{{ route('gallery') }}">Voir toute la galerie</a>
        </div>
    </div>
</section>
@endif

<section class="band ink2">
    <div class="wrap">
        <x-section-head
            eyebrow="Transparence"
            titre="Ce que vous pouvez vérifier"
            lede="Les informations qu'un éleveur doit pouvoir donner avant toute réservation. Elles sont affichées ici, pas sur demande." />

        <div class="legalgrid">
            <div class="legalcell"><span class="k">Élevage</span><span class="v">{{ \App\Models\Setting::get('elevage.nom') }}</span></div>
            <div class="legalcell"><span class="k">Adresse</span><span class="v">{{ \App\Models\Setting::get('elevage.ville') }} ({{ \App\Models\Setting::get('elevage.code_postal') }}), {{ \App\Models\Setting::get('elevage.departement') }}</span></div>
            <div class="legalcell"><span class="k">Certificat de capacité</span><x-legal-value cle="legal.certificat" /></div>
            <div class="legalcell"><span class="k">SIREN</span><x-legal-value cle="legal.siren" /></div>
            <div class="legalcell"><span class="k">N° de portée LOOF</span>
                @if($portee?->loof_portee_numero)
                    <span class="v">{{ $portee->loof_portee_numero }}</span>
                @else
                    <span class="v todo">À compléter</span>
                @endif
            </div>
            <div class="legalcell"><span class="k">Identification</span><span class="v">Puce ICAD avant cession</span></div>
            <div class="legalcell"><span class="k">Âge minimum de cession</span><span class="v">{{ \App\Models\Litter::SEMAINES_AVANT_CESSION }} semaines</span></div>
            <div class="legalcell"><span class="k">Contrat</span><span class="v">Écrit et signé à chaque cession</span></div>
        </div>

        <p class="lede" style="margin-top:24px;font-size:.9rem">
            Les champs « à compléter » sont ceux que la loi impose d'afficher sur toute annonce de
            cession de chat. Le site les réclame automatiquement : une fiche chaton ne peut pas être
            publiée tant que son numéro d'identification est vide.
        </p>
    </div>
</section>

<section class="band paper">
    <div class="wrap">
        <x-section-head
            centre
            eyebrow="Prendre rendez-vous"
            titre="Venez les rencontrer avant de décider"
            lede="Aucun chaton ne part sans que sa famille soit venue le voir. Les visites se font sur rendez-vous, à L'Isle d'Abeau, le week-end ou en fin de journée." />
        <div class="btnrow" style="justify-content:center">
            <a class="btn" href="{{ route('adoption.create') }}">Demander une visite</a>
            <a class="btn ghost" href="tel:+33624488936">{{ \App\Models\Setting::get('contact.telephone') }}</a>
        </div>
    </div>
</section>

@endsection
