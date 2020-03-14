<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'reference_no', 'total cost', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_order_size', 'order_id','pizza_id')
        ->withPivot('size_id', 'quantity')
        ->join('sizes', 'size_id','=','sizes.id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'pizza_order_size');
    }

    /*
        when create data and need save data to size
        Order::find(1)->pizzas()->save(Pizza::find(1), ['size' => '??']);
        
        call data
        $warehouse = Warehouse::find(1);
        $gear = $warehouse->gears()->first();
        $qty = $gear->pivot->qty;
    */
}
