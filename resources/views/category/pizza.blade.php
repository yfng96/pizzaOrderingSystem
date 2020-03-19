@extends('layouts.main')

@section('content')
<div class="container text-center">
  <div class='row'>
    @foreach($pizzas as $pizza)
    {{-- a href link, id --}}
      <div class='col-sm-6 col-md-4 col-lg-3' style='margin: 10px -10px'>
        <div class='img-thumbnail' style='width: 350px; height: 360px'>
          <img class='' src='{{ url(asset('/pizzas/'.$pizza->name.".jpg")) }}' style='width: 100%; margin-x: auto;'/>
          <p class='text-left' style='margin-top: 5px;'><strong>{{ $pizza->name }}</strong></p>
          <p class='text-left' style='margin-top: 5px;'>{{ $pizza->description }}</p>
          <p class='text-right'><strong>RM{{ $pizza->base_price }}</strong></p>
        </div>
      </div>
    @endforeach
  </div>
</div>




@endsection
