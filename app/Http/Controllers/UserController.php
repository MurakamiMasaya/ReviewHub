<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Condition;
use App\Models\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $user = Auth::user();
        $companies = Company::orderBy('company_gr', 'desc')
            ->limit(5)
            ->get(); 
        $conditions = Condition::all();
        $stacks = Stack::all();
        // dd($conditions, $stacks);
        
        return view('top', compact('user', 'companies', 'conditions', 'stacks'));
    }

    public function go_refferrer(){
        return back();
    }
}
