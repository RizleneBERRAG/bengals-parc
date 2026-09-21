@extends('layouts.app')

@section('title', "Contact — venir voir les chatons")
@section('description', "Écrivez-nous ou appelez l'élevage Bengal's Parc à L'Isle d'Abeau (38), à 20 minutes de Lyon. Visites sur rendez-vous, réponse sous 48 heures.")

@push('scripts')
    @vite('resources/js/map.js')
@endpush

@php
    $tel    = \App\Models\Setting::get('contact.telephone');
    $telRaw = \Illuminate\Support\Str::of($tel)->replace(' ', '')->replaceFirst('0', '+33');
    $mail   = \App\Models\Setting::get('contact.email');
    $insta  = \App\Models\Setting::get('contact.instagram');
@endphp

@section('content')

<section class="band">
    <div class="wrap">
        <x-section-head
            eyebrow="Contact"
            titre="Écrivez-nous, ou appelez"
            lede="Un appel vaut souvent mieux qu'un long formulaire — nous décrochons en soirée et le week-end. Si vous préférez écrire, tout est ci-dessous : réponse sous 48 heures." />

        <div class="two off" style="align-items:start">

            {{-- ---------------- formulaire ---------------- --}}
            <div id="formulaire">

                @if(session('succes'))
                    <p class="flash">{{ session('succes') }}</p>
                @endif

                @if($errors->any())
                    <div class="flash err">
                        Votre message n'a pas pu être envoyé :
                        <ul>
                            @foreach($errors->all() as $erreur)
                                <li>{{ $erreur }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="demo form-dark" method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    {{-- Piege a robots : invisible pour un humain. --}}
                    <div style="position:absolute;left:-9999px" aria-hidden="true">
                        <label for="c-site">Site</label>
                        <input type="text" id="c-site" name="site" tabindex="-1" autocomplete="off">
                    </div>

                    <fieldset class="field full" style="border:0;padding:0;margin:0">
                        <legend style="padding:0;margin-bottom:11px"
                                class="mono" >Votre demande</legend>
                        <div class="objets">
                            @foreach($objets as $cle => $libelle)
                                <label for="c-objet-{{ $cle }}">
                                    <input type="radio" id="c-objet-{{ $cle }}" name="objet" value="{{ $cle }}"
                                           @checked(old('objet', 'adoption') === $cle)>
                                    <span>{{ $libelle }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <div class="field">
                        <label for="c-prenom">Prénom</label>
                        <input id="c-prenom" name="prenom" type="text" autocomplete="given-name"
                               value="{{ old('prenom') }}" required>
                    </div>
                    <div class="field">
                        <label for="c-nom">Nom</label>
                        <input id="c-nom" name="nom" type="text" autocomplete="family-name" value="{{ old('nom') }}">
                    </div>
                    <div class="field">
                        <label for="c-email">Email</label>
                        <input id="c-email" name="email" type="email" autocomplete="email"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="field">
                        <label for="c-tel">Téléphone</label>
                        <input id="c-tel" name="telephone" type="tel" autocomplete="tel" value="{{ old('telephone') }}">
                    </div>

                    <div class="field full">
                        <label for="c-message">Votre message</label>
                        <textarea id="c-message" name="message" required
                                  placeholder="Dites-nous ce qui vous amène : un chaton en particulier, une visite, une question sur la race…">{{ old('message') }}</textarea>
                    </div>

                    <label class="consent" for="c-rgpd">
                        <input type="checkbox" id="c-rgpd" name="rgpd" value="1" @checked(old('rgpd'))>
                        <span>
                            J'accepte que Bengal's Parc conserve ces informations pour répondre à mon
                            message. Elles ne sont jamais transmises à un tiers et sont supprimées au bout
                            de {{ \App\Models\ContactMessage::MOIS_CONSERVATION }} mois.
                            <a href="{{ route('legal') }}">Politique de confidentialité</a>
                        </span>
                    </label>

                    <div class="full"><button class="btn" type="submit">Envoyer le message</button></div>
                </form>
            </div>

            {{-- ---------------- coordonnées ---------------- --}}
            <div class="stack" style="gap:20px">
                <x-record titre="Nous joindre directement">
                    <table>
                        <tr><th>Téléphone</th><td><a href="tel:{{ $telRaw }}" style="color:var(--bronze-lt);text-decoration:none">{{ $tel }}</a></td></tr>
                        <tr><th>Email</th><td><a href="mailto:{{ $mail }}" style="color:var(--bronze-lt);text-decoration:none">{{ $mail }}</a></td></tr>
                        <tr><th>Visites</th><td>Sur rendez-vous, week-end et fin de journée</td></tr>
                        <tr><th>Réponse</th><td>Sous 48 heures maximum</td></tr>
                    </table>
                </x-record>

                <div class="socials">
                    @if($insta)
                        <x-social-link :url="$insta" />
                    @endif
                    <x-social-link type="mail" :url="'mailto:'.$mail" :handle="$mail" />
                    <x-social-link type="tel" :url="'tel:'.$telRaw" :handle="$tel" />
                </div>

                <div class="btnrow">
                    <a class="btn" href="tel:{{ $telRaw }}">Appeler l'élevage</a>
                    <a class="btn ghost" href="{{ route('adoption.create') }}">Demander une visite</a>
                </div>

                <figure class="figure" style="margin:0">
                    <img src="{{ asset('images/cats/ambiance.webp') }}"
                         alt="Bengals de la chatterie Bengal's Parc" loading="lazy">
                    <figcaption>Fin de journée à la maison</figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>

{{-- ---------------- avis ---------------- --}}
{{--
    Avis repris de la fiche Google de l'elevage, saisis dans le back-office.
    Deux regles tenues ici :
    - prenom seul, jamais de nom de famille, comme l'annonce la page Mentions legales ;
    - le lien vers la fiche Google reste visible, pour que le lecteur verifie la
      source lui-meme plutot que de nous croire sur parole.
    Pas de balisage schema.org Review : les regles de Google interdisent de
    republier en donnees structurees des avis collectes sur une autre plateforme.
--}}
@if($avis->isNotEmpty())
<section class="band paper tight">
    <div class="wrap">
        <x-section-head
            eyebrow="Ils sont passés par là"
            titre="Ce que disent les familles"
            lede="Avis publiés sur la fiche Google de l'élevage, repris ici avec l'accord de leurs auteurs. Prénom seul — aucun nom de famille n'est publié sur ce site." />

        <div class="cells">
            @foreach($avis as $a)
                <div class="cell-b">
                    <span class="n">{{ $a->etoiles() }}</span>
                    <p>{{ $a->texte }}</p>
                    <span class="n" style="margin-top:auto">{{ $a->prenom }}@if($a->publie_le) · {{ $a->publie_le->translatedFormat('F Y') }}@endif</span>
                </div>
            @endforeach
        </div>

        @if($avisGoogle = \App\Models\Setting::get('contact.avis_google'))
            <p style="margin-top:24px">
                <a class="tlink" href="{{ $avisGoogle }}" target="_blank" rel="noopener noreferrer">
                    Voir tous les avis sur Google
                </a>
            </p>
        @endif
    </div>
</section>
@endif
{{-- ---------------- carte ---------------- --}}
<section class="band ink2 tight">
    <div class="wrap">
        <x-section-head
            eyebrow="Venir jusqu'à nous"
            titre="À vingt minutes de Lyon"
            lede="L'élevage est à L'Isle d'Abeau, en Isère. L'adresse exacte vous est communiquée lors de la prise de rendez-vous — la carte situe la zone et les principaux accès." />

        <div class="mapwrap">
            <div id="carte" data-carte='@json($points)' role="application"
                 aria-label="Carte de situation de l'élevage à L'Isle d'Abeau"></div>
            <div class="mapcard">
                <h4>Temps de trajet</h4>
                <dl>
                    @foreach($points['reperes'] as $repere)
                        <dt>{{ $repere['titre'] }}</dt>
                        <dd>{{ $repere['detail'] }}</dd>
                    @endforeach
                </dl>
                <p class="small" style="font-size:.78rem">
                    Nous pouvons venir vous chercher à la gare de La Verpillière.
                </p>
                {{-- Vise la commune, pas l'adresse exacte : celle-ci n'est donnée
                     qu'au rendez-vous, un itinéraire porte-à-porte la publierait. --}}
                <a class="btn ghost" href="{{ $itineraire }}" target="_blank" rel="noopener noreferrer"
                   style="margin-top:18px;width:100%;justify-content:center;padding:12px 18px;font-size:.84rem">
                    Itinéraire sur Google Maps
                </a>
            </div>
        </div>

        <p class="small" style="margin-top:16px">
            Carte &copy; OpenStreetMap et CARTO. Aucun traceur publicitaire n'est chargé sur cette page :
            le lien d'itinéraire ouvre Google Maps dans un nouvel onglet, rien n'est chargé depuis Google ici.
        </p>
    </div>
</section>

@endsection
