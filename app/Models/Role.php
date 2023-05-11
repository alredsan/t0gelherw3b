<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property $idRol
 * @property $NombreRol
 *
 * @property UsersRole[] $usersRoles
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Role extends Model
{

    static $rules = [
		'idRol' => 'required',
		'NombreRol' => 'required',
    ];


    protected $table = 'roles';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idRol','NombreRol'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersRoles()
    {
        return $this->belongsToMany(User::class,'users_roles', 'idRol', 'idRol');
    }


}
