<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\Idioma as Idioma;
use App\IdiomaCertificado as IdiomaCertificado;
use App\ProgramaPosgrado as ProgramaPosgrado;



class IdiomaCertificadoController extends Controller
{
    public function show_info($msg = null) {
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		
		$nivel_programa = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
			'programa_posgrado.id')
			->select('programa_posgrado.nivel_estudio_id as nivel_id')
			->where('aspirantes.id', '=', $aspirante_id)->get();
		$nivel_programa = $nivel_programa[0];
		
        $idiomas = Idioma::all()->keyBy('id');
        $idiomas_certificados=IdiomaCertificado::where('aspirantes_id','=',$aspirante_id)->get()->keyBy('id');
       
        $data = array(
            'aspirante_id' => $aspirante_id,
            'idiomas'=>$idiomas,
            'idiomas_certificados'=>$idiomas_certificados,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
			'nivel_programa' => $nivel_programa,
            'msg' => $msg,
			'count' => $count
        );
        return view('idiomas', $data);
    }

    public function insert() {
        $input = Input::all();
        $id = Auth::user()->id;
		
		$idioma = Idioma::find($input['idiomas_id']);
		
		//Verificamos si es idioma nativo del candidato
		if ($input['nativo']==1) {
			unset($input['nombre_certificado']);
			unset($input['puntaje']);
			unset($input['marco_referencia']);
		}
        
		$aleatorio = rand(111111, 999999);
		$titulo = $idioma->nombre . $aleatorio;
        //Guardamos el archivo de soporte de experiencia laboral si existe
		if (isset($input['adjunto'])){
			$file = Input::file('adjunto');
			//$titulo = str_replace(' ', '_', $input['nombre_certificado']) . '_' . str_replace(' ', '_', $input['puntaje']);
			$file->move(public_path() . '/file/' . $id . '/idiomas/' , $titulo . '.pdf');
			
			$input['ruta_adjunto'] = 'file/' . $id . '/idiomas/' . $titulo . '.pdf';
			unset($input['adjunto']);			
		}

		$input['aspirantes_id'] = $id;
        $idiomas_certificado = IdiomaCertificado::create($input);
        if ($idiomas_certificado->save()) {
            return $this->show_info("Se ingresó la información de idioma.");
        }
    }
    
    public function delete(){
        $input = Input::all();
        $idiomas_certificado=IdiomaCertificado::find($input["id"]);
		
		if ($idiomas_certificado->ruta_adjunto) {			
			Storage::delete($idiomas_certificado->ruta_adjunto);
		}
        if($idiomas_certificado->delete()){
            return $this->show_info("Se borró la información de idioma.");
        }
    }
}
