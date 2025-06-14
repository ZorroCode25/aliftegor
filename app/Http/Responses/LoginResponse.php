<?php

namespace App\Http\Responses;

use App\Filament\Resources\OrderResource;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\LoginResponse as FilamentLoginResponse;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Dapatkan pengguna yang baru saja diautentikasi
        $user = Filament::auth()->user();

        // Logika redirect berdasarkan role
        // Asumsikan model User Anda memiliki metode untuk mengecek role,
        // misalnya: hasRole('admin'), atau atribut $user->role
        // Jika menggunakan Spatie Laravel Permission:
        if ($user->hasRole('admin')) {
            // Arahkan admin ke dashboard Filament utama atau halaman admin spesifik
            // Gunakan Filament::getUrl() untuk URL di dalam panel Filament
            // atau route() untuk named route Laravel biasa.
            return redirect()->intended(Filament::getPanel('admin')->getUrl()); // Ganti 'admin' dengan ID panel Anda jika berbeda
        } elseif ($user->hasRole('guardian')) {
            // Arahkan wali murid ke dashboard kustom mereka (yang sudah dibuat sebelumnya)
            return redirect()->route('guardian.dashboard');
        } elseif ($user->hasRole('another_role')) {
            // Contoh untuk role lain, arahkan ke halaman spesifik di dalam panel Filament
            return redirect()->intended(Filament::getPanel('admin')->getUrl('resource-atau-halaman-lain'));
        }

        // Fallback ke redirect default Filament jika tidak ada role yang cocok
        // atau jika pengguna mencoba mengakses URL tertentu sebelum login (intended URL).
        // Filament::getHomeUrl() akan mengarah ke URL default setelah login untuk panel saat ini.
        return redirect()->intended(Filament::getHomeUrl());
    }
}
