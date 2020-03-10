@extends('layouts.main')
@section('content');

<div class="content">
    <p style="margin:0px 25px 0px"><a href="{{ route('admin.pizza.index') }}">
        &larr; Back</a>
    </p>
    <div class="panel-body">
        <div style="background:#F0F8FF; padding:20px; margin:10px">
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <img style="width:100%" src="/storage/pizzas/{{$pizza->image}}">
                    <a class="btn btn-primary" style="margin-top:10px;width:120px" href="{{ route('admin.pizza.upload', ['id' => $pizza->id]) }}">Change Photo</a>
                </div>
                <div class="col-md-7 col-sm-7">

                    <table class="table table-striped task-table">
                        <thead>
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $pizza->name }}</td>
                            </tr>
                            <tr>
                                <td>Base Price (RM)</td>
                                <td>{{ $pizza->base_price }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $pizza->description}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
