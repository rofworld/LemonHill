@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/shopping_cart_style_new.css') }}">

</head>

@section('content')
<main>
    <div class="basket">
      <div class="basket-labels">
        <ul>
          <li class="item item-heading">Item</li>
          <li class="price">Price</li>
          <li class="quantity">Quantity</li>
          <li class="subtotal">Subtotal</li>
        </ul>
      </div>
      @foreach ($shoppingCartLines as $line)
      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="/storage/{{$map_images[$line['id']]}}" alt="{{$line['product_name']}}" class="product-frame">
          </div>
          <div class="product-details">
            <p>{{$line['product_name']}}</p>
          </div>
        </div>
        <div class="price">{{$line['unit_price']}}</div>
        <div class="quantity">
          {{$line['units']}}
        </div>
        <div class="subtotal">{{$line['total_line_price']}}</div>
      </div>
      @endforeach
      </div>
    <aside>
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Subtotal</div>
          <div class="subtotal-value final-value" id="basket-subtotal">{{$total_price}}</div>
        </div>
        <div class="summary-gastos-envio">
          <div class="subtotal-title">Envio</div>
          <div class="subtotal-value final-value" id="basket-subtotal">{{env('GASTOS_ENVIO')}}</div>
        </div>
        <div class="summary-total">
          <div class="total-title">Total</div>
          <div class="total-value final-value" id="basket-total">{{$total_price + env('GASTOS_ENVIO') }}</div>
        </div>
      </div>
    </aside>

  <hr>
  <div>
    <em><a id="deleteButton" title="Borrar Carrito" href="{{ url('/delete_shopping_cart')}}">Borrar Carrito</a></em>
    <em><a id="checkoutButton" title="Checkout Button" href="{{ url('/checkout')}}">Checkout ({{ $total_price + env('GASTOS_ENVIO') }} €)</a></em>
  </div>
</main>


@endsection
