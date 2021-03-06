<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_category');
    }

    public function orders() {
        return $this->belongsToMany('App\Models\Order');
    }
}
