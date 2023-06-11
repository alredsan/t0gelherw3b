<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class EventUserController extends Controller
{
    /**
     * *Donde se realiza la peticion por AJAX del cliente para apuntarse al evento
     * y devuelve en JSON para su tratamiento correcto
     */
    public function add($idEvent)
    {

        $event = Event::find($idEvent);

        $particiantes = EventsUser::where('idEvent', $idEvent)->count();

        //Creamos una clase generica para crear un JSON de envio
        $result = new stdClass();

        //Comprobamos que tiene la sesión iniciada
        if (Auth::user() == null) {
            //En caso que no tiene sesion, envio respuesta
            $result->message = "Inicia Sesion para apuntarse";
            $result->status = "error";
            return json_encode($result);
        }

        //Comprobamos si existe el usuario registrado en el evento
        $userExistInEvent = EventsUser::where('idUser','=',Auth::user()->id)
                            ->where('idEvent','=',$idEvent)->first();


        if($userExistInEvent != null){
            //El usuario ya esta apuntado en el evento
            $result->message = "Ya estas apuntado";
            $result->status = "error";
            return json_encode($result);
        }

        if ($event->numMaxVoluntarios > $particiantes) {
            //Comprobamos el limite de voluntarios permitido
            //Creamos nuevo obj de EventsUser para registar la participacion
            $nuevoRegistro = new EventsUser();

            $nuevoRegistro->idEvent = $idEvent;
            $nuevoRegistro->idUser = Auth::user()->id;
            $nuevoRegistro->registration_date = time();

            $nuevoRegistro->save();
            //Devolvemos el mensaje correcto y nuevo numero de voluntarios restantes para actualizar el numero
            $result->message = "Has sido registrado correctamente";
            $result->status = "success";
            $result->newNum = $event->numMaxVoluntarios - $particiantes - 1;
        } else {
            //Se ha superado el numero permitido
            $result->message = "No se ha podido registrar";
            $result->status = "error";
        }


        return json_encode($result);
    }
}
