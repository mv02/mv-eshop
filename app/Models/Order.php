<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $with = ['products'];

    public function products() {
        return $this->belongsToMany('App\Models\Product')->withPivot('amount');
    }
}
