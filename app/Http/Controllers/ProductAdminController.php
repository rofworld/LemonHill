<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class ProductAdminController extends Controller
{
  public function createForm(Request $request) {
    $categories=ProductCategory::all();
    if (Auth::user()->admin==true){
      return view('product_creation')
      ->with('categories',$categories);
    }else{
      return "Not allowed";
    }

  }


  public function editForm($id) {
    if (Auth::user()->admin==true){
      $product=Product::where('id', $id)->first();
      $categories=ProductCategory::all();
      return view('product_edit')
      ->with('product',$product)
      ->with('categories',$categories);
    }else{
      return "Not allowed";
    }
  }

  // Store Contact Form data
  public function createProduct(Request $request) {

      // Form validation
      $this->validate($request, [
          'name' => ['required','unique:products'],
          'description' => ['required','max:1000'],
          'file' => 'required|mimes:jpeg,png,bmp,tiff|max:4096',
          'category_id' => 'required|integer|min:1',
          'price' => 'required|numeric|min:0'

       ]);

      //  Store data in database


        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('product_images', $fileName, 'public');



            Product::create([
              'name' => $request->name,
              'description' => $request->description,
              'category' => $request->category_id,
              'price' => $request->price,
              'image_url' => $filePath,
              'hidden' => false
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
        'category_id' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0'

     ]);

    //  Store data in database


      if($request->file()) {
          $fileName = time().'_'.$request->file->getClientOriginalName();
          $filePath = $request->file('file')->storeAs('product_images', $fileName, 'public');


          $product=Product::find($request->id)
          ->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category_id,
            'price' => $request->price,
            'image_url' => $filePath
          ]);

      }


    //
    return back()->with('success', 'You have successfully updated a Product');

  }


  public function listProducts(Request $request){
    if (Auth::check() && Auth::user()->admin==true){
      $products = Product::all();


      return view('product_list')
      ->with('product_list',$products);
    }else{
      return "Not allowed";
    }
  }

  public function delete($id){
    if (Auth::user()->admin==true){
      Product::destroy($id);
      return back()->with('success', 'You have successfully deleted a Product');
    }else{
      return "Not allowed";
    }
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

  public function hide($id){
    if (Auth::check() && Auth::user()->admin==true){
      $product = Product::find($id);
      $hidden = $product->hidden ? false : true;
      $product->update([
        'hidden' => $hidden
      ]);

      if ($hidden){
        return back()->with('success', 'You have successfully hide the product');
      }else{
        return back()->with('success', 'You have successfully unhide the product');
      }
    }else{
      return "Not allowed";
    }
  }
}
