<?php

// app/Models/Wedding.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Wedding extends Model
{
    use HasFactory;

    protected $table = 'weddings';

    protected $fillable = [
        'user_id',
        'slug',
        'bride_name',
        'groom_name',
        'bride_parents_info',    // Keterangan orang tua mempelai wanita
        'groom_parents_info',   // Keterangan orang tua mempelai pria
        'akad_date',
        'reception_date',
        'location',
        'place_name',
        'description',
        'template_id',
        'music_id',
        'order_id',
    ];

    protected $casts = [
        'akad_date' => 'datetime',
        'reception_date' => 'datetime',
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

    public function template() {
        return $this->belongsTo(Template::class);
    }

    public function music() {
        return $this->belongsTo(Music::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class); // Jika wedding memiliki order
    }
    
    public function getFormattedAkadDateAttribute()
    {
        return $this->akad_date 
            ? Carbon::parse($this->akad_date)->translatedFormat('l, d F Y') . ' pukul ' . Carbon::parse($this->akad_date)->format('H:i')
            : null;
    }

    public function getFormattedReceptionDateAttribute()
    {
        return $this->reception_date 
            ? Carbon::parse($this->reception_date)->translatedFormat('l, d F Y') . ' pukul ' . Carbon::parse($this->reception_date)->format('H:i')
            : null;
    }

}
