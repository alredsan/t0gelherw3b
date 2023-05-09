<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class EventUserController extends Controller
{
    //
    public function add($idEvent){

        $event = Event::find($idEvent);

        $particiantes = EventsUser::where('idEvent',$idEvent)->count();
        $result = new stdClass();

        if(Auth::user() != null){

            if($event->numMaxVoluntarios > $particiantes){
                $nuevoRegistro = new EventsUser();

                $nuevoRegistro->idEvent = $idEvent;
                $nuevoRegistro->idUser = Auth::user()->id;
                $nuevoRegistro->registration_date = time();

                $nuevoRegistro->save();

                $result->message = "Has sido registrado correctamente";
                $result->status = "success";
                $result->newNum = $event->numMaxVoluntarios-$particiantes-1;


            }else{
                $result->message = "No se ha podido registrar";
                $result->status = "error";

            }

        }else{
            $result->message = "Inicia Sesion para apuntarse";
            $result->status = "error";

        }

        return json_encode($result);

    }
}
