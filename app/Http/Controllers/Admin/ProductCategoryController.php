<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::orderBy('index_id', 'asc')->paginate(10);
        return view('admin.product-categories.index', compact('product_categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        ProductCategory::create($validated);
        $redirect_url = route('product-categories.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function edit(ProductCategory $product_category)
    {
        return view('admin.product-categories.edit', compact('product_category'));
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $validated = $this->validateRequest($request);
        $product_category->name = $validated['name'];
        $product_category->en_name = $validated['en_name'];
        $product_category->index_id = $validated['index_id'];
        $product_category->save();

        $redirect_url = route('product-categories.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();
        return redirect()->back();
    }

    protected function validateRequest(Request $request)
    {
        return request()->validate([
            'name' => ['required'],
            'en_name' => ['required'],
            'index_id' => ['required', 'integer']
        ]);
    }
}
