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

        $productCategory = ProductCategory::findByEnName($cotegories1);

        $products = $productCategory->products()
                        ->orderBy('index_id', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('products.product-list', compact('products', 'productCategory'));
    }

    public function show($id)
    {   
        $product = Product::findOrfail($id);
        
        return view('products.show', compact('product'));
    }
}
