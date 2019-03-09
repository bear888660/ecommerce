<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {

        $product_categories = ProductCategory::orderBy('index_id', 'asc')->get();

        $products = Product::where('is_hot', '=', true)->where('stock', '>', 0)->orderBy('updated_at')->limit(4)->get();

        return view('index', compact('products', 'product_categories'));
    }
}
