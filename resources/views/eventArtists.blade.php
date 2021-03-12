@extends('layouts.app')
<head>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_event_artists.css') }}">
</head>

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if (!empty($eventArtists))
  <ul class="list-group">
    @foreach($eventArtists as $link)
      <li class="list-group-item">
        {{ $link->artist_name }}
        <a href="{{url('/eventArtists/delete/'.$link->id)}}" class="btn btn-dark btn-link-delete">Delete</a>
      </li>
    @endforeach
  </ul>
  <form  method="get" action="{{ route('eventArtist.store') }}">

      @csrf

      <div class="form-group">
          <input type="hidden" name="eventId" value="{{$eventId}}">
          <label>New Artist:</label>
          <strong><select name="newArtist">
            @foreach ($artists as $artist)
        		  <option value="{{$artist->id}}">{{$artist->name}}</option>
        		@endforeach
	        </select></strong>

      <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
      </div>

      </form>


      @endif


</div>
@endsection
