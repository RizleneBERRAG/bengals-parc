@props(['eyebrow' => null, 'titre', 'lede' => null, 'centre' => false])

<div class="shead @if($centre) center @endif">
    @unless($centre)
        <x-rosettes class="rosettes rail" />
    @endunless
    <div class="txt">
        @if($eyebrow)<span class="eyebrow">{{ $eyebrow }}</span>@endif
        <h2>{!! $titre !!}</h2>
        @if($lede)<p class="lede">{!! $lede !!}</p>@endif
    </div>
</div>
