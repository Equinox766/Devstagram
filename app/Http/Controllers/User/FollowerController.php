<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class FollowerController extends Controller
{
    public function index(User $user): RedirectResponse
    {
        $user->followers()->attach(auth()->user()->id, ['id' => Str::uuid()]);

        return back();
    }
    public function destroy(User $user): RedirectResponse
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
