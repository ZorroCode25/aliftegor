<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = [];
    function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function guardians()
    {
        return Guardian::whereJsonContains('student_ids', $this->id)->get();
    }


    public function scopeOwn($query)
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            return $query; // Tampilkan semua
        }

        return $query->where('guardian_id', $user->guardian->id); // Tampilkan hanya milik sendiri
    }
}
