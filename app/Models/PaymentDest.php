<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDest extends Model
{
    protected $table = 'payment_dests';

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
