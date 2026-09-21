<?php

namespace App\Filament\Resources\Litters;

use App\Filament\Resources\Litters\Pages\CreateLitter;
use App\Filament\Resources\Litters\Pages\EditLitter;
use App\Filament\Resources\Litters\Pages\ListLitters;
use App\Filament\Resources\Litters\Schemas\LitterForm;
use App\Filament\Resources\Litters\Tables\LittersTable;
use App\Models\Litter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LitterResource extends Resource
{
    protected static ?string $model = Litter::class;

    protected static ?string $modelLabel = 'portée';

    protected static ?string $pluralModelLabel = 'portées';

    protected static ?string $navigationLabel = 'Portées';

    protected static ?int $navigationSort = 1;

    /*
     * Litter route sur son slug cote public, pour des URLs lisibles.
     * Le back-office route sur l'identifiant : l'adresse d'un ecran d'edition
     * ne doit pas dependre d'un champ que l'on modifie sur cet ecran.
     */
    protected static ?string $recordRouteKeyName = 'id';

    protected static ?string $recordTitleAttribute = 'code';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function form(Schema $schema): Schema
    {
        return LitterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LittersTable::configure($table);
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
            'index' => ListLitters::route('/'),
            'create' => CreateLitter::route('/create'),
            'edit' => EditLitter::route('/{record}/edit'),
        ];
    }
}
