<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'template_id',
        'music_id',
        'kode_transaksi',
        'bride_name',
        'groom_name',
        'bride_parents_info',
        'groom_parents_info',
        'akad_date',
        'reception_date',
        'place_name',
        'location',
        'description',
        'phone_number',
        'payment_total',
        'payment_proof',
        'status',
    ];

    protected $casts = [
        'akad_date' => 'datetime',
        'reception_date' => 'datetime',
    ];

    // Relasi ke user (pemesan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke template undangan
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function music()
    {
        return $this->belongsTo(Music::class);
    }

    public function wedding()
    {
        return $this->hasOne(Wedding::class);
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
