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

    public function updateUser(Request $request, User $user)
    {
        request()->validate(User::$rules);

        // $user->update($request->all());
        // print("hola");
        $data = User::find(Auth::user()->id);

        $data->DNI = $request->DNI;
        $data->name = $request->name;
        $data->Apellidos = $request->Apellidos;
        $data->email = $request->email;
        $data->Direccion = $request->Direccion;
        $data->ProvinciaLocalidad = $request->ProvinciaLocalidad;
        $data->Telefono = $request->Telefono;

        // falta la fotografia
        $path = $request->file('Foto')->getRealPath();
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);
        $data->Foto = $base64;
        // $data->Foto = $request->Foto;

        $data->save();

        return redirect()->route('perfil')
            ->with('success', 'Usuario'. $request->name .'ha sido actualizado correctamente');
    }
}
