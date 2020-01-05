<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategories;
use App\User;

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


    public function change(){
        return view('changepass');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'confirmed|min:6'
        ]);

        if(\Hash::check($request->old_password, \Auth::user()->password)){
            $user = User::find(\Auth::user()->id);
            $user->password = \Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Changed Password Successfully');
        }else{
            return back()->withErrors('Old password error.');
        }
    }

}
