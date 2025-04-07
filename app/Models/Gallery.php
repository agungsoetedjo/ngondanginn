<?php

// app/Models/Gallery.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'wedding_id',
        'image',
    ];

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}
