<?php

// app/Models/GuestBook.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GuestBook extends Model
{
    use HasFactory;

    protected $table = 'guest_books';
    
    protected $fillable = [
        'wedding_id',
        'name',
        'message',
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

