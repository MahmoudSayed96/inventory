<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getProducts() {
        $products = DB::table('pos')->get();
        return response()->json($products);
    }

    public function addToCart($id) {
        $product = DB::table('products')->where('id', $id)->first();
        $check = DB::table('pos')->where('product_id', $id)->first();
        if ($check) {
            // Increase quantity.
            DB::table('pos')->where('product_id', $id)->increment('product_quantity');
            $product = DB::table('pos')->where('product_id', $id)->first();
            $subtotal = $product->product_quantity * $product->product_price;
            DB::table('pos')->where('product_id', $id)->update(['subtotal' => $subtotal]);
        } else {
            // Add new to cart.
            $data = [];
            $data['product_id'] = $id;
            $data['product_name'] = $product->name;
            $data['product_quantity'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['subtotal'] = $product->selling_price;
            DB::table('pos')->insert($data);
        }
    }

    public function removeFromCart($id) {
        DB::table('pos')->where('id', $id)->delete();
        return response('done');
    }

    public function cartIncrement(Request $request, $id)
    {
        $quantity = DB::table('pos')->where('id', $id)->increment('product_quantity');
        $product = DB::table('pos')->where('id', $id)->first();
        $subtotal = $product->product_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('done');

    }

    public function cartDecrement(Request $request, $id)
    {
        $quantity = DB::table('pos')->where('id', $id)->decrement('product_quantity');
        $product = DB::table('pos')->where('id', $id)->first();
        $subtotal = $product->product_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('done');

    }
    public function vats(){
        $vat = DB::table('extra')->first();
        return response()->json($vat);
    }
}
