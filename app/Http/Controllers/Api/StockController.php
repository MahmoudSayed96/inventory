<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function update(Request $request, $id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Not found Product']);
        }

        $product->update(['quantity' => $request->quantity]);
        return new ProductResource($product);
    }
}
