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

    <div class="panel-body">
        
            <div>
                <a href="{{ route('admin.pizza.create') }}" class="btn btn-success" style="margin:0px 10px 10px">
                    Add new pizza
                </a>
                <div class="pull-right" style="margin:0px 10px">{{ $pizzas->links() }}</div>
            </div>
            
            <div style="background:#ddd;padding:5px;margin:10px">
                @include('admin.pizzas._filter')
                <table class="table-striped content-table">
                    <thead>
                        <tr>
                            <th class="col-sm-1">No.</th>
                            <th class="col-sm-1">Name</th>
                            <th class="col-sm-2">Base Price (RM)</th>
                            <th>Description</th>
                            <th class="col-sm-2" colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($pizzas) > 0)
                            @foreach ($pizzas as $i => $pizza)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $i+1 }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! link_to_route(
                                                'admin.pizza.show',
                                                $title = $pizza->name,
                                                $parameters = [
                                                    'id' => $pizza->id,
                                                ]
                                            )!!}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                        {{ number_format($pizza->base_price, 2) }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {{ $pizza->description }}
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <a class="btn btn-info" style="margin:5px" href="{{ route('admin.pizza.edit', $pizza->id) }}">Edit</a>
                                    </td>
                                    <td class="table-text">
                                        <a class="btn btn-danger" style="margin:5px" href="{{ route('admin.pizza.delete', $pizza->id) }}">Delete</a>
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