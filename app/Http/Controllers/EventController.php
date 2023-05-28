<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsType;
use App\Models\EventsUser;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    /**
     * Mostrar todos los eventos para el administrador WEB
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(7);
        $showONG = true;

        return view('admin.event.index', compact('events','showONG'));
        // return view('event.index', compact('events'))
        //     ->with('i', (request()->input('page', 1) - 1) * $events->perPage());
    }

    /**
     * Mostrar solo los eventos que usuario tiene permiso
     */
    public function indexEventsONG()
    {
        $events = Event::where('id_ONG', '=', Auth::user()->id_ONG)->paginate(10);

        $showONG = false;

        return view('admin.event.index', compact('events','showONG'));
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

        return view('event.create', compact('event', 'types'));
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

        if ($request->CheckVisible) {
            $data['Visible'] = 1;
        } else {
            $data['Visible'] = 0;
        }

        //Creacion objeto Event y obtenemos el objeto para insertar los tipos del evento seleccionados
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

        $particiantes = EventsUser::where('idEvent', $id)->count();

        $particiantesRestantes = $event->numMaxVoluntarios - $particiantes;

        return view('event.show', compact('event', 'particiantesRestantes'));
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
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $event = Event::find($id);

        $types = Type::all();

        if ($event->id_ONG == Auth::user()->id_ONG || $user->roles('1')) {

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
        //Validamos los datos
        request()->validate(Event::$rules);

        //Buscamos por idEvent
        $data = Event::find($event);

        $data->Nombre = $request->Nombre;
        $data->Descripcion = $request->Descripcion;
        $data->FechaEvento = strtotime($request->FechaEvento); //Convertir al EPOCH para mayor compatibilidad a largo plazo
        $data->numMaxVoluntarios = $request->numMaxVoluntarios;
        $data->Direccion = $request->Direccion;
        $data->Latitud = $request->Latitud;
        $data->Longitud = $request->Longitud;
        $data->Aportaciones = $request->Aportaciones;
        if ($request->CheckVisible) {
            $data->Visible = 1;
        } else {
            $data->Visible = 0;
        }
        //Comprobamos si existe alguna fotografia el input
        if ($request->hasFile('Foto')) {
            //Comprobamos si no es la foto por defecto
            if ($data->Foto != config('constants.DEFAULT_PHOTO_EVENT')) {
                unlink($data->Foto); //Eliminamos del sistema la fotografia antigua
            }
            //Subida imagen y asginar el nuevo nombre de imagen para mayor seguridad
            $data->Foto = $request->file('Foto')->store('event');
            $data->Foto = 'storage/' . $data->Foto;
        }

        $data->save();

        $rows = EventsType::find($event);
        if ($rows != null) {
            $rows->delete();
        }

        $data->eventsType()->attach($request->selectmultiple);


        // return back()->with('success', 'El evento ha sido actualizado correctamente.');
        // return redirect()->route('admin.ong.event.index')
        //     ->with('success', 'El evento ha sido actualizado correctamente.');
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

        // return redirect()->route('perfil')
        //     ->with('success-events', 'Ya no participas en este evento');
        return back()->with('success-events', 'Ya no participa en ese Evento');
    }

    /**
     * BUSCADOR: donde se va a filtrar los eventos de la aplicacion principal
     */
    public function indexFilter(Request $request)
    {

        $nombre = $request->input('nombre');
        $type = $request->input('selectType');
        $fecha = $request->input('fecha');
        $localidad = $request->input('localidad');
        $lat = $request->input('lat');
        $lon = $request->input('lon');
        $radio = $request->input('selectRadio');

        $order = $request->input('order');

        $tipos = Type::all();

        //Si ha selecionado que ordene por distancia, comprobamos que tenemos la ubicacion deseada del cliente
        if ($order == "1" && ($lat == null || $lon == null)) {
            return redirect()->route('/', compact('request', 'tipos'))->with('error', 'Si desea ordenar por distancia, debe indicar ubicacion');
        }

        $events = Event::where("Visible", "=", "1")
            ->FechaEvento($fecha)
            ->where('Nombre', 'LIKE', "%$nombre%")
            ->Tematica($type)
            ->Localidad($lat, $lon, $radio)
            ->Ordenacion($order)
            ->paginate(8);


        return view('event.index', compact('events', 'tipos', 'request'));
    }

    function showUsersEvent(Event $id)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if (Auth::user()->idONG != $id->idONG || !($user->roles('1'))) {
            abort(404);
        }

        $event = $id;

        $users = $event->usuarios()->paginate(10);

        // return $usuarios;
        return view('admin.user.indexUsersEvent', compact('event', 'users'));
    }

    public function destroyParticipanteAdmin($idEvent, $idUser)
    {
        try {
            $participante = EventsUser::query();
            $participante->where('idEvent', '=', $idEvent)
                ->where('idUser', '=', $idUser);
            $participante->delete();
        } catch (Exception $ex) {
            return back()->with('fail', 'Ha habido un error en eliminar el voluntario del evento');
        }

        return back()->with('success', 'Ya no participa en ese Evento');
    }
}
