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
        return $this->belongsToMany(Pizza::class, 'pizza_order')->withPivot('quantity');
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
