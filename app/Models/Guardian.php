<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class Guardian extends Model
{
    /** @use HasFactory<\Database\Factories\GuardianFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'student_ids' => 'array',
    ];
    function students()
    {
        return $this->hasMany(Student::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
