@extends('layouts.main')
@section('content');

<div class="content">
    <div class="panel-body">
        <div style="background:#F0F8FF; padding:5px; margin:10px">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="/storage/pizzas/{{$pizza->image}}">
                    <a class="btn btn-primary" style="margin-top:10px;width:120px" href="{{ route('admin.pizzas.upload', ['id' => $pizza->id]) }}">Change Photo</a>
                </div>
                <div class="col-md-8 col-sm-8">

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
    <p><a class="btn btn-success" href="{{ route('admin.pizzas.index') }}">
          &larr; Back</a>
    </p>
  </div>
@endsection
