@extends('layouts.app')

<head>
  @if ((new \Jenssegers\Agent\Agent())->isDesktop())
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment.css') }}"/>
  @else
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment_mobile.css') }}"/>
  @endif
  <script src="https://js.stripe.com/v3/"></script>
</head>



@section('content')
<div class="container">
<div id="status">
</div>
  <h3 style="margin-left:15%;"><u>Payment Details</u></h3>
  <div class="payment-details">

                        <input id="total_price" type="text" value="{{$total_price + env('GASTOS_ENVIO')}}" hidden>
                        <label style="margin-left:15%;">Datos de envio</label>
                        <div id="form-send-data">
                        <div class="form-group">
                          <div>
                                <label for="name" class="form-control">{{ __('Nombre Completo') }}</label>
                          </div>
                          <div>
                                <input id="send_name" type="text" class="form-control" required>
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
                                <label for="city" class="form-control">{{ __('Ciudad') }}</label>
                              </div>
                              <div>
                                <input id="city" type="text" class="form-control" required>
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
                      </div>
                      <label style="margin-left:15%;">Datos de pago</label>
                      <div id="form-payment-data">
                        <label for="card-element">
                        Tarjeta de credito o debito
                      </label>
                      <div id="card-element" style="margin-top:10px;">
                        <!-- a Stripe Element will be inserted here. -->
                      </div>

                      <!-- Used to display form errors -->
                      <div id="card-errors" role="alert"></div>
                      </div>
                      </div>
                      <em><button id="btn-submit" class="btn-submit">
                                    Pagar ( {{$total_price + env('GASTOS_ENVIO')}} € )
                      </button></em>

  <script src="{{ asset('js/client.js') }}" type="text/javascript"></script>

  </div>
</div>
@endsection
