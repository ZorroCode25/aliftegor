<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament; // Gunakan facade Filament
use Illuminate\Support\Facades\Redirect;

class RedirectGuardianFromPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Filament::isServing() && Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $currentPanel = Filament::getCurrentPanel(); // Dapatkan instance panel saat ini

            if (!$currentPanel) { // Jika karena suatu alasan panel tidak ditemukan, lanjutkan saja
                return $next($request);
            }

            // Bangun nama route logout secara dinamis berdasarkan ID panel saat ini
            // Nama route logout default Filament adalah 'filament.{panelId}.auth.logout'
            $logoutRouteName = 'filament.' . $currentPanel->getId() . '.auth.logout';

            // Jika request saat ini adalah untuk route logout, biarkan proses logout berjalan
            if ($request->routeIs($logoutRouteName)) {
                return $next($request);
            }

            // Asumsikan model User Anda memiliki metode hasRole() atau atribut 'role'
            if ($user->hasRole('guardian')) { // atau $user->role === 'guardian'
                $guardianDashboardPath = route('guardian.dashboard', [], false);

                // Arahkan jika pengguna 'guardian' mencoba mengakses halaman panel Filament
                // dan halaman saat ini BUKAN guardian.dashboard itu sendiri,
                // dan BUKAN route logout.
                if (
                    $request->is($currentPanel->getPath() . '*') &&
                    $request->getPathInfo() !== $guardianDashboardPath
                ) {
                    return Redirect::route('guardian.dashboard');
                }
            }
        }

        return $next($request);
    }
}
