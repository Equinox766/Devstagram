<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        $post = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request,[
           'titulo'      =>  'required|max:255',
           'descripcion' => 'required',
           'imagen'      => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
