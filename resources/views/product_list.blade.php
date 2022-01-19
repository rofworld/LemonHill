@extends('layouts.app')
<head>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_product_list.css') }}">

</head>

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif


    <div class="table">
    @foreach ($product_list as $product)
		<article>
			<h3>{{$product->name}} {{$product->price}}€</h3>
			<strong>{{$product->description}}</strong>
			<div><img src="storage/{{ $product->image_url }}" alt="Picture 1"></div>
		</article>

    <div id="product_list_buttons" class="product_list_buttons">
      <em><a href="{{ url('/product/hide/'. $product->id) }}">
        {{$product->hidden ? 'Hidden' : 'Hide' }}
      </a></em>
      <em><a href="{{ url('/product/delete/'. $product->id) }}">Delete</a></em>
      <em><a href="{{ url('/product_edit_form/'. $product->id) }}">Edit</a></em>
      

    </div>
	   <hr>

     @endforeach
</div>
</div>
</div>

</div>
@endsection
