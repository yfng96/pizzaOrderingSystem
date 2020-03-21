<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Pizza;
use App\Cart;
use App\Order;
use App\User;

class PizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pizzas = Pizza::when($request->query('name'), function($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->query('name').'%');
            })
            ->when($request->query('description'), function($query) use ($request) {
                return $query->where('description', 'like','%'.$request->query('description').'%');
            })
            ->get();

        return view('user.index', [
            'pizzas' => $pizzas,
            'request' => $request,
        ]);
    }

    public function add(Request $request, $id)
    {
        $pizza = Pizza::find($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($pizza, $pizza->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('user.pizza.index');
    }

    public function reduce(Request $request, $id)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduce($id);

        if (count($cart->pizzas) > 0) 
        {
            $request->session()->put('cart', $cart);
        } else 
        {
            $request->session()->forget('cart');
        }

        return redirect()->route('user.pizza.cart');
    }

    public function increase(Request $request, $id)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->increase($id);

        $request->session()->put('cart', $cart);
        return redirect()->route('user.pizza.cart');
    }

    public function cart(Request $request)
    {
        if (!$request->session()->has('cart'))
        {
             return view('user.cart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('user.cart', ['pizzas' => $cart->pizzas, 'totalPrice' => $cart->totalPrice]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $user = User::find(Auth::user()->id);
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        $order->reference_no = rand(1000000000, 9999999999);
        $order->total_cost = $cart->totalPrice;
        $order->user_id = Auth::user()->id;
        
        $order->save();

        foreach ($cart->pizzas as $pizza)
        {
            $order->pizzas()->attach($pizza['id'], ['quantity' => $pizza['qty']]);
        }
        
        $order->user()->associate($user);

        $request->session()->forget('cart');
        return redirect()->route('user.pizza.index')->with('success', 'Successfully Placed Order!');
    }

    public function clear(Request $request)
    {
        if ($request->session()->has('cart'))
        {
            $request->session()->forget('cart');
        }

        return redirect()->route('user.pizza.index');
    }

    public function profile(Request $request)
    {
        $results = new Collection;
        $orders = Order::where('user_id', Auth::user()->id)->get();
        foreach ($orders as $order) {
            $pizzas = $order->pizzas()->get();
            $results->push(['order' => $order, 'pizzas'=>$pizzas]);
        }

        return view('user.profile', [
            'results' => $results,
        ]);
    }
}
