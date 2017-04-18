<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
     protected $table = 'aspirantes';
     protected $filltable = array('*');     
     protected $guarded = array('_token');

    public function referencias() {
        return $this->hasManyThrough(
            'App\Referencia', 'App\AspiranteReferencia',
            'aspirantes_id','referencias_id', 'id'
        );
    }

    public function estudios(){
         return $this->hasMany('App\Estudio');
     }
}
