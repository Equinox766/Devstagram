<?php

namespace App\Http\Controllers\Post;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid(). "." . $imagen->extension();
        $imagenServidor =  Image::make($imagen);
        $imagenServidor->fit(1000,1000);
        $imagenPath = public_path('uploads'). '/' .$nombreImagen;
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
