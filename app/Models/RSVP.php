<?php

// app/Models/RSVP.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}
