<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends Controller
{

    /**
     * *Listar los ONG
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $buscador = $request->nameONG;

        if ($buscador){
            $organisations = Organisation::where('Name','LIKE',"%$buscador%")->paginate(10)->withQueryString();
        }else{
            $organisations = Organisation::paginate(10)->withQueryString();
        }

        return view('admin.organisation.index', compact('organisations', 'userAuth'));
            // ->with('i', (request()->input('page', 1) - 1) * $organisations->perPage());

    }

    /**
     * *Mostrar el formulario para crear nuevo ONG
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAuth = Auth::user();
        if ($userAuth->Role >= 4) {

            $organisation = new Organisation();
            return view('admin.organisation.create', compact('organisation', 'userAuth'));
        } else {
            abort(404);
        }
    }

    /**
     * *Guardar en BBDD nuevo ONG creado
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Organisation::$rules);

        $data = $request->all();
        $newOng = [];

        $newOng['Name'] = $request->Name;
        $newOng['DireccionSede'] = $request->DireccionSede;
        $newOng['Descripcion'] = $request->Descripcion;
        $newOng['IBANmetodoPago'] = $request->IBANmetodoPago;
        $newOng['eMail'] = $request->eMail;
        $newOng['Telefono'] = $request->Telefono;

        $newOng['FechaCreacion'] = strtotime($request->FechaCreacion);
        // $data['FechaCreacion'] = strtotime($request->FechaCreacion);

        if ($request->hasFile('FotoLogo')) {
            // $data['FotoLogo'] = $request->file('FotoLogo')->store('logo_ong');
            // $data['FotoLogo'] = 'storage/' . $data['FotoLogo'];
            $newImage = $request->file('FotoLogo')->store('logo_ong');
            $newOng['FotoLogo'] = 'storage/' . $newImage;
        }

        $organisation = Organisation::create($newOng);

        // return redirect()->route('admin.ong.show', $organisation->idONG)
        //     ->with('success', 'Organización creada con éxito.');
        return redirect()->route('admin.ong.usersassign', $organisation->idONG)
            ->with('success', 'Organización creada con éxito. Puedes agregar usuarios para tener acceso');
    }

    /**
     * *Mostrar un ONG con su informacion
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userAuth = Auth::user();

        $organisation = Organisation::find($id);

        if (Auth::user()->id_ONG == $id || $userAuth->Role >= 4) {

            return view('admin.organisation.show', compact('organisation', 'userAuth'));
        } else {
            abort(404);
        }
    }

    /**
     * *Mostrar el ONG que tiene acceso
     */
    public function showModeAdmin()
    {
        $userAuth = Auth::user();

        $organisation = Organisation::where('idONG', $userAuth->id_ONG)->first();
        if ($organisation == null) {
            abort(404);
        }
        return view('admin.organisation.show', compact('organisation', 'userAuth'));
    }

    /**
     * *Mostrar el formulario para editar el ONG
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userAuth = Auth::user();

        $organisation = Organisation::findOrFail($id);

        if ((Auth::user()->id_ONG == $id && $userAuth->Role >= 3) || $userAuth->Role >= 4) {

            return view('admin.organisation.edit', compact('organisation', 'userAuth'));
        } else {
            abort(404);
        }
    }

    /**
     * *Mostrar el formulario de edicion el ONG que tiene permiso hacerlo
     */
    public function showModeAdminEdit()
    {
        $userAuth = Auth::user();
        // $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $organisation = Organisation::find($userAuth->id_ONG);

        if ($organisation == null || $userAuth->Role == 1) {
            abort(404);
        }

        return view('admin.organisation.edit', compact('organisation', 'userAuth'));
    }

    /**
     * *Actualizar el ONG tras el formulario
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function ModeAdminONGUpdate(Request $request, Organisation $organisation)
    {
        request()->validate(Organisation::$rules);
        // $data = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $data = Organisation::find($request->idONG);

        $data->Name = $request->Name;
        $data->DireccionSede = $request->DireccionSede;
        $data->Descripcion = $request->input('Descripcion');
        $data->FechaCreacion = strtotime($request->FechaCreacion);
        $data->IBANmetodoPago = $request->IBANmetodoPago;
        $data->eMail = $request->eMail;
        $data->Telefono = $request->Telefono;

        if ($request->hasFile('FotoLogo')) {
            if ($data->FotoLogo != config('constants.DEFAULT_PHOTO_ONG')) {
                unlink($data->FotoLogo); //Eliminamos del sistema la fotografia antigua
            }

            $data->FotoLogo = $request->file('FotoLogo')->store('logo_ong');
            $data->FotoLogo = 'storage/' . $data->FotoLogo;
        }

        $data->save();

        return redirect()->route('admin.ong.show', $data->idONG)
            ->with('success', 'Ha sido actualizada correctamente');
    }

    /**
     * *Eliminar ONG del BBDD
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            //Cambiamos los roles, aplicando NULL menos al WEB
            User::where('id_ONG', $id)->where('Role', '<', 4)->update(['Role' => NULL]);

            //Eliminamos el ONG y ya asigna NULL al usuario por clave foranea
            Organisation::find($id)->delete();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.ong.index')
                ->with('fail', 'EL ONG no ha sido eliminado del sistema, ha producido un error');
        }

        return redirect()->route('admin.ong.index')
            ->with('success', 'EL ONG ha sido eliminado del sistema');
    }


    /**
     * *Mostrar los usuarios que tiene permiso sobre el ONG
     */
    public function showUserOng($id = "")
    {
        $userAuth = Auth::user();

        if ($id != "") {
            $id = intval($id);
            //En caso que tenga un numero en URL , comprobamos que tiene rol requerido WEB
            if (!($userAuth->id_ONG == $id && $userAuth->Role >= 3)) {
                if (($userAuth->Role <= 3)) {
                    //No tiene rol de administracion total o no tiene permiso
                    abort(404);
                }
            }

            $id_ONG = $id;
        } else {
            // Comprobar que tiene el rol requerido

            if ($userAuth->Role <= 2) abort(404);

            $id_ONG = $userAuth->id_ONG;
        }


        $users = User::where('id_ONG', $id_ONG)->paginate(10);

        $roles = Role::where('idRol', '<', '4')->get();

        $organisation = Organisation::findOrFail($id_ONG);

        return view('admin.user.indexUsersONG', compact('users', 'roles', 'organisation', 'userAuth'));
    }

    /**
     * *Funcion donde asigna el usuario a un ONG, para gestionarlo
     */
    public function assignUser(Request $request, Organisation $id)
    {
        // dd($request);
        //Recogemos del formulario
        $email = $request->email;
        $rolesAssignRequest = $request->chxRol;

        //Comprobamos que tenga los datos requeridos para insertar
        if ($email == "" || $rolesAssignRequest == "") {
            return back()->with('fail', 'No has seleccionado usuario o no has seleccionado roles');
        }

        // $rolesAssign = array_keys($rolesAssignRequest);
        $rolesAssign = $rolesAssignRequest;

        //Comprobamos si el usuario esta libre o que exista
        $user = User::where('email', $email)->where('id_ONG', NULL)->first();

        if (!$user) {
            //En caso que no exista o ya esta gestionando un ONG
            return back()->with('fail', 'El Usuario no existe o ya gestiona un ONG, el email introducido: ' . $email);
        }

        try {
            DB::beginTransaction();
            //Cambiamos la propiedad id_ONG del usuario

            $user->id_ONG = $id->idONG;
            $user->Role = $rolesAssign;
            $user->save();

            DB::commit(); //Confirmamos la intregridad de datos
        } catch (Exception) {
            //Revertimos los cambios en BBDD y notificamos al usuario el error producido
            DB::rollBack();
            return back()->with('fail', 'Ha habido un error durante el proceso de asignacion de permisos');
        }


        //Devolucion respuesta de forma exitosa
        return back()->with('success', 'Usuario' . $user->Name . ' ha sido asignado correctamente' . $email);
        //redirect()->route('admin.ong.usersassign')
    }

    /**
     * *Donde se devuelve la informacion de UN usuario del sistema de forma simplicada
     * (id, name, Apellidos, id_ONG, Role)
     */
    public function assignUserInfo($id)
    {

        $user = User::select('id', 'name', 'Apellidos', 'id_ONG', 'Role')->where('id', $id)->first();

        if ($user->id_ONG != Auth::user()->id_ONG) {
            return ['result' => 'No valido'];
        }

        $array = ['result' => 'Valido', "user" => $user];

        return $array;
    }

    /**
     * *Donde recibe del form de Edicion Roles de un usuario
     */
    public function assignUserEdit(Request $request)
    {
        $user = User::find($request->idUser);

        if (!$user) {
            return back()->with('success', 'No se ha podido realizar la peticion: Usuario no encontrado');
        }

        if ($request->chxRolEdit == null) {
            $user->id_ONG = null;
        } else {

            $user->Role = $request->chxRolEdit;
        }
        $user->save();

        return back()->with('success', 'Ha sido modificado los permisos correctamente para el Usuario ' . $user->name);
    }

    /**
     * *En caso que pulse el boton de eliminar permiso de un usuario
     */
    public function desassignUser($id)
    {

        $user = User::find($id);

        if (!$user) {
            return back()->with('success', 'No se ha podido realizar la peticion: Usuario no encontrado, error');
        }

        $user->id_ONG = NULL;

        //Comprobamos si el rol no sea ADMINWEB
        if ($user->Role <= 3) {
            $user->Role = NULL;
        }

        $user->save();

        return back()->with('success', 'Usuario' . $user->name . ' ha sido desasignado correctamente');
    }
}
