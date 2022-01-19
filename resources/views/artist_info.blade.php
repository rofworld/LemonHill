@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_artist.css') }}">
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
<div class="simple">
  @foreach ($artist_info_list as $artist)
  	<article>
  		<h3>{{$artist->name}}</h3>
  		<div><img src="/storage/{{ $artist->image_url }}">{{$artist->description}}</div>

      <details>
        <summary>Links</summary>
          <ul>
            @foreach($map_artist_links[$artist->id] as $link)
          	 <li><a href="{{ $link }}">{{ $link }}</a></li>
            @endforeach
          </ul>
    </details>
    <details>
      <summary>Eventos Futuros</summary>
        <ul>
          @foreach($map_future_events[$artist->id] as $future_event)
           <li><a href="{{ url('/events_info/view/'. $future_event->event_id) }}">{{ $map_events_name[$future_event->id] }}</a></li>
          @endforeach
        </ul>
    </details>

      <div id="artist_admin_buttons" class="artist_admin_buttons">
        @if (Auth::check() && Auth::user()->admin==true)
        <em><a href="{{ url('/artist_info/delete/'. $artist->id) }}" class="btn">Delete</a></em>
        <em><a href="{{ url('/links/list/'. $artist->id) }}" class="btn">Links</a></em>
        @endif
      </div>
    </article>

  	<hr>
  @endforeach
</div>
{{$artist_info_list->links()}}
@endsection
