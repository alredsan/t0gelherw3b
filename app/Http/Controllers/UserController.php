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
    public function index(Request $request)
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $buscadorName = $request->name;
        $buscadorLastName = $request->lastname;

        $users = "";

        if ($buscadorName){

            $users = User::where('name','LIKE',"%$buscadorName%");
        }

        if ($buscadorLastName){
            if($users == ""){
                $users = User::where('Apellidos','LIKE',"%$buscadorLastName%");
            }else{
                $users->where('Apellidos','LIKE',"%$buscadorLastName%");
            }
        }

        if($users == ""){
            $users = User::paginate(4);
        }else{
            $users->paginate(4);
            dd($users);
        }

        return view('admin.user.index',compact('users','userAuth'));
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

    public function editUserAdmin($idUser)
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $user = User::find($idUser);

        return view('admin.user.edit', compact('user','userAuth'));
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
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        if($id != "") User::find($id)->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'El usuario ha sido eliminado correctamente del sistema');
    }

    /**
     * Mostrar los eventos del usuario
     */
    public function showEventos()
    {

        $user = User::find(Auth::user()->id);

        return view('cuenta.showEventsCuenta', compact('user'));
    }

    /**
     * Actualizar el usuario
     */
    public function updateUserV(Request $request, User $user)
    {
        request()->validate(User::$rules);


        $data = User::find(Auth::user()->id);

        if($data->email != $request->email){
            $comprobarEmail = User::where('email',$request->email)->first();

            if ($comprobarEmail){
                return back()->with('fail','El correo electronico existe en el sistema');
            }

            //Ponemos a NULL la vertificacion, para volver a verticar la cuenta por nuevo correo
            $data->email_verified_at = NULL;

        }

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

    public function updateUserAdmin(Request $request, $idUser)
    {
        request()->validate(User::$rules);


        $data = User::find($idUser);

        if($data->email != $request->email){
            $comprobarEmail = User::where('email',$request->email)->first();

            if ($comprobarEmail){
                return back()->with('fail','El correo electronico existe en el sistema');
            }


            //Ponemos a NULL la vertificacion, para volver a verticar la cuenta por nuevo correo
            $data->email_verified_at = NULL;

        }

        if($data->DNI != $request->DNI){
            // dd($data->DNI,$request->DNI);
            $comprobarDNI = User::where('DNI',"=",$request->DNI)->first();
            if ($comprobarDNI){
                // dd($comprobarDNI);
                return back()->with("fail","El DNI nuevo introducido ya existe en el sistema");
            }

            $data->DNI = $request->DNI;
        }

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

        return redirect()->route('admin.users.index')
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
            return back()->with('error', 'El correo electronico o DNI ya existe en el sistema')->withInput();
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
     * Login del usuario en el sistema, utilizando el Auth de Laravel
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
            return back()->with('message', 'Usuario o contraseña incorrectos')->withInput();
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
        if (Auth::user()->id_ONG != null || Auth::user()->Role != null) {
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
     * Donde se devuelve en JSON un registro de 3 personas que no tiene ningun acceso a un ONG
     * para asignarle nuevo permisos
     */
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
