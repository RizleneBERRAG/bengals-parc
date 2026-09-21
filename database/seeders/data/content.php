<?php

/*
 * Contenu de reference du site Bengal's Parc.
 *
 * Ce fichier est extrait tel quel de la maquette HTML validee par le client :
 * textes des reproducteurs, chatons, suivi de portee, lecture de robe, galerie,
 * detail de ce que couvre l'adoption et questions frequentes.
 * Il ne sert qu'au seeder de demarrage — une fois le back-office en place,
 * la verite est en base, plus ici.
 */

return [
        'REPROS' => [
            'uzumaki' => [
                'id' => 'uzumaki',
                'nom' => 'UZUMAKI',
                'sexe' => 'Mâle',
                'role' => 'Étalon',
                'naissance' => '2023',
                'robe' => 'Brown tabby spotted rosetted',
                'loof' => 'LOOF 2023-XXXXXX',
                'icad' => '250 26X XXX XXX XXX',
                'photo' => 'uzumaki',
                'photo2' => 'uzu-harnais',
                'texte' => 'Rosettes en donut nettement cerclées sur un fond doré profond, ligne dorsale marquée, front large et museau puissant. Caractère vif et demandeur de contact — c\'est lui qui vient accueillir les visiteurs à la porte, avant même qu\'on ait sonné.',
                'tests' => [
                    [
                        'HCM — échographie cardiaque',
                        'Normal',
                        'Contrôle annuel',
                    ],
                    [
                        'PK-Def — déficit en pyruvate kinase',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'PRA-b — atrophie rétinienne',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'FIV / FeLV',
                        'Négatif',
                        'Dépistage sanguin',
                    ],
                ],
            ],
            'uanna' => [
                'id' => 'uanna',
                'nom' => 'UANNA',
                'sexe' => 'Femelle',
                'role' => 'Reproductrice',
                'naissance' => '2023',
                'robe' => 'Brown tabby rosetted',
                'loof' => 'LOOF 2023-XXXXXX',
                'icad' => '250 26X XXX XXX XXX',
                'photo' => 'uanna',
                'photo2' => 'hero-uanna',
                'texte' => 'Contraste très soutenu, rosettes larges et bien ouvertes, glitter franchement visible en pleine lumière. Mère extrêmement présente : elle élève ses portées au milieu du salon, ce qui explique le niveau de socialisation de ses chatons.',
                'tests' => [
                    [
                        'HCM — échographie cardiaque',
                        'Normal',
                        'Contrôle annuel',
                    ],
                    [
                        'PK-Def — déficit en pyruvate kinase',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'PRA-b — atrophie rétinienne',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'FIV / FeLV',
                        'Négatif',
                        'Dépistage sanguin',
                    ],
                ],
            ],
            'xena' => [
                'id' => 'xena',
                'nom' => 'XENA',
                'sexe' => 'Femelle',
                'role' => 'Jeune femelle — en observation',
                'naissance' => '2025',
                'robe' => 'Brown tabby spotted',
                'loof' => 'LOOF 2025-XXXXXX',
                'icad' => '250 26X XXX XXX XXX',
                'photo' => 'xena',
                'photo2' => 'xena2',
                'texte' => 'Gardée à l\'élevage pour la suite du programme. Tests ADN déjà réalisés, échographie cardiaque programmée avant toute mise à la reproduction : aucune saillie tant que le bilan n\'est pas complet.',
                'tests' => [
                    [
                        'HCM — échographie cardiaque',
                        'À programmer',
                        'Avant reproduction',
                    ],
                    [
                        'PK-Def — déficit en pyruvate kinase',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'PRA-b — atrophie rétinienne',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'FIV / FeLV',
                        'Négatif',
                        'Dépistage sanguin',
                    ],
                ],
            ],
            'wendy' => [
                'id' => 'wendy',
                'nom' => 'WENDY',
                'sexe' => 'Femelle',
                'role' => 'Jeune femelle — en observation',
                'naissance' => '2025',
                'robe' => 'Brown tabby spotted rosetted',
                'loof' => 'LOOF 2025-XXXXXX',
                'icad' => '250 26X XXX XXX XXX',
                'photo' => 'wendy',
                'photo2' => 'chatons-pile',
                'texte' => 'Issue de la lignée maison. Tempérament très posé, excellente avec les enfants et le chien — un profil que nous cherchons à fixer dans les prochaines portées.',
                'tests' => [
                    [
                        'HCM — échographie cardiaque',
                        'À programmer',
                        'Avant reproduction',
                    ],
                    [
                        'PK-Def — déficit en pyruvate kinase',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'PRA-b — atrophie rétinienne',
                        'N/N',
                        'Test ADN',
                    ],
                    [
                        'FIV / FeLV',
                        'Négatif',
                        'Dépistage sanguin',
                    ],
                ],
            ],
        ],
        'CHATONS' => [
            [
                'id' => 'xilo',
                'nom' => 'XILO',
                'sexe' => 'Mâle',
                'robe' => 'Brown tabby spotted rosetted',
                'statut' => 'dispo',
                'photo' => 'k1',
                'ref' => 'X-01',
                'poids' => '1 480 g',
                'texte' => 'Le plus entreprenant de la portée. Rosettes déjà bien cerclées sur les flancs, fond très chaud. Premier à venir vers les visiteurs, premier dans la gamelle, premier à ouvrir les portes de placard.',
            ],
            [
                'id' => 'xia',
                'nom' => 'XIA',
                'sexe' => 'Femelle',
                'robe' => 'Brown tabby rosetted',
                'statut' => 'dispo',
                'photo' => 'k2',
                'ref' => 'X-02',
                'poids' => '1 320 g',
                'texte' => 'Contraste marqué et glitter net sur le dos. Caractère plus observateur : elle regarde d\'abord, puis ne vous lâche plus de la soirée. Très à l\'aise avec le chien de la maison.',
            ],
            [
                'id' => 'xenon',
                'nom' => 'XÉNON',
                'sexe' => 'Mâle',
                'robe' => 'Brown charcoal spotted',
                'statut' => 'reserve',
                'photo' => 'k3',
                'ref' => 'X-03',
                'poids' => '1 510 g',
                'texte' => 'Masque et ligne dorsale charcoal, fond plus froid que ses frères et sœurs. Très bavard — typiquement le Bengal qui commente chacun de vos déplacements dans la maison.',
            ],
            [
                'id' => 'xali',
                'nom' => 'XALI',
                'sexe' => 'Femelle',
                'robe' => 'Snow mink spotted',
                'statut' => 'reserve',
                'photo' => 'k4',
                'ref' => 'X-04',
                'poids' => '1 290 g',
                'texte' => 'Seule snow de la portée, yeux aqua. Sa robe continuera de se contraster jusqu\'à ses huit mois environ : elle est aujourd\'hui beaucoup plus claire qu\'elle ne le sera.',
            ],
            [
                'id' => 'xuma',
                'nom' => 'XUMA',
                'sexe' => 'Mâle',
                'robe' => 'Brown tabby marbled',
                'statut' => 'adopte',
                'photo' => 'k5',
                'ref' => 'X-05',
                'poids' => '1 560 g',
                'texte' => 'Marbré à grands aplats horizontaux, sans alignement vertical. Parti en Savoie début septembre — sa famille envoie toujours des nouvelles, et il a pris ses aises sur le canapé.',
            ],
        ],
        'PORTEE' => [
            'code' => 'Portée X',
            'pere' => 'uzumaki',
            'mere' => 'uanna',
            'naissance' => '12 juillet 2026',
            'dispo' => '12 septembre 2026',
            'nb' => 5,
        ],
        'ETAPES' => [
            [
                'done' => true,
                'when' => '12 juillet 2026',
                'what' => 'Naissance — pesée quotidienne pendant les quinze premiers jours',
            ],
            [
                'done' => true,
                'when' => '26 juillet 2026',
                'what' => 'Ouverture des yeux, premiers déplacements hors du nid',
            ],
            [
                'done' => true,
                'when' => '12 août 2026',
                'what' => 'Première vermifugation et début du sevrage',
            ],
            [
                'done' => true,
                'when' => '22 août 2026',
                'what' => 'Identification par puce électronique et enregistrement ICAD',
            ],
            [
                'done' => true,
                'when' => '29 août 2026',
                'what' => 'Primo-vaccination typhus et coryza',
            ],
            [
                'done' => true,
                'when' => '8 septembre 2026',
                'what' => 'Rappel de vaccination et certificat vétérinaire de bonne santé',
            ],
            [
                'now' => true,
                'when' => '12 septembre 2026',
                'what' => 'Douze semaines révolues — âge légal de cession atteint, départs possibles',
            ],
            [
                'done' => false,
                'when' => 'Au départ',
                'what' => 'Pedigree LOOF, carnet de santé, contrat de cession et kit d\'alimentation remis à la famille',
            ],
        ],
        'COAT' => [
            [
                'x' => 59,
                'y' => 23,
                'k' => 'Motif',
                't' => 'Rosette en donut',
                'd' => 'Une tache claire entièrement cerclée d\'un contour plus foncé, comme un anneau refermé. C\'est le motif le plus recherché de la race, et le plus difficile à fixer : il demande plusieurs générations de sélection.',
            ],
            [
                'x' => 50,
                'y' => 12,
                'k' => 'Structure',
                't' => 'Ligne dorsale',
                'd' => 'Sur un Bengal bien typé, les taches ne se rejoignent jamais en une bande continue le long du dos. Une ligne dorsale pleine est un défaut de type, héritage du tabby domestique.',
            ],
            [
                'x' => 85,
                'y' => 57,
                'k' => 'Effet',
                't' => 'Glitter',
                'd' => 'Un reflet doré déposé sur la pointe du poil, visible seulement quand la lumière frappe la robe de biais. C\'est un caractère propre au Bengal, hérité de ses origines, qui donne l\'impression que le chat a été saupoudré d\'or.',
            ],
            [
                'x' => 74,
                'y' => 38,
                'k' => 'Fond',
                't' => 'Fond chaud',
                'd' => 'Le fond de robe va du sable au cuivre profond. Plus le contraste entre le fond et les rosettes est marqué, plus la robe est considérée comme réussie.',
            ],
            [
                'x' => 26,
                'y' => 23,
                'k' => 'Tête',
                't' => 'Masque et colliers',
                'd' => 'Les lignes du front doivent dessiner un M ouvert, et les marques du cou — les colliers — rester brisées. Un collier fermé qui fait le tour de la gorge est, là encore, une trace de tabby domestique.',
            ],
        ],
        'GALERIE' => [
            [
                'f' => 'hero-uanna',
                'c' => 'Uanna — brown tabby rosetted',
                'cat' => 'adultes',
            ],
            [
                'f' => 'portee',
                'c' => 'Portée W — mars 2025',
                'cat' => 'chatons',
            ],
            [
                'f' => 'uzu-harnais',
                'c' => 'Uzumaki au jardin',
                'cat' => 'adultes',
            ],
            [
                'f' => 'chatons-pile',
                'c' => 'Fratrie au repos',
                'cat' => 'chatons',
            ],
            [
                'f' => 'wild',
                'c' => 'Après-midi dans la végétation',
                'cat' => 'adultes',
            ],
            [
                'f' => 'k6',
                'c' => 'Premiers pas sur le bois',
                'cat' => 'chatons',
            ],
            [
                'f' => 'couple',
                'c' => 'Uzumaki et Uanna',
                'cat' => 'adultes',
            ],
            [
                'f' => 'k1',
                'c' => 'Xilo — X-01',
                'cat' => 'chatons',
            ],
            [
                'f' => 'xena',
                'c' => 'Xena — brown tabby spotted',
                'cat' => 'adultes',
            ],
            [
                'f' => 'k3',
                'c' => 'Xénon — X-03, masque charcoal',
                'cat' => 'chatons',
            ],
            [
                'f' => 'ambiance',
                'c' => 'Fin de journée à la maison',
                'cat' => 'maison',
            ],
            [
                'f' => 'banner-petits',
                'c' => 'Deux semaines d\'écart, deux caractères',
                'cat' => 'chatons',
            ],
            [
                'f' => 'uanna',
                'c' => 'Uanna — contraste et glitter',
                'cat' => 'adultes',
            ],
            [
                'f' => 'k2',
                'c' => 'Xia — X-02',
                'cat' => 'chatons',
            ],
            [
                'f' => 'xena2',
                'c' => 'Sieste de fin d\'après-midi',
                'cat' => 'maison',
            ],
            [
                'f' => 'k4',
                'c' => 'Xali — X-04, snow mink',
                'cat' => 'chatons',
            ],
            [
                'f' => 'uzumaki',
                'c' => 'Uzumaki — portrait',
                'cat' => 'adultes',
            ],
            [
                'f' => 'k5',
                'c' => 'Xuma — X-05, marbled',
                'cat' => 'chatons',
            ],
            [
                'f' => 'wendy',
                'c' => 'Wendy',
                'cat' => 'adultes',
            ],
        ],
        'LEDGER' => [
            [
                '01',
                'Saillie et suivi de gestation',
                'Échographie de confirmation, alimentation spécifique de la mère pendant neuf semaines, visites vétérinaires.',
                'Avant la naissance',
            ],
            [
                '02',
                'Mise bas et première semaine',
                'Surveillance continue jour et nuit, pesée quotidienne, aide à la tétée si un chaton décroche.',
                'Semaine 1',
            ],
            [
                '03',
                'Douze semaines de nourrissage',
                'Lait maternisé au besoin, puis pâtée et croquettes kitten de qualité, pour la mère comme pour les petits.',
                'Semaines 1 à 12',
            ],
            [
                '04',
                'Deux vermifugations',
                'Protocole complet, renouvelé avant le départ.',
                'Semaines 5 et 9',
            ],
            [
                '05',
                'Identification ICAD',
                'Puce électronique posée et enregistrée au nom de l\'élevage, puis transférée à la famille.',
                'Semaine 6',
            ],
            [
                '06',
                'Primo-vaccination et rappel',
                'Typhus et coryza, deux injections, carnet de santé tenu à jour.',
                'Semaines 8 et 12',
            ],
            [
                '07',
                'Certificat vétérinaire de bonne santé',
                'Établi moins de huit jours avant la cession, obligatoire et remis en main propre.',
                'Avant le départ',
            ],
            [
                '08',
                'Inscription LOOF et pedigree',
                'Déclaration de saillie, déclaration de portée, édition du pedigree officiel.',
                'Semaines 1 à 12',
            ],
            [
                '09',
                'Tests des parents',
                'Échographie cardiaque HCM, tests ADN PK-Def et PRA-b, dépistage FIV/FeLV — refaits régulièrement.',
                'Toute l\'année',
            ],
            [
                '10',
                'Socialisation quotidienne',
                'Manipulation dès la naissance, habituation aux bruits, aux enfants, au chien, au transport et à la voiture.',
                'Chaque jour',
            ],
            [
                '11',
                'Contrat et document d\'information',
                'Contrat de cession écrit, document d\'information sur les besoins de l\'espèce, conseils d\'arrivée.',
                'Au départ',
            ],
            [
                '12',
                'Suivi après le départ',
                'Disponibilité à vie pour les questions, et reprise du chat si votre situation change.',
                'Sans limite',
            ],
        ],
        'FAQ' => [
            [
                'À quel âge un chaton peut-il partir ?',
                '<p>Douze semaines révolues, jamais avant. C\'est la loi, et c\'est surtout du bon sens : un chaton séparé plus tôt de sa mère et de sa fratrie n\'a pas terminé son apprentissage social. Il en garde souvent des troubles du comportement — morsures, malpropreté, anxiété de séparation.</p><p>Un éleveur qui vous propose un chaton à huit ou dix semaines vous dit en réalité quelque chose sur sa façon de travailler.</p>',
            ],
            [
                'Que comprend exactement le tarif ?',
                '<p>Pas le chat. Tout ce qui l\'entoure : la saillie, le suivi de gestation, la mise bas, douze semaines de nourrissage, les vermifugations, l\'identification, les deux vaccins, le certificat vétérinaire, l\'inscription au LOOF, les tests génétiques des parents, le contrat — et les centaines d\'heures passées à les manipuler pour qu\'ils arrivent chez vous déjà sociables.</p><p>Le détail complet est sur la page <a href=\'#/adoption\' data-nav style=\'color:var(--bronze-dim)\'>Adopter</a>.</p>',
            ],
            [
                'Le Bengal s\'entend-il avec les enfants et les chiens ?',
                '<p>Oui, et c\'est même l\'un de ses points forts. Nos chatons grandissent au milieu des enfants et du chien de la maison, ce qui fait une différence considérable à l\'arrivée chez vous.</p><p>La seule vraie règle est l\'adaptation progressive : une pièce dédiée les premiers jours, des présentations courtes, et on laisse le chaton décider du rythme.</p>',
            ],
            [
                'Faut-il en prendre deux ?',
                '<p>Si vous êtes absent toute la journée, oui, franchement. Le Bengal est un chat actif et joueur qui s\'ennuie vite seul, et l\'ennui se transforme en bêtises. Deux chatons de la même portée s\'occupent mutuellement et se dépensent ensemble.</p><p>Si quelqu\'un est présent à la maison une bonne partie de la journée, un seul suffit — il vous suivra partout.</p>',
            ],
            [
                'Peut-il vivre en appartement ?',
                '<p>Oui, à condition de lui donner de la hauteur. Un arbre à chat solide, des étagères libérées, une fenêtre sécurisée avec vue. Un Bengal en appartement avec de la verticalité est plus heureux qu\'un Bengal en maison sans rien à escalader.</p><p>Prévoyez aussi du jeu actif : quinze minutes de canne à pêche par jour changent tout.</p>',
            ],
            [
                'Est-ce qu\'il miaule beaucoup ?',
                '<p>Beaucoup. C\'est une race bavarde, qui commente, réclame et répond quand on lui parle. Si le silence est un critère pour vous, le Bengal n\'est pas la bonne race.</p>',
            ],
            [
                'Pourquoi le LOOF est-il important ?',
                '<p>Le LOOF est le livre officiel des origines félines français. Un chaton inscrit a un pedigree qui trace ses ascendants sur plusieurs générations : c\'est ce qui permet de vérifier qu\'il n\'y a pas de consanguinité excessive et que la lignée est suivie.</p><p>Un chat vendu « de race » sans pedigree LOOF n\'est pas un chat de race au sens légal. Le pedigree est remis à la famille, il n\'est jamais en option ni en supplément.</p>',
            ],
            [
                'Livrez-vous les chatons ?',
                '<p>Non. Vous venez le chercher, et vous êtes déjà venu le voir au moins une fois avant. Un chaton n\'est pas un colis, et nous tenons à savoir dans quelles mains il part.</p><p>Nous ne faisons pas non plus de réservation sans rencontre préalable.</p>',
            ],
            [
                'Et si je ne peux plus le garder ?',
                '<p>Vous nous appelez. C\'est écrit au contrat : nous reprenons le chat quel que soit son âge et quelle que soit la raison. Un chat né ici ne finit pas en refuge.</p>',
            ],
            [
                'Perd-il ses poils ? Est-il hypoallergénique ?',
                '<p>Il perd peu, son poil est court et ras, et il demande très peu d\'entretien — un brossage par semaine suffit largement.</p><p>En revanche, aucun chat n\'est hypoallergénique. Le Bengal produit lui aussi la protéine Fel d 1 responsable des allergies. Si vous êtes allergique, venez passer du temps à l\'élevage avant de vous engager.</p>',
            ],
            [
                'F1, F4, qu\'est-ce que ça veut dire ?',
                '<p>C\'est le nombre de générations qui séparent le chat de son ancêtre sauvage, le chat léopard du Bengale. Les F1 à F3 sont des hybrides soumis à une réglementation particulière et ne sont pas des chats de compagnie.</p><p>Tous les chatons vendus en élevage, les nôtres compris, sont au minimum F4 : ce sont des chats domestiques à part entière, sans aucune restriction.</p>',
            ],
            [
                'Comment se passe une visite ?',
                '<p>Sur rendez-vous, chez nous à L\'Isle d\'Abeau, le week-end ou en fin de journée. Vous rencontrez la mère, la fratrie complète, et vous voyez l\'endroit où ils grandissent — pas une pièce préparée pour la visite.</p><p>Comptez une bonne heure. Venez avec vos questions, et avec les enfants si vous en avez.</p>',
            ],
        ],
    ];
