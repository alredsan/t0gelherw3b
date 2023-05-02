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
    protected $fillable = ['idEvento','id_ONG','Nombre','Descripcion','FechaEvento','numMaxVoluntarios','Direccion','Latitud','Longitud','Aportaciones','Foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eventsType()
    {
        // return $this->belongsToMany('App\Models\EventsType','events_types', 'idEvento', 'idEvento');
        return $this->belongsToMany(Type::class,'events_types','idEvento','idtype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
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

    public function scopeFechaEvento($query,$fecha){
        if($fecha){
            $fecha_inicio = strtotime($fecha . " 00:00:00");
            $fecha_final = strtotime($fecha . " 23:59:59");

            return $query->whereBetween('FechaEvento',[$fecha_inicio,$fecha_final]);
        }
    }

    public function usuarios(){
        return $this->belongsToMany(User::class,'events_users');
    }


}
