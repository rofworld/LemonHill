<?php

namespace App\Http\Controllers;

use Request;


use App\Models\Link;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{



  public function ListLinks($id) {
    if (Auth::check() && Auth::user()->admin==true){
    $links = Link::where(['artist_id' => $id])->get();
    return view('links')
    ->with('links',$links)
    ->with('artist_id',$id);
  }else{
    return "Not allowed";
  }
  }

  public function newLink() {
      if (Auth::check() && Auth::user()->admin==true){
      $newlink = Request::get('newlink', '');
      $artist_id = Request::get('artist_id', 0);
      //  Store data in database
            if (!empty($newlink)){
            Link::create([
              'artist_id' => $artist_id,
              'link' => $newlink
            ]);

            return back()->with('success', 'You have successfully added a new link');
          }

        }else{
          return "Not allowed";
        }
      //

  }

  public function delete($id){

    if (Auth::check() && Auth::user()->admin==true){

      Link::destroy($id);


      return back()->with('success', 'You have successfully deleted a link');
    }else{
      return "Not allowed";
    }

  }

}
