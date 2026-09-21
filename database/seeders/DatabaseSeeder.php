<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Compte du back-office. Mot de passe a changer a la premiere connexion.
        User::updateOrCreate(
            ['email' => 'bengalsparc@gmail.com'],
            ['name' => "Bengal's Parc", 'password' => Hash::make('bengals-parc')],
        );

        $this->call(ElevageSeeder::class);
    }
}
