<?php

/*
 * Contenu editorial fixe du site Bengal's Parc.
 *
 * - 'robe'       : les reperes cliquables de la lecture de robe (page Le Bengal).
 *                  x et y sont des pourcentages sur la photo resources/images/cats/uanna.webp ;
 *                  changer de photo impose de repositionner les reperes.
 * - 'couverture' : le detail de ce que couvre l'adoption (page Adopter).
 *
 * Ces deux blocs ne bougent quasiment jamais : ils restent en config plutot qu'en base.
 * Le reste du contenu (chatons, portees, chats, questions) vit en base de donnees.
 */

return [

    'robe' => [
        [
            'x' => 59,
            'y' => 23,
            'categorie' => 'Motif',
            'titre' => 'Rosette en donut',
            'texte' => 'Une tache claire entièrement cerclée d\'un contour plus foncé, comme un anneau refermé. C\'est le motif le plus recherché de la race, et le plus difficile à fixer : il demande plusieurs générations de sélection.',
        ],
        [
            'x' => 50,
            'y' => 12,
            'categorie' => 'Structure',
            'titre' => 'Ligne dorsale',
            'texte' => 'Sur un Bengal bien typé, les taches ne se rejoignent jamais en une bande continue le long du dos. Une ligne dorsale pleine est un défaut de type, héritage du tabby domestique.',
        ],
        [
            'x' => 85,
            'y' => 57,
            'categorie' => 'Effet',
            'titre' => 'Glitter',
            'texte' => 'Un reflet doré déposé sur la pointe du poil, visible seulement quand la lumière frappe la robe de biais. C\'est un caractère propre au Bengal, hérité de ses origines, qui donne l\'impression que le chat a été saupoudré d\'or.',
        ],
        [
            'x' => 74,
            'y' => 38,
            'categorie' => 'Fond',
            'titre' => 'Fond chaud',
            'texte' => 'Le fond de robe va du sable au cuivre profond. Plus le contraste entre le fond et les rosettes est marqué, plus la robe est considérée comme réussie.',
        ],
        [
            'x' => 26,
            'y' => 23,
            'categorie' => 'Tête',
            'titre' => 'Masque et colliers',
            'texte' => 'Les lignes du front doivent dessiner un M ouvert, et les marques du cou — les colliers — rester brisées. Un collier fermé qui fait le tour de la gorge est, là encore, une trace de tabby domestique.',
        ],
    ],

    'couverture' => [
        [
            'numero' => '01',
            'titre' => 'Saillie et suivi de gestation',
            'detail' => 'Échographie de confirmation, alimentation spécifique de la mère pendant neuf semaines, visites vétérinaires.',
            'quand' => 'Avant la naissance',
        ],
        [
            'numero' => '02',
            'titre' => 'Mise bas et première semaine',
            'detail' => 'Surveillance continue jour et nuit, pesée quotidienne, aide à la tétée si un chaton décroche.',
            'quand' => 'Semaine 1',
        ],
        [
            'numero' => '03',
            'titre' => 'Douze semaines de nourrissage',
            'detail' => 'Lait maternisé au besoin, puis pâtée et croquettes kitten de qualité, pour la mère comme pour les petits.',
            'quand' => 'Semaines 1 à 12',
        ],
        [
            'numero' => '04',
            'titre' => 'Deux vermifugations',
            'detail' => 'Protocole complet, renouvelé avant le départ.',
            'quand' => 'Semaines 5 et 9',
        ],
        [
            'numero' => '05',
            'titre' => 'Identification ICAD',
            'detail' => 'Puce électronique posée et enregistrée au nom de l\'élevage, puis transférée à la famille.',
            'quand' => 'Semaine 6',
        ],
        [
            'numero' => '06',
            'titre' => 'Primo-vaccination et rappel',
            'detail' => 'Typhus et coryza, deux injections, carnet de santé tenu à jour.',
            'quand' => 'Semaines 8 et 12',
        ],
        [
            'numero' => '07',
            'titre' => 'Certificat vétérinaire de bonne santé',
            'detail' => 'Établi moins de huit jours avant la cession, obligatoire et remis en main propre.',
            'quand' => 'Avant le départ',
        ],
        [
            'numero' => '08',
            'titre' => 'Inscription LOOF et pedigree',
            'detail' => 'Déclaration de saillie, déclaration de portée, édition du pedigree officiel.',
            'quand' => 'Semaines 1 à 12',
        ],
        [
            'numero' => '09',
            'titre' => 'Tests des parents',
            'detail' => 'Échographie cardiaque HCM, tests ADN PK-Def et PRA-b, dépistage FIV/FeLV — refaits régulièrement.',
            'quand' => 'Toute l\'année',
        ],
        [
            'numero' => '10',
            'titre' => 'Socialisation quotidienne',
            'detail' => 'Manipulation dès la naissance, habituation aux bruits, aux enfants, au chien, au transport et à la voiture.',
            'quand' => 'Chaque jour',
        ],
        [
            'numero' => '11',
            'titre' => 'Contrat et document d\'information',
            'detail' => 'Contrat de cession écrit, document d\'information sur les besoins de l\'espèce, conseils d\'arrivée.',
            'quand' => 'Au départ',
        ],
        [
            'numero' => '12',
            'titre' => 'Suivi après le départ',
            'detail' => 'Disponibilité à vie pour les questions, et reprise du chat si votre situation change.',
            'quand' => 'Sans limite',
        ],
    ],

    /*
     * Carte de la page Contact.
     * L'adresse exacte n'est jamais publiee : on affiche une zone autour de
     * L'Isle d'Abeau, et les points de repere cites dans les acces.
     */
    'carte' => [
        'zone' => [
            'lat'    => 45.6236,
            'lng'    => 5.2247,
            'rayon'  => 2200,          // metres
            'titre'  => "L'Isle d'Abeau",
            'detail' => "L'élevage — adresse exacte communiquée au rendez-vous",
        ],
        'reperes' => [
            ['lat' => 45.7640, 'lng' => 4.8357, 'titre' => 'Lyon',                 'detail' => "25 min par l'A43"],
            ['lat' => 45.6353, 'lng' => 5.1372, 'titre' => 'Gare de La Verpillière', 'detail' => '10 min en voiture'],
            ['lat' => 45.1885, 'lng' => 5.7245, 'titre' => 'Grenoble',             'detail' => "50 min par l'A48 puis l'A43"],
        ],
    ],

    /*
     * Qui a le droit d'entrer dans le back-office. Lu par User::canAccessPanel().
     * Le site n'ouvre aucune inscription : ajouter une adresse ici est une
     * decision, pas un effet de bord de la creation d'un compte.
     */
    'back_office' => [
        'emails' => [
            'bengalsparc@gmail.com',
        ],
    ],

];