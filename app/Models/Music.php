<?php

// app/Models/Music.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics';
    protected $fillable = [
        'title',
        'file_path',
    ];

    public function weddings() {
        return $this->hasMany(Wedding::class);
    }
}
