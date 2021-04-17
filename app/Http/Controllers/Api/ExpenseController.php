<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest('id')->paginate(AppServiceProvider::PAGINATE_LIMIT);
        return ExpenseResource::collection($expenses);
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
            'amount' => ['required', 'numeric'],
            'details' => ['nullable'],
        ]);
        $expense = Expense::create(
            [
                'amount' => $request->amount,
                'details' => $request->details,
            ]
        );
        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return new ExpenseResource($expense);
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
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $validateData = $request->validate([
            'amount' => ['required', 'numeric'],
            'details' => ['nullable'],
        ]);
        $expense->update(
            [
                'amount' => $request->amount,
                'details' => $request->details,
                'expense_date' => date('Y-m-d')
            ]
        );
        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $expense->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
