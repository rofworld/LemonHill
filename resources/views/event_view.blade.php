@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_event.css') }}">
</head>


@section('content')
<div class="container">

<div class="simple">
  	<article>
  		<h3>{{$event->name}}</h3>
  		<div><img src="/storage/{{ $event->image_url }}">{{$event->description}}</div>
      <details>
        <summary>Artists</summary>
          <ul>
            @foreach($map_artists[$event->id] as $artist)
          	 <li><a href="{{url('/artist_info/view/'.$artist->id)}}">{{ $artist->name }}</a></li>
            @endforeach
          </ul>
      </details>


    </article>
    </div>
  	<br>
    <div class="flex-grid-3">
	     <section class="panel">
         <dl>
           <dt>Fecha</dt>
           <dd>{{$event->event_date}}</dd>
         </dl>
       </section>

	     <section class="panel">
         <dl>
           <dt>Lugar</dt>
           <dd>{{$event->location}}</dd>
         </dl>
       </section>
	      <section class="panel">
          <dl>
            <dt>Ciudad</dt>
            <dd>{{$event->city}}</dd>
          </dl>
        </section>




</div>
@endsection
