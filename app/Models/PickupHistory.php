<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupHistory extends Model
{
    /** @use HasFactory<\Database\Factories\PickupHistoryFactory> */
    use HasFactory;
    protected $guarded = [];

    function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getDurasiAttribute()
    {
        $start = $this->start_at ? Carbon::parse($this->start_at) : null;
        $end = $this->end_at ? Carbon::parse($this->end_at) : Carbon::now();

        if (!$start) {
            return null; // atau bisa return 'N/A'
        }

        return $start->diffForHumans($end, true); // true = tanpa "ago"
    }

    public function getStatusAttribute()
    {
        if (!$this->start_at && !$this->end_at) {
            return 'belum dijemput';
        }

        if ($this->start_at && !$this->end_at) {
            return 'proses';
        }

        if ($this->start_at && $this->end_at) {
            return 'selesai';
        }

        return 'tidak diketahui'; // fallback jika kondisi tidak sesuai
    }
}
