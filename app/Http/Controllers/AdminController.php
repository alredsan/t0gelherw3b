<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function __invoke()
    {
        $userAuth = Auth::user();

        if ($userAuth->id_ONG != null || $userAuth->Role >= 4) {

            return view('admin.index', compact('userAuth'));
        }
        abort(404);
    }

    // public function show()
    // {
    //     $user = User::find(Auth::user()->id);

    //     return view('admin.user.show', compact('user'));
    // }

    // public function edit()
    // {
    //     $user = User::find(Auth::user()->id);

    //     return view('admin.user.edit', compact('user'));
    // }
}
