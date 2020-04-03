<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return IlluminateHttpResponse
     */
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  IlluminateHttpRequest  $request
     * @return IlluminateHttpResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required' //optional if you want this to be required
        ]);
        $expense = Expense::create($request->all());
        return response()->json(['message'=> 'expense created', 
        'expense' => $expense]);
    }

    /**
     * Display the specified resource.
     *
     * @param  AppExpense  $expense
     * @return IlluminateHttpResponse
     */
    public function show(Expense $expense)
    {
        return $expense;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AppExpense  $expense
     * @return IlluminateHttpResponse
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  IlluminateHttpRequest  $request
     * @param  AppExpense  $expense
     * @return IlluminateHttpResponse
     */
    public function update(Request $request, Expense $expense)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required' //optional if you want this to be required
        ]);
        $expense->name = $request->input('name');
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        $expense->save();
        
        return response()->json([
            'message' => 'expense updated!',
            'expense' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AppExpense  $expense
     * @return IlluminateHttpResponse
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'message' => 'expense deleted'
        ]);
        
    }
}