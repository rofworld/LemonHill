<?php

namespace App\Http\Controllers;

use Request;

use App\Models\EventArtists;
use Illuminate\Support\Facades\Auth;
use App\Models\ArtistInfo;

class eventArtistsController extends Controller
{
  public function listEventArtists($id) {
    if (Auth::check() && Auth::user()->admin==true){
      $eventArtists = EventArtists::where(['event_id' => $id])->get();
      $artists = ArtistInfo::all();
    
      return view('eventArtists')
      ->with('eventArtists',$eventArtists)
      ->with('eventId',$id)
      ->with('artists',$artists);
  }else{
    return "Not allowed";
  }
  }

  public function newArtist() {
      if (Auth::check() && Auth::user()->admin==true){
      $artist_id = Request::get('newArtist', '');
      $event_id = Request::get('eventId', '');
      $artist= ArtistInfo::find($artist_id);
      //  Store data in database
            if (!empty($artist_id)){
            EventArtists::create([
              'artist_id' => $artist_id,
              'artist_name' => $artist->name,
              'event_id' => $event_id
            ]);

            return back()->with('success', 'You have successfully added a new artist');
          }else{
            return "Event Id = ".$event_id;
          }

        }else{
          return "Not allowed";
        }
      //

  }

}
