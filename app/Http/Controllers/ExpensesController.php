<?php

namespace App\Http\Controllers;

use App\Expenses;
use Illuminate\Http\Request;
use App\ExpenseCategories;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expenses::with('category')->latest()->paginate(10);
        $categories = ExpenseCategories::all();
        return view('expenses.index', compact('expenses', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'date|required'
        ]);
        $category = ExpenseCategories::find($request->category_id);

        $category->expenses()->create($request->all());
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'amount' => 'required',
            'entry_date' => 'date|required'
        ]);
        
        $expense = Expenses::find($request->id);
        $expense->amount = $request->amount;
        $expense->entry_date = $request->entry_date;
        $expense->category_id = $request->category_id;
        $expense->save();


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expenses::find($id)->delete();
        
        return response()->json(1);
    }
}
