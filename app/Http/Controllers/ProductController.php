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
        return view('front.product-list', compact('products', 'productCategory'));
    }

    public function show($id)
    {
        $product = Product::findOrfail($id);

        $currentNum = 0;

        $items = Cart::content();
        $rowId = $items->search(function($items, $rowId) use ($id){
            return $items-> id === $id;
        });
        if ($rowId) {
            $currentNum = Cart::get($rowId)->qty;
        }

        return view('front.product-detail', compact('product', 'currentNum'));
    }
}
