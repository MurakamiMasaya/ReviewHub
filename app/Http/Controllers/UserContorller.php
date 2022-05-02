<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserContorller extends Controller
{
    public function index(){

        $user = Auth::user();

        // dd($user);
        return view('top', compact('user'));
    }
}
