<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class SignupController extends Controller
{

    public function register(SignupRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Account Created Successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function LoginPost(LoginRequest $request)
    {
        $credentilas = $request->only(['email', 'password']);
        if (Auth::attempt($credentilas)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Account Login Successfully.');
        } else {
            return back()->withInput()->withErrors(['password' => 'Wrong password']);
        }
    }

    public function dashboard()
    {
        return view('welcome');
    }
}
