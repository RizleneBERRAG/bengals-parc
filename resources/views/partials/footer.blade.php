@php
    $tel  = \App\Models\Setting::get('contact.telephone', '06 24 48 89 36');
    $mail = \App\Models\Setting::get('contact.email', 'bengalsparc@gmail.com');
    $insta = \App\Models\Setting::get('contact.instagram');
    $siren = \App\Models\Setting::get('legal.siren');
@endphp

<footer>
    <div class="wrap">
        <div class="fgrid">
            <div>
                <h4>Chatterie Bengal's Parc</h4>
                <p class="small" style="max-width:34ch">
                    Élevage familial de chats Bengal à L'Isle d'Abeau (38080), à 20 minutes de Lyon.
                    Chatons inscrits au LOOF, parents testés, socialisation en famille.
                </p>
                <x-rosettes class="rosettes" style="margin-top:18px" />
            </div>
            <div>
                <h4>L'élevage</h4>
                <ul>
                    <li><a href="{{ route('kittens.index') }}">Chatons disponibles</a></li>
                    <li><a href="{{ route('cats.index') }}">Nos reproducteurs</a></li>
                    <li><a href="{{ route('gallery') }}">Galerie</a></li>
                    <li><a href="{{ route('breed') }}">La race Bengal</a></li>
                </ul>
            </div>
            <div>
                <h4>Adopter</h4>
                <ul>
                    <li><a href="{{ route('adoption.create') }}">Le parcours</a></li>
                    <li><a href="{{ route('adoption.create') }}#couverture">Ce que couvre l'adoption</a></li>
                    <li><a href="{{ route('faq') }}">Questions fréquentes</a></li>
                    <li><a href="{{ route('legal') }}">Mentions légales &amp; RGPD</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul>
                    <li><a href="tel:{{ \Illuminate\Support\Str::of($tel)->replace(' ', '')->replaceFirst('0', '+33') }}">{{ $tel }}</a></li>
                    <li><a href="mailto:{{ $mail }}">{{ $mail }}</a></li>
                    <li><a href="{{ route('contact') }}">Venir nous voir</a></li>
                </ul>
                <div class="socials" style="margin-top:20px">
                    @if($insta)
                        <x-social-link :url="$insta" />
                    @endif
                    <x-social-link type="mail" :url="'mailto:'.$mail" :handle="$mail" />
                    <x-social-link type="tel" :url="'tel:'.\Illuminate\Support\Str::of($tel)->replace(' ', '')->replaceFirst('0', '+33')" :handle="$tel" />
                </div>
            </div>
        </div>
        <div class="fbot">
            <span>© {{ date('Y') }} Bengal's Parc — Certificat de capacité · SIREN {{ $siren ?? 'à compléter' }}</span>
            <span>Rizlene Berrag</span>
        </div>
    </div>
</footer>
