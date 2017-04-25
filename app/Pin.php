<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model {

    protected $table = 'pines';
    protected $filltable = array('*');
    protected $guarded = array('_token');
    
    public $timestamps = false;

}
