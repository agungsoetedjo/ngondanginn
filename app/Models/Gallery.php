<?php

// app/Models/Gallery.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'wedding_id',
        'image',
        'image_desc',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}
