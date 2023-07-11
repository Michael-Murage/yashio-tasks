<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUserRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth/register');
    }

    public function register(ValidateUserRegistration $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect('/dashboard');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }
}
