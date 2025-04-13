<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'template_id',
        'kode_transaksi',
        'bride_name',
        'groom_name',
        'place_name',
        'location',
        'wedding_date',
        'description',
        'phone_number',
        'status',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
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
}
