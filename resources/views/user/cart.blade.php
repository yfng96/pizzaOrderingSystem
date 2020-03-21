@extends('layouts.userMain')

@section('content')
<div class="container">
    @if (Session::has('cart'))
    <form action="{{ route('user.pizza.store') }}" method="post" id="checkout-form">
        <div class="row" style="margin-top:20px">
            <p style="margin:0px 25px 0px"><a href="{{ route('user.pizza.index') }}">
                &larr; Back</a>
            </p>
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <table class="content-table table-striped" style="border:1px solid black">
                    <tr>
                        <th>Pizza</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    @foreach($pizzas as $pizza)
                        <tr>
                            <td class="col-sm-4">{{$pizza['pizza']['name']}}</td>
                            <td class="col-sm-4">RM {{ number_format($pizza['price'], 2) }}</td>
                            <td class="text-center col-sm-4">
                                <a class="btn" style="margin-bottom:10px;background-color:#d2d2d4" href="{{ route('user.pizza.reduce', ['id' => $pizza['id']])}}">-</a>
                                &nbsp;&nbsp;{{ $pizza['qty'] }}&nbsp;&nbsp;
                                <a class="btn" style="margin-bottom:10px;background-color:#d2d2d4" href="{{ route('user.pizza.increase', ['id' => $pizza['id']])}}">+</a>
                            </td>
                        </tr>
                    @endforeach
                    </tr>
                        <td colspan=2></td>
                        <td>Total: RM {{ number_format($totalPrice, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        {{ csrf_field() }}
        <div class="row text-center">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('user.pizza.clear')}}" class="btn btn-primary">Clear</a>
                <button type="submit" class="btn btn-success">Checkout</button>
            </div>
        </div>
    </form>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 text-center">
                <h2>No Items in Cart</h2>
                <a href="{{ route('user.pizza.index')}}" class="btn btn-success">Add Order</a>
            </div>
        </div>
    @endif
</div>

@endsection
