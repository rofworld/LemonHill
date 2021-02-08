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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/artist_info_admin', [App\Http\Controllers\ArtistInfoAdminController::class, 'createForm']);
Route::post('/artist_info_admin', [App\Http\Controllers\ArtistInfoAdminController::class, 'ArtistInfoForm'])->name('artist.store');


Route::get('/product_creation_form', [App\Http\Controllers\ProductAdminController::class, 'createForm']);
Route::get('/product_edit_form/{id}', [App\Http\Controllers\ProductAdminController::class, 'editForm']);
Route::get('/product/delete/{id}', [App\Http\Controllers\ProductAdminController::class, 'delete']);
Route::post('/product/changeStock', [App\Http\Controllers\ProductAdminController::class, 'changeStock'])->name('product.changeStock');
Route::post('/product_store', [App\Http\Controllers\ProductAdminController::class, 'createProduct'])->name('product.store');
Route::post('/product_update', [App\Http\Controllers\ProductAdminController::class, 'editProduct'])->name('product.update');
Route::get('/product_list_admin', [App\Http\Controllers\ProductAdminController::class, 'listProducts']);



Route::get('/artist_info', [App\Http\Controllers\ArtistInfoController::class, 'ListArtists']);

Route::get('/artist_info/delete/{id}', [App\Http\Controllers\ArtistInfoAdminController::class,'delete']);


Route::get('/links/list/{id}', [App\Http\Controllers\LinksController::class,'ListLinks']);
Route::get('/links/newlink', [App\Http\Controllers\LinksController::class,'newLink'])->name('link.store');

Route::get('/product',[App\Http\Controllers\ProductController::class,'show']);
Route::post('/charge',[App\Http\Controllers\PaymentController::class,'pay']);