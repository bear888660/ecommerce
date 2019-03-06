<?php
namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\CartCraditCardRequest;
class OrderController extends Controller
{
    public function create($method)
    {
        if ($method === 'CreditCard') {
            return view('front.cart.shipping-method.cradit-card');
        }
        throw new \Exception('無效的付款方式');
    }

    public function store(CartCraditCardRequest $request, $method)
    {
        if ($method === 'CreditCard') {
            try {
              \DB::transaction(function() use($request, $method)  {
                    $order = new Order();

                    $order->user_id = auth()->user()->id;
                    $order->recipient = $request->input('recipient');
                    $order->recipient_mobile = $request->input('recipient_mobile');
                    $order->recipient_county = $request->input('recipient_county');
                    $order->recipient_district = $request->input('recipient_district');
                    $order->recipient_zipcode = $request->input('recipient_zipcode');
                    $order->recipient_address = $request->input('recipient_address');
                    $order->shipping_method = $method;
                    $order->status = '1';
                    $order->shipping_fee = config('ecommerce.shipping_fee.cradit_card');
                    $order->save();

                    foreach (Cart::content() as $item) {
                        $detail = new OrderDetail();
                        $detail->price = $item->price;
                        $detail->qty = $item->qty;
                        $detail->product_id = $item->id;
                        $order->orderDetails()->save($detail);

                        //扣除存貨
                        $product = Product::find($item->id);

                        if ($product->stock < $item->qty) {
                            throw new \Exception('商品:' . $item->name . '存貨物量不足');
                        }
                        $product->stock = $product->stock - $item->qty;
                        $product->save();
                    }
                });
                Cart::destroy();
            } catch(\Exception $e) {
                return json_encode(['status' => 'true', 'errorMsg' => $e->getMessage()]);
            }

            return json_encode(['status' => 'true', 'errorMsg' => '']);
        }
        $error = ['status' => false, 'errorMsg' => '發生不可預期的錯誤，請重新再試！'];
        return json_encode($error);
    }

    public function cashFlow($method)
    {
        if ($method === 'CreditCard') {
            return view('front.cart.cashflow.credit-card');
        }
    }
}
