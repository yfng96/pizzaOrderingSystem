<?php
?>
@extends('layouts.main')
@section('content')
<div class="content" style="padding:20px">

  @if (session('success'))
   <p class="alert alert-success">{{ session('success') }}</p>
  @endif

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
        <h3 class="page-title">Change Password</h3>
    </div>
    <!--Bootstrap Boilerplate...-->
    <div class="panel-body">
        <!-- New Tenant Form -->
        {!! Form::open([
            'route' => ['auth.change_password'],
            'method' => 'patch',
            'class' => 'form-horizontal'
        ]) !!}

            <!--CurrentPassword-->
            <div class="form-group row">
                {!! Form::label('current_password', 'Currrent Password ', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::password('current_password', [
                        'class' => 'form-control',
                    ]) !!}
                    @if($errors->has('current_password'))
							          <p class="help-block">
								            {{ $errors->first('current_password') }}
							          </p>
						        @endif
                </div>
            </div>

            <!--New Password-->
            <div class="form-group row">
                {!! Form::label('new_password', 'New Password ', [
                    'class' => 'control-label col-sm-3',
                ]) !!}
                <div class="col-sm-9">
                    {!! Form::password('new_password', [
                        'class' => 'form-control',
                    ]) !!}
                    @if($errors->has('new_password'))
							          <p class="help-block">
								            {{ $errors->first('new_password') }}
							          </p>
						        @endif
                </div>
            </div>

            <!--Confirm Password-->
            <div class="form-group row">
                {!! Form::label('confirm_password', 'Confirm Password ', [
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
  </div>
@endsection
