<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'kode_transaksi',
        'nama_pemesan',
        'phone_number',
        'payment_destination',
        'payment_total',
        'payment_proof',
        'payment_desc',
        'status',
    ];

    public function wedding()
    {
        return $this->hasOne(Wedding::class, 'order_id');
    }

}
