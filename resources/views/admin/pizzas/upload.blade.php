<?php
  use App\Pizza;
?>
@extends('layouts.main')
@section('content')
<div class="content" style="padding:20px">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="page-title" style="margin-bottom:30px"><b>Change Photo</b></h3>
        <h4>Pizza Name: {{ $pizza->name }}</h4>
    </div>
    <!--Bootstrap Boilerplate...-->
    <div class="panel-body">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

        <!-- Upload Form -->
        {!! Form::open([
            'route' => ['admin.pizza.saveUpload', $pizza->id],
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
        ]) !!}

            <!--Image-->
            <div class="form-group row">
                {!! Form::label('pizza-photo', 'Select File ', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::file('image', [
                        'id' => 'pizza-photo-file',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <!--Submit Button-->
            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                  {!! Form::button('Upload', [
                      'type' => 'submit',
                      'class' => 'btn btn-primary'
                  ]) !!}
                </div>
            </div>
          {!! Form::close() !!}
      </div>
    </div>
    <p>
      <a href="{{ route('admin.pizza.show', ['id' => $pizza->id]) }}" class="btn btn-success">
          &larr; Back</a>
    </p>
  </div>
@endsection
