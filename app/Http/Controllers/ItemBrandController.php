<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemBrand;

class ItemBrandController extends Controller
{
    public function viewAllBrands()
    {
        $brands = ItemBrand::all();
        return response()->json($brands);
    }

    public function createBrand(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
        ]);

        $brand = ItemBrand::create($validated);
        return response()->json($brand, 201);
    }
}
