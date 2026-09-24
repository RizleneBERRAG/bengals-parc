<?php

namespace Tests\Feature;

use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalerieTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Sans dimensions declarees, la grille en colonnes se reorganise a chaque
     * image qui arrive. Les dimensions sont relevees a l'enregistrement.
     */
    public function test_chaque_photo_declare_ses_dimensions(): void
    {
        $html = $this->get('/galerie')->assertOk()->getContent();

        // On se limite a la grille : le hero et le ruban defilant portent aussi
        // des images de ce dossier, sans les memes contraintes.
        $grille = \Illuminate\Support\Str::between($html, '<div class="masonry"', '</div>');

        preg_match_all('/<img[^>]*>/', $grille, $m);
        $this->assertNotEmpty($m[0], 'La galerie doit afficher des images.');

        foreach ($m[0] as $img) {
            $this->assertMatchesRegularExpression('/width="\d+"/', $img);
            $this->assertMatchesRegularExpression('/height="\d+"/', $img);
        }
    }

    public function test_les_dimensions_sont_relevees_a_l_enregistrement(): void
    {
        $photo = Photo::publiees()->firstOrFail();

        $this->assertNotNull($photo->largeur);
        $this->assertNotNull($photo->hauteur);
        $this->assertGreaterThan(0, $photo->largeur);
    }

    /**
     * Le filtre agit cote client, mais les liens doivent continuer de marcher
     * sans JavaScript : la page rendue masque alors les autres categories.
     */
    public function test_le_filtre_fonctionne_aussi_sans_javascript(): void
    {
        $html = $this->get('/galerie?categorie=chatons')->assertOk()->getContent();

        preg_match_all('/<figure[^>]*data-categorie="([a-z]+)"([^>]*)>/', $html, $m, PREG_SET_ORDER);
        $this->assertNotEmpty($m);

        foreach ($m as [, $categorie, $attributs]) {
            $masquee = str_contains($attributs, 'hidden');
            $this->assertSame(
                $categorie !== 'chatons',
                $masquee,
                "La figure « {$categorie} » devrait ".($categorie !== 'chatons' ? 'être masquée' : 'rester visible')."."
            );
        }
    }

    public function test_toutes_les_photos_sont_rendues_quel_que_soit_le_filtre(): void
    {
        $total = Photo::publiees()->count();

        foreach (['', '?categorie=chatons', '?categorie=adultes'] as $requete) {
            $html = $this->get('/galerie'.$requete)->assertOk()->getContent();
            $this->assertSame($total, substr_count($html, '<figure'), "Filtre « {$requete} »");
        }
    }
}
