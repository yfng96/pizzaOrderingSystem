@extends('layouts.main')
@section('content');

<div class="content">
    <p style="margin:0px 25px 0px"><a href="{{ route('admin.order.index') }}">
        &larr; Back</a>
    </p>
    <div class="panel-body">
        <div style="background:#F0F8FF; padding:20px; margin:10px">
            <div class="row">
                    <table class="table table-striped task-table">
                        <thead>
                            <tr>
                                <th class="col-sm-3">Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Reference No</td>
                                <td>{{ $order->reference_no }}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Customer Contact No.</td>
                                <td>{{ $order->user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Total Cost (RM)</td>
                                <td>{{ $order->total_cost }}</td>
                            </tr>
                            <tr>
                                <td>Orders</td>
                                <td>
                                    @foreach ($pizzas as $i => $pizza)
                                        <div>
                                            {{ $pizza->name }} x {{ $pizza->pivot->quantity }}
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
  </div>
@endsection
