<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistInfo;
use App\Models\Link;

class ArtistInfoController extends Controller
{
  // Create Contact Form
  public function ListArtists(Request $request) {
    $artist_info_list = ArtistInfo::all();
    $map_artist_links= array();
    foreach ($artist_info_list as $artist) {
      $links = Link::where(['artist_id' => $artist->id])->pluck('link');
        $map_artist_links[$artist->id]=$links;
    }

    return view('artist_info')
    ->with('artist_info_list',$artist_info_list)
    ->with('map_artist_links',$map_artist_links);
  }

  public function viewArtist($id){
    $artist_info_list = ArtistInfo::where('id',$id)->get();
    $map_artist_links= array();
    foreach ($artist_info_list as $artist) {
      $links = Link::where(['artist_id' => $artist->id])->pluck('link');
        $map_artist_links[$artist->id]=$links;
    }

    return view('artist_info')
    ->with('artist_info_list',$artist_info_list)
    ->with('map_artist_links',$map_artist_links);
  }


}
