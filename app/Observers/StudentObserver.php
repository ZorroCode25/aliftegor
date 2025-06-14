<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        if (is_null($student->guardian_id) && Auth::user()->hasRole('guardian')) {
            $student->guardian_id = Auth::user()->guardian->id;
            $student->save();
        }
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
