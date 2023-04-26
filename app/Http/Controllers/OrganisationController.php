<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = Organisation::paginate();

        return view('organisation.index', compact('organisations'))
            ->with('i', (request()->input('page', 1) - 1) * $organisations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisation = new Organisation();
        return view('organisation.create', compact('organisation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Organisation::$rules);

        $organisation = Organisation::create($request->all());

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organisation = Organisation::find($id);

        return view('organisation.show', compact('organisation'));
    }

    public function showModeAdmin()
    {
        $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        // $organisation = Organisation::find(Auth::user()->id_ONG);

        return view('admin.organisation.show', compact('organisation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organisation = Organisation::find($id);

        return view('organisation.edit', compact('organisation'));
    }


    public function showModeAdminEdit()
    {
        $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        // $organisation = Organisation::find(Auth::user()->id_ONG);

        return view('admin.organisation.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        request()->validate(Organisation::$rules);

        $organisation->update($request->all());

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation updated successfully');
    }

    public function ModeAdminONGUpdate(Request $request, Organisation $organisation)
    {
        request()->validate(Organisation::$rules);
        $data = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        // $data = Organisation::find(Auth::user()->id_ONG);

        $data->Name = $request->Name;
        $data->DireccionSede = $request->DireccionSede;
        $data->Descripcion = $request->Descripcion;
        $data->FechaCreacion = $request->FechaCreacion;
        $data->IBANmetodoPago = $request->IBANmetodoPago;
        $data->eMail = $request->eMail;
        $data->Telefono = $request->Telefono;

        $path = $request->file('FotoLogo')->getRealPath();
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);
        $data->logo = $base64;

        $data->save();

        return redirect()->route('admin.ong')
            ->with('success', 'Ha sido actualizada correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $organisation = Organisation::find($id)->delete();

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation deleted successfully');
    }
}
