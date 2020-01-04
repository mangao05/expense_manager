<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategories;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       
        $categories = ExpenseCategories::with('expenses')->get();
        $labelArray = [];
        $amountArray = [];
        if($request->ajax()){
            foreach($categories as $category){
                array_push($labelArray, $category->name);
                array_push($amountArray, $category->expenses->sum('amount'));
            }
            
            return response()->json([
                'label' => $labelArray,
                'amount' => $amountArray
            ]);
        }
        return view('home', compact('categories'));
    }
}
