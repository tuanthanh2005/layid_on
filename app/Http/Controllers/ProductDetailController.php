<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductDetailController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', true)->firstOrFail();
        $related = Product::where('status', true)->where('id', '!=', $product->id)->take(3)->get();
        return view('store.product-detail', compact('product', 'related'));
    }
}
