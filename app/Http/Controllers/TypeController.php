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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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
