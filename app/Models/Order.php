<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'kode_transaksi',
        'nama_pemesan',
        'email_pemesan',
        'phone_number',
        'status',
    ];

    public function wedding()
    {
        return $this->hasOne(Wedding::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
