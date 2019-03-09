<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

use App\Http\Requests\CartCraditCardRequest;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function add(Request $request)
    {
        $qty = $request->input('qty');
        $productId = $request->input('productId');
        $product = Product::findOrfail($productId);

        if ($product->stock < $qty) {
            return json_encode(['errMsg' => "存貨不足", 'status' => false, 'itemPrice' => $qty * $product->price]);
        }
        if ($qty > 20) {
            return json_encode(['errMsg' => "最大購買數量不可大於20", 'status' => false, 'itemPrice' => $qty * $product->price]);
        }

        $item = $this->getCartItemByProductId($product->id);
        

        if ($item) {
            $item = Cart::update($item->rowId, ['qty' => $qty]);
        } else {
            $item = Cart::add($product->id, $product->name, $qty, $product->price);
        }

        return json_encode(['errMessage' => '', 'status' => true, 'itemPrice' => $item->qty * $product->price]);
    }


    public function setShipping()
    {
        if (Cart::count() <= 0) {
            return redirect()->route('cart');
        }
        return view('cart.shipping');
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
    }

    protected function getCartItemByProductId($productId)
    {
        $items = Cart::content();
        $rowId = $items->search(function($cartItem, $rowId) use ($productId){
            return $cartItem->id === $productId;
        });
        return $rowId ? Cart::get($rowId) : false;
    }
}
