<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

use App\Http\Requests\CartCraditCardRequest;

class CartController extends Controller
{

    public function index()
    {
        return view('front/cart/index');
    }

    public function store(Request $request)
    {
        try {
            $id = $request->input('id');
            $qty = $request->input('qty');
            $this->addToCart($id, $qty);
            return json_encode(['status' => true]);
        } catch (\Exception $e) {
            return json_encode(['status' => false, 'errorMsg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $rowId)
    {
        try {
            $qty = $request->input('qty');
            $item = Cart::get($rowId);
            $item = $this->modifyCartItemQty($item, $qty);
            return json_encode(['status' => true, 'itemPrice' => $item->qty * $item->price]);
        } catch (\Exception $e) {
            return json_encode(['status' => false, 'errorMsg' => $e->getMessage()]);
        }
    }

    protected function checkQty($qty)
    {
        if ($qty <= 0) {
            $qty = 1;
        }
        $maxAllowQty = 20;
        return ($qty <= $maxAllowQty) ? $qty : $maxAllowQty;
    }

    protected function checkStock(Product $product, $qty)
    {
        if ($qty > $product->stock) {
            throw new \Exception('商品：' . $product->name . '存貨不足!');
        }
    }

    protected function addToCart($ProductId, $qty)
    {
        //檢查產品是否已在購物車內
        //若是則加上數量後更新購物車
        //若不是則新增一筆購物車
        $product = Product::findOrFail($ProductId);

        $item = $this->getCartItemByProductId($ProductId);
        if ($item) {
            return $this->modifyCartItemQty($item, ($qty + $item->qty));
        }

        $qty = $this->checkQty($qty);
        $this->checkStock($product, $qty);
        return Cart::add($ProductId, $product->name, $qty, $product->price);
    }

    protected function modifyCartItemQty($item, $qty)
    {

        $product = Product::findOrFail($item->id);
        $qty = $this->checkQty($qty);
        $this->checkStock($product, $qty);
        return Cart::update($item->rowId, ['qty' => $qty]);
    }

    protected function getCartItemByProductId($productId)
    {
        $items = Cart::content();
        $rowId = $items->search(function($cartItem, $rowId) use ($productId){
            return $cartItem->id === (string)$productId;
        });
        return $rowId ? Cart::get($rowId) : false;
    }

    protected function shipping()
    {
        return view('front.cart.shipping');
    }

    protected function complete()
    {

    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
    }
}
