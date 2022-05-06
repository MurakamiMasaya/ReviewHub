<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required'],
            'gender' => ['required', 'numeric'],
            'username' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email:strict,spoof', 'max:255', 'unique:users'],
            'phone' => ['required','numeric','digits_between:10,11'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'privacy_policy' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'admin_flg' => 0
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
