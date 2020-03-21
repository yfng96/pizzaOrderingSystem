@extends('layouts.main')
@section('content')

<div class="content">
    <h2 style="padding:20px">ORDER</h2>

    <div class="panel-body">
        
            <div>
                <div class="pull-right" style="margin:0px 10px">{{ $orders->links() }}</div>
            </div>
            
            <div style="background:#ddd;padding:5px;margin:10px">
                <table class="table-striped content-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Reference No.</th>
                            <th>Customer Name</th>
                            <th>Total Cost (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($orders) > 0)
                            @foreach ($orders as $i => $order)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $i+1 }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! link_to_route(
                                                'admin.order.show',
                                                $title = $order->reference_no,
                                                $parameters = [
                                                    'id' => $order->id,
                                                ]
                                            )!!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $order->user->name }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ number_format($order->total_cost, 2) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan=5 style="padding:20px;text-align:center">No record found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        
    </div>
</div>

@endsection