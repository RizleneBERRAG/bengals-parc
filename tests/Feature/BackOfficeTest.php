<?php

namespace Tests\Feature;

use App\Models\Kitten;
use App\Models\Litter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Le back-office Filament : acces, et rendu de chaque ecran.
 * Ces tests attrapent une erreur fatale dans un formulaire ou une table —
 * exactement ce qui ne doit pas se decouvrir devant la cliente.
 */
class BackOfficeTest extends TestCase
{
    use RefreshDatabase;

    private function eleveuse(): User
    {
        $this->seed();

        return User::where('email', 'bengalsparc@gmail.com')->firstOrFail();
    }

    public static function ecrans(): array
    {
        return [
            'tableau de bord'   => ['/admin'],
            'portées'           => ['/admin/litters'],
            'nouvelle portée'   => ['/admin/litters/create'],
            'chatons'           => ['/admin/kittens'],
            'nouveau chaton'    => ['/admin/kittens/create'],
            'reproducteurs'     => ['/admin/cats'],
            'photos'            => ['/admin/photos'],
            'nouvelle photo'    => ['/admin/photos/create'],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('ecrans')]
    public function test_l_ecran_repond(string $chemin): void
    {
        $this->actingAs($this->eleveuse())->get($chemin)->assertOk();
    }

    public function test_les_ecrans_d_edition_repondent(): void
    {
        $eleveuse = $this->eleveuse();
        $portee   = Litter::firstOrFail();
        $chaton   = Kitten::firstOrFail();

        $this->actingAs($eleveuse)->get("/admin/litters/{$portee->id}/edit")->assertOk();
        $this->actingAs($eleveuse)->get("/admin/kittens/{$chaton->id}/edit")->assertOk();
    }

    public function test_le_back_office_est_ferme_aux_visiteurs(): void
    {
        $this->seed();

        $this->get('/admin')->assertRedirect('/admin/login');
    }

    /**
     * canAccessPanel() s'appuie sur une liste explicite : un compte cree pour
     * autre chose ne doit pas heriter de l'acces au back-office.
     */
    public function test_un_compte_hors_liste_est_refuse(): void
    {
        $this->seed();

        $intrus = User::create([
            'name'     => 'Quelqu’un',
            'email'    => 'quelquun@example.com',
            'password' => 'peu-importe',
        ]);

        $this->actingAs($intrus)->get('/admin')->assertForbidden();
    }
}
