<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{

  public function pay(Request $request) {

    try{
    Stripe::setApiKey(config('services.stripe.secret'));
    $token = $request->stripeToken;
    $charge = Charge::create([
          'amount' => 50,
          'currency' => 'eur',
          'description' => 'Example charge',
          'source' => $token,
        ]);



      return 'Charge successful, you get the course!';
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }

}


}
