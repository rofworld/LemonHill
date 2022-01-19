<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\shoppingCart;
use App\Models\Shopping_Cart_Line;
use App\Models\Order;
use App\Models\Order_line;
use App\Models\Product;
use App;
use Mail;

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
  public function pay(Request $request){
    try{
    $amount = $request->input('amount');

    $address = $request->input('address');
    $provincia = $request->input('provincia');
    $city = $request->input('city');
    $description = $address." | ".$provincia." | ".$city;

    Stripe::setApiKey(config('services.stripe.secret'));

    $intent = PaymentIntent::create([
      'amount' => $amount*100,
      'currency' => 'eur',
      'payment_method_types' => ['card'],
      'description' => $description
    ]);

    return $intent;
  }catch (Exception $ex){
    return $ex->getMessage();
  }
  }
  public function confirmPay(Request $request) {
    if (session('shoppingCart')){
    $shoppingCart = session('shoppingCart');
    $user_id=null;
    if (Auth::check()){
      $user_id = Auth::user()->id;
    }
    try{

        $new_order=Order::create([
          'user_id' => $user_id,
          'send_name' => $request->input('send_name'),
          'send_address'=>$request->input('address'),
          'postal_code'=>$request->input('cp'),
          'country'=>$request->input('country'),
          'provincia'=>$request->input('provincia'),
          'city' =>$request->input('city'),
          'total_price' =>$request->input('totalPrice'),
          'state' => 4
        ]);

        $shoppingCartLines = $shoppingCart['lines'];

        foreach ($shoppingCartLines as $line) {
          Order_line::create([
              'order_id' => $new_order->id,
              'product_id' => $line['product_id'],
              'product_name' =>  $line['product_name'],
              'units' =>  $line['units'],
              'unit_price' =>  $line['unit_price'],
              'total_line_price' =>  $line['total_line_price'],
              'size' => $line['size'],
              'size_name' => $line['size_name']

          ]);


        }




        //Enviar factura por correo
        if (Auth::check()){

          $order_lines = Order_line::where('order_id',$new_order->id)->get();
          $subtotal = $order_lines->sum('total_line_price');
          $gastos_envio = env('GASTOS_ENVIO');
          $data = [
            'order_lines' => $order_lines,
            'order_id' => $new_order->id,
            'send_name' => $new_order->send_name,
            'send_address' => $new_order->send_address,
            'postal_code' => $new_order->postal_code,
            'city' => $new_order->city,
            'provincia' => $new_order->provincia,
            'country' => $new_order->country,
            'date' => $new_order->created_at->format('Y-m-d'),
            'subtotal' => $subtotal,
            'gastos_envio' => $gastos_envio
          ];

          $pdf = App::make('dompdf.wrapper');
          $pdf->loadView('pdf.factura',$data);

          $data_mail["email"] = Auth::user()->email;
          $data_mail["title"] = "Factura de su pedido ".$new_order->id;
          $data_mail["body"] = "Le enviamos la factura de su pedido ".$new_order->id."\n Un Saludo";

          $order_id = $new_order->id;
          Mail::send('emails.factura', $data_mail, function($message) use($data_mail, $pdf,$order_id) {
            $message->to($data_mail["email"])
                    ->subject($data_mail["title"])
                    ->attachData($pdf->output(), 'factura_'.$order_id.'.pdf');
          });

        }

        session()->forget('shoppingCart');
        session()->flush();

      return 'success';
    } catch (\Exception $ex) {
        //return "ERROR_DURING_ORDER_CREATION";
        return $ex->getMessage();
    }

  }else{
    return "NOSC";
  }

}


}
