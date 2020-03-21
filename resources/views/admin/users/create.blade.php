<?php
use App\Common;
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
    
    <p><a href="{{ route('admin.user.index') }}" style="margin:10px">
        &larr; Back</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="page-title">User</h3>
        </div>

        <div class="panel-body">
        {!! Form::model($user, [
            'route' => ['admin.user.store'],
            'class' => 'from-horizontal',
            'enctype' => 'multipart/form-data'
        ])!!}

            <!--Name-->
            <div class="form-group row">
                {!! Form::label('user-name', 'Name', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', null, [
                        'id' => 'user-name',
                        'class' => 'form-control',
                        'maxlength' => 100,
                    ]) !!}
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                {!! Form::label('user-email', 'Email', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::email('email', null, [
                        'id' => 'user-email',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <!--Phone-->
            <div class="form-group row">
                {!! Form::label('user-phone', 'Phone', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', null, [
                        'id' => 'user-phone',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            
            <!-- Role -->
            <div class='form-group row'>
                {!! Form::label('user-role','Role',[
                    'class'=>'control-label col-sm-3'
                ])!!}
                <div class='col-sm-9'>
                    {!! Form::select('role',Common::$roles,null,[
                        'class'=>'form-control',
                        'placeholder'=>'- Select Role -',
                    ])!!}
                </div>
            </div>

            <!-- Default Password -->
            <div class='form-group row'>
                {!! Form::label('user-password','Password',[
                    'class'=>'control-label col-sm-3'
                ])!!}
                <div class='col-sm-9'>
                    {!! Form::text('password',null,[
                        'id' => 'user-password',
                        'class' => 'form-control',
                    ])!!}
                </div>
            </div>

            <!--Confirm Password-->
            <div class="form-group row">
                {!! Form::label('user-confirm_password', 'Confirm Password ', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::password('confirm_password', [
                        'class' => 'form-control',
                    ]) !!}
                    @if($errors->has('confirm_password'))
					    <p class="help-block">
					        {{ $errors->first('confirm_password') }}
					    </p>
					@endif
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