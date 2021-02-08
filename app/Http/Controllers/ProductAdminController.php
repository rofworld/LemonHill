<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductAdminController extends Controller
{
  public function createForm(Request $request) {
    return view('product_creation');

  }


  public function editForm($id) {
    $product=Product::where('id', $id)->first();
    return view('product_edit')
    ->with('product',$product);
  }

  // Store Contact Form data
  public function createProduct(Request $request) {

      // Form validation
      $this->validate($request, [
          'name' => ['required','unique:products'],
          'description' => ['required','max:1000'],
          'file' => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
          'stock' => 'required|integer|min:0',
          'price' => 'required|integer|min:0'

       ]);

      //  Store data in database


        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('product_images', $fileName, 'public');



            Product::create([
              'name' => $request->name,
              'description' => $request->description,
              'stock' => $request->stock,
              'price' => $request->price,
              'image_url' => $filePath
            ]);
        }


      //
      return back()->with('success', 'You have successfully added a Product');
  }

  public function editProduct(Request $request) {

    // Form validation
    $this->validate($request, [
        'description' => ['required','max:1000'],
        'file' => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
        'stock' => 'required|integer|min:0',
        'price' => 'required|integer|min:0'

     ]);

    //  Store data in database


      if($request->file()) {
          $fileName = time().'_'.$request->file->getClientOriginalName();
          $filePath = $request->file('file')->storeAs('product_images', $fileName, 'public');


          $product=Product::find($request->id)
          ->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'image_url' => $filePath
          ]);
          
      }


    //
    return back()->with('success', 'You have successfully updated a Product');

  }


  public function listProducts(Request $request){

    $products = Product::all();


    return view('product_list')
    ->with('product_list',$products);
  }

  public function delete($id){
    Product::destroy($id);
    return back()->with('success', 'You have successfully deleted a Product');
  }

  public function changeStock(Request $request){
    $this->validate($request, [
        'stock' => 'required|integer|min:0',
     ]);
    Product::where('id',$request->id)->update(
      ['stock' => $request->stock]
    );
    return back()->with('success', 'You have successfully updated the stock');
  }
}
