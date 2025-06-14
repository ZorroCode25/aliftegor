<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuardianResource\Pages;
use App\Filament\Resources\GuardianResource\RelationManagers;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;
    protected static ?string $modelLabel = 'Wali Murid';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Wali Murid')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Wali Murid')
                            ->required()
                            ->maxLength(255),

                        Grid::make(2)
                            ->schema([
                                //email
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                //phone_number
                                Forms\Components\TextInput::make('phone_number')
                                    ->label('Nomor Telepon')
                                    ->numeric()
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    // Jangan dehydrate (simpan ke database) kalau kosong
                                    ->dehydrated(fn($state) => filled($state))
                                    // Ubah jadi hash hanya kalau ada isinya
                                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                                    // Hanya required saat create
                                    ->required(fn(string $context) => $context === 'create'),                  // Confirm Password field hanya wajib jika password diisi
                                Forms\Components\TextInput::make('confirm_password')
                                    ->label('Konfirmasi Password')
                                    ->password()
                                    ->required(fn($get) => $get('password') !== null && $get('password') !== '')
                                    ->same('password')
                                    ->dehydrated(false),
                            ]),
                    ]),

                // Forms\Components\Section::make('Pilih Siswa Terkait')
                //     ->description('Pilih satu atau lebih siswa yang diasuh oleh wali murid ini. Anda juga bisa membuat siswa baru di sini.')
                //     ->schema([
                //         Select::make('student_ids')
                //             ->label('Siswa Terkait')
                //             ->relationship('students', 'name')
                //             ->multiple()
                //             ->preload()
                //             ->searchable()
                //             ->placeholder('Pilih siswa...')
                //             ->createOptionForm([
                //                 Forms\Components\TextInput::make('name')
                //                     ->label('Nama Siswa')
                //                     ->required()
                //                     ->maxLength(255),

                //                 Forms\Components\TextInput::make('nis')
                //                     ->label('Nomor Induk Siswa')
                //                     // ignoreRecord: true untuk kasus create (tidak ada record lama)
                //                     // Atau gunakan closure untuk penanganan yang lebih spesifik
                //                     ->unique(table: Student::class, column: 'nis') // Pastikan unik di tabel Student
                //                     ->required()
                //                     ->maxLength(255),

                //                 Forms\Components\TextInput::make('class')
                //                     ->label('Kelas')
                //                     ->required()
                //                     ->maxLength(50),
                //             ])
                //     ])
                //     ->collapsible(),
                Section::make('Pilih Siswa Terkait')
                    ->description('Pilih satu atau lebih siswa yang diasuh oleh wali murid ini. Anda juga bisa membuat siswa baru jika tidak ditemukan.')
                    ->schema([
                        Select::make('student_ids')
                            ->label('Siswa Terkait')
                            // ->options(Student::get()->pluck('name', 'id'))
                            ->options(function (callable $get) {
                                // Ambil id guardian sekarang (kalau edit)
                                $currentGuardianId = $get('id');

                                // Ambil semua student_ids yang sudah dipakai oleh wali murid lain
                                $usedStudentIds = Guardian::where('id', '!=', $currentGuardianId)
                                    ->pluck('student_ids') // asumsi ini array di DB atau json
                                    ->flatten() // kalau array nested, flatten jadi 1D
                                    ->unique()
                                    ->filter() // hilangkan null/empty
                                    ->values()
                                    ->toArray();

                                // Ambil students yang belum dipakai
                                return Student::whereNotIn('id', $usedStudentIds)
                                    ->pluck('name', 'id');
                            })
                            ->multiple()
                            ->preload()
                            ->searchable() // Mengaktifkan fitur pencarian
                            ->placeholder('Pilih atau cari siswa...')
                            ->createOptionForm([ // Opsi untuk membuat siswa baru jika tidak ada
                                TextInput::make('name')
                                    ->label('Nama Siswa')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('nis')
                                    ->label('Nomor Induk Siswa')
                                    ->unique(table: Student::class, column: 'nis', ignoreRecord: true)
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('class')
                                    ->label('Kelas')
                                    ->required()
                                    ->maxLength(50),
                            ])
                    ])
                    ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Wali Murid')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_ids') // Ini akan bekerja setelah withCount()
                    ->label('Siswa Terkait')
                    ->getStateUsing(function ($record) {
                        $students = Student::whereIn('id', $record->student_ids ?? [])->get();
                        return $students->pluck('name')->implode(', ');
                    })
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([])
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
            'index' => Pages\ListGuardians::route('/'),
            'create' => Pages\CreateGuardian::route('/create'),
            'edit' => Pages\EditGuardian::route('/{record}/edit'),
        ];
    }
}
