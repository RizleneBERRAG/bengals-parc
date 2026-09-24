<?php

namespace App\Console\Commands;

use App\Models\Litter;
use App\Models\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Enregistre en base les images presentes dans public/images/cats.
 * Passerelle en attendant l'upload depuis le back-office : on depose les
 * fichiers, on lance la commande, la galerie se remplit.
 */
class SyncPhotos extends Command
{
    protected $signature = 'photos:sync {--legendes : Rafraîchir aussi les légendes connues des photos déjà en base}';

    protected $description = 'Enregistre les images de public/images/cats dans la galerie';

    /**
     * Legendes connues : [legende affichee, categorie, texte alternatif].
     *
     * La legende est editoriale et courte — elle s'affiche en capitales sur la
     * photo. Le texte alternatif decrit ce qu'on voit, pour un lecteur d'ecran
     * ou quand l'image ne charge pas : ce sont deux textes differents, et les
     * confondre etait justement le reproche fait au site actuel du client.
     *
     * Sans entree ici, le nom de fichier sert de legende — d'ou les « G1 » a
     * « G16 » qui s'affichaient sur la galerie.
     */
    public const LEGENDES = [
        'hero-duo'      => ['Nos Bengals à la maison', 'maison'],
        'hero-uanna'    => ['Uanna — brown tabby rosetted', 'adultes'],
        'uanna'         => ['Uanna — contraste et glitter', 'adultes'],
        'uzumaki'       => ['Uzumaki — portrait', 'adultes'],
        'uzu-harnais'   => ['Uzumaki au jardin', 'adultes'],
        'couple'        => ['Uzumaki et Uanna', 'adultes'],
        'wild'          => ['Après-midi dans la végétation', 'adultes'],
        'xena'          => ['Xena — brown tabby spotted', 'adultes'],
        'xena2'         => ['Sieste de fin d’après-midi', 'maison'],
        'wendy'         => ['Wendy', 'adultes'],
        'ambiance'      => ['Fin de journée à la maison', 'maison'],
        'portee'        => ['Portée W — mars 2025', 'chatons'],
        'chatons-pile'  => ['Fratrie au repos', 'chatons'],
        'banner-petits' => ['Quatre chatons de la portée, tous en alerte', 'chatons'],

        'k1'             => ['Xilo — X-01', 'chatons', 'Xilo, chaton Bengal de la portée X, robe brown tabby spotted rosetted, rosettes en donut bien dessinées sur le dos'],
        'k2'             => ['Xia — X-02', 'chatons', 'Xia, chatonne Bengal de la portée X, robe brown tabby rosetted'],
        'k3'             => ['Xénon — X-03, masque charcoal', 'chatons', 'Xénon, chaton Bengal de la portée X, robe brown charcoal spotted au masque sombre'],
        'k4'             => ['Xali — X-04, snow mink', 'chatons', 'Xali, chaton Bengal de la portée X, robe snow mink spotted aux teintes claires'],
        'k5'             => ['Xuma — X-05, marbled', 'chatons', 'Xuma, chaton Bengal de la portée X, robe brown tabby marbled aux dessins en volutes'],
        'k6'             => ['Portée X', 'chatons', 'Chatons Bengal de la portée X réunis sur le plaid de l’élevage'],

        'g1'             => ['Premiers pas sur le plaid', 'chatons', 'Chaton Bengal assis sur un plaid blanc, rosettes déjà marquées sur les flancs'],
        'g2'             => ['Les yeux encore bleus', 'chatons', 'Chaton Bengal couché sur un plaid blanc, les yeux bleus du jeune âge'],
        'g3'             => ['Le collier de la portée', 'chatons', 'Chaton Bengal assis, collier d’identification violet, près d’une fleur rose'],
        'g4'             => ['Première balle d’osier', 'chatons', 'Chaton Bengal tenant entre ses pattes une balle en osier tressé'],
        'g5'             => ['Curiosité', 'chatons', 'Chaton Bengal de profil reniflant une fleur rose posée sur le plaid'],
        'g6'             => ['Devant le panier', 'chatons', 'Chaton Bengal debout devant un panier en paille, robe brown tabby rosetted'],
        'g7'             => ['Portrait de face', 'chatons', 'Chaton Bengal assis de face, rosettes et masque du visage bien dessinés'],
        'g8'             => ['Bien campé sur ses pattes', 'chatons', 'Chaton Bengal assis sur un plaid blanc devant un panier en paille'],
        'g9'             => ['Les rosettes du dos', 'chatons', 'Chaton Bengal vu de dos, montrant les grandes rosettes en donut de sa robe'],
        'g10'            => ['La fratrie au complet', 'chatons', 'Quatre chatons Bengal de la même portée réunis sur un plaid blanc'],
        'g11'            => ['Trois curieux', 'chatons', 'Trois chatons Bengal serrés les uns contre les autres derrière des balles en osier'],
        'g12'            => ['En exploration', 'chatons', 'Trois chatons Bengal avançant côte à côte vers l’objectif'],
        'g13'            => ['De profil', 'chatons', 'Chaton Bengal debout de profil, rosettes contrastées sur fond clair'],
        'g14'            => ['Sieste', 'chatons', 'Chaton Bengal endormi de dos, rosettes sombres très contrastées'],
        'g15'            => ['Au pied du panier', 'chatons', 'Chaton Bengal couché sur un plaid blanc au pied d’un panier en paille'],
        'g16'            => ['Adulte à la maison', 'adultes', 'Bengal adulte debout sur un canapé, robe brown tabby rosetted et glitter'],
        'wendy'          => ['Wendy', 'adultes', 'Wendy, reproductrice de l’élevage, robe brown tabby'],
    ];

