<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'content',
        'slug',
        'active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'menu_id', 'id');
    }
}

// php artisan make:model --migration --controller Menu