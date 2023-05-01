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
        return view('admin.index');
    }

    public function show(){
        $user = User::find(Auth::user()->id);

        return view('admin.user.show',compact('user'));
    }

    public function edit(){
        $user = User::find(Auth::user()->id);

        return view('admin.user.edit',compact('user'));
    }


}
