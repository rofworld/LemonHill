@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_event.css') }}">
</head>


@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
  @endif
<div class="search-form">
  <form  method="post" action="{{ route('event.search') }}">

      @csrf

      <div class="form-group">
          <label>Nombre del Evento</label>
          <input type="text" class="form-control" name="event_name" id="event_name">
          <label >Filtro de fecha</label>
          <strong><select name="eventDateOption" id="eventDateOption">
              <option value="nofilter">Sin Filtro</option>
        		  <option value="before">Eventos pasados</option>
              <option value="next15days">Eventos en los próximos 15 dias</option>
              <option value="after">Eventos futuros</option>
	        </select></strong>

            <div style="margin-top:10px;"><label>Ciudad</label></div>
            <input type="text" style="height:50px;" name="event_city">


          <input type="submit" name="send" value="Buscar" class="btn btn-dark btn-search">

      </div>
      </form>

</div>
<div class="list">
  @foreach ($events as $event)
  	<article>
  		<h3>{{$event->name}}</h3>
  		<div><img src="/storage/{{ $event->image_url }}">{{$event->description}}</div>

      <details>
        <summary>Artists</summary>
          <ul>

            @foreach ($map_artist_links[$event->id] as $eventArtist)
          	 <li>{{ $eventArtist->name}}</li>
            @endforeach
          </ul>
        </details>
      <div id="event_admin_buttons" class="event_admin_buttons">
        <em><a href="{{url('/events_info/view/'.$event->id)}}" class="btn">View</a></em>
      @if (Auth::check() && Auth::user()->admin==true)

        <em><a href="{{ url('/events_info/delete/'.$event->id)}}" class="btn">Delete</a></em>
        <em><a href="{{ url('/eventArtists/list/'.$event->id)}}" class="btn">Artists</a></em>

      @endif
      </div>
    </article>

  @endforeach
</div>
{{$events->links()}}
@endsection
