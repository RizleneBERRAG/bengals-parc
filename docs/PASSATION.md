# Passation — Projet Bengal's Parc

**Client** : Bengal's Parc, élevage familial de chats Bengal à L'Isle d'Abeau (38080), Isère, à 20 min de Lyon.
**Agence** : Net Strategy.
**Date de la passation** : 21 septembre 2026.
**Statut** : maquette validée par le client interne, projet Laravel initialisé et fonctionnel en local.

---

## 1. Contexte commercial

Une développeuse web a contacté l'éleveuse sur une plateforme de petites annonces en proposant un **troc** : concevoir le site de la chatterie en échange d'un chaton Bengal. L'éleveuse a répondu qu'elle avait déjà un site et n'avait pas besoin de la prestation, mais a tenu à expliquer longuement que **le tarif d'un chaton ne paie pas l'animal**, mais les mois de soins, de socialisation, les frais vétérinaires et les démarches administratives qui l'entourent.

Un rendez-vous a été fixé **samedi 26 septembre à 14 h 30** à l'élevage.

**Stratégie retenue** : arriver au rendez-vous avec un site déjà construit, nettement supérieur au leur, en surprise. L'angle n'est pas « c'est plus joli » mais **« votre site actuel publie les noms de vos clients, affiche des chatons de mars 2025 comme actualité, et n'a ni mentions légales ni numéro de portée LOOF »**.

Le message de l'éleveuse sur le prix est devenu une page entière du nouveau site (« Ce que couvre l'adoption »), qui reprend presque mot pour mot sa propre argumentation. C'est le levier émotionnel principal.

---

## 2. Audit du site existant (bengalsparc.com)

WordPress généré par **ZipWP** (builder IA), thème Astra + Spectra. Dernière modification de contenu : **8 juillet 2025**.

### Architecture cassée

Le menu ne pointe pas sur les bonnes pages :

| Libellé menu | URL réelle | Titre de la page |
|---|---|---|
| REPRODUCTEURS | `/reproducteurs-2/` | REPRODUCTEURS |
| RESERVATIONS | `/reproducteurs/` | **Réservation** |
| LA RACE BENGAL | `/histoire-chats/` | Histoire chats |

Trois pages **vides mais indexées** dans le sitemap Yoast : `/reservations/`, `/la-race-bengal/` et `/l/` (page titrée « L »).

### Conformité — le point le plus lourd

- **Les noms complets des clients sont publiés en clair** sur la page réservations : « RESERVE PAR KATHERINE ABBY », « SLYMANE AYKO », « Cécile AKYTO », « Saoussen ASTON », « CAROLINE ALVIN ».
- **Aucune mention légale, aucune politique de confidentialité, aucune CGV.**
- **Aucune mention SIREN, n° de portée LOOF, n° d'identification des chatons ni n° de certificat de capacité** (art. L214-8-1 du code rural).
- Écrit « inscrit au **look** » 5 fois au lieu de LOOF, et confond LOOF et couleur : « Loof : Brown tabby spotted ».
- Formulaire sans case de consentement RGPD, sans anti-spam, champ doublon (« Prénom » + « Name »).
- Aucun bandeau cookies (cohérent : aucun tracker installé).

> À faire valider par un juriste avant présentation, mais les faits sont vérifiables en 30 secondes sur la page.

### Contenu périmé

Les 5 chatons affichés sont tous nés le **25/03/2025**, adoption prévue 25/06/2025, tous marqués réservé. La home annonce « Les chatons arrivent bientôt » avec un plugin countdown chargé qui n'affiche aucun compteur.

Home : **1 393 caractères de texte**. Aucun prix, aucun process d'adoption, aucun contrat, aucune FAQ, aucun blog. **Zéro pedigree, zéro test génétique** (HCM, PK-Def, PRA-b), zéro affixe LOOF — ce qu'un acheteur sérieux cherche en premier.

Les 2 seuls avis clients sont des **commentaires WordPress** sous la page Contact, avec formulaire de commentaire ouvert.

### Technique

