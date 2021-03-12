<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class shoppingCartController extends Controller
{
  public function viewShop(Request $request){
    $products = Product::all();
    $shoppingCart = null;
    $total_products = null;
    if (session('shoppingCart')) {

      $shoppingCart = session('shoppingCart');
      $shoppingCartLines = $shoppingCart['lines'];
      $total_products =0;
      foreach ($shoppingCartLines as $line) {
        $total_products += $line['units'];
      }
    }
    return view('online_shop')
    ->with('product_list',$products)
    ->with('shoppingCart',$shoppingCart)
    ->with('total_products',$total_products);

  }

  public function viewProduct($id, Request $request){

    $product=Product::where('id', $id)->first();
    $shoppingCart =null;
    $shoppingCartLines =null;
    $total_products = null;
    if (session('shoppingCart')) {
      $shoppingCart = session('shoppingCart');
      $shoppingCartLines = $shoppingCart['lines'];
      $total_products =0;
      foreach ($shoppingCartLines as $line) {
        $total_products += $line['units'];
      }
    }

    return view('product_view')
    ->with('product',$product)
    ->with('shoppingCart',$shoppingCart)
    ->with('total_products',$total_products);

  }

  public function viewCart(Request $request){

        $shoppingCart = session('shoppingCart');
        $shoppingCartLines =$shoppingCart['lines'];
        $total_price =0;
        foreach ($shoppingCartLines as $line) {
          $total_price += $line['total_line_price'];
        }
          return view('shopping_cart')
          ->with('shoppingCartLines',$shoppingCartLines)
          ->with('total_price',$total_price);


  }


  public function addToCart(Request $request){


          $product=Product::where('id', $request->input('id'))->first();

          if (!session('shoppingCart')){
            if ($request->input('stock_units')  > $product->stock){
              return "NOSTOCK";
            }

            $shoppingCart=array();
            $lines = array();
            $newline = array();

            $newline['product_id'] = $request->input('id');
            $newline['product_name'] =  $product->name;
            $newline['units'] =  $request->input('stock_units');
            $newline['unit_price'] =  $product->price;
            $newline['total_line_price'] =  $product->price * $request->input('stock_units');

            $lines[] = $newline;
            if (Auth::check()){
              $shoppingCart['user_id'] = Auth::user()->id;
            }
            $shoppingCart['lines'] = $lines;
            session(['shoppingCart' => $shoppingCart]);
            return "The new shopping Cart is created";
          }else{
            $shoppingCart = session('shoppingCart');
            $stockInShoppingCart =0;
            foreach ($shoppingCart['lines'] as $line){
              if ($line['product_id'] == $product->id){
                $stockInShoppingCart += $line['units'];
              }
            }

            if ($request->input('stock_units') + $stockInShoppingCart > $product->stock){
              return "NOSTOCK";
            }
            $newline['product_id'] = $request->input('id');
            $newline['product_name'] =  $product->name;
            $newline['units'] =  $request->input('stock_units');
            $newline['unit_price'] =  $product->price;
            $newline['total_line_price'] =  $product->price * $request->input('stock_units');

            $shoppingCart['lines'][] = $newline;
            session(['shoppingCart' => $shoppingCart]);
          }



  }
}
