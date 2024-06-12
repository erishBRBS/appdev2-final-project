<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSizeRequest;
use App\Models\ItemSize;

class ItemSizeController extends Controller
{
    public function viewAllSize()
    {
        $sizes = ItemSize::all();
        return response()->json([
            'Product sizes ' => $sizes, 200]);
    }

    public function createSize(CreateSizeRequest $request)
    {
        $size = ItemSize::create($request->validated());
        return response()->json([
        'message' => "Product size successfully created.",
        'info' => $size, 201]);
    }
}
