<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistInfo;
use App\Models\Link;
use App\Models\EventArtists;
use App\Models\Event;
use Carbon\Carbon;

class ArtistInfoController extends Controller
{
  // Create Contact Form
  public function ListArtists(Request $request) {
    $artist_info_list = ArtistInfo::Simplepaginate(10);
    $map_artist_links= array();
    $map_future_events = array();

    foreach ($artist_info_list as $artist) {
      $links = Link::where(['artist_id' => $artist->id])->pluck('link');
      $map_artist_links[$artist->id]=$links;
      $event_artists = EventArtists::where(['artist_id' => $artist->id])->get();
      $future_events=array();
      foreach ($event_artists as $event_artist) {
        $future_event = Event::whereDate('event_date','>=',Carbon::now()->toDateString())->where(['id' => $event_artist->event_id])->first();
        if ($future_event){
          $future_events[] = $future_event;
        }
      }
      $map_future_events[$artist->id] = $future_events;


    }

    $map_events_name= array();
    $events = Event::whereDate('event_date','>=',Carbon::now()->toDateString())->get();
    foreach ($events as $event){
      $map_events_name[$event->id] = $event->name;
    }

    return view('artist_info')
    ->with('artist_info_list',$artist_info_list)
    ->with('map_artist_links',$map_artist_links)
    ->with('map_future_events',$map_future_events)
    ->with('map_events_name',$map_events_name);
  }

  public function viewArtist($id){
    $artist_info_list = ArtistInfo::where('id',$id)->Simplepaginate(10);
    $map_artist_links= array();
    $map_future_events = array();

    foreach ($artist_info_list as $artist) {
      $links = Link::where(['artist_id' => $artist->id])->pluck('link');
      $map_artist_links[$artist->id]=$links;
      $event_artists = EventArtists::where(['artist_id' => $artist->id])->get();
      $future_events=array();
      foreach ($event_artists as $event_artist) {
        $future_event = Event::whereDate('event_date','>=',Carbon::now()->toDateString())->where(['id' => $event_artist->event_id])->first();
        if ($future_event){
          $future_events[] = $future_event;
        }
      }
      $map_future_events[$artist->id] = $future_events;


    }

    $map_events_name= array();
    $events = Event::whereDate('event_date','>=',Carbon::now()->toDateString())->get();
    foreach ($events as $event){
      $map_events_name[$event->id] = $event->name;
    }

    return view('artist_info')
    ->with('artist_info_list',$artist_info_list)
    ->with('map_artist_links',$map_artist_links)
    ->with('map_future_events',$map_future_events)
    ->with('map_events_name',$map_events_name);
  }


}
