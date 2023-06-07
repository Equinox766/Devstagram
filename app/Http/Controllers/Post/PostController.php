<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    public function index(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $post = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $post
        ]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('posts.create');
    }

    public function store(Request $request, User $user): RedirectResponse
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

    public function show(User $user, Post $post): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);
        $post->delete();
        //eliminanddo la imagen
        $imagen_path = public_path('uploads/'. $post->imagen);
        if(File::exists($imagen_path)){
          unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
