<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsType;
use App\Models\EventsUser;
use App\Models\Organisation;
use App\Models\Type;
use Exception;
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
     * *Mostrar todos los eventos para el administrador WEB
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userAuth = Auth::user();

        if($userAuth->Role < 4) abort(404);

        $buscador = $request->name;

        if ($buscador){
            $events = Event::where('Nombre','LIKE',"%$buscador%")->paginate(7)->withQueryString();
        }else{
            $events = Event::paginate(7)->withQueryString();
        }

        $showONG = true;

        return view('admin.event.index', compact('events', 'showONG','userAuth','buscador'));
    }

    /**
     * *Mostrar solo los eventos que usuario tiene permiso
     */
    public function indexEventsONG(Request $request)
    {
        $userAuth = Auth::user();
        if (!$userAuth->id_ONG) abort(404);

        $buscador = $request->name;

        if ($buscador){
            $events = Event::where('id_ONG', $userAuth->id_ONG)->where('Nombre','LIKE',"%$buscador%")->orderBy('FechaEvento', 'DESC')->paginate(10)->withQueryString();
        }else{
            $events = Event::where('id_ONG', $userAuth->id_ONG)->orderBy('FechaEvento', 'DESC')->paginate(10)->withQueryString();
        }


        $showONG = false;

        return view('admin.event.index', compact('events', 'showONG', 'userAuth','buscador'));
    }

    /**
     * *Mostrar el formualrio para crear nuevo evento
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAuth = Auth::user();
        if (!$userAuth->id_ONG || $userAuth->Role < 2) abort(404);

        $event = new Event();

        $types = Type::all();

        return view('admin.event.create', compact('event', 'types', 'userAuth'));
    }

    /**
     * *Guardar el nuevo evento en BBDD
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
        // dd($data);
        //Creacion objeto Event y obtenemos el objeto para insertar los tipos del evento seleccionados
        $event = Event::create($data);

        $event->eventsType()->attach($request->selectmultiple);

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido creado correctamente.');
    }

    /**
     * *Mostrar informacion de un Evento
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findorFail($id);

        // en caso que no tiene la sesion, guardar la url para cuando inicie sesion, no pierda la pagina que estaba
        app('redirect')->setIntendedUrl(request()->fullUrl());

        //Comprobamos que el evento este visible
        if (!$event->Visible) {
            //En caso que no este visible, comprobamos que tiene permiso

            if (Auth::check()) {
                $user = Auth::user();

                if (!($user->id_ONG == $event->id_ONG || $user->Role > 4)) {
                    abort(404);
                }
            } else {
                //En caso que no esta iniciado sesion
                abort(404);
            }
        }

        $particiantes = EventsUser::where('idEvent', $id)->count();

        $particiantesRestantes = $event->numMaxVoluntarios - $particiantes;

        return view('event.show', compact('event', 'particiantesRestantes'));
    }

    /**
     * *Mostrar el formulario para editar el evento
     *
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userAuth = Auth::user();

        $event = Event::find($id);

        $types = Type::all();

        if (($event->id_ONG == $userAuth->id_ONG && $userAuth->Role >= 2) || $userAuth->Role >= 4) {

            return view('admin.event.edit', compact('event', 'types', 'userAuth'));
        } else {
            abort(404);
        }
    }

    /**
     * *Actualizar el evento tras el submit del formulario POST
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

        $particiantesApuntados = EventsUser::where('idEvent', $event)->count();

        if ($particiantesApuntados > $request->numMaxVoluntarios) {
            return back()->with('danger-events', 'Hay mas voluntarios apuntados que el numero maximo, elimine voluntarios para editar.')->withInput();
        }

        $data->Nombre = $request->Nombre;
        $data->Descripcion = $request->Descripcion;
        $data->FechaEvento = strtotime($request->FechaEvento); //Convertir al EPOCH para mayor compatibilidad a largo plazo

        $data->numMaxVoluntarios = $request->numMaxVoluntarios;
        $data->Direccion = $request->Direccion;
        $data->Latitud = $request->Latitud;
        $data->Longitud = $request->Longitud;

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
        try {
            DB::beginTransaction();
            $rows = EventsType::find($event);
            if ($rows != null) {
                $rows->delete();
            }

            $data->eventsType()->attach($request->selectmultiple);
            DB::commit();
        } catch (Exception) {
            DB::rollBack();
            return back()->with('danger-events', 'Ha habido un error en los tipos.')->withInput();
        }

        return redirect()->route('events.show',$data->idEvento)
            ->with('success', 'El evento ha sido actualizado correctamente.');
    }

    /**
     * *Eliminar el evento del sistema
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $event = Event::find($id)->delete();
        } catch (Exception $ex) {

            return redirect()->route('admin.ong.event.index')
                ->with('fail', 'El evento no ha sido eliminado, ha producido un error');
        }

        return redirect()->route('admin.ong.event.index')
            ->with('success', 'El evento ha sido eliminado');
    }

    /**
     * *Eliminar el participante que esta vinculado con el evento
     */
    public function destroyParticipante($id)
    {
        $participante = EventsUser::query();
        $participante->where('idEvent', '=', $id)
            ->where('idUser', '=', Auth::user()->id);
        $participante->delete();

        return back()->with('success-events', 'Ya no participa en ese Evento');
    }

    /**
     * *BUSCADOR: donde se va a filtrar los eventos de la aplicacion principal
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

        $idONG = $request->id_ONG;

        $tipos = Type::all();
        $organisation = Organisation::all();

        //Si ha selecionado que ordene por distancia, comprobamos que tenemos la ubicacion deseada del cliente
        if ($order == "1" && ($lat == null || $lon == null)) {
            return back()->with('error', 'Si desea ordenar por distancia, debe indicar ubicacion')->withInput();
        }

        $events = Event::where("Visible", "=", "1")
            ->Organisation($idONG)
            ->FechaEvento($fecha)
            ->where('Nombre', 'LIKE', "%$nombre%")
            ->Tematica($type)
            ->Localidad($lat, $lon, $radio)
            ->Ordenacion($order)
            ->paginate(7)->withQueryString();

        return view('event.index', compact('events', 'tipos', 'request', 'organisation'));
    }

    /**
     * *Donde muestra los voluntarios apuntados a un evento
     */
    function showUsersEvent(Event $id)
    {
        $userAuth = Auth::user();

        if ($userAuth->id_ONG != $id->id_ONG) {
            if (($userAuth->Role < 4)) {
                abort(404);
            }
        }

        $event = $id;

        $users = $event->usuarios()->paginate(10);

        return view('admin.user.indexUsersEvent', compact('event', 'users','userAuth'));
    }

    /**
     * *Donde se elimina la participacion del evento mediante por ADMINISTRACION
     */
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

    /**
     * *Donde se recibe la cantidad donacion para un evento y actualizar el contador de APORTACIONES
     * Como futura aportacion, uso de la pasarela de PAYPAL con una tabla en BBDD para tener el registro
     */
    public function aportacionEvent(Request $request, Event $id)
    {
        $donacion = $request->donative;

        if (!is_numeric($donacion)) {
            return back()->with("fail", "La cantidad introducida debe ser numerica");
        }

        if ($donacion <= 0) {
            return back()->with("fail", "La cantidad introducida no puede ser menos o igual a 0");
        }

        try {
            $id->Aportaciones += $donacion;

            $id->save();
        } catch (Exception) {
            return back()->with("fail", "Ha habido un error en el proceso");
        }

        return back()->with("success", "Has aportado {$donacion}€ a este evento ¡Gracias!");
    }
}
