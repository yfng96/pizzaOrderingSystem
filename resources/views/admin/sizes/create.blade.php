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

    <p><a href="{{ route('admin.size.index') }}" style="margin:10px">
        &larr; Back</a>
    </p>

    <!--Bootstrap Boilerplate-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="page-title">Size</h3>
        </div>

        <div class="panel-body">
          {!! Form::model($size, [
              'route' => ['admin.size.store'],
              'class' => 'form-horizontal'
          ]) !!}

            <!--Name-->
            <div class="form-group row">
                {!! Form::label('size-name', 'Name', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', null, [
                        'id' => 'size-name',
                        'class' => 'form-control',
                        'maxlength' => 30,
                    ]) !!}
                </div>
            </div>

            <!--Rate-->
            <div class="form-group row">
                {!! Form::label('size-rate', 'Rate', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::number('rate', null, [
                        'id' => 'size-rate',
                        'class' => 'form-control',
                        'step' => 'any',
                        'maxlength' => 6,
                    ]) !!}
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
