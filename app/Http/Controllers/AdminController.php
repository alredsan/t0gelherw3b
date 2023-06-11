<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * *Acceso general a la administracion
     */
    public function __invoke()
    {
        $userAuth = Auth::user();

        if ($userAuth->id_ONG != null || $userAuth->Role >= 4) {

            return view('admin.index', compact('userAuth'));
        }
        abort(404);
    }
}
