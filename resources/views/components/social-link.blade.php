@props([
    'url',
    'handle' => '@bengals_parc',
    'reseau' => 'Instagram',
])

{{--
    Icône seule, sans libellé. Au survol, l'anneau s'allume aux couleurs du réseau.
    Le pictogramme est un diaphragme dessiné pour ce site : les règles de marque de
    Meta interdisent de redessiner leur glyphe. Pour mettre l'officiel, remplacer
    le <svg> ci-dessous par l'asset téléchargé sur les ressources de marque Meta.
--}}

<a {{ $attributes->merge(['class' => 'social']) }}
   href="{{ $url }}" target="_blank" rel="noopener noreferrer"
   title="{{ $reseau }} — {{ $handle }}"
   aria-label="{{ $reseau }} {{ $handle }} (nouvelle fenêtre)">
    <span class="social-mark" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9.2"/>
            <path d="M21.2 12 L7.4 20"/><path d="M16.6 20 L2.8 12"/><path d="M7.4 20 L7.4 4"/>
            <path d="M2.8 12 L16.6 4"/><path d="M7.4 4 L21.2 12"/><path d="M16.6 4 L16.6 20"/>
        </svg>
    </span>
</a>
