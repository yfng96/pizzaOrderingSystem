<?php

use App\Pizza;

?>
<div class="panel-body">
    <div align="center">
        <div class="filters">
          {!!Form::open([
              'route'=>['admin.pizza.index'],
              'method'=>'get',
              'class'=>'form-inline',
          ])!!}
              {!! Form::text('name', null, [
                  'id' => 'pizza-name',
                  'class' => 'form-control',
                  'style' => "margin:5px",
                  'maxlength' => 100,
                  'placeholder' => 'Search Name',
              ]) !!}

              {!! Form::text('description', null, [
                  'id' => 'pizza-description',
                  'class' => 'form-control',
                  'style' => "margin:5px",
                  'maxlength' => 100,
                  'placeholder' => 'Search Description',
              ]) !!}

              {!!Form::button('Filter',[
                  'type'=>'submit',
                  'class'=>'btn btn-primary',
                  'style' => "margin:5px;width:100px"
              ])!!}

              <a class="btn btn-primary" style="margin:5px;width:100px" href="{{ route('admin.pizza.index') }}">Clear</a>

          {!! Form::close() !!}
        </div>
    </div>
</div>
