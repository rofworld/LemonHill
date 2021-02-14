@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment.css') }}"/>
  <script src="https://js.stripe.com/v2/"></script>
</head>



@section('content')
<div class="container">

  <h3 style="margin-left:15%;"><u>Payment Details</u></h3>
  <div class="payment-details">
                        <input id="shoppingCartId" type="text" value="{{$shoppingCartId}}" hidden>
                        <div class="form-group">
                          <div>
                                <label for="name" class="form-control">{{ __('Nombre del titular de la tarjeta') }}</label>
                          </div>
                          <div>
                                <input id="cardholder_name" type="text" class="form-control" required>
                          </div>

                        </div>

                        <div class="form-group">
                            <div>
                                <label for="address" class="form-control">{{ __('Direccion de Envio') }}</label>
                            </div>
                            <div>
                                <input id="send_address" type="text" class="form-control" required>
                            </div>

                        </div>

                        <div class="form-group">
                              <div>
                                <label for="cp" class="form-control">{{ __('Codigo Postal') }}</label>
                              </div>

                              <div>
                                <input id="cp" type="text" class="form-control" required>
                              </div>

                        </div>


                        <div class="form-group">
                              <div>
                                <label for="provincia" class="form-control">{{ __('Provincia') }}</label>
                              </div>
                              <div>
                                <input id="provincia" type="text" class="form-control" required>
                              </div>

                        </div>

                        <div class="form-group">

                            <div>
                                <label for="country" class="form-control">{{ __('Pais') }}</label>
                            </div>

                            <div>
                                <input id="country" type="text" class="form-control" required>
                            </div>

                        </div>

                        <div class="form-group">
                          <div>
                          <label for="ccn" class="form-control">Credit Card Number:</label>
                          </div>
                          <div>
                          <input id="ccn" class="form-control-ccn" type="text" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="expiry_month" class="form-control">{{ __('Expiry Month') }}</label>
                          </div>
                          <div>
                          <input id="expiry_month" class="form-control-expiry-month" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="expiry_year" class="form-control">{{ __('Expiry Year') }}</label>
                          </div>
                          <div>
                          <input id="expiry_year" class="form-control-expiry-year" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="cvc" class="form-control">{{ __('CVC') }}</label>
                          </div>
                          <div>
                          <input id="cvc" class="form-control-cvc" type="text" required>
                          </div>
                        </div>

                      <em><button id="btn-submit" class="btn-submit">
                                    Pay ( {{$total_price}} € )
                      </button></em>

  <script src="{{ asset('js/client.js') }}" type="text/javascript"></script>

  </div>
</div>
@endsection
