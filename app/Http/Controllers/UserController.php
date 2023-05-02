<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules);

        $user = User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'El usuario ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::find(Auth::user()->id);

        return view('cuenta.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // $user = User::find($id);
        $user = User::find(Auth::user()->id);

        return view('cuenta.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'El usuario ha sido actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('/')
            ->with('success', 'El usuario ha sido eliminado correctamente');
    }


    public function showEventos(){

        $user = User::find(Auth::user()->id);

        return view('cuenta.showEventsCuenta',compact('user'));
    }

    public function updateUserV(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $data = User::find(Auth::user()->id);

        $data->DNI = $request->DNI;
        $data->name = $request->name;
        $data->Apellidos = $request->Apellidos;
        $data->email = $request->email;
        $data->Direccion = $request->Direccion;
        $data->ProvinciaLocalidad = $request->ProvinciaLocalidad;
        $data->Telefono = $request->Telefono;

        if ($request->hasFile('Foto')) {
            $data->Foto = $request->file('Foto')->store('foto_perfil');
            $data->Foto = 'storage/' . $data->Foto;
        }

        $data->save();

        return redirect()->route('cuenta.perfil')
            ->with('success', 'Usuario'. $request->name .'ha sido actualizado correctamente');
    }


    public function register(Request $request)
    {
        // Validacion de los datos

        // una vez validados los datos, creamos el objeto user
        $user = new User();

        $user->name = $request->Nombre;
        $user->Apellidos = $request->Apellidos;
        $user->email = $request->email;
        $user->DNI = $request->DNI;
        $user->Direccion = $request->Direccion;
        $user->ProvinciaLocalidad = $request->Provincia;
        $user->Telefono = $request->Telefono;
        $user->password = Hash::make($request->passwd);

        $user->save();

        // Add el usuario registrado al sistema, iniciado automaticamente
        Auth::login($user);

        return redirect(route('/'));
    }

    public function login(Request $request)
    {
        // Validacion de los datos

        // asignacion a la session
        $usuario = [
            "email" => $request->email,
            "password" => $request->passwd
        ];

        $recordarCuenta = ($request->has('recordar'));

        if (Auth::attempt($usuario, $recordarCuenta)) {

            $request->session()->regenerate();
            // intended , cuando intenta acceder, pero se queda capturado cuando inicie sesion, lleva a la url deseada

            return redirect()->intended(route('/'));
        } else {
            // en caso de fallo, decir al usuario fallido acceso
            return redirect('inicioSesion')->with('message', 'Usuario o contraseña incorrectos');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('/'));
    }

    public function acceso(){

        if(Auth::user()->id_ONG != null){
            return redirect(route('selectingCuenta'));
        }

        return redirect('cuenta');
    }

    public function selectingCuenta(){
        if(Auth::user() == null){
            return redirect('login');
        }
        return view('SelectingTipoCuenta');
    }

    public function general(){
        return view('cuenta.welcomeCuenta');
    }

    public function mostrarInicioSesion()
    {
        if(Auth::user() != null){
            return redirect('/');
        }
        return view('inicioSesion');
    }

    public function mostrarRegistro()
    {
        if(Auth::user() != null){
            return redirect('/');
        }
        return view('registro');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


}
