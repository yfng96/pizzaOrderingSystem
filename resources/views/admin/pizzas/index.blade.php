<?php

use App\Pizza;

?>

@extends('layouts.main')
@section('content')

<div class="content">
    <h2 style="padding:20px">PIZZA</h2>
    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    @include('admin.pizzas._filter')

    <div class="panel-body">
        @if(count($pizzas) > 0)
            <div style="margin:10px">
                <a href="{{ route('admin.pizzas.create') }}" class="btn btn-success">
                    Add new pizza
                </a>
                <!-- div class="pull-right">{{ $pizzas->links() }}</div-->
            </div>

            <div style="background:#ddd;padding:5px;margin:10px">
                <table class="table-striped content-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Base Price (RM)</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizzas as $i => $pizza)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $i+1 }}</div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {!! link_to_route(
                                            'admin.pizzas.show',
                                            $title = $pizza->name,
                                            $parameters = [
                                                'id' => $pizza->id,
                                            ]
                                        )!!}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                    {{ number_format($pizza->base_price, 2) }}{{ $pizza->name }}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{ $pizza->description }}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        <a class="btn btn-info" style="margin-bottom:10px;width:110px" href="{{ route('admin.pizzas.edit', $pizza->id) }}">Edit</a>
                                        <a class="btn btn-danger" style="margin-bottom:10px;width:110px" href="{{ route('admin.pizzas.delete', $pizza->id) }}">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div>
                No record found
            </div>
        @endif
    </div>
</div>

@endsection