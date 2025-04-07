<?php

// app/Models/GuestBook.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    use HasFactory;

    protected $table = 'guest_books';
    protected $fillable = [
        'wedding_id',
        'name',
        'message',
    ];

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}

