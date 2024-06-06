<?php

namespace App\Http\Controllers;

use App\Models\ItemProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //--------------------------------------CREATE PRODUCT--------------------------------------//
public function createProduct(Request $request)
{
    $validator = Validator::make($request->all(), [
        'brand_id' => 'required|exists:item_brands,id',
        'product_name' => 'required|string|max:255|unique:item_products',
        'size_id' => 'required|exists:item_sizes,id',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'quantity_id' => 'required|exists:item_quantities,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $product = ItemProduct::create($request->all());

    return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
}

//--------------------------------------UPDATE PRODUCT--------------------------------------//
public function updateProduct(Request $request, $id)
{
    // Find the product by ID
    $product = ItemProduct::find($id);

    // Check if the product exists
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'brand_id' => 'sometimes|exists:item_brands,id',
        'product_name' => 'sometimes|string|max:255|unique:item_products,product_name,' . $id, // Exclude current product from unique check
        'size_id' => 'sometimes|exists:item_sizes,id',
        'price' => 'sometimes|numeric',
        'description' => 'sometimes|string',
        'quantity_id' => 'sometimes|exists:item_quantities,id',
    ]);

    // If validation fails, return the errors
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Update the product with the validated data
    $product->update($request->all());

    // Return a success response with the updated product data
    return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
}

//--------------------------------------DELETE PRODUCT--------------------------------------//
public function deleteProduct($id)
{
    $product = ItemProduct::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully'], 200);
}

}
