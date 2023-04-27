<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organisation
 *
 * @property $idONG
 * @property $Name
 * @property $DireccionSede
 * @property $Descripcion
 * @property $FechaCreacion
 * @property $IBANmetodoPago
 * @property $FotoLogo
 * @property $eMail
 * @property $Telefono
 *
 * @property Event[] $events
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Organisation extends Model
{

    static $rules = [
		'Name' => 'required',
		'DireccionSede' => 'required',
		'Descripcion' => 'required',
		'FechaCreacion' => 'required',
		'IBANmetodoPago' => 'required',
		'FotoLogo' => 'image|max:2048',
		'eMail' => 'required',
		'Telefono' => 'required',
    ];

    protected $primaryKey = 'idONG';
    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','Name','DireccionSede','Descripcion','FechaCreacion','IBANmetodoPago','FotoLogo','eMail','Telefono'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'id_ONG', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'id_ONG', 'id');
    }


}
