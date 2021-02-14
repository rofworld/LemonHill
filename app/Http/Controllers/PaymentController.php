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

class PaymentController extends Controller
{

  public function paymentDetails($id){

    $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$id)->get();
    $total_price = $shoppingCartLines->sum('total_line_price');

    return view('paymentDetails')
    ->with('shoppingCartId',$id)
    ->with('total_price',$total_price);
  }

  public function pay(Request $request) {

    try{
    Stripe::setApiKey(config('services.stripe.secret'));
    $token = $request->input('token');
    $charge = Charge::create([
          'amount' => 5000,
          'currency' => 'eur',
          'description' => 'Example charge',
          'source' => $token,
        ]);

        $new_order=Order::create([
          'user_id' => Auth::user()->id,
          'send_address'=>$request->input('address'),
          'postal_code'=>$request->input('cp'),
          'country'=>$request->input('country'),
          'provincia'=>$request->input('provincia')
        ]);

        $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$request->input('shoppingCartId'))->get();

        foreach ($shoppingCartLines as $line) {
          Order_line::create([
              'order_id' => $new_order->id,
              'product_id' => $line->product_id,
              'product_name' =>  $line->product_name,
              'units' =>  $line->units,
              'unit_price' =>  $line->unit_price,
              'total_line_price' =>  $line->total_line_price
          ]);
        }

        Shopping_Cart_Line::where('shopping_cart_id', $request->input('shoppingCartId'))->delete();
        shoppingCart::destroy($request->input('shoppingCartId'));

      return 'success';
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }

}


}
