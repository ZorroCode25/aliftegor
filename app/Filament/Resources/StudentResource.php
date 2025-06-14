<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        return $query->own();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Siswa')
                    ->schema([
                        // Forms\Components\Select::make('guardian_id')
                        //     ->label('Wali Murid')
                        //     ->relationship('guardian', 'name')
                        //     ->searchable()
                        //     ->required()
                        //     ->createOptionForm([
                        //         // Ini adalah schema form untuk membuat wali murid baru di modal
                        //         Forms\Components\TextInput::make('name')
                        //             ->label('Nama Wali Murid')
                        //             ->required()
                        //             ->maxLength(255),
                        //         Forms\Components\TextInput::make('email')
                        //             ->label('Email')
                        //             ->email()
                        //             ->required()
                        //             ->maxLength(255)
                        //             ->unique(ignorable: fn($record) => $record),
                        //         Forms\Components\TextInput::make('phone_number')
                        //             ->label('Nomor Telepon')
                        //             ->tel()
                        //             ->maxLength(255),
                        //         Hidden::make('password')->default(Hash::make('password')),
                        //         // Tambahkan field lain dari model Guardian jika diperlukan
                        //         // Contoh: TextInput::make('address')->label('Alamat'),
                        //     ]),
                        // Forms\Components\Select::make('guardian_id')
                        //     ->label('Wali Murid')
                        //     ->relationship('guardian', 'name')
                        //     ->searchable()
                        //     ->required()
                        //     ->default(fn() => auth()->user()?->guardian?->id)
                        //     ->hidden(fn() => auth()->user()?->hasRole('guardian'))
                        //     ->dehydrated(fn() => true)
                        //     ->createOptionForm([
                        //         Forms\Components\TextInput::make('name')
                        //             ->label('Nama Wali Murid')
                        //             ->required()
                        //             ->maxLength(255),
                        //         Forms\Components\TextInput::make('email')
                        //             ->label('Email')
                        //             ->email()
                        //             ->required()
                        //             ->maxLength(255)
                        //             ->unique(ignorable: fn($record) => $record),
                        //         Forms\Components\TextInput::make('phone_number')
                        //             ->label('Nomor Telepon')
                        //             ->tel()
                        //             ->maxLength(255),
                        //         Hidden::make('password')->default(Hash::make('password')),
                        //     ]),




                        Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Siswa')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('nis')
                                    ->label('Nomor Induk Siswa')
                                    ->unique(ignorable: fn($record) => $record)
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('class')
                                    ->label('Kelas')
                                    ->required()
                                    ->maxLength(50),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nis')
                    ->label('Nomor Induk Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('class')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                //nama wali murid
                // TextColumn::make('guardian.name')
                //     ->label('Wali Murid')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('guardians')
                //     ->label('Wali Murid')
                //     ->getStateUsing(function ($record) {
                //         $guardians = \App\Models\Guardian::whereJsonContains('student_ids', $record->id)->get();
                //         return $guardians->pluck('name')->join(', ');
                //     })
                //     ->sortable(false) // Kalau mau sortable harus custom query
                //     ->searchable(false),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
