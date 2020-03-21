@extends('layouts.userMain')

@section('content')
<div class="container">
  @if (Session::has('success'))
    <div>
      <div class="alert alert-success" style="margin-top: 20px; width:100%">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('success') }}
      </div>
    </div>
  @endif
  <div class='row' style="margin-top:10px">
    @foreach($pizzas as $pizza)
      <div class='col-sm-3 col-md-4 col-lg-3' style='display: flex;flex-direction: column;padding-bottom: 20px;'>
        <div class='img-thumbnail' style='width: 350px; height: 370px;'>
          <div style='width: 100%; height: 50%;position: relative;overflow:hidden'>
            <img class='img-responsive' src='{{ url(asset('./storage/pizzas/'.$pizza->image)) }}' style='width: 100%; margin-x: auto;overflow: hidden;'/>
          </div>
          <div style='width: 100%; height: 5%;margin-left: 5px;'>
            <strong>{{ $pizza->name }}</strong>
          </div>
          <div style='width: 100%; height: 30%;margin: 5px;position: relative;overflow:hidden'>
            <p  style='margin-top: 5px;'>{{ $pizza->description }}</p>
          </div>
          <div class="row" style='border-top:1px solid #d9d9d9; height: 15%; padding:5px'>
            <div class='col-sm-6 col-md-6'>
              <a class="btn btn-success" href="{{ route('user.pizza.add', ['id' => $pizza->id])}}">Add To Cart</a>
            </div>
            <div class='col-sm-6 col-md-6'>
              From <strong style='font-size:15px'>RM {{ number_format($pizza->price, 2) }}</strong>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>




@endsection
