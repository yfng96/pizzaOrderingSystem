<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'name',
        'base_price',
        'description',
        'image',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'pizza_order_size');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'pizza_order_size');
    }
}
