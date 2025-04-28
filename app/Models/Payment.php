<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'payment_total',
        'payment_proof',
        'payment_desc',
        'payment_status',
        'payment_dests_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentDest()
    {
        return $this->belongsTo(PaymentDest::class, 'payment_dests_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at 
            ? Carbon::parse($this->created_at)->translatedFormat('l, d F Y') . ' pukul ' . Carbon::parse($this->created_at)->format('H:i')
            : null;
    }
}
