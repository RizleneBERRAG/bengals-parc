# Bengal's Parc

Site de la chatterie Bengal's Parc (L'Isle d'Abeau, 38) — Laravel 12, Blade, MySQL.

Laravel 12 et non 13 : le XAMPP de la machine de dev tourne en PHP 8.2, et
Laravel 13 exige PHP 8.3. Laravel 12 accepte PHP 8.2 et c'est aussi la version
la mieux couverte par Filament.
Refonte réalisée par Net Strategy à partir de la maquette validée.

## Installation

Depuis PhpStorm, terminal à la racine du projet :

```powershell
composer install
npm install
npm run build          # ou `npm run dev` pendant le développement
php artisan key:generate
```

> PowerShell 5 ne comprend pas `&&` : enchaîner les commandes avec `;`
> ou les lancer une par une.

Créer la base dans phpMyAdmin (XAMPP) :

```sql
CREATE DATABASE bengals_parc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Puis :

```bash
php artisan migrate --seed
```

Le site est ensuite accessible sur **http://localhost/bengals-parc/public**
(ou `php artisan serve` pour http://127.0.0.1:8000).

Compte de départ du back-office : `bengalsparc@gmail.com` / `bengals-parc`
— à changer à la première connexion.

## Ce qui est en place

| Domaine | Fichiers |
|---|---|
| Reproducteurs et dépistages | `app/Models/Cat.php`, `HealthTest.php` |
| Portées, chatons, suivi | `Litter.php`, `Kitten.php`, `LitterEvent.php` |
| Dossiers adoptants (RGPD) | `AdoptionRequest.php`, `app/Console/Commands/PurgeRgpd.php` |
| Messages de contact (RGPD) | `ContactMessage.php`, `ContactController.php` |
| Réglages et mentions légales | `Setting.php` |
| Pages publiques | `routes/web.php`, `app/Http/Controllers/`, `resources/views/pages/` |
| Charte graphique | `resources/css/app.css` (extrait de la maquette, ne pas reformater) |
| Contenu éditorial fixe | `config/bengal.php` |
| Contenu de démarrage | `database/seeders/data/content.php` |

## La règle métier à ne pas contourner

Une fiche chaton **ne peut pas être publiée** tant que son numéro d'identification
ICAD et le numéro de portée LOOF sont vides. C'est une obligation légale
(annonces de cession d'animaux de compagnie), appliquée à trois niveaux :

1. `Kitten::estPubliable()` — la règle elle-même ;
2. `App\Observers\KittenObserver` — repasse `est_publie` à `false` à chaque
   enregistrement si les numéros manquent, même si la case est cochée ;
3. `Kitten::scopePublies()` — utilisé par toutes les requêtes du site public,
   et `KittenController::show()` renvoie un 404 sur une fiche non publiée.

Le seeder laisse volontairement ces numéros vides : au premier lancement, les
fiches chatons sont donc en brouillon. C'est le comportement attendu — il suffit
de saisir les numéros pour qu'elles se publient.

### Voir le site rempli tout de suite

Au premier `migrate --seed`, les fiches chatons sont **en brouillon** et la page
Chatons est vide : c'est le comportement attendu, pas un bug.

```powershell
php artisan demo:numeros           # remplit les numéros, publie les fiches
php artisan demo:numeros --reset   # vide les numéros, tout repasse en brouillon
```

Faire l'aller-retour devant la cliente est la démonstration la plus parlante de
la règle. La commande est à supprimer une fois le back-office en place.

Aucun nom d'adoptant n'est jamais affiché côté public. Les statuts
« réservé » et « adopté » portent sur le chaton, pas sur la famille.

## Reste à faire

- Back-office Filament (portées, chatons, reproducteurs, dossiers adoptants, réglages)
- Envoi des emails de notification et d'accusé de réception (`AdoptionController::store`)
- Upload des photos depuis le back-office (actuellement dans `public/images/cats/`)
- Sitemap XML et robots.txt

## Carte de la page Contact

Leaflet + fond sombre CartoDB, sans clé API et sans traceur. Les coordonnées et
les temps de trajet sont dans `config/bengal.php`, clé `carte`.
L'adresse exacte n'est volontairement jamais publiée : la carte affiche un
cercle de 2,2 km autour de L'Isle d'Abeau, plus les repères d'accès.
