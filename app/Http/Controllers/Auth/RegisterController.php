<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class RegisterController extends Controller
{
    function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request = $request->merge(['username' => Str::slug($request->username)]);

        $this->validate($request, [
           'name'       => 'required|max:30',
           'username'   => 'required|max:20|unique:users|min:3',
           'email'      => 'required|max:45|unique:users|email',
           'password'   => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('login');

    }
}
