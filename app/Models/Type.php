<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Type
 *
 * @property $idtypeONG
 * @property $Nombre
 *
 * @property EventsType[] $eventsTypes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Type extends Model
{

    static $rules = [
		'Nombre' => ['required','min:3','max:45'],
    ];

    protected $perPage = 20;
    protected $table = 'types';
    protected $primaryKey = 'idtypeONG';
    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idtypeONG','Nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventsTypes()
    {
        return $this->hasMany('App\Models\EventsType', 'idType', 'idtypeONG');
    }


}
