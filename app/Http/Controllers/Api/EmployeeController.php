<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Providers\AppServiceProvider;
use App\Traits\ApiUploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    use ApiUploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest('id')->paginate(AppServiceProvider::PAGINATE_LIMIT);
        return EmployeeResource::collection($employees);
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
            $photo = $this->uploadImage($request->photo, 'uploads/images/employees');
        }
        $employee = Employee::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'nid' => $request->nid,
                'salary' => $request->salary,
                'phone' => $request->phone,
                'joining_date' => $request->joining_date,
                'photo' => $photo,
            ]
        );
        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return new EmployeeResource($employee);
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
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($id)],
            'phone' => ['required', Rule::unique('employees', 'phone')->ignore($id)],
        ]);
        $photo = $employee->photo;
        if ($request->new_photo) {
            $photo = $this->uploadImage($request->new_photo, 'uploads/images/employees');
            $this->removeImage($employee->photo);
        }
        $employee->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'nid' => $request->nid,
                'salary' => $request->salary,
                'phone' => $request->phone,
                'joining_date' => $request->joining_date,
                'photo' => $photo,
            ]
        );
        return $employee;
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $photo = $employee->photo;
        $this->removeImage($photo);
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
