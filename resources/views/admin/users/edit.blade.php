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
                'route' => ['admin.user.update', $user->id],
                'method' => 'put',
                'class' => 'form-horizontal'
            ]) !!}

              <!-- Name -->
              <div class="form-group row">
                  {!! Form::label('user-name', 'Name', [
                      'class' => 'control-label col-sm-3',
                  ]) !!}
                  <div class="col-sm-9">
                      {!! Form::text('name', $user->name, [
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
                      {!! Form::email('email', $user->email, [
                          'id' => 'user-email',
                          'class' => 'form-control',
                      ]) !!}
                  </div>
              </div>

              <!-- Phone -->
              <div class="form-group row">
                  {!! Form::label('user-phone', 'Phone', [
                      'class' => 'control-label col-sm-3',
                  ]) !!}
                  <div class="col-sm-9">
                      {!! Form::text('phone', $user->phone, [
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
                    {!! Form::select('role',Common::$roles,$user->role,[
                        'class'=>'form-control',
                        'placeholder'=>'- Select Role -',
                    ])!!}
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
