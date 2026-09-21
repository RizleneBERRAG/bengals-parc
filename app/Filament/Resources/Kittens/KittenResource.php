<?php

namespace App\Filament\Resources\Kittens;

use App\Filament\Resources\Kittens\Pages\CreateKitten;
use App\Filament\Resources\Kittens\Pages\EditKitten;
use App\Filament\Resources\Kittens\Pages\ListKittens;
use App\Filament\Resources\Kittens\Schemas\KittenForm;
use App\Filament\Resources\Kittens\Tables\KittensTable;
use App\Models\Kitten;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KittenResource extends Resource
{
    protected static ?string $model = Kitten::class;

    protected static ?string $modelLabel = 'chaton';

    protected static ?string $pluralModelLabel = 'chatons';

    protected static ?string $navigationLabel = 'Chatons';

    protected static ?int $navigationSort = 2;

    /*
     * Kitten route sur son slug cote public, pour des URLs lisibles.
     * Le back-office route sur l'identifiant : l'adresse d'un ecran d'edition
     * ne doit pas dependre d'un champ que l'on modifie sur cet ecran.
     */
    protected static ?string $recordRouteKeyName = 'id';

    protected static ?string $recordTitleAttribute = 'nom';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    public static function form(Schema $schema): Schema
    {
        return KittenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KittensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKittens::route('/'),
            'create' => CreateKitten::route('/create'),
            'edit' => EditKitten::route('/{record}/edit'),
        ];
    }
}
