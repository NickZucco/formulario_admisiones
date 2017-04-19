<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Request;
use Auth;
use DB;
use App\Aspirante as Aspirante;
use App\ProgramaPosgrado as ProgramaPosgrado;
use App\AreaCurricular as AreaCurricular;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;
		
	protected function getData($aspirante_id){
		//Arreglo para devolver la información recolectada.
		$main_data = array();
		//Contamos la cantidad de registros de cada tipo de formulario para visualizarlos en las pestañas
		//de la plantilla (main.blade.php).
		$count = array();
		$count['estudio'] = DB::table('estudios')->where('aspirantes_id', $aspirante_id)->count();
		$count['distincion'] = DB::table('distinciones_academica')->where('aspirantes_id', $aspirante_id)->count();
		$count['laboral'] = DB::table('experiencias_laboral')->where('aspirantes_id', $aspirante_id)->count();
		$count['docente'] = DB::table('experiencias_docente')->where('aspirantes_id', $aspirante_id)->count();
		$count['investigativa'] = DB::table('experiencias_investigativa')->where('aspirantes_id', $aspirante_id)->count();
		$count['produccion'] = DB::table('produccion_intelectual')->where('aspirantes_id', $aspirante_id)->count();
		$count['idioma'] = DB::table('idiomas_certificado')->where('aspirantes_id', $aspirante_id)->count();
		array_push($main_data, $count);
		//Encontramos el programa seleccionado por el aspirante.
		$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
				'programa_posgrado.id')
			->select('programa_posgrado.id as id', 'programa_posgrado.nombre as nombre' )
			->where('aspirantes.id', '=', $aspirante_id)
			->get();
		array_push($main_data, $programa_seleccionado);
		//Correo del área curricular a cargo del programa del aspirante.
		$correo_area = AreaCurricular::join('programa_posgrado', 'programa_posgrado.area_curricular_id',
				'=', 'area_curricular.id')
			->join('aspirantes', 'aspirantes.programa_posgrado_id', '=', 'programa_posgrado.id')
			->select('area_curricular.correo as correo')
			->where('aspirantes.id', '=', $aspirante_id)->get();
		if($correo_area->isEmpty()) {
			array_push($main_data, '');
		}
		else {
			$correo = $correo_area[0]->correo;
			array_push($main_data, $correo);
		}
		return $main_data;
	}

}
