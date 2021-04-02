@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/shopping_cart_style.css') }}">
</head>

@section('content')

<div class="container">

    <div class="table">

       @foreach ($shoppingCartLines as $line)
       <article>
       <h3>{{$line['product_name']}} X {{$line['units']}}</h3>
       <strong>{{$map_description[$line['id']]}} <br><b> Precio: {{$line['unit_price']}} X {{$line['units']}} = {{$line['total_line_price']}} € </b></strong>
       <div><img src="/storage/{{$map_images[$line['id']]}}"></div>
       </article>
       @endforeach

    <div>
      <label class="total_price pull-right">Precio total: {{$total_price}} €</label>
    </div>
    <hr>
    <div>
  		<em><a id="checkoutButton" title="Checkout Button" href="{{ url('/checkout')}}">Checkout ({{ $total_price }} €)</a></em>
    </div>




</div>
@endsection
