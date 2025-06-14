<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PickupHistoryResource\Pages;
use App\Filament\Resources\PickupHistoryResource\RelationManagers;
use App\Models\PickupHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PickupHistoryResource extends Resource
{
    protected static ?string $model = PickupHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Riwayat Penjemputan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPickupHistories::route('/'),
            'create' => Pages\CreatePickupHistory::route('/create'),
            'edit' => Pages\EditPickupHistory::route('/{record}/edit'),
        ];
    }
}
