<?php

namespace App\Listeners;

use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;

class AssignGuardianRoleAfterRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event)
    {
        $user = $event->user; // Mendapatkan pengguna yang baru saja terdaftar
        $guardianRole = Role::where('name', 'guardian')->first();

        if ($guardianRole) {
            $user->roles()->syncWithoutDetaching([$guardianRole->id]);
        }
    }
}
