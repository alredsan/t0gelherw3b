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
     * Mostrar los usuarios del sistema
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
     * Mostrar el formulario de nuevo usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Guardar en el sistema el nuevo usuario
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
     * Mostrar informacion de un usuario
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::find(Auth::user()->id);

        return view('cuenta.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar el usuario
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
     * Actualizar el usuario en el sistema
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
     * Eliminar el usuario del sistema
     *
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

    /**
     * Mostrar los eventos del usuario
     */
    public function showEventos()
    {

        $user = User::find(Auth::user()->id);

        // $prueba = $user->eventos::where("Visible","=","1");

        // dd($prueba);

        return view('cuenta.showEventsCuenta', compact('user'));
    }

    /**
     * Actualizar el usuario
     */
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
            if($data->Foto != config('constants.DEFAULT_PHOTO_USER')){
                unlink($data->Foto); //Eliminamos del sistema la fotografia antigua
            }

            $data->Foto = $request->file('Foto')->store('foto_perfil');
            $data->Foto = 'storage/' . $data->Foto;
        }

        $data->save();

        return redirect()->route('cuenta.perfil')
            ->with('success', 'Usuario' . $request->name . 'ha sido actualizado correctamente');
    }

    /**
     * Introducir el nuevo usuario voluntario en el sistema
     */
    public function register(Request $request)
    {
        // Validacion de los datos
        request()->validate(User::$rules);

        $comprobarUserUnique = User::orWhere('email','=',$request->email)->orWhere('DNI','=',$request->DNI)->count();
        //dd($comprobarUserUnique);

        if($comprobarUserUnique > 0){
            return redirect()->route('registro')->with('error', 'El correo electronico o DNI ya existe en el sistema');
        }

        // una vez validados los datos, creamos el objeto user
        $user = new User();

        $user->name = $request->name;
        $user->Apellidos = $request->Apellidos;
        $user->email = $request->email;
        $user->DNI = $request->DNI;
        $user->Direccion = $request->Direccion;
        $user->ProvinciaLocalidad = $request->ProvinciaLocalidad;
        $user->Telefono = $request->Telefono;
        $user->password = Hash::make($request->passwd);

        $user->save();

        // Add el usuario registrado al sistema, iniciado automaticamente
        // Auth::login($user);

        return redirect()->route('/')->with('success', 'Ha sido registrado correctamente, inicia sesión');
    }

    /**
     * Login del usuario en el sistema, utilizando el Auth de Lavarel
     */
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

    /**
     * Cierre del sesion del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('/'))->with('success','Ha sido cerrada la sesion correctamente');
    }

    /**
     * Mostrar formulario de cambio de password de la cuenta
     */
    public function cambiopassword()
    {
        return view('cuenta.changePassword');
    }

    /**
     * Donde se actualiza la password del usuario
     */
    public function updatepassword(Request $request)
    {
        // Validacion
        $oldpassword = $request->oldpassword;
        $newpassword = $request->newpassword;
        $confirmarpassword = $request->confirmarpassword;

        if ($confirmarpassword == $newpassword) {
            if (!Hash::check($oldpassword, Auth::user()->password)) {
                return back()->with("error",'La contraseña es incorrecta');
            }
            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($newpassword);
            $user->save();
            return back()->with("exito",'La contraseña ha sido cambiada correctamente!');
        } else {
            return back()->with("error",'La contraseña no conciden');
        }
    }

    /**
     * Comprobar si el usuario tiene permisos con un ONG, para seleccionar un modo de administrar
     * Si no tiene, entra directamente al parte voluntario
     *  o lo contrario, puede seleccionar la parte voluntario o administrar ONG
     */
    public function acceso()
    {
        //En caso que no tiene
        if (Auth::user()->id_ONG != null) {
            return redirect(route('selectingCuenta'));
        }

        return redirect('cuenta');
    }

    /**
     * Mostrar para seleccionar entre dos area de administracion
     */
    public function selectingCuenta()
    {
        if (Auth::user() == null) {
            return redirect('login');
        }
        return view('SelectingTipoCuenta');
    }

    /**
     * Acceso por la parte administrativa voluntario
     */
    public function general()
    {
        $user = User::find(Auth::user()->id);

        return view('cuenta.welcomeCuenta', compact('user'));
    }

    /**
     * Mostrar form para iniciar sesion
     */
    public function mostrarInicioSesion()
    {
        if (Auth::user() != null) {
            return redirect('/')->with('success','Ya estas iniciado sesion');
        }
        return view('inicioSesion');
    }

    /**
     * Mostrar el form de registro usuario
     */
    public function mostrarRegistro()
    {
        if (Auth::user() != null) {
            return redirect('/')->with('success','Ya estas iniciado sesion');
        }
        return view('registro');
    }

    /**
     * Relacion con la tabla de roles que tiene el usuario
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function searchUsers(Request $request)
    {
        $email = $request->email;

        $users = User::select('id','name','Apellidos','email','id_ONG')->where('email','LIKE','%'.$email.'%')
            ->where('id_ONG','=',NULL)
            ->limit(3)
            ->get()
            ->toJson();

        return $users;

    }
}
