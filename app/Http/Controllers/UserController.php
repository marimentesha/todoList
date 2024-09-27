<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function create()
    {
        return view('register');
    }

    public function store()
    {

        $attributes = request()->validate([
            'first' => 'required',
            'last' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_repeat' => 'required|same:password',
            'phone' => 'required|unique:users',
        ]);

        $user = (new User())->create($attributes);

        Auth::login($user);

        return redirect('/');

    }

    public function login(){
        return view('login');
    }

    /**
     * @throws ValidationException
     */
    public function authenticate()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
