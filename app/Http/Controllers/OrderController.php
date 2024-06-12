<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderList;
use App\Models\ItemProduct;
use App\Models\ItemQuantity;

class OrderController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        $product = ItemProduct::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $quantity = ItemQuantity::find($product->quantity_id);
        if ($quantity->quantity < 1) {
            return response()->json(['message' => 'Product out of stock'], 400);
        }

        \DB::beginTransaction();

        try {
            $order = OrderList::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'product_name' => $product->product_name,
                'total_price' => $product->price,
            ]);

            $quantity->quantity -= 1;
            $quantity->save();

            \DB::commit();

            return response()->json([
                'message' => 'Order created successfully',
                'order' => [
                    'id' => $order->id,
                    'user_id' => $order->user_id,
                    'product_id' => $order->product_id,
                    'product_name' => $product->product_name,
                    'total_price' => $order->total_price,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function viewOrders()
    {
        $orders = OrderList::where('user_id', Auth::id())->with('product')->get()->map(function($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'product_id' => $order->product_id,
                'product_name' => $order->product->product_name,
                'total_price' => $order->total_price,
            ];
        });

        return response()->json(['orders' => $orders], 200);
    }
}