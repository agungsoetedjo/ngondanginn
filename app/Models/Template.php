<?php

// app/Models/Template.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';

    protected $fillable = [
        'name',
        'preview_image',
        'view_path',
        'price',
        'category_id',
    ];

    public function weddings() {
        return $this->hasMany(Wedding::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
