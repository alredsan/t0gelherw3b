<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 *
 * @property $id
 * @property $DNI
 * @property $name
 * @property $Apellidos
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $Direccion
 * @property $ProvinciaLocalidad
 * @property $Telefono
 * @property $id_ONG
 * @property $Foto
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property EventsUser[] $eventsUsers
 * @property Organisation $organisation
 * @property UsersRole $usersRole
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    protected $table = 'users';

    static $rules = [
		'DNI' => 'required|max:4',
		'name' => 'required',
		'Apellidos' => 'required',
		'email' => 'required',
		'Direccion' => 'required',
		'ProvinciaLocalidad' => 'required',
		'Telefono' => 'required',
        'Foto' => 'image|max:2048'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['DNI','name','Apellidos','email','Direccion','ProvinciaLocalidad','Telefono','id_ONG','Foto'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventsUsers()
    {
        return $this->hasMany('App\Models\EventsUser', 'idUser', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organisation()
    {
        return $this->hasOne('App\Models\Organisation', 'idONG', 'id_ONG');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usersRole()
    {
        return $this->belongsToMany(Role::class,'users_roles', 'idUser', 'idRol','id','idRol');
    }


    public function eventos(){
        // return $this->belongsToMany(Event::class,'events_users');
        return $this->belongsToMany('App\Models\Event','events_users','idUser','idEvent','id','idEvento')->orderBy('FechaEvento','DESC');
    }

    public function eventosUser(){
        // return $this->belongsToMany(Event::class,'events_users');
        return $this->belongsToMany('App\Models\Event','events_users','idUser','idEvent','id','idEvento')->where("Visible","=","1");
    }

    public function roles($id){

        $array = $this->belongsToMany('App\Models\Role','users_roles','idUser','idRol','id','idRol')->wherePivot('idRol', $id)->count();

        if ($array == 0){
            return false;
        }else{
            return true;
        }

        // $obj = array_reduce($array, static function ($carry, $item) {
        //     return $carry === false && $item->id === 'one' ? $item : $carry;
        // }, false);
        // return "hola";
    }

    public function eventosPaginate(){
        return $this->eventos()->paginate(10);
    }

}
