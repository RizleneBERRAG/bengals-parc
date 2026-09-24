<?php
$f = 'resources/views/pages/gallery.blade.php';
$s = file_get_contents($f);

// 1. La grille reserve sa place : plus de reorganisation a chaque image.
$old = '                <figure data-full="{{ asset($photo->chemin) }}" data-legende="{{ $photo->legende }}">'."\n"
     . '                    <img src="{{ asset($photo->chemin) }}" alt="{{ $photo->alt }}" loading="lazy">';
$new = '                <figure data-full="{{ asset($photo->chemin) }}" data-legende="{{ $photo->legende }}"'."\n"
     . '                        data-categorie="{{ $photo->categorie }}">'."\n"
     . '                    {{-- width et height declares : sans eux le navigateur ne peut reserver'."\n"
     . '                         aucune place, et la grille en colonnes se reorganise a chaque image'."\n"
     . '                         qui arrive. Sur trente-six photos, ça saute pendant plusieurs'."\n"
     . '                         secondes. Les dimensions viennent de la base, relevees a'."\n"
     . '                         l\'enregistrement de la photo. --}}'."\n"
     . '                    <img src="{{ asset($photo->chemin) }}" alt="{{ $photo->alt }}" loading="lazy"'."\n"
     . '                         @if($photo->largeur && $photo->hauteur) width="{{ $photo->largeur }}" height="{{ $photo->hauteur }}" @endif>';

if (substr_count($s, $old) !== 1) { fwrite(STDERR, "ancre figure introuvable\n"); exit(1); }
$s = str_replace($old, $new, $s);
echo "  dimensions declarees\n";

// 2. Toutes les photos sont rendues ; le filtre agit cote client.
$old = '            @foreach($photos->when(request(\'categorie\'), fn ($c) => $c->where(\'categorie\', request(\'categorie\'))) as $photo)';
$new = '            {{-- Toutes les photos sont rendues : le filtre les masque sur place au'."\n"
     . '                 lieu de recharger la page. Le serveur n\'en renvoyait de toute façon'."\n"
     . '                 jamais moins — il les filtrait ici apres les avoir toutes chargees. --}}'."\n"
     . '            @foreach($photos as $photo)';
if (substr_count($s, $old) !== 1) { fwrite(STDERR, "ancre boucle introuvable\n"); exit(1); }
$s = str_replace($old, $new, $s);
echo "  toutes les photos rendues\n";

// 3. Un message quand un filtre ne donne rien.
$old = '        </div>'."\n".'    </div>'."\n".'</section>';
$new = '        </div>'."\n\n"
     . '        <p class="small" id="galerie-vide" hidden style="margin-top:28px">'."\n"
     . '            Aucune photo dans cette catégorie pour le moment.'."\n"
     . '        </p>'."\n"
     . '    </div>'."\n</section>";
if (substr_count($s, $old) !== 1) { fwrite(STDERR, "ancre fin introuvable\n"); exit(1); }
$s = str_replace($old, $new, $s);
echo "  message de categorie vide\n";

file_put_contents($f, $s);
