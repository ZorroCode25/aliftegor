<?php

namespace App\Observers;

use App\Models\Guardian;
use App\Models\User;

class GuardianObserver
{
    public function created(Guardian $guardian)
    {
        // Cegah jika sudah punya user_id
        if ($guardian->user_id) {
            return;
        }

        // Buat user
        $user = User::updateOrCreate(
            [
                'email' => $guardian->email,
            ],
            [
                'name' => $guardian->name,
                'password' => $guardian->password,
            ]
        );

        // Hubungkan kembali
        $guardian->user_id = $user->id;
        $guardian->saveQuietly(); // saveQuietly mencegah memicu observer lagi
    }
}
