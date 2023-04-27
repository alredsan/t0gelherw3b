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

        if (Auth::user()->roles('1')) {

            return view('admin.organisation.index', compact('organisations'))
                ->with('i', (request()->input('page', 1) - 1) * $organisations->perPage());
        } else {
            return "NO PERMITIDO";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisation = new Organisation();
        return view('admin.organisation.create', compact('organisation'));
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

        $data = $request->all();

        if ($request->hasFile('FotoLogo')) {
            $data['FotoLogo'] = $request->file('FotoLogo')->store('logo_ong');
            $data['FotoLogo'] = 'storage/' . $data['FotoLogo'];
        }

        $organisation = Organisation::create($data);

        return redirect()->route('admin.ong.show', $organisation->idONG)
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

        if (Auth::user()->id_ONG == $id || Auth::user()->roles('1')) {
            return view('admin.organisation.show', compact('organisation'));
        } else {
            return "NO PERMITIDO";
        }
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

        if (Auth::user()->id_ONG == $id || Auth::user()->roles('1')) {

            return view('admin.organisation.edit', compact('organisation'));
        } else {
            return "NO PERMITIDO";
        }
    }


    public function showModeAdminEdit()
    {
        // $organisation = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $organisation = Organisation::find(Auth::user()->id_ONG);

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
        // $data = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $data = Organisation::find($request->idONG);

        $data->Name = $request->Name;
        $data->DireccionSede = $request->DireccionSede;
        $data->Descripcion = $request->input('Descripcion');
        $data->FechaCreacion = $request->FechaCreacion;
        $data->IBANmetodoPago = $request->IBANmetodoPago;
        $data->eMail = $request->eMail;
        $data->Telefono = $request->Telefono;

        if ($request->hasFile('FotoLogo')) {
            $data->FotoLogo = $request->file('FotoLogo')->store('logo_ong');
            $data->FotoLogo = 'storage/' . $data->FotoLogo;
        }

        $data->save();

        return redirect()->route('admin.ong.show', $data->idONG)
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

        return redirect()->route('admin.ong.index')
            ->with('success', 'Organisation deleted successfully');
    }
}
