<?php
/**
 * Created by PhpStorm.
 * User: mesi
 * Date: 11/04/17
 * Time: 12:43 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Referencia extends Model
{
    protected $table = 'referencias';
    protected $filltable = array('*');
    protected $guarded = array('_token');

    public function aspirantes() {
        return $this->hasManyThrough(
            'App\Aspirante', 'App\AspiranteReferencia',
            'referencias_id', 'aspirantes_id', 'id'
        );
    }
}