<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsUser;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate();

        return view('event.index', compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * $events->perPage());
    }

    public function indexEventsONG(){
        $events = Event::where('id_ONG', '=', Auth::user()->id_ONG)->paginate(1);

        return view('admin.event.index',compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();
        return view('event.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Event::$rules);

        $request['id_ONG'] = Auth::user()->id_ONG;

        $event = Event::create($request->all());

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event)
    {
        request()->validate(Event::$rules);

        // $data = Organisation::where('idONG', '=', Auth::user()->id_ONG)->first();
        $data = Event::find($event);

        $data->Nombre = $request->Nombre;
        $data->Descripcion = $request->Descripcion;
        $data->FechaEvento = strtotime($request->FechaEvento);
        $data->numMaxVoluntarios = $request->numMaxVoluntarios;
        $data->Direccion = $request->Direccion;
        $data->Latitud = $request->Latitud;
        $data->Longitud = $request->Longitud;
        $data->Aportaciones = $request->Aportaciones;

        if ($request->hasFile('Foto')) {
            $data->Foto = $request->file('Foto')->store('event');
            $data->Foto = 'storage/' . $data->Foto;
        }

        $data->save();

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $event = Event::find($id)->delete();

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido eliminado');
    }

    public function destroyParticipante($id)
    {
        $participante = EventsUser::query();
        $participante->where('idEvent','=',$id)
        ->where('idUser','=',Auth::user()->id);
        $participante->delete();

        // $event = Event::find($id)->delete();

        return redirect()->route('perfil')
            ->with('success-events', 'Ya no participas en este evento');
    }

    // DONDE SE VA A FILTRAR SEGUN EL BUSCADOR
    public function indexFilter(Request $request)
    {
        $nombre = $request->get('nombre');
        $type = $request->get('selectType');
        $fecha = $request->get('fecha');
        $localidad = $request->get('localidad');

        $fecha_inicio = strtotime($fecha . " 00:00:00");
        $fecha_final = strtotime($fecha . " 23:59:59");
        $events = Event::orderBy('idEvento', 'DESC')
            ->where('Nombre', 'LIKE', "%$nombre%")
            ->FechaEvento($fecha, $fecha_inicio, $fecha_final)
            ->paginate(8);
        // ->Nombre($nombre)
        // ->FechaEvento($fecha);
        $tipos = Type::all();
        return view('event.index', compact('events', 'tipos', 'request'));
        // $events = Event::paginate();

        // return view('event.index', compact('events'))
        //     ->with('i', (request()->input('page', 1) - 1) * $events->perPage());
    }
}
