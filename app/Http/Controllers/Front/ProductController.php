<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;

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

    public function showProduct($id)
    {
        $product = Product::find($id);
        //$productCategory = ProductCategory::where('en_name', '=', $cotegories1)->first();
        return view('front.product-detail', compact('product'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
