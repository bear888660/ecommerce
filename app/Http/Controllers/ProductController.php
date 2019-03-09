<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
class ProductController extends Controller
{
    public function showProductList($cotegories1)
    {
        $productCategory = ProductCategory::where('en_name', '=', $cotegories1)->first();
        $products = $productCategory->products()
                        ->orderBy('index_id', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('products.product-list', compact('products', 'productCategory'));
    }

    public function show(Product $product)
    {   
        //dd(app(Product::class));
    
        $product = Product::findOrfail($id);
        
        return view('products.show', compact('product', 'currentNum'));
    }
}
