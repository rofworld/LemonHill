<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function show(Request $request) {
    return view('product_example');
  }
}
