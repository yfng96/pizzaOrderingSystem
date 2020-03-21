<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('user:id,name')
            ->when($request->query('reference_no'), function($query) use ($request) {
                return $query->where('reference_no', 'like','%'.$request->query('reference_no').'%');
            })
            ->when($request->query('user_id'), function($query) use ($request) {
                return $query->where('user_id', $request->query('user_id'));
            })
            ->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders,
            'request' => $request,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $pizzas = $order->pizzas()->get();
        if(!$order) throw new ModelNotFoundException;

        return view('admin.orders.show', [
            'order' => $order,
            'pizzas' => $pizzas,
        ]);
    }
}
