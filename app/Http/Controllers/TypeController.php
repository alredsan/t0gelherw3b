<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TypeController
 * @package App\Http\Controllers
 */
class TypeController extends Controller
{
    /**
     * *Mostrar los tipos que puede tener un evento para mejor filtración de eventos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $types = Type::paginate();

        return view('admin.type.index', compact('types','userAuth'))
            ->with('i', (request()->input('page', 1) - 1) * $types->perPage());
    }

    /**
     * *Mostrar el formulario de nuevo TIPO
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $type = new Type();
        return view('admin.type.create', compact('type','userAuth'));
    }

    /**
     * *STORE: Almacenar el nuevo tipo tras de realizar el FORM
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Type::$rules);

        $type = Type::create($request->all());

        return redirect()->route('admin.types.index')
            ->with('success', 'Ha sido creado nuevo Tipo de evento.');
    }

    /**
     * *EDIT: mostrar el formulario para editar el tipo seleccionado
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userAuth = Auth::user();

        if ($userAuth->Role < 4) abort(404);

        $type = Type::find($id);

        if(!$type){
            return redirect()->route('admin.types.index')->with('error','No se ha podido encontrar el tipo');
        }

        return view('admin.type.edit', compact('type','userAuth'));
    }

    /**
     * *UPDATE: donde se actualiza el tipo tras del formulario
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        request()->validate(Type::$rules);

        $type->Nombre = $request->Nombre;
        $type->save();

        return redirect()->route('admin.types.index')
            ->with('success', 'Ha sido actualizado el Tipo '.$type->Nombre);
    }

    /**
     * *Donde se elimina el tipo del sistema
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $type = Type::find($id)->delete();

        return redirect()->route('admin.types.index')
            ->with('success', 'El tipo ha sido eliminado correctamente');
    }
}
