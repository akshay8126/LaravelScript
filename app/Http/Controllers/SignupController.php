<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


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
        $slug = Str::slug($user->name);

        return redirect()->route('profile.slug', $slug)->with('success', 'Your Account Register Successfully.');
    }

    public function profile($slug)
    {
        if (str_replace('-', ' ', $slug) == strtolower(Auth::user()->name)) {
            return view('welcome');
        } else {
            $slug = Str::slug(Auth::user()->name);
            return redirect()->route('profile.slug', $slug);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Successfully.');
    }
}
