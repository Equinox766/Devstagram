<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
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
