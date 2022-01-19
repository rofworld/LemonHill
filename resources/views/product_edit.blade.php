@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

@section('content')
<div class="container">

  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

<form  method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">

    @csrf
    @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
    @endif
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" value="{{$product->name}}">
        <input type="hidden" class="form-control" name="id" id="id" value="{{$product->id}}">
        <!-- Error -->
        @if ($errors->has('name'))
        <div class="error">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control {{ $errors->has('description') ? 'error' : '' }}" name="description" id="description" rows="6">
          {{$product->description}}
        </textarea>
        @if ($errors->has('description'))
        <div class="error">
            {{ $errors->first('description') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Categoria</label>
        <strong><select name="category_id" id="category_id" value="{{$product->category}}">
          @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select></strong>
        @if ($errors->has('category_id'))
        <div class="error">
            {{ $errors->first('category_id') }}
        </div>
        @endif
    </div>


    <div class="form-group">
        <label>Price (in Euros)</label>
        <input type="text" class="form-control {{ $errors->has('price') ? 'error' : '' }}" name="price" id="price" value="{{$product->price}}">

        <!-- Error -->
        @if ($errors->has('price'))
        <div class="error">
            {{ $errors->first('price') }}
        </div>
        @endif
    </div>

    <div class="form-group">


          <label>Choose Image File:</label>
          <input type="file" id="file" name="file" style="display: none;" />
          <input type="button" value="Browse..." onclick="document.getElementById('file').click();" />
          <!-- Error -->
          @if ($errors->has('file'))
          <div class="error">
              {{ $errors->first('file') }}
          </div>
          @endif
    </div>



    <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
</form>
</div>
@endsection
