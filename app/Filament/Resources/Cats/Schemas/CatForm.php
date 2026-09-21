<?php

namespace App\Filament\Resources\Cats\Schemas;

use App\Enums\CatRole;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('sexe')
                    ->required(),
                Select::make('role')
                    ->options(CatRole::class)
                    ->required(),
                TextInput::make('annee_naissance')
                    ->default(null),
                DatePicker::make('date_naissance'),
                TextInput::make('robe')
                    ->default(null),
                TextInput::make('loof_numero')
                    ->default(null),
                TextInput::make('icad_numero')
                    ->default(null),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('photo_principale')
                    ->default(null),
                TextInput::make('photo_secondaire')
                    ->default(null),
                TextInput::make('ordre')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('est_publie')
                    ->required(),
            ]);
    }
}
