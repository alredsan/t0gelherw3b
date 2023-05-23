<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends Controller
{
    /**
     * Listar los ONG
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = Organisation::paginate();

        if (Auth::user()->roles('1')) {

            return view('admin.organisation.index', compact('organisations'))
                ->with('i', (request()->input('page', 1) - 1) * $organisations->perPage());
        } else {
            abort(404);
        }
    }

    /**
     * Mostrar el formulario para crear nuevo ONG
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisation = new Organisation();
        return view('admin.organisation.create', compact('organisation'));
    }

    /**
     * Guardar en BBDD nuevo ONG creado
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Organisation::$rules);

        $data = $request->all();
        $data['FechaCreacion'] = strtotime($request->FechaCreacion);

        if ($request->hasFile('FotoLogo')) {
            $data['FotoLogo'] = $request->file('FotoLogo')->store('logo_ong');
            $data['FotoLogo'] = 'storage/' . $data['FotoLogo'];
        }

        $organisation = Organisation::create($data);

        return redirect()->route('admin.ong.show', $organisation->idONG)
            ->with('success', 'Organisation created successfully.');
    }

    /**
     * Mostrar un ONG con su informacion
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organisation = Organisation::find($id);

        if (Auth::user()->id_ONG == $id || Auth::user()->roles('1')) {
            return view('admin.organisation.show', compact('organisation'));
        } else {
            abort(404);
        }
    }

    /**
     * Mostrar el ONG que tiene acceso
     */
    public function showModeAdmin()
    {
        $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        // $organisation = Organisation::find(Auth::user()->id_ONG);
        if($organisation == null){
            abort(404);
        }
        return view('admin.organisation.show', compact('organisation'));
    }

    /**
     * Mostrar el formulario para editar el ONG
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organisation = Organisation::findOrFail($id);

        if (Auth::user()->id_ONG == $id || Auth::user()->roles('1')) {

            return view('admin.organisation.edit', compact('organisation'));
        } else {
            abort(404);
        }
    }

    /**
     * Mostrar el formulario de edicion el ONG que tiene permiso hacerlo
     */
    public function showModeAdminEdit()
    {
        // $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $organisation = Organisation::find(Auth::user()->id_ONG);

        if($organisation == null){
            abort(404);
        }

        return view('admin.organisation.edit', compact('organisation'));
    }

    /**
     * Actualizar el ONG tras el formulario
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Organisation $organisation)
    // {
    //     request()->validate(Organisation::$rules);

    //     $organisation->update($request->all());

    //     return redirect()->route('organisations.index')
    //         ->with('success', 'Organisation updated successfully');
    // }

    /**
     * Actualizar el ONG que tiene permiso hacerlo
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
     * Eliminar ONG del BBDD
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $organisation = Organisation::find($id)->delete();

        return redirect()->route('admin.ong.index')
            ->with('success', 'EL ONG ha sido eliminado del sistema');
    }



    // Mostrar los usuarios que tiene permiso sobre el ONG
    public function showUserOng($id = "")
    {
        if($id != ""){
            //En caso que tenga un numero en URL , comprobamos que tiene rol requerido WEB
            if (!Auth::user()->roles('1') || Auth::user()->id_ONG == $id) {
                abort(404);
            }
            $id_ONG = $id;

        }else{
            $id_ONG = Auth::user()->id_ONG;
        }


        $users = User::where('id_ONG', $id_ONG)->paginate(10);

        $roles = Role::where('idRol', '>', '1')->get();

        $organisation = Organisation::findOrFail($id_ONG);

        return view('admin.user.indexUsersONG', compact('users', 'roles','organisation'));
    }

    // public function showUserOngAdmin($id)
    // {
    //     if (!Auth::user()->roles('1')) {
    //         abort(404);
    //     }

    //     $id_ONG = $id;

    //     $users = User::where('id_ONG', $id_ONG)->paginate(10);

    //     $roles = Role::where('idRol', '>', '1')->get();


    //     return view('admin.user.indexUsersONG', compact('users', 'roles'));
    // }


    public function assignUser(Request $request)
    {

        $email = $request->email;

        $rolesAssignRequest = $request->chxRol;

        $rolesAssign = array_keys($rolesAssignRequest);

        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            return redirect()->route('admin.ong.usersassign')->with('fail', 'El Usuario no existe o ya gestiona un ONG, el email introducido: ' . $email);
        }

        $user->id_ONG = Auth::user()->id_ONG; //Cambiar, por el adminWEb, no tiene la propiedad
        $user->save();

        $user->usersRole()->attach($rolesAssign);

        return redirect()->route('admin.ong.usersassign')->with('success', 'Usuario'.$user->Name.' ha sido asignado correctamente' . $email);
    }


    public function assignUserInfo($id)
    {

        $user = User::select('id', 'name','Apellidos','id_ONG')->where('id','=',$id)->first();

        if($user->id_ONG != Auth::user()->id_ONG){
            return ['result'=> 'No valido'];
        }

        $rolesUser = $user->usersRole()->where('users_roles.idRol', '>', '1')->get();

        $array = ['result'=> 'Valido',"user"=> $user,"roles"=>$rolesUser];


        return $array;
    }

    public function assignUserEdit(Request $request)
    {
        $user = User::find($request->idUser);

        if(!$user){
            return redirect()->route('admin.ong.usersassign')->with('success', 'No se ha podido realizar la peticion: Usuario no encontrado');
        }

        $user->usersRole()->detach();

        if($request->chxRolEdit == null){
            $user->id_ONG = null;
            $user->save();
        }else{

            $rolesAssign = array_keys($request->chxRolEdit);
            $user->usersRole()->attach($rolesAssign);
        }

        return redirect()->route('admin.ong.usersassign')->with('success', 'Ha sido modificado los permisos correctamente para el Usuario '.$user->name);
    }

    public function desassignUser($id)
    {

        $user = User::findOrFail($id);

        if(!$user){
            return redirect()->route('admin.ong.usersassign')->with('success', 'No se ha podido realizar la peticion: Usuario no encontrado');
        }

        $user->id_ONG = NULL;
        $user->save();

        //Eliminar Roles de la tabla relacionada entre Users y Roles (users_roles)
        $user->usersRole()->detach();

        return redirect()->route('admin.ong.usersassign')->with('success', 'Usuario'.$user->name.' ha sido desasignado correctamente');
    }
}
