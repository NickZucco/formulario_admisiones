<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\Pais as Pais;
use App\ExperienciaDocente as ExperienciaDocente;
use App\TipoVinculacionDocente as TipoVinculacionDocente;
use App\ProgramaPosgrado as ProgramaPosgrado;

class ExperienciaDocenteController extends Controller {

    public function show_info($msg = null) {
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		
        $user_email = Auth::user()->email;

        $experiencias_docente_info = ExperienciaDocente::where('aspirantes_id', '=', $aspirante_id)->get();
        $tipos_vinculacion_docente = TipoVinculacionDocente::all();
        $paises = Pais::all();
        
        //Si no hay entrada de adjunto válida, se crea una entrada con el id de usuario, por lo tanto, cambiamos el enlace para no mostrar esta información
        foreach ($experiencias_docente_info as $cur_key=>$cur_value) {
            if (preg_match("/^[0-9]+$/", $cur_value["ruta_adjunto"])) {            //La expresión regular para los ids autonuméricos
                $experiencias_docente_info[$cur_key]["ruta_adjunto"]=null;
            }
        }

        $data = array(
            'aspirante_id' => $aspirante_id,
            'experiencias_docente' => $experiencias_docente_info,
            'tipos_vinculacion_docente' => $tipos_vinculacion_docente,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
            'paises' => $paises,
            'msg' => $msg,
			'count' => $count
        );
        return view('experiencia_docente', $data);
    }

    public function insert() {
        $input = Input::all();
        $id = Auth::user()->id;
		
		//Verificamos si la vinculación está en curso para no tener en cuenta la fecha de finalización
		if ($input['en_curso']==1) {
			unset($input['fecha_finalizacion']);
		}
		
		$aleatorio = rand(111111, 999999);
		$titulo = substr($input['nombre_institucion'], 0, 12);
		$titulo = $titulo . $aleatorio;
		$titulo = str_replace(' ', '_', $titulo);
		
        //Guardamos el archivo de soporte de experiencia docente si existe
		$file = Input::file('adjunto');
		$file->move(public_path() . '/file/' . $id . '/experiencia_docente/' , $titulo . '.pdf');
		$input['ruta_adjunto'] = 'file/' . $id . '/experiencia_docente/' . $titulo . '.pdf';
		unset($input['adjunto']);            
		
        //Adaptamos el campo info_asignaturas (es un array, lo volvemos JSON y lo guardamos en la BD)
        $input['info_asignaturas'] = json_encode(self::transpose($input['info_asignaturas']));
		$input['aspirantes_id'] = $id;
        $experiencia_docente = ExperienciaDocente::create($input);
        if ($experiencia_docente->save()) {
            return $this->show_info("Se ingresó exitosamente la información de experiencia docente.");
        }
    }

    public function delete() {
        $input = Input::all();
        $vinculacion = ExperienciaDocente::find($input["id"]);
		
		if ($vinculacion->ruta_adjunto) {			
			Storage::delete($vinculacion->ruta_adjunto);
		}
        if ($vinculacion && $vinculacion->delete()) {
            return $this->show_info("Se borró la información de la experiencia docente.");
        } else {
            return $this->show_info();
        }
    }

    //Solo para PHP 5.6+
    private static function transpose($array) {
        $out = array();
        foreach ($array as $key => $subarr) {
            foreach ($subarr as $subkey => $subvalue) {
                $out[$subkey][$key] = $subvalue;
            }
        }
        return $out;
    }

}
