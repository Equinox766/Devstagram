<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post): RedirectResponse
    {
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]);

        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
