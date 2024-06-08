<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemSize;

class ItemSizeController extends Controller
{
    public function viewAllSize()
    {
        $sizes = ItemSize::all();
        return response()->json($sizes);
    }

    public function createSize(Request $request)
    {
        $validated = $request->validate([
            'size' => 'required|string|max:255',
        ]);

        $size = ItemSize::create($validated);
        return response()->json($size, 201);
    }
}