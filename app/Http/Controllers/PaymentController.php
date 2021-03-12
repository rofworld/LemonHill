<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Models\shoppingCart;
use App\Models\Shopping_Cart_Line;
use App\Models\Order;
use App\Models\Order_line;
use App\Models\Product;

class PaymentController extends Controller
{

  public function paymentDetails(Request $request){

    if (session('shoppingCart')){

      $shoppingCart = session('shoppingCart');
      $shoppingCartLines = $shoppingCart['lines'];

      $total_price = 0;
      foreach ($shoppingCartLines as $line){
        $total_price+=$line['total_line_price'];
      }

      return view('paymentDetails')
      ->with('total_price',$total_price);

  }else{
    return "Not allowed";
  }
  }

  public function pay(Request $request) {
    if (session('shoppingCart')){
    $shoppingCart = session('shoppingCart');
    $user_id=null;
    if (Auth::check()){
      $user_id = Auth::user()->id;
    }
    try{
    Stripe::setApiKey(config('services.stripe.secret'));
    $token = $request->input('token');
    $charge = Charge::create([
          'amount' => $request->input('totalPrice')*100,
          'currency' => 'eur',
          'description' => $request->input('address').' | '.$request->input('city').' | '.$request->input('country'),
          'source' => $token,
        ]);

        $new_order=Order::create([
          'user_id' => $user_id,
          'send_name' => $request->input('send_name'),
          'send_address'=>$request->input('address'),
          'postal_code'=>$request->input('cp'),
          'country'=>$request->input('country'),
          'provincia'=>$request->input('provincia'),
          'city' =>$request->input('city'),
          'total_price' =>$request->input('totalPrice'),
          'sent' => false
        ]);

        $shoppingCartLines = $shoppingCart['lines'];

        foreach ($shoppingCartLines as $line) {
          Order_line::create([
              'order_id' => $new_order->id,
              'product_id' => $line['product_id'],
              'product_name' =>  $line['product_name'],
              'units' =>  $line['units'],
              'unit_price' =>  $line['unit_price'],
              'total_line_price' =>  $line['total_line_price']

          ]);

          //Update product stock
          $product = Product::find($line['product_id']);
          if ($stock>0){
            $stock=$product->stock - intval($line['units']);
          }else{
            $stock=0;
          }
          Product::where('id',$line['product_id'])->update(['stock' => $stock]);
        }

        session()->forget('shoppingCart');
        session()->flush();


      return 'success';
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }

  }else{
    return "NOSC";
  }

}


}
