<?php
/**
 * Created by PhpStorm.
 * User: mesi
 * Date: 17/04/17
 * Time: 03:48 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class AspiranteReferencia extends Model
{
    protected $table  = 'aspirantes_referencias';
    protected $fillable = array('*');
    protected $guarded = array('_token');
}