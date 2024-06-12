<?php

namespace App\Http\Controllers;

use App\Models\ItemProduct;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $product = ItemProduct::create($request->all());
        return new ProductResource($product);
    }

    public function readProducts()
    {
        return ProductResource::collection(ItemProduct::all());
    }

    public function updateProduct(UpdateProductRequest $request, $id)
    {
        $product = ItemProduct::findOrFail($id);
        $product->update($request->all());

        return new ProductResource($product);
    }

    public function deleteProduct($id)
    {
        $product = ItemProduct::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
