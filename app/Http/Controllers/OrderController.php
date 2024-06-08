<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderList;
use App\Models\ItemProduct;
use App\Models\ItemQuantity;

class OrderController extends Controller
{
    //--------------------------------------CREATE ORDER--------------------------------------//
    public function createOrder(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:item_products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Fetch the product to get its price and quantity
        $product = ItemProduct::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Fetch the quantity
        $quantity = ItemQuantity::find($product->quantity_id);
        if (!$quantity) {
            return response()->json(['message' => 'Quantity not found'], 404);
        }

        // Check if the product has enough quantity
        if ($quantity->quantity < 1) {
            return response()->json(['message' => 'Product out of stock'], 400);
        }

        // Begin a transaction
        \DB::beginTransaction();

        try {
            // Create the order
            $order = OrderList::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'product_name' => $product->product_name,
                'total_price' => $product->price,
            ]);

            // Decrement the product quantity
            $quantity->quantity -= 1;
            $quantity->save();

            // Commit the transaction
            \DB::commit();

            // Return the order with product_name only
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
            // Rollback the transaction if something goes wrong
            \DB::rollBack();

            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    //--------------------------------------VIEW ORDERS--------------------------------------//
    public function viewOrders()
    {
        $orders = OrderList::where('user_id', Auth::id())->with('product')->get()->map(function($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'product_id' => $order->product_id,
                'product_name' => $order->product->product_name,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });

        return response()->json(['orders' => $orders], 200);
    }
}
