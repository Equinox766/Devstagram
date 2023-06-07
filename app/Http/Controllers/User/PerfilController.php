<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }

    public function store(Request $request)
    {
        $request = $request->merge(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','max:20','unique:users,username,'.auth()->user()->id,'min:3', 'not_in:editar-perfil,crear-cuenta,login,posts,posts/create'],
        ]);
        if ($request->imagen)
        {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid(). "." . $imagen->extension();
            $imagenServidor =  Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            $imagenPath = public_path('users'). '/' .$nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);


    }
}
