<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PickupRequestResource\Pages;
use App\Filament\Resources\PickupRequestResource\RelationManagers;
use App\Models\PickupRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PickupRequestResource extends Resource
{

    protected static ?string $model = PickupRequest::class;
    protected static ?string $modelLabel = 'Permintaan Penjemputan';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListPickupRequests::route('/'),
            'create' => Pages\CreatePickupRequest::route('/create'),
            'edit' => Pages\EditPickupRequest::route('/{record}/edit'),
        ];
    }
}
