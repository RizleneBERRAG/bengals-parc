<?php

namespace App\Filament\Resources\Reviews\Tables;

use App\Models\Review;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('ordre')
            ->columns([
                TextColumn::make('prenom')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('note')
                    ->label('Note')
                    ->state(fn (Review $avis) => $avis->etoiles()),

                TextColumn::make('texte')
                    ->label('Avis')
                    ->limit(70)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('publie_le')
                    ->label('Sur Google le')
                    ->date('d/m/Y')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('est_publie')
                    ->label('État')
                    ->badge()
                    ->state(fn (Review $avis) => $avis->est_publie ? 'Affiché' : 'Masqué')
                    ->color(fn (Review $avis) => $avis->est_publie ? 'success' : 'gray'),
            ])
            ->filters([
                TernaryFilter::make('est_publie')
                    ->label('Affichage')
                    ->placeholder('Tous')
                    ->trueLabel('Affichés')
                    ->falseLabel('Masqués'),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
