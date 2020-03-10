<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name',
        'rate',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class);
    }
}
