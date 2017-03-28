<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\Aspirante as Aspirante;
use App\ProgramaPosgrado as ProgramaPosgrado;
use App\Pais as Pais;

class ReferenciasPersonalesController extends Controller
{
    public function show_info($msg = null)
    {
        $data = array();
        try {
            $aspirante_id = Auth::user()->id;
            //Contamos la cantidad de registros de cada tipo de formulario para visualizarlos en las pestañas
            //de la plantilla (main.blade.php)
            $count = array();
            $count['estudio'] = DB::table('estudios')->where('aspirantes_id', $aspirante_id)->count();
            $count['distincion'] = DB::table('distinciones_academica')->where('aspirantes_id', $aspirante_id)->count();
            $count['laboral'] = DB::table('experiencias_laboral')->where('aspirantes_id', $aspirante_id)->count();
            $count['docente'] = DB::table('experiencias_docente')->where('aspirantes_id', $aspirante_id)->count();
            $count['investigativa'] = DB::table('experiencias_investigativa')->where('aspirantes_id', $aspirante_id)->count();
            $count['produccion'] = DB::table('produccion_intelectual')->where('aspirantes_id', $aspirante_id)->count();
            $count['idioma'] = DB::table('idiomas_certificado')->where('aspirantes_id', $aspirante_id)->count();
            $programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
                'programa_posgrado.id')
                ->select('programa_posgrado.nombre as nombre')
                ->where('aspirantes.id', '=', $aspirante_id)
                ->get();
            $paises = Pais::orderBy('nombre')->get();
        } catch (ErrorException $e) {
            $msg = "Error";
        } finally {
            $data = array(
                'id' => $aspirante_id,
                'msg' => $msg,
                'programa_seleccionado' => $programa_seleccionado,
                'paises' => $paises,
                'count' => $count
            );
            return view('referencias_personales', $data);
        }
    }
}