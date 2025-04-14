<?php

// app/Models/RSVP.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RSVP extends Model
{
    use HasFactory;

    protected $table = 'rsvps';
    
    protected $fillable = [
        'wedding_id',
        'name',
        'email',
        'attendance',
        'note',
    ];

    protected $dates = ['created_at', 'updated_at'];

    // Method untuk mendapatkan waktu dalam format "3 menit lalu"
    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    
    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}
