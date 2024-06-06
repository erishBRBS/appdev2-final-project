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
    $orders = OrderList::where('user_id', Auth::id())->get();

    return response()->json(['orders' => $orders], 200);
}

}
