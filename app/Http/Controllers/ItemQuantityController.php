<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuantityRequest;
use App\Http\Requests\UpdateQuantityRequest;
use App\Models\ItemQuantity;

class ItemQuantityController extends Controller
{
    public function productQty(CreateQuantityRequest $request)
    {
        $quantity = ItemQuantity::create($request->validated());
        return response()->json([
            'message' => "Product quantity successfully created.",
            'info' => $quantity], 201);
    }

    public function viewProductQty()
    {
        $quantity = ItemQuantity::all();
        return response()->json([
            'Product quantities' => $quantity], 200);
        
    }

    public function updateQty(UpdateQuantityRequest $request, $id)
    {
        $quantity = ItemQuantity::findOrFail($id);
        $quantity->update($request->validated());
        return response()->json([
            'message' => "Product with id: " . $id . " successfully updated.",
            'updated info' => $quantity,
        ], 200);
        
    }
}
