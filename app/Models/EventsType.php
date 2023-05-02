<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsType extends Model
{
    use HasFactory;

    protected $table = 'events_types';
    protected $primaryKey = 'idEvento';
    public $timestamps = false;
}
