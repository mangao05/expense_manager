<?php

namespace App\Http\Controllers;

use App\ExpenseCategories;
use Illuminate\Http\Request;

class ExpenseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategories::paginate(10);
        return view('expense_categories.index', compact('categories'));
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
            'name' => 'required',
            'description' => 'required'
        ]);
        
        ExpenseCategories::create($request->all());

        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseCategories  $expenseCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategories $expenseCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseCategories  $expenseCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategories $expenseCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseCategories  $expenseCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        ExpenseCategories::find($id)->update($request->all());
        return back();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseCategories  $expenseCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExpenseCategories::find($id)->delete();

        return response()->json(1);
    }
}
