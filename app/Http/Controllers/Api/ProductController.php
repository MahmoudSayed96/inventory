<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Providers\AppServiceProvider;
use App\Traits\ApiUploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use ApiUploadImageTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('suppliers', 'products.supplier_id', 'suppliers.id')
            ->select('categories.name as category', 'suppliers.name as supplier', 'products.*')
            ->orderByDesc('products.id')
            ->paginate(AppServiceProvider::PAGINATE_LIMIT);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'unique:products'],
            'buying_price' => ['required', 'numeric'],
            'selling_price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'buying_date' => ['nullable'],
            'image' => ['nullable'],
            'stock' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);
        $image = null;
        if ($request->image) {
            $image = $this->uploadImage($request->image, 'uploads/images/products');
        }
        $supplier = Product::create(
            [
                'name' => $request->name,
                'code' => $request->code,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'image' => $image,
                'stock' => $request->stock,
                'quantity' => $request->quantity,
            ]
        );
        return new ProductResource($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $validateData = $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', Rule::unique('products', 'code')->ignore($id)],
            'buying_price' => ['required', 'numeric'],
            'selling_price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'buying_date' => ['nullable'],
            'new_image' => ['nullable'],
            'stock' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ]);
        $image = $product->image;
        if ($request->new_image) {
            $image = $this->uploadImage($request->new_image, 'uploads/images/products');
            $this->removeImage($product->image);
        }
        $product->update(
            [
                'name' => $request->name,
                'code' => $request->code,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'buying_date' => $request->buying_date,
                'image' => $image,
                'stock' => $request->stock,
                'quantity' => $request->quantity,
            ]
        );
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $photo = $product->photo;
        $this->removeImage($photo);
        $product->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