- **1,57 Mo** sur la home, 21 requêtes, dont **937 Ko d'images** et **563 Ko de CSS** (Spectra).
- Une photo hero non optimisée de **563 Ko**. Zéro WebP/AVIF.
- Une image **`.heic`** servie sur la page chatons (invisible sur Chrome/Firefox Windows).
- **Alt manquants : 7/9** en home, 15/17 en galerie, 27/29 sur la page chatons.
- `H2` avant le `H1` en home, deux `H1` sur la galerie.
- **Aucun lien `tel:` ni `mailto:`** sur tout le site.
- **`/wp-json/wp/v2/users` ouvert** → login admin énumérable (`Jcf5dSDvu2Xk`). Aucun header de sécurité.

### SEO / GEO

- Meta description uniquement sur la home.
- **Aucun analytics, aucun GTM, aucune Search Console détectable.**
- Schema.org limité au `WebPage`/`Organization` de Yoast. Pas de `LocalBusiness`, `Product`/`Offer`, `FAQPage`, `Review`.
- Aucune page locale (« éleveur Bengal Lyon », « chaton Bengal Isère »).

---

## 3. La maquette validée

**Artefact publié** : https://claude.ai/artifact/4eWSZEmUqdFn2dWb9jTxAM (version 3)

⚠️ **Le lien est privé.** Il faut le partager depuis le menu Share de la page pour que l'éleveuse puisse l'ouvrir.

11 pages navigables, construites avec **leurs vraies photos** (récupérées sur leur site, recompressées en WebP) et leurs vrais chats : Uzumaki, Uanna, Xena, Wendy.

Un bandeau « Maquette de démonstration — conçue par Net Strategy pour Bengal's Parc » signe le travail et couvre le fait que la portée X et les numéros sont des exemples.

### Direction artistique

- **Palette** : obsidienne chaude (`#0B0906`), bandes « papier » os (`#EDE4D4`), accent bronze (`#B07A3C` / `#DDAC63`), ivoire (`#F4EFE5`), vert mousse pour le statut disponible (`#8FB57A`).
- **Typographies** : Bodoni Moda (display), Archivo (courant), JetBrains Mono (données et libellés — numéros LOOF, ICAD, dates).
- **Motif signature** : trois rosettes, utilisées comme marqueur de section (rail vertical) et dans le pied de page.
- **Matière** : grain argentique en overlay fixe sur toute la page.

### Les moments forts

1. **Le hero** — photo plein écran légendée comme un pedigree.
2. **Le bandeau live** — « 2 chatons disponibles, nés le 12 juillet, départs depuis le 12 septembre ».
3. **La fiche chaton** — identité, robe, parents cliquables, n° de portée LOOF, ICAD, dépistages HCM / PK-Def / PRA-b des parents, timeline de la portée avec point vert sur « âge légal de cession atteint ».
4. **« Lire une robe »** — cinq repères cliquables sur une photo : rosette en donut, ligne dorsale, glitter, fond chaud, masque et colliers. Aucun site d'élevage français n'a ça.
5. **La règle affichée** : « Tant que les numéros LOOF et ICAD sont vides, la fiche reste en brouillon et n'est pas publiée. »
6. **Les mentions légales** avec la ligne « Aucun nom de famille d'adoptant n'est publié sur le site ».

---

## 4. Le projet Laravel

### Emplacement et stack

```
C:\xampp\htdocs\bengals-parc
```

| | |
|---|---|
| Framework | **Laravel 12** (v12.69.2) |
| PHP | 8.2.12 (XAMPP de la machine de dev) |
| Base | MySQL / MariaDB XAMPP, base `bengals_parc`, utf8mb4_unicode_ci |
| Front | Blade + le CSS de la maquette, compilé par Vite 7 |
| Carte | Leaflet 1.9 + tuiles CartoDB dark |
| Back-office | **Pas encore installé** (voir § 7) |

### Décisions et leur justification

**Laravel 12 et non 13.** Le premier squelette posé était en Laravel 13, qui exige PHP ^8.3. Le XAMPP de la machine tourne en 8.2.12. Plutôt que de toucher à l'environnement (les autres projets dans `htdocs` — AKO, climhero, cee-platform, siberien-de-russie — tournent probablement en 8.2), le projet a été rebasculé en Laravel 12, qui accepte PHP 8.2. Bonus : Filament 4 supporte officiellement Laravel 12.

