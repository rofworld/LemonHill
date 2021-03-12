<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ArtistInfo;
use Illuminate\Support\Facades\Auth;


class ArtistInfoAdminController extends Controller
{
  // Create Contact Form
  public function createForm(Request $request) {
    if (Auth::check() && Auth::user()->admin==true){
      return view('artist_info_admin');
    }else{
      return "Not allowed";
    }
  }

  // Store Contact Form data
  public function ArtistInfoForm(Request $request) {

      // Form validation
      $this->validate($request, [
          'name' => ['required','unique:artist_infos'],
          'description' => ['required','max:5000'],
          'file' => 'required|mimes:jpeg,png,bmp,tiff|max:4096'

       ]);

      //  Store data in database


        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');



            ArtistInfo::create([
              'name' => $request->name,
              'description' => $request->description,
              'image_url' => $filePath
            ]);
        }


      //
      return back()->with('success', 'You have successfully added an Artist');
  }

  public function delete($id){
    if (Auth::check() && Auth::user()->admin==true){
      try {
        ArtistInfo::destroy($id);
        return back()->with('success', 'You have successfully deleted an Artist');

      } catch (\Exception $e) {
        return back()->with('warning', 'Database violation');

      }
    }else{
      return "Not allowed";
    }
  }
}
