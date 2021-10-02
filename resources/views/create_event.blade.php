@extends('layouts.app')

@section('content')
<div class="container">

  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

<form action="" method="post" action="{{ route('event.store') }}" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name">

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
        </textarea>
        @if ($errors->has('description'))
        <div class="error">
            {{ $errors->first('description') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Date</label>
        <input type="date" class="form-control {{ $errors->has('date') ? 'error' : '' }}" name="date" id="date">

        <!-- Error -->
        @if ($errors->has('date'))
        <div class="error">
            {{ $errors->first('date') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="text" class="form-control {{ $errors->has('price') ? 'error' : '' }}" name="price" id="price">

        <!-- Error -->
        @if ($errors->has('price'))
        <div class="error">
            {{ $errors->first('price') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Location</label>
        <input type="text" class="form-control {{ $errors->has('location') ? 'error' : '' }}" name="location" id="location">

        <!-- Error -->
        @if ($errors->has('location'))
        <div class="error">
            {{ $errors->first('location') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>City</label>
        <input type="text" class="form-control {{ $errors->has('city') ? 'error' : '' }}" name="city" id="city">

        <!-- Error -->
        @if ($errors->has('city'))
        <div class="error">
            {{ $errors->first('city') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Sell Point</label>
        <input type="text" class="form-control {{ $errors->has('sellPoint') ? 'error' : '' }}" name="sellPoint" id="sellPoint">

        <!-- Error -->
        @if ($errors->has('sellPoint'))
        <div class="error">
            {{ $errors->first('sellPoint') }}
        </div>
        @endif
    </div>


    <div class="form-group">

      @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif



        <label>Choose Image File:</label>
        <input type="file" id="file" name="file" style="display: none;" />
        <input type="button" value="Browse..." onclick="document.getElementById('file').click();" />
      </div>




    <input type="submit" name="send" value="Submit" class="btn button-dark btn-block">
</form>
</div>
@endsection
