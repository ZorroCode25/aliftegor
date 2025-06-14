<?php

namespace App\Observers;

use App\Models\Guardian;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $user->assignRole('guardian');

        if ($user->guardian) {
            return;
        }

        $guardian = Guardian::updateOrCreate(
            [
                'email' => $user->email,
                'user_id' => $user->id,
            ],
            [
                'name' => $user->name,
                'password' => $user->password,
            ],
        );
    }
}
