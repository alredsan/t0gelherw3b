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
        'Nombre' => ['required','min:3','max:80'],
        'Descripcion' => ['required','max:62000'],
        'FechaEvento' => ['required','date'],
        'numMaxVoluntarios' => ['required','gt:1'],
        'Direccion' => ['required','min:3','max:80'],
        'Latitud' => ['required','regex:/^-?(90|[0-8]?\d)(\.\d+)?$/'],
        'Longitud' => ['required','regex:/^-?(180|1[0-7]\d|\d?\d)(\.\d+)?$/'],
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
    protected $fillable = ['idEvento', 'id_ONG', 'Nombre', 'Descripcion', 'FechaEvento', 'numMaxVoluntarios', 'Direccion', 'Latitud', 'Longitud', 'Aportaciones', 'Foto','Visible'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventsType()
    {
        // return $this->belongsToMany('App\Models\EventsType','events_types', 'idEvento', 'idEvento');
        return $this->belongsToMany(Type::class, 'events_types', 'idEvento', 'idtype');
    }

    // public function eventsdeUnType($type)
    // {
    //     // return $this->belongsToMany('App\Models\EventsType','events_types', 'idEvento', 'idEvento');
    //     return $this->belongsToMany(Type::class, 'events_types', 'idEvento', 'idtype')->wherePivot('idType', $type);
    // }

    // public function eventUsers()
    // {
    //     return $this->hasOne('App\Models\EventsUser', 'idEvento', 'idEvento');
    // }

    // public function eventsUser()
    // {
    //     return $this->hasOne('App\Models\EventsUser', 'idEvento', 'idEvento');
    // }

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
    public function scopeOrganisation($query, $idONG)
    {
        if ($idONG) {
            return $query->where('id_ONG',$idONG);
        }
    }

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
            return $query->whereHas('eventsType', function ($query) use ($type) {
                $query->where('idtype', $type);
            });
        }
    }

    //Localidad
    public function scopeLocalidad($query, $lat, $lon, $radio)
    {
        if ($lat != null && $lon != null) {

            $query = $query->select("*")->selectRaw('(6371 * ACOS(COS(RADIANS(Latitud)) * COS(RADIANS(' . $lat . ')) * COS(RADIANS(' . $lon . ') - RADIANS(Longitud)) + SIN(RADIANS(Latitud)) * SIN(RADIANS(' . $lat . ')))) AS distancia');

            if ($radio != 0) {
                $query = $query->having('distancia', '<=', $radio);
            }

            return $query;
        }
    }

    //Ordenacion
    public function scopeOrdenacion($query, $type)
    {
        if ($type == '0') {

            return $query->orderBy('FechaEvento', 'ASC');
        }

        if ($type == '1') {

            return $query->orderBy('distancia', 'ASC');
        }

        if ($type == '2') {

            return $query->orderBy('idEvento', 'DESC');
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