    public function handle(): int
    {
        $dossier = public_path('images/cats');
        $fichiers = glob($dossier.'/*.{webp,jpg,jpeg,png}', GLOB_BRACE) ?: [];

        if ($fichiers === []) {
            $this->warn('Aucune image trouvée dans public/images/cats.');

            return self::FAILURE;
        }

        $ordre = (int) Photo::max('ordre');
        $crees = 0;
        $majs  = 0;
        $dimensions = 0;

        foreach ($fichiers as $fichier) {
            $base    = pathinfo($fichier, PATHINFO_FILENAME);
            $chemin  = 'images/cats/'.basename($fichier);

            $connue = self::LEGENDES[$base] ?? null;

            $legende   = $connue[0] ?? Str::of($base)->replace(['-', '_'], ' ')->ucfirst()->toString();
            $categorie = $connue[1] ?? (Str::startsWith($base, ['k', 'g']) ? 'chatons' : 'adultes');
            // A defaut de texte alternatif propre, la legende fait office — mais
            // c'est un pis-aller : les deux ne disent pas la meme chose.
            $alt       = $connue[2] ?? $legende;

            $photo = Photo::firstOrNew([
                'attachable_type' => Litter::class,
                'attachable_id'   => 0,
                'chemin'          => $chemin,
            ]);

            if (! $photo->exists) {
                $photo->fill([
                    'alt'       => $alt,
                    'legende'   => $legende,
                    'categorie' => $categorie,
                    'ordre'     => ++$ordre,
                ])->save();
                $crees++;
                continue;
            }

            // Les photos d'avant l'ajout des dimensions n'en ont pas : on les
            // releve ici. Le modele ne le fait qu'au changement de chemin.
            if (blank($photo->largeur) || blank($photo->hauteur)) {
                $taille = @getimagesize($fichier);
                if ($taille !== false) {
                    $photo->forceFill(['largeur' => $taille[0], 'hauteur' => $taille[1]])->save();
                    $dimensions++;
                }
            }

            // --legendes : on réaligne les libellés connus, sans toucher au reste.
            if ($this->option('legendes') && isset(self::LEGENDES[$base])) {
                $photo->update(['alt' => $alt, 'legende' => $legende, 'categorie' => $categorie]);
                $majs++;
            }
        }

        $this->info("{$crees} photo(s) ajoutée(s), {$majs} mise(s) à jour, {$dimensions} dimension(s) relevée(s). Galerie : ".Photo::count().' au total.');

        return self::SUCCESS;
    }
}
