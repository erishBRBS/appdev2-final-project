<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemQuantity;

class ItemQuantityController extends Controller
{
    public function productQty(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $quantity = ItemQuantity::create($validated);
        return response()->json($quantity, 201);
    }

    public function viewProductQty()
    {
        $quantity = ItemQuantity::all();
        return response()->json($quantity);
    }

    public function updateQty(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $quantity = ItemQuantity::findOrFail($id);
        $quantity->update($validated);
        return response()->json($quantity);
    }
}
