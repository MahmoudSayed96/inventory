<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Providers\AppServiceProvider;
use App\Traits\ApiUploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    use ApiUploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest('id')->paginate(AppServiceProvider::PAGINATE_LIMIT);
        return SupplierResource::collection($suppliers);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:employees'],
            'phone' => ['required', 'unique:employees'],
        ]);
        $photo = null;
        if ($request->photo) {
            $photo = $this->uploadImage($request->photo, 'uploads/images/suppliers');
        }
        $supplier = Supplier::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'shop_name' => $request->shop_name,
                'photo' => $photo,
            ]
        );
        return new SupplierResource($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return new SupplierResource($supplier);
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
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('suppliers', 'email')->ignore($id)],
            'phone' => ['required', Rule::unique('suppliers', 'phone')->ignore($id)],
        ]);
        $photo = $supplier->photo;
        if ($request->new_photo) {
            $photo = $this->uploadImage($request->new_photo, 'uploads/images/suppliers');
            $this->removeImage($supplier->photo);
        }
        $supplier->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'shop_name' => $request->shop_name,
                'phone' => $request->phone,
                'photo' => $photo,
            ]
        );
        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $photo = $supplier->photo;
        $this->removeImage($photo);
        $supplier->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }

    
    public function supplierList() {
        $suppliers = Supplier::all();
        return SupplierResource::collection($suppliers);
    }
}
