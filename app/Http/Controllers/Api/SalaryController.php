<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index() {
        $salaries = DB::table('salaries')
            ->select('month')
            ->groupBy('month')
            ->get();
        return response()->json($salaries);
    }

    public function paid(Request $request, $id)
    {
        $validateData = $request->validate([
            'month' => ['required', 'string'],
            'amount' => ['required', 'numeric']
        ]);
        
        $check = DB::table('salaries')
            ->where('employee_id', $id)
            ->where('month', $request->month)
            ->where('year', date('Y'))
            ->first();
        if ($check) {
            return response()->json(['error' => 'Salary Already Paid'], 422);
        }
        $salary = Salary::create(
            [
                'employee_id' => $id,
                'amount' => $request->amount,
                'month' => $request->month,
                'year' => date('Y'),
                'date' => date('Y-m-d')
            ]
        );
        return new SalaryResource($salary);
    }

    public function employeesSalaries() {
        $salaries = DB::table('salaries')
        ->join('employees', 'salaries.employee_id', 'employees.id')
        ->select('salaries.*', 'employees.name as name')
        ->orderBy('employees.id')
        ->paginate(AppServiceProvider::PAGINATE_LIMIT);
        return SalaryResource::collection($salaries);
    }

    public function viewSalary($month)
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.month', $month)
            ->get();
        return response()->json($salary);
    }

    public function show($id)
    {
        $salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();
        if (!$salary) {
            return response()->json(['error' => 'Not found']);
        }
        return response()->json($salary);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'month' => ['required', 'string'],
            'amount' => ['required', 'numeric']
        ]);
        
        DB::table('salaries')->where('id', $id)->update(
            [
                'employee_id' => $id,
                'amount' => $request->amount,
                'month' => $request->month,
                'year' => date('Y'),
                'date' => date('Y-m-d')
            ]
        );
    }
}