**Pas de Tailwind.** Le CSS vient de la maquette validée par le client, extrait tel quel du fichier HTML approuvé. `vite.config.js` et `package.json` ont été nettoyés du plugin Tailwind. Ne pas reformater `resources/css/app.css` sans raison : les valeurs viennent de la maquette approuvée.

**Contenu de démarrage extrait de la maquette.** `database/seeders/data/content.php` est généré automatiquement depuis le JS de la maquette — textes des reproducteurs, chatons, suivi de portée, galerie, questions. Garantit que le site et la maquette disent exactement la même chose.

### Fichiers écrits

27 classes PHP, 10 migrations métier, 27 vues Blade, 36 photos, 610 lignes de CSS.

```
app/
  Console/Commands/  DemoNumeros.php  PurgeRgpd.php  SyncPhotos.php
  Enums/             CatRole.php  HealthTestType.php  KittenStatus.php
  Http/Controllers/  Page  Kitten  Cat  Adoption  Contact
  Http/Requests/     StoreAdoptionRequest.php  StoreContactMessage.php
  Models/            Cat  HealthTest  Litter  Kitten  LitterEvent
                     Photo  AdoptionRequest  ContactMessage  Faq  Setting
  Observers/         KittenObserver.php
config/bengal.php    lecture de robe, détail de l'adoption, points de la carte
resources/views/
  components/        12 composants (kitten-card, cat-card, record, timeline,
                     health-table, photo-strip, photo-band, social-link…)
  pages/             home, kittens/{index,show}, cats/{index,show}, breed,
                     gallery, adoption, faq, contact, legal
```

### Modèle de données

- `cats` — reproducteurs et jeunes sujets : rôle (étalon / reproductrice / observation / retraite), robe, n° LOOF, n° ICAD.
- `health_tests` — dépistages par chat : HCM, PK-Def, PRA-b, FIV/FeLV, avec date, laboratoire, PDF.
- `litters` — portées : père, mère, date de naissance, date de disponibilité (naissance + 12 semaines), n° de portée LOOF.
- `kittens` — chatons : statut (disponible / réservé / adopté), poids, robe, n° ICAD.
- `litter_events` — suivi de portée, avec un drapeau `est_jalon` pour l'âge légal de cession.
- `photos` — galerie polymorphe, avec catégorie (chatons / adultes / maison).
- `adoption_requests` — dossiers adoptants, consentement horodaté, conservation 24 mois.
- `contact_messages` — messages du formulaire de contact, conservation 12 mois.
- `faqs`, `settings` — éditables, `settings` porte les mentions obligatoires.

### Routes

```
/                      home
/chatons               kittens.index      (filtre ?statut=)
/chatons/{slug}        kittens.show
/elevage               cats.index
/elevage/{slug}        cats.show
/le-bengal             breed
/galerie               gallery            (filtre ?categorie=)
/adopter               adoption.create  + POST adoption.store
/questions             faq
/contact               contact          + POST contact.store
/mentions-legales      legal
```

Les deux POST sont limités à `throttle:5,60` et ont un honeypot (champ `site` en `prohibited`).

---

## 5. La règle métier à ne pas contourner

Une fiche chaton **ne peut pas être publiée** tant que son numéro d'identification ICAD et le numéro de portée LOOF sont vides. Obligation légale sur les annonces de cession d'animaux de compagnie. Appliquée à trois niveaux :

1. `Kitten::estPubliable()` — la règle et la liste des mentions manquantes.
2. `App\Observers\KittenObserver` — repasse `est_publie` à `false` à chaque enregistrement si les numéros manquent, **même si la case est cochée dans le back-office**.
3. `Kitten::scopePublies()` — utilisé par toutes les requêtes publiques ; `KittenController::show()` renvoie un 404 sur une fiche non publiée.

**Le seeder laisse volontairement ces numéros vides.** Au premier `migrate --seed`, les fiches sont donc en brouillon et la page Chatons est vide. C'est le comportement attendu, pas un bug.

Aucun nom d'adoptant n'est jamais affiché côté public. Les statuts « réservé » et « adopté » portent sur le chaton, pas sur la famille.

---

## 6. Commandes

