<?php

namespace App\Filament\Resources\Cats;

use App\Filament\Resources\Cats\Pages\CreateCat;
use App\Filament\Resources\Cats\Pages\EditCat;
use App\Filament\Resources\Cats\Pages\ListCats;
use App\Filament\Resources\Cats\Schemas\CatForm;
use App\Filament\Resources\Cats\Tables\CatsTable;
use App\Models\Cat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CatResource extends Resource
{
    protected static ?string $model = Cat::class;

    protected static ?string $modelLabel = 'reproducteur';

    protected static ?string $pluralModelLabel = 'reproducteurs';

    protected static ?string $navigationLabel = 'L’élevage';

    protected static ?int $navigationSort = 3;

    /*
     * Cat route sur son slug cote public, pour des URLs lisibles.
     * Le back-office route sur l'identifiant : l'adresse d'un ecran d'edition
     * ne doit pas dependre d'un champ que l'on modifie sur cet ecran.
     */
    protected static ?string $recordRouteKeyName = 'id';

    protected static ?string $recordTitleAttribute = 'nom';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return CatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CatsTable::configure($table);
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
            'index' => ListCats::route('/'),
            'create' => CreateCat::route('/create'),
            'edit' => EditCat::route('/{record}/edit'),
        ];
    }
}
