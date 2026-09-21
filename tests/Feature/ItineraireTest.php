<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Le bouton d'itineraire de la page Contact.
 */
class ItineraireTest extends TestCase
{
    use RefreshDatabase;

    /**
     * La page annonce que l'adresse exacte est communiquee au rendez-vous. Un
     * itineraire porte-a-porte la publierait : le lien doit viser la commune.
     */
    public function test_le_lien_vise_la_commune_et_non_une_adresse(): void
    {
        $this->seed();

        $this->get('/contact')
            ->assertOk()
            ->assertSee('google.com/maps/dir', escape: false)
            ->assertSee(urlencode("L'Isle d'Abeau"), escape: false);
    }

    public function test_le_lien_est_remplacable_depuis_les_reglages(): void
    {
        $this->seed();

        Setting::where('cle', 'contact.itineraire')->firstOrFail()
            ->update(['valeur' => 'https://exemple.test/fiche-google']);

        $this->get('/contact')
            ->assertOk()
            ->assertSee('https://exemple.test/fiche-google', escape: false)
            ->assertDontSee('google.com/maps/dir', escape: false);
    }

    /** Rien ne doit etre charge depuis Google sur la page elle-meme. */
    public function test_la_page_ne_charge_rien_depuis_google(): void
    {
        $this->seed();

        $html = $this->get('/contact')->assertOk()->getContent();

        foreach (['maps.googleapis.com', 'maps.google.com/maps?', '<iframe'] as $interdit) {
            $this->assertStringNotContainsString($interdit, $html);
        }
    }
}
