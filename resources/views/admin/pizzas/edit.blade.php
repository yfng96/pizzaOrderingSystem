<?php
  use App\Pizza;
?>
@extends('layouts.main')
@section('content')
<div class="content" style="padding:20px">

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="page-title">Pizza</h3>
        </div>

        <div class="panel-body">
            {!! Form::model($pizza, [
                'route' => ['admin.pizzas.update', $pizza->id],
                'method' => 'put',
                'class' => 'form-horizontal'
            ]) !!}

              <!-- Name -->
              <div class="form-group row">
                  {!! Form::label('pizza-name', 'Name', [
                      'class' => 'control-label col-sm-3',
                  ]) !!}
                  <div class="col-sm-9">
                      {!! Form::text('name', null, [
                          'id' => 'pizza-name',
                          'class' => 'form-control',
                          'maxlength' => 100,
                      ]) !!}
                  </div>
              </div>

              <!-- Base Price -->
              <div class="form-group row">
                  {!! Form::label('pizza-base_price', 'Base Price (RM)', [
                      'class' => 'control-label col-sm-3',
                  ]) !!}
                  <div class="col-sm-9">
                      {!! Form::number('base_price', null, [
                          'id' => 'pizza-base_price',
                          'class' => 'form-control',
                          'maxlength' => 6,
                          'step' => 'any'
                      ]) !!}
                  </div>
              </div>

              <!--Description-->
              <div class="form-group row">
                  {!! Form::label('pizza-description', 'Description', [
                      'class' => 'control-label col-sm-3',
                  ]) !!}
                  <div class="col-sm-9">
                      {!! Form::textarea('description', $pizza->description, [
                          'id' => 'pizza-description',
                          'class' => 'form-control',
                      ]) !!}
                  </div>
              </div>

              <!--Submit Button-->
              <div class="form-group row">
                  <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::button('Update', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ]) !!}
                  </div>
              </div>

              {!! Form::close() !!}
        </div>
    </div>
    <p><a href="{{ route('admin.pizzas.index') }}" class="btn btn-success">
          &larr; Back</a>
    </p>
</div>
@endsection
