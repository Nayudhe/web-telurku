<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'image',
    ];

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
}
