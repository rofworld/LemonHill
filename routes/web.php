<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/artist_info_admin', [App\Http\Controllers\ArtistInfoAdminController::class, 'createForm']);
Route::post('/artist_info_admin', [App\Http\Controllers\ArtistInfoAdminController::class, 'ArtistInfoForm'])->name('artist.store');

Route::get('/product/hide/{id}', [App\Http\Controllers\ProductAdminController::class, 'hide']);
Route::get('/product_creation_form', [App\Http\Controllers\ProductAdminController::class, 'createForm']);
Route::get('/product_edit_form/{id}', [App\Http\Controllers\ProductAdminController::class, 'editForm']);
Route::get('/product/delete/{id}', [App\Http\Controllers\ProductAdminController::class, 'delete']);
Route::post('/product/changeStock', [App\Http\Controllers\ProductAdminController::class, 'changeStock'])->name('product.changeStock');
Route::post('/product_store', [App\Http\Controllers\ProductAdminController::class, 'createProduct'])->name('product.store');
Route::post('/product_update', [App\Http\Controllers\ProductAdminController::class, 'editProduct'])->name('product.update');
Route::get('/product_list_admin', [App\Http\Controllers\ProductAdminController::class, 'listProducts']);



Route::get('/artist_info', [App\Http\Controllers\ArtistInfoController::class, 'ListArtists']);
Route::get('/artist_info/view/{id}', [App\Http\Controllers\ArtistInfoController::class, 'viewArtist']);

Route::get('/artist_info/delete/{id}', [App\Http\Controllers\ArtistInfoAdminController::class,'delete']);



Route::get('/links/list/{id}', [App\Http\Controllers\LinksController::class,'ListLinks']);
Route::get('/links/newlink', [App\Http\Controllers\LinksController::class,'newLink'])->name('link.store');
Route::get('/links/delete/{id}',[App\Http\Controllers\LinksController::class,'delete']);


Route::get('/onlineShop',[App\Http\Controllers\shoppingCartController::class,'viewShop']);
Route::get('/product_view/{id}',[App\Http\Controllers\shoppingCartController::class,'viewProduct']);
Route::post('/product_view/addToCart',[App\Http\Controllers\shoppingCartController::class,'addToCart']);
Route::get('/shoppingCart',[App\Http\Controllers\shoppingCartController::class,'viewCart']);
Route::get('/delete_shopping_cart',[App\Http\Controllers\shoppingCartController::class,'deleteShoppingCart'] );

Route::get('/checkout',[App\Http\Controllers\PaymentController::class,'paymentDetails'] );
Route::post('/checkout/pay',[App\Http\Controllers\PaymentController::class,'pay'] );
Route::post('/checkout/confirmPay',[App\Http\Controllers\PaymentController::class,'confirmPay'] );




Route::get('/list_orders',[App\Http\Controllers\OrderController::class,'list'] );
Route::post('/list_orders/markAsComplete',[App\Http\Controllers\OrderController::class,'markAsComplete'] );
Route::post('/list_orders/markAsRefused',[App\Http\Controllers\OrderController::class,'markAsRefused'] );
Route::get('/orders/view/{id}',[App\Http\Controllers\OrderController::class,'viewOrder'] );
Route::get('/orders/printToPdf/{id}',[App\Http\Controllers\OrderController::class,'printToPdf'])->name('orders.printToPdf');
Route::get('/orders/printFactura/{id}',[App\Http\Controllers\OrderController::class,'printFactura'])->name('factura.printToPdf');


Route::get('auth/facebook', [App\Http\Controllers\SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [App\Http\Controllers\SocialController::class, 'loginWithFacebook']);

Route::get('/create_event', [App\Http\Controllers\EventsController::class, 'createForm']);
Route::post('/create_event', [App\Http\Controllers\EventsController::class, 'storeEvent'])->name('event.store');
Route::get('/events_info', [App\Http\Controllers\EventsController::class, 'ListEvents']);
Route::get('/events_info/delete/{id}', [App\Http\Controllers\EventsController::class, 'deleteEvent']);
Route::get('/events_info/view/{id}', [App\Http\Controllers\EventsController::class, 'viewEvent']);
Route::post('/events_info/search', [App\Http\Controllers\EventsController::class, 'searchEvent'])->name('event.search');;

Route::get('/eventArtists/list/{id}',[App\Http\Controllers\eventArtistsController::class, 'listEventArtists'] );
Route::get('/eventArtists/delete/{id}',[App\Http\Controllers\eventArtistsController::class,'delete']);
Route::get('/eventArtists/store', [App\Http\Controllers\eventArtistsController::class,'newArtist'])->name('eventArtist.store');
