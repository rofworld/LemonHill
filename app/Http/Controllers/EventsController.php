<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventArtists;
use App\Models\ArtistInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{


  public function searchEvent(Request $request){

    $eventQuery = DB::table('events');

    if ($request->filled('eventDateOption')){

      switch ($request->eventDateOption){

        case "before":
          $eventQuery = $eventQuery->whereDate('event_date','<',Carbon::now()->toDateString());
          break;

        case "next15days":
          $eventQuery = $eventQuery->whereDate('event_date','<=',Carbon::now()->add(15,'day')->toDateString());
          $eventQuery = $eventQuery->whereDate('event_date','>=',Carbon::now()->toDateString());
          break;

        case "after":
          $eventQuery = $eventQuery->whereDate('event_date','>=',Carbon::now()->toDateString());
          break;


      }
    }

    if ($request->filled('event_name')){
        $eventQuery = $eventQuery->where('name','like','%'.$request->event_name.'%');
    }
    if ($request->filled('event_city')){
        $eventQuery = $eventQuery->where('city','like','%'.$request->event_city.'%');
    }

    $events =$eventQuery->simplePaginate(10);
    $map_artist_links= array();
    foreach ($events as $event) {

      $links = EventArtists::where(['event_id' => $event->id])->pluck('artist_id');
      $eventArtists = array();
      foreach ($links as $link) {
        $eventArtists[] = ArtistInfo::find($link);
      }
      $map_artist_links[$event->id]=$eventArtists;
    }

    return view('event_info')
    ->with('events',$events)
    ->with('map_artist_links',$map_artist_links);

  }
  // Create Contact Form
  public function createForm(Request $request) {
    if (Auth::check() && Auth::user()->admin==true){
      return view('create_event');
    }else{
      return "Not allowed";
    }
  }

  public function storeEvent(Request $request) {
    $this->validate($request, [
        'name' => ['required','unique:events'],
        'description' => ['required','max:5000'],
        'file' => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
        'date' => 'required|date',
        'price' => 'required|numeric',
        'location' => 'required',
        'city' => 'required',
        'sellPoint' => 'required'

     ]);

    //  Store data in database


      if($request->file()) {
          $fileName = time().'_'.$request->file->getClientOriginalName();
          $filePath = $request->file('file')->storeAs('events', $fileName, 'public');



          Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'event_date' =>$request->date,
            'price' => $request->price,
            'image_url' => $filePath,
            'location' => $request->location,
            'city' => $request->city,
            'sellPoint' => $request->sellPoint
          ]);
      }


    //
    return back()->with('success', 'You have successfully added an Event');
  }


  public function ListEvents(Request $request) {

    $events = Event::simplePaginate(10);
    $map_artist_links= array();
    foreach ($events as $event) {

      $links = EventArtists::where(['event_id' => $event->id])->pluck('artist_id');
      $eventArtists = array();
      foreach ($links as $link) {
        $eventArtists[] = ArtistInfo::find($link);
      }
      $map_artist_links[$event->id]=$eventArtists;
    }
    return view('event_info')
    ->with('events',$events)
    ->with('map_artist_links',$map_artist_links);
  }

  public function viewEvent($id) {
    $event = Event::find($id);
    $map_artists= array();

      $links = EventArtists::where(['event_id' => $event->id])->pluck('artist_id');
      $eventArtists = array();
      foreach ($links as $link) {
        $eventArtists[] = ArtistInfo::where('id',$link)->first();
      }
      $map_artists[$event->id]=$eventArtists;


    return view('event_view')
    ->with('event',$event)
    ->with('map_artists',$map_artists);
  }

  public function deleteEvent($id){
    if (Auth::check() && Auth::user()->admin==true){
    try{
      Event::destroy($id);
      return back()->with('success', 'You have successfully deleted an Event');
    }catch (\Exception $e) {
        return back()->with('warning', 'Database violation');

    }
    }else{
      return "Not allowed";
    }
  }
}
