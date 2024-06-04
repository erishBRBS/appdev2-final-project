<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderList;
use App\Models\ItemProduct;


class OrderController extends Controller
{
    //--------------------------------------CREATE ORDER--------------------------------------//
    public function createOrder(Request $request)
    {
        // Ensure the user has the correct role
        if (Auth::user()->role_id !== 1) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:item_products,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Fetch the product to get its price
        $product = ItemProduct::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        // Create the order
        $order = OrderList::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'total_price' => $product->price,
        ]);
    
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
    

//--------------------------------------VIEW ORDERS--------------------------------------//
public function viewOrders()
{
    if (Auth::user()->role_id !== 1) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $orders = OrderList::where('user_id', Auth::id())->get();

    return response()->json(['orders' => $orders], 200);
}

}
