<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Les avis repris de la fiche Google, sur la page Contact.
 */
class AvisTest extends TestCase
{
    use RefreshDatabase;

    private function avis(array $attributs = []): Review
    {
        return Review::create(array_merge([
            'prenom'     => 'Camille',
            'note'       => 5,
            'texte'      => 'Un accueil remarquable et un chaton parfaitement sociabilisé.',
            'est_publie' => true,
        ], $attributs));
    }

    public function test_la_section_n_apparait_pas_sans_avis(): void
    {
        $this->seed();

        $this->get('/contact')
            ->assertOk()
            ->assertDontSee('Ce que disent les familles');
    }

    public function test_un_avis_publie_s_affiche(): void
    {
        $this->seed();
        $this->avis();

        $this->get('/contact')
            ->assertOk()
            ->assertSee('Ce que disent les familles')
            ->assertSee('Camille')
            ->assertSee('parfaitement sociabilisé', escape: false);
    }

    public function test_un_avis_masque_ne_s_affiche_pas(): void
    {
        $this->seed();
        $this->avis(['prenom' => 'Sabine', 'est_publie' => false]);

        $this->get('/contact')->assertOk()->assertDontSee('Sabine');
    }

    /**
     * La page Mentions legales s'engage a ne publier les temoignages que sous le
     * prenom seul. La table n'a donc pas de colonne pour un nom de famille : la
     * regle est tenue par le schema, pas par la vigilance de qui saisit.
     */
    public function test_aucun_nom_de_famille_ne_peut_etre_stocke(): void
    {
        $this->seed();

        $colonnes = array_keys($this->avis()->getAttributes());

        foreach (['nom', 'nom_famille', 'last_name'] as $interdite) {
            $this->assertNotContains($interdite, $colonnes);
        }
    }

    public function test_le_lien_vers_la_fiche_google_apparait_s_il_est_renseigne(): void
    {
        $this->seed();
        $this->avis();

        $this->get('/contact')->assertDontSee('Voir tous les avis sur Google');

        // Par le modele, pas en masse : c'est l'evenement d'enregistrement qui
        // vide le cache des reglages.
        Setting::where('cle', 'contact.avis_google')->firstOrFail()
            ->update(['valeur' => 'https://exemple.test/avis']);

        $this->get('/contact')
            ->assertSee('Voir tous les avis sur Google')
            ->assertSee('https://exemple.test/avis', escape: false);
    }
}
