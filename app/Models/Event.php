<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @property $idEvento
 * @property $id_ONG
 * @property $Nombre
 * @property $Descripcion
 * @property $FechaEvento
 * @property $numMaxVoluntarios
 * @property $Direccion
 * @property $Latitud
 * @property $Longitud
 * @property $Aportaciones
 * @property $Foto
 *
 * @property EventsType $eventsType
 * @property EventsUser $eventsUser
 * @property Organisation $organisation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Event extends Model
{
    //Reglas de vertificacion
    static $rules = [
        'Nombre' => 'required',
        'Descripcion' => 'required',
        'FechaEvento' => 'required',
        'numMaxVoluntarios' => 'required',
        'Direccion' => 'required',
        'Latitud' => 'required',
        'Longitud' => 'required',
        'Aportaciones' => 'required',
        'Foto' => 'image|max:2048',
    ];

    protected $primaryKey = 'idEvento';
    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idEvento', 'id_ONG', 'Nombre', 'Descripcion', 'FechaEvento', 'numMaxVoluntarios', 'Direccion', 'Latitud', 'Longitud', 'Aportaciones', 'Foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventsType()
    {
        // return $this->belongsToMany('App\Models\EventsType','events_types', 'idEvento', 'idEvento');
        return $this->belongsToMany(Type::class, 'events_types', 'idEvento', 'idtype');
    }

    public function eventsdeUnType($type)
    {
        // return $this->belongsToMany('App\Models\EventsType','events_types', 'idEvento', 'idEvento');
        return $this->belongsToMany(Type::class, 'events_types', 'idEvento', 'idtype')->wherePivot('idType', $type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventUsers()
    {
        return $this->hasOne('App\Models\EventsUser', 'idEvento', 'idEvento');
    }

    public function eventsUser()
    {
        return $this->hasOne('App\Models\EventsUser', 'idEvento', 'idEvento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organisation()
    {
        return $this->hasOne('App\Models\Organisation', 'idONG', 'id_ONG');
    }

    /**
     * SCOPE CONSULTAS
     */
    //Fecha
    public function scopeFechaEvento($query, $fecha)
    {
        if ($fecha) {
            $fecha_inicio = strtotime($fecha . " 00:00:00");
            $fecha_final = strtotime($fecha . " 23:59:59");

            return $query->whereBetween('FechaEvento', [$fecha_inicio, $fecha_final]);
        } else {
            return $query->where('FechaEvento', '>', time());
        }
    }

    //Tipos
    public function scopeTematica($query, $type)
    {
        if ($type) {
            // $eventstype = EventsType::where('idType','=',$type);

            // return $query->whereIn('idEvento',$eventstype);
            // $events = $this->eventsdeUnType($type);

            return $query->whereHas('eventsType', function ($query) use ($type) {
                $query->where('idtype', $type);
            });
        }
    }

    public function scopeLocalidad($query, $lat, $lon, $radio)
    {
        if ($lat != null && $lon != null) {

            $query = $query->select("*")->selectRaw('(6371 * ACOS(COS(RADIANS(Latitud)) * COS(RADIANS(' . $lat . ')) * COS(RADIANS(' . $lon . ') - RADIANS(Longitud)) + SIN(RADIANS(Latitud)) * SIN(RADIANS(' . $lat . ')))) AS distancia');

            if ($radio != 0) {
                $query = $query->having('distancia', '<=', $radio);
            }

            // $query = $query->orderBy('distancia','DESC');


            return $query;
        }
    }

    public function scopeOrdenacion($query, $type)
    {
        if ($type == '0') {

            return $query->orderBy('FechaEvento', 'ASC');
        }

        if ($type == '1') {

            return $query->orderBy('distancia', 'ASC');
        }

        if ($type == '2') {

            return $query->orderBy('idEvento', 'ASC');
        }

    }

    /**
     * Obtenemos los usuarios que estan apuntando en un evento , a traves de la tabla M-M
     *
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'events_users','idEvent','idUser','idEvento','id')->withPivot('registration_date');
    }
}
