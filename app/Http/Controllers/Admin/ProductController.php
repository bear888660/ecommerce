<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('index_id', 'asc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $product_categories = ProductCategory::orderBy('index_id', 'asc')->get();

        return view('admin.products.create', compact('product_categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request);
        }

        if ($request->input('is_hot')) {
            $validated['is_hot'] = true;
        }

        Product::create($validated);
        $redirect_url = route('products.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function edit(Product $product)
    {
        $product_categories = ProductCategory::orderBy('index_id', 'asc')->get();
        return view('admin.products.edit', compact('product', 'product_categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateRequest($request);

        $product->name = $validated['name'];
        $product->en_name = $validated['en_name'];

        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];
        $product->index_id = $validated['index_id'];

        if ($request->input('is_hot')) {
            $product->is_hot = true;
        }

        if ($request->hasFile('image')) {
            //刪除舊檔案
            $this->deleteImage($product);
            $product->image = $this->uploadImage($request);
        }

        $product->save();

        $redirect_url = route('products.index') . '?' . $request->input('redirect_val');
        return redirect($redirect_url);
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product);
        $product->delete();
        return redirect()->back();
    }

    protected function deleteImage(Product $product)
    {
        if ($product->image && file_exists(public_path('images/products') . '/' . $product->image)) {
            unlink(public_path('images/products') . '/' . $product->image);
        }
        return true;
    }

    protected function uploadImage(Request $request)
    {
        $this->validateImage();

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();

        $image = $request->file('image');
        $image->move(public_path('images/products'), $imageName);

       return $imageName;
    }
    protected function validateImage() {
        return request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }


    protected function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'max:255'],
            'en_name' => ['required', 'max:255'],
            'price' => ['required', 'integer'],
            'description' => ['max:255'],
            'category_id' => ['required', 'integer'],
            'index_id' => ['required', 'integer'],
            'stock' => ['required', 'integer'],

        ]);
    }
}
