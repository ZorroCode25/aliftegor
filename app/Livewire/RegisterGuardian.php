<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterGuardian extends Component implements HasForms
{
    use InteractsWithForms;

    // Properti untuk menyimpan data dari form
    public ?array $data = [];

    // Fungsi untuk inisialisasi form
    public function mount(): void
    {
        $this->form->fill();
    }

    // Mendefinisikan struktur form menggunakan Filament Forms
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique('users', 'email') // Pastikan email unik di tabel 'users'
                ->maxLength(255),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required()
                ->minLength(8) // Minimal 8 karakter
                ->dehydrateStateUsing(fn(string $state): string => Hash::make($state)) // Otomatis hash password
                ->same('passwordConfirmation'), // Harus sama dengan konfirmasi password

            TextInput::make('passwordConfirmation')
                ->label('Konfirmasi Password')
                ->password()
                ->required()
                ->minLength(8)
                ->dehydrated(false), // Jangan simpan ini ke database, hanya untuk validasi
        ];
    }

    // Fungsi yang dipanggil saat form disubmit (daftar)
    public function register(): void
    {
        // Validasi dan ambil data dari form
        $data = $this->form->getState();

        // Hapus 'passwordConfirmation' karena tidak perlu disimpan
        unset($data['passwordConfirmation']);

        // Buat user baru
        $user = User::create($data);

        // Login user secara otomatis setelah registrasi
        auth()->login($user);

        // Tampilkan notifikasi sukses menggunakan Filament Notification
        Notification::make()
            ->title('Selamat datang! Akun Anda berhasil dibuat.')
            ->success()
            ->send();

        // Arahkan user ke dashboard Filament setelah registrasi
        // Sesuaikan 'filament.admin.pages.dashboard' dengan nama rute dashboard Filament Anda
        $this->redirect(route('filament.admin.pages.dashboard'), navigate: true);
    }

    // Fungsi untuk merender tampilan Livewire
    public function render()
    {
        return view('livewire.register-guardian')->layout('components.layouts.app'); // Menggunakan layout 'app' yang baru Anda buat
    }
}
