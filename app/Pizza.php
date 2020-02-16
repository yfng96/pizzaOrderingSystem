<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('size', 'price');
    }
}
