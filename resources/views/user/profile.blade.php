@extends('layouts.userMain')

@section('content')
<div class="container">
    @if(count($results) > 0)
        <div style="margin-top:20px">
            <h2 class="text-center" style="margin:30px 0px">Order History</h2>
                <table class="content-table table-striped" style="border:1px solid black">
                    <tr>
                        <th>No</th>
                        <th>Reference No</th>
                        <th>Orders</th>
                        <th>Total Cost</th>
                        <th>Time</th>
                    </tr>
                    @foreach($results as $i => $result)
                        <tr>
                            <td class="table-text">{{ $i+1 }}</div></td>
                            <td class="col-sm-3">{{ $result['order']->reference_no }}</td>
                            <td class="col-sm-4">
                                @foreach($result['pizzas'] as $pizza)
                                    {{ $pizza->name }} x {{ $pizza->pivot->quantity }}<br/>
                                @endforeach
                            </td>
                            <td class="col-sm-2">
                                RM {{ number_format($result['order']->total_cost,2) }}
                            </td>
                            <td class="col-sm-3">
                                {{ $result['order']->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </table>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('user.pizza.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 text-center">
                <h2>No Order Record</h2>
                <a href="{{ route('user.pizza.index')}}" class="btn btn-success">Make Order</a>
            </div>
        </div>
    @endif
</div>

@endsection
