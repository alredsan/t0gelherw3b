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
		'name' => ['required','min:3','max:255'],
		'Apellidos' => ['required','min:3','max:60'],
		'email' => 'required|email',
		'Direccion' => ['required','min:3','max:60'],
		'ProvinciaLocalidad' => ['required','min:3','max:45'],
		'Telefono' => ['required','regex:/[+]{0,1}[0-9]{10,12}|[0-9]{9}$/'],
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organisation()
    {
        return $this->hasOne('App\Models\Organisation', 'idONG', 'id_ONG');
    }

    public function rol()
    {
        return $this->hasOne(Role::class, 'idRol', 'Role');
    }

    public function eventos(){
        return $this->belongsToMany('App\Models\Event','events_users','idUser','idEvent','id','idEvento')->orderBy('FechaEvento','DESC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function eventsUsers()
    // {
    //     return $this->hasMany('App\Models\EventsUser', 'idUser', 'id');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function usersRole()
    // {
    //     return $this->belongsToMany(Role::class,'users_roles', 'idUser', 'idRol','id','idRol');
    // }

    // public function eventosUser(){
    //     // return $this->belongsToMany(Event::class,'events_users');
    //     return $this->belongsToMany('App\Models\Event','events_users','idUser','idEvent','id','idEvento')->where("Visible","=","1");
    // }

    // public function roles($id){

    //     $array = $this->belongsToMany('App\Models\Role','users_roles','idUser','idRol','id','idRol')->wherePivot('idRol', $id)->count();

    //     if ($array == 0){
    //         return false;
    //     }else{
    //         return true;
    //     }
    // }

    // public function eventosPaginate(){
    //     return $this->eventos()->paginate(10);
    // }

}
