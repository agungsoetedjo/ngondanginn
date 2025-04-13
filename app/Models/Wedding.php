<?php

// app/Models/Wedding.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $table = 'weddings';

    protected $fillable = [
        'user_id',
        'slug',
        'bride_name',
        'groom_name',
        'wedding_date',
        'location',
        'place_name',
        'description',
        'template_id',
        'music_id',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rsvps() {
        return $this->hasMany(RSVP::class);
    }
    
    public function guestBooks() {
        return $this->hasMany(GuestBook::class);
    }

    public function galleries() {
        return $this->hasMany(Gallery::class);
    }

    public function templates() {
        return $this->belongsTo(Template::class);
    }

    public function music() {
        return $this->belongsTo(Music::class);
    }
}