### Installation

```powershell
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate --seed
php artisan photos:sync
```

Base à créer avant le `migrate` :
```sql
CREATE DATABASE bengals_parc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Site sur `http://localhost/bengals-parc/public`.
Compte back-office : `bengalsparc@gmail.com` / `bengals-parc` — à changer.

### Commandes du projet

| Commande | Rôle |
|---|---|
| `php artisan demo:numeros` | Remplit les numéros LOOF/ICAD de démo et publie les fiches |
| `php artisan demo:numeros --reset` | Vide les numéros, tout repasse en brouillon |
| `php artisan photos:sync` | Enregistre en base les images de `public/images/cats` |
| `php artisan photos:sync --legendes` | Rafraîchit aussi les légendes connues |
| `php artisan rgpd:purge` | Purge les dossiers et messages expirés (planifié à 3 h) |

> `demo:numeros` puis `--reset` devant la cliente, c'est la démonstration la plus parlante de la règle légale. À supprimer une fois le back-office en place.

---

## 7. Reste à faire

**Back-office Filament** — non installé. Impossible de vérifier la version compatible depuis l'environnement de travail (Packagist bloqué), et les resources ne s'écrivent pas pareil selon la major. Lancer :

```powershell
composer require filament/filament
php artisan filament:install --panels
```

Puis écrire les resources : portées, chatons (avec validation des numéros et affichage des mentions manquantes), reproducteurs et dépistages, dossiers adoptants, messages de contact, réglages, upload des photos.

**Autres chantiers :**

- Emails de notification et accusé de réception — TODO commenté dans `AdoptionController::store` et `ContactController::store`, à brancher avec le SMTP.
- Upload des photos depuis le back-office (actuellement dépôt dans `public/images/cats` + `photos:sync`).
- Sitemap XML et robots.txt.
- Pedigree sur 3 générations : les grands-parents sont affichés en « À compléter », à reprendre du pedigree LOOF, avec calcul du taux de consanguinité.
- Renseigner les vraies mentions légales dans `settings` : SIREN, certificat de capacité, directeur de publication, hébergeur.

---

## 8. Pièges rencontrés, à connaître

**Packagist inaccessible** depuis l'environnement de travail de l'agent (403 de la politique de sortie). Le squelette Laravel a été cloné depuis GitHub, et tout `composer install` doit être lancé depuis la machine de l'utilisateur.

**PowerShell 5 ne comprend pas `&&`** — enchaîner avec `;` ou lancer les commandes une par une. Il mange aussi les `$variable` dans `php artisan tinker --execute="..."`, d'où la création de vraies commandes artisan plutôt que des one-liners.

**MySQL refuse deux colonnes `timestamp NOT NULL`** dans la même table (erreur 1067 « Invalid default value »). `consentement_le` et `a_purger_le` sont en `dateTime` nullable, renseignées par le modèle. Ne pas repasser en `timestamp`.

**Suppression bloquée dans les dossiers connectés** — `git clone` échoue directement dans `htdocs` parce qu'il doit supprimer ses fichiers de verrou. Cloner ailleurs puis copier.

**`Str::plural` est anglais** — ne pas l'utiliser sur du français, écrire les pluriels à la main.

---

## 9. Ressources

| Quoi | Où |
|---|---|
| Maquette validée | https://claude.ai/artifact/4eWSZEmUqdFn2dWb9jTxAM (privée) |
| Projet Laravel | `C:\xampp\htdocs\bengals-parc` |
| Photos optimisées | `C:\Users\BERRA\Downloads\bengalsparc-assets` et `public/images/cats` (36) |
| Site actuel du client | https://bengalsparc.com |
| Instagram du client | https://www.instagram.com/bengals_parc/ |
| Contact élevage | 06 24 48 89 36 — bengalsparc@gmail.com |

**Note sur l'icône Instagram** : le pictogramme du composant `social-link` est un diaphragme dessiné pour ce site, pas le glyphe officiel. Les règles de marque de Meta imposent le fichier d'origine sans modification. Pour mettre l'officiel, remplacer le `<svg>` dans `resources/views/components/social-link.blade.php` — l'anneau qui s'allume au survol continuera de fonctionner.
