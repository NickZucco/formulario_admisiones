<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaPosgrado extends Model {

    protected $table = 'programa_posgrado';
    protected $filltable = array('*');
    protected $guarded = array('_token');
    public $timestamps = false;

}
