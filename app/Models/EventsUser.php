<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsUser extends Model
{
    use HasFactory;

    protected $table = 'events_users';

    static $rules = [
		'idEvent' => 'required',
		'idUser' => 'required',

    ];

    protected $perPage = 20;
    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idEvent','idUser'];

}
