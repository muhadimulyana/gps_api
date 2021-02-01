<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    protected $table = 'gps_markers';
    public $timestamps = false;
    protected $fillable = ['id', 'place', 'lat',' lng', 'user'];
}