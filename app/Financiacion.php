<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financiacion extends Model
{
    protected $table = 'financiacion';
    protected $filltable = array('*');
    protected $guarded = array('_token');
    public $timestamps = false;
}
