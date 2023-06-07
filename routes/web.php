<?php

use App\Http\Controllers\User\FollowerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Post\ImagenController;
use App\Http\Controllers\User\PerfilController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\ComentarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
})->name('principal');
// REGISTRO DEL USUARIO
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

//LOGIN Y LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//PERFIL DEL USUARIO
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// RUTAS DE POSTS
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// PUBLICAR IMAGENES
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Likes a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


// VARIABLES DE POSTS Y COMENTARIOS
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/{user:username}/follow', [FollowerController::class, 'index'])->name('follow.index');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('follow.unfollow');

