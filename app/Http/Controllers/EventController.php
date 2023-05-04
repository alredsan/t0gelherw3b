<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsType;
use App\Models\EventsUser;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    /**
     * Mostrar todos los eventos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate();

        return view('event.index', compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * $events->perPage());
    }

    /**
     * Mostrar solo los eventos que usuario tiene permiso
     */
    public function indexEventsONG()
    {
        $events = Event::where('id_ONG', '=', Auth::user()->id_ONG)->paginate(5);

        return view('admin.event.index', compact('events'));
    }

    /**
     * Mostrar el formualrio para crear nuevo evento
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();

        $types = Type::all();

        return view('event.create', compact('event','types'));
    }

    /**
     * Guardar el nuevo evento en BBDD
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Event::$rules);

        $data = $request->all();

        $data['id_ONG'] = Auth::user()->id_ONG;
        $data['FechaEvento'] = strtotime($request->FechaEvento);

        if ($request->hasFile('Foto')) {
            $name = $request->file('Foto')->store('event');
            $data['Foto'] = '';
            $data['Foto'] = 'storage/' . $name;
        }

        $event = Event::create($data);

        $event->eventsType()->attach($request->selectmultiple);

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido creado correctamente.');
    }

    /**
     * Mostrar informacion de un Evento
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
     * Mostrar el formulario para editar el evento
     *
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        $types = Type::all();

        if ($event->id_ONG == Auth::user()->id_ONG) {
            return view('event.edit', compact('event', 'types'));
        } else {
            abort(404);
        }
    }

    /**
     * Actualizar el evento tras el submit del formulario POST
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event)
    {
        request()->validate(Event::$rules);

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
            if($data->Foto != 'img/eventWithoutPhoto.png'){
                unlink($data->Foto); //Eliminamos del sistema la fotografia antigua
            }

            $data->Foto = $request->file('Foto')->store('event');
            $data->Foto = 'storage/' . $data->Foto;
        }

        $data->save();

        $rows = EventsType::find($event);
        if ($rows != null) {
            $rows->delete();
        }

        $data->eventsType()->attach($request->selectmultiple);

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido actualizado correctamente.');
    }

    /**
     * Eliminar el evento del sistema
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

    /**
     * Eliminar el participante que esta vinculado con el evento
     */
    public function destroyParticipante($id)
    {
        $participante = EventsUser::query();
        $participante->where('idEvent', '=', $id)
            ->where('idUser', '=', Auth::user()->id);
        $participante->delete();

        return redirect()->route('perfil')
            ->with('success-events', 'Ya no participas en este evento');
    }

    /**
     * BUSCADOR: donde se va a filtrar los eventos de la aplicacion principal
     */
    public function indexFilter(Request $request)
    {
        $nombre = $request->get('nombre');
        $type = $request->get('selectType');
        $fecha = $request->get('fecha');
        $localidad = $request->get('localidad');

        $events = Event::orderBy('FechaEvento', 'ASC')
            ->where('Nombre', 'LIKE', "%$nombre%")
            ->FechaEvento($fecha)
            ->Tematica($type)
            ->paginate(8);

        $tipos = Type::all();
        return view('event.index', compact('events', 'tipos', 'request'));

    }
}
