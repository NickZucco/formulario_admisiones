<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\Estudio as Estudio;
use App\Pais as Pais;
use App\ProgramaPosgrado as ProgramaPosgrado;
use App\NivelEstudio as NivelEstudio;

class EstudioController extends Controller {

    public function show_info($msg = null) {
		$aspirante_id = Auth::user()->id;
		$count = $this->contar_registros($aspirante_id);
		$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
			'programa_posgrado.id')
			->select('programa_posgrado.nombre as nombre')
			->where('aspirantes.id', '=', $aspirante_id)
			->get();
        $user_email = Auth::user()->email;

        $estudios = Estudio::join('nivel_estudio', 'estudios.nivel_estudio_id', '=', 'nivel_estudio.id')
			->select(
				'estudios.institucion as institucion',
				'estudios.titulo as titulo',
				'nivel_estudio.nombre as nivel',
				'estudios.otro_nivel_estudio as otro_nivel',
				'estudios.fecha_inicio as fecha_inicio',
				'estudios.fecha_finalizacion as fecha_finalizacion',
				'estudios.ruta_adjunto as ruta_adjunto',
				'estudios.ruta_entramite_minedu as ruta_entramite_minedu',
				'estudios.ruta_res_convalidacion as ruta_res_convalidacion'
			)->where('estudios.aspirantes_id', '=', $aspirante_id)->get();
        
        $paises = Pais::orderBy('nombre')->get();
		$niveles = NivelEstudio::all();
        $data = array(
            'aspirante_id' => $aspirante_id,
            'estudios' => $estudios,
			'programa_seleccionado' => $programa_seleccionado,
            'paises' => $paises,
			'niveles' => $niveles,
            'msg' => $msg,
			'count' => $count
        );
        return view('estudio', $data);
    }

    public function insert() {
        $input = Input::all();
        $msg = null;
		$id = Auth::user()->id;
		
		//Verificamos si el nivel de estudio no sea Otro
		if ($input['nivel_estudio_id']!=6) {
			unset($input['otro_nivel_estudio']);
		}
		
		//Verificamos si el programa está en curso para no tener en cuenta la fecha de finalización
		//También se remueven posibles adjuntos que hayan quedado cargados en el formulario
		if ($input['en_curso']==1) {
			unset($input['fecha_finalizacion']);
			unset($input['adjunto_entramite_minedu']);
			unset($input['adjunto_res_convalidacion']);
		}
		//El programa no está en curso
		else {
			//Si el país seleccionado es Colombia
			if ($input['paises_id']==57) {
				//Eliminamos los soportes ante MinEdu
				unset($input['adjunto_entramite_minedu']);
				unset($input['adjunto_res_convalidacion']);
			}
			//Si el país seleccionado es otro distinto a Colombia
			else {
				//Eliminamos el adjunto que no fue seleccionado entre las dos opciones de documentos
				//ante el MinEdu
				if ($input['additional_attatchments'] == 'adjunto_res_convalidacion') {
					unset($input['adjunto_entramite_minedu']);
				}
				else unset($input['adjunto_res_convalidacion']);
			}
		}
		
        //Quitamos el radiobutton (al tener nombre se envia con el formulario)
        unset($input['additional_attatchments']);
		
        //Efectuamos las operaciones sobre los archivos adjuntos
		$aleatorio = rand(111111, 999999);
		$titulo = substr($input['titulo'], 0, 12);
		$titulo = $titulo . $aleatorio;
		$titulo = str_replace(' ', '_', $titulo);
		//Guardamos el adjunto de soporte si existe
		if (isset($input['adjunto'])) {
			$file = Input::file('adjunto');
			//$titulo = str_replace(' ', '_', $input['titulo']) . '_' . str_replace(' ', '_', $input['institucion']);
			$file->move(public_path() . '/file/' . $id . '/estudios/' , $titulo . '_soporte.pdf');
			
			$input['ruta_adjunto'] = 'file/' . $id . '/estudios/' . $titulo . '_soporte.pdf';
			unset($input['adjunto']);
		}
		
        //Guardamos el soporte de tramite ante el Min Edu si existe
        if (isset($input['adjunto_entramite_minedu'])) {
			$file = Input::file('adjunto_entramite_minedu');
			//$titulo = str_replace(' ', '_', $input['titulo']);
			$file->move(public_path() . '/file/' . $id . '/estudios/' , $titulo . '_entramite.pdf');
			
			$input['ruta_entramite_minedu'] = 'file/' . $id . '/estudios/' . $titulo . '_entramite.pdf';
			unset($input['adjunto_entramite_minedu']);
        }
		
        //Guardamos la resolución de convalidación del MinEdu para el título internacional si existe
        if (isset($input['adjunto_res_convalidacion'])) {
			$file = Input::file('adjunto_res_convalidacion');
			//$titulo = str_replace(' ', '_', $input['titulo']);
			$file->move(public_path() . '/file/' . $id . '/estudios/' , $titulo . '_convalidacion.pdf');
			
			$input['ruta_res_convalidacion'] = 'file/' . $id . '/estudios/' . $titulo . '_convalidacion.pdf';
			unset($input['adjunto_res_convalidacion']);
        }

        //Guardamos los datos
        $input['aspirantes_id'] = $id;
        $estudio = Estudio::create($input);
        if ($estudio->save()) {
            return $this->show_info("Se ingresó exitosamente la información de estudios.");
        }
    }

    public function delete() {
        $input = Input::all();
        $estudio = Estudio::find($input["id"]);
		
		if ($estudio->ruta_adjunto) {			
			Storage::delete($estudio->ruta_adjunto);
		}
		if ($estudio->ruta_entramite_minedu) {
			Storage::delete($estudio->ruta_entramite_minedu);
		}
		if ($estudio->ruta_res_convalidacion) {
			Storage::delete($estudio->ruta_res_convalidacion);
		}
		
        //Borramos el registro en base de datos
        if ($estudio->delete()) {
            return $this->show_info("Se borró la información de estudio.");
        }
    }
}
