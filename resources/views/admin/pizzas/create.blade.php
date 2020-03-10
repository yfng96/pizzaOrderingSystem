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
    
    <p><a href="{{ route('admin.pizza.index') }}" style="margin:10px">
        &larr; Back</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="page-title">Pizza</h3>
        </div>

        <div class="panel-body">
        {!! Form::model($pizza, [
            'route' => ['admin.pizza.store'],
            'class' => 'from-horizontal',
            'enctype' => 'multipart/form-data'
        ])!!}

            <!--Name-->
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

            <!--Base Price-->
            <div class="form-group row">
                {!! Form::label('pizza-base_price', 'Base Price (RM)', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::number('base_price', null, [
                        'id' => 'pizza-base_price',
                        'class' => 'form-control',
                        'step' => 'any',
                        'maxlength' => 6,
                    ]) !!}
                </div>
            </div>

            <!--Description-->
            <div class="form-group row">
                {!! Form::label('pizza-description', 'Description', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description', null, [
                        'id' => 'pizza-description',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            
            <div class="form-group row">
                {!! Form::label('pizza-image', 'Photo', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::file('image') !!}
                </div>
            </div>
        
            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                  {!! Form::button('Save', [
                      'type' => 'submit',
                      'class' => 'btn btn-primary'
                  ]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection