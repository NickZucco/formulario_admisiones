<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Auth;
use DB;
use App\Pais as Pais;
use App\ExperienciaInvestigativa as ExperienciaInvestigativa;
use App\ProgramaPosgrado as ProgramaPosgrado;

class ExperienciaInvestigativaController extends Controller {
    
    public function show_info($msg = null) {
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		
        $user_email = Auth::user()->email;

        $experiencia_investigativa = ExperienciaInvestigativa::where('aspirantes_id', '=', $aspirante_id)->get();
        $paises = Pais::orderBy('nombre')->get();

        $data = array(
            'aspirante_id' => $aspirante_id,
            'experiencias_investigativa' => $experiencia_investigativa,
            'paises' => $paises,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
            'msg' => $msg,
			'count' => $count
        );
        return view('experiencia_investigativa', $data);
    }

    public function insert() {
        $input = Input::all();
        $id = Auth::user()->id;

		//Verificamos si el programa está en curso para no tener en cuenta la fecha de finalización
		if ($input['en_curso']==1) {
			unset($input['fecha_finalizacion']);
		}
		
		//Si el campo de funciones principales está vacío lo ignoramos
		if ($input['funcion_principal']=='') {
			unset($input['funcion_principal']);
		}
		
		//Verificamos si el programa tiene financiación para tener en cuenta la entidad financiadora
		if ($input['financiacion']==0) {
			unset($input['entidad_financiadora']);
		}
		unset($input['financiacion']);
        
		$aleatorio = rand(111111, 999999);
		$titulo = substr($input['nombre_proyecto'], 0, 12);
		$titulo = $titulo . $aleatorio;
		$titulo = str_replace(' ', '_', $titulo);
		
        //Guardamos el archivo de soporte adjunto
		$file = Input::file('adjunto');
		$file->move(public_path() . '/file/' . $id . '/experiencia_investigativa/' , $titulo . '.pdf');
		$input['ruta_adjunto'] = 'file/' . $id . '/experiencia_investigativa/' . $titulo . '.pdf';
		unset($input['adjunto']);		
		
		$input['aspirantes_id'] = $id;
        $experiencia_investigativa = ExperienciaInvestigativa::create($input);
        if ($experiencia_investigativa->save()) {
            return $this->show_info("Se ingresó exitosamente la información de experiencia investigativa.");
        }
    }
    
    public function delete() {
        $input = Input::all();
        $experiencia_investigativa = ExperienciaInvestigativa::find($input["id"]);
		
		if ($experiencia_investigativa->ruta_adjunto) {			
			Storage::delete($experiencia_investigativa->ruta_adjunto);
		}
        if ($experiencia_investigativa->delete()) {
            return $this->show_info("Se borró la información de la experiencia investigativa.");
        }else{
            return $this->show_info();
        }
    }

}
