<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Auth;
use DB;
use App\Aspirante as Aspirante;
use App\TipoDocumento as TipoDocumento;
use App\Pais as Pais;
use App\EstadoCivil as EstadoCivil;
use App\ProgramaPosgrado as ProgramaPosgrado;
use App\Financiacion as Financiacion;

class AspiranteController extends Controller {

    public function show_info($msg = null) {
        $data = array();

		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		
		$user = Auth::user();
		$candidate_info = Aspirante::where('correo', '=', $user->email)->first();
		$tipos_documento = TipoDocumento::all();
		$paises = Pais::orderBy('nombre')->get();
		$estados_civiles = EstadoCivil::all();
		if (!$candidate_info) {
			$candidate_info = Aspirante::where('id', '=', 0)->first();
		}
		
		$data = array(
			'id' => $aspirante_id,
			'user' => $user,
			'candidate_info' => $candidate_info,
			'tipos_documento' => $tipos_documento,
			'paises' => $paises,
			'estados_civiles' => $estados_civiles,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
			'msg' => $msg,
			'count' => $count
		);
		return view('aspirante', $data);
    }

    public function insert() {
        $input = Input::all();
		$id = Auth::user()->id;
		//Validar si la cédula ingresada ya se encuentra en la base de datos_personales
		/*$aspirante_cedula = Aspirante::where('documento', $input['documento'])->get();
		$aspirante_cedula = $aspirante_cedula->toArray();
		//dd($aspirante_cedula);
		if(!empty($aspirante_cedula)){
			if ($id != $aspirante_cedula['0']['id']) {
				return redirect()->back()->with('message', 'El número de documento ingresado ya se encuentra en la base de datos');
			}
		}*/
        
        $input['id'] = $id;
        $record = Aspirante::find($id);

        if ($record) {
			//Efectuamos las operaciones sobre los archivos adjuntos
			//Borramos y guardamos nuevamente el soporte del documento de identidad si existe
			if (isset($input['adjunto_documento'])) {
				Storage::delete($record->ruta_adjunto_documento);
			
				$file = Input::file('adjunto_documento');
				$file->move(public_path() . '/file/' . $id . '/datos_personales/' , 'documento_identidad.pdf');
				
				$input['ruta_adjunto_documento'] = 'file/' . $id . '/datos_personales/' . 'documento_identidad.pdf';
				unset($input['adjunto_documento']);
			}
			
			//Borramos y guardamos nuevamente el soporte de la tarjeta profesional si existe
			if (isset($input['adjunto_tarjetaprofesional'])) {
				if ($record->ruta_adjunto_tarjetaprofesional){					
					Storage::delete($record->ruta_adjunto_tarjetaprofesional);
				}
				$file = Input::file('adjunto_tarjetaprofesional');
				$file->move(public_path() . '/file/' . $id . '/datos_personales/' , 'tarjeta_profesional.pdf');
				
				$input['ruta_adjunto_tarjetaprofesional'] = 'file/' . $id . '/datos_personales/' . 'tarjeta_profesional.pdf';
				unset($input['adjunto_tarjetaprofesional']);
			}
			
            $record->fill($input);
            $record->save();
            return redirect('programas');
        }
		else {
			//Efectuamos las operaciones sobre los archivos adjuntos
			//Guardamos el soporte del documento de identidad (es obligatorio)
			$file = Input::file('adjunto_documento');
			$file->move(public_path() . '/file/' . $id . '/datos_personales/' , 'documento_identidad.pdf');
			
			$input['ruta_adjunto_documento'] = 'file/' . $id . '/datos_personales/' . 'documento_identidad.pdf';
			unset($input['adjunto_documento']);
			
			//Guardamos el documento de soporte de la tarjeta profesional si existe
			if (isset($input['adjunto_tarjetaprofesional'])) {
				$file = Input::file('adjunto_tarjetaprofesional');
				$file->move(public_path() . '/file/' . $id . '/datos_personales/' , 'tarjeta_profesional.pdf');
				
				$input['ruta_adjunto_tarjetaprofesional'] = 'file/' . $id . '/datos_personales/' . 'tarjeta_profesional.pdf';
				unset($input['adjunto_tarjetaprofesional']);
			}
            Aspirante::create($input);
            return redirect('programas');
        }
    }
	
	//Función que reune los datos necesarios para la vista 'programas' y se los pasa a ésta
	public function showPrograms() {
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		$programa_completo = ProgramaPosgrado::join('area_curricular', 'area_curricular.id',
				'=', 'programa_posgrado.area_curricular_id')
			->join('aspirantes', 'aspirantes.programa_posgrado_id', '=', 'programa_posgrado.id')
			->select(
				'programa_posgrado.nombre as programa',
				'area_curricular.nombre as area_curricular'
			)->where('aspirantes.id', '=', $aspirante_id)->first();
		
		$msg=null;
		$data = array(
            'programa_completo' => $programa_completo,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
            'msg' => $msg,
			'count' => $count
        );
        return view('programas', $data);	
	}
	
	//Función que guarda el programa de posgrado seleccionado por el usuario
	//No se requiere para el proceso de admisión a posgrados, pero puede usarse en el futuro
	//Para usar correctamente esta función debe también utilizarse el archivo programas.blade.php en la raíz
	//del proyecto
	/*public function saveProgram() {
		$input = Input::all();
		//Encontramos el registro del aspirante en la DB
        $id = Auth::user()->id;
		$aspirante = Aspirante::find($id);
		//Programa seleccionado en el formulario por el usuario
		$programa_seleccionado = $input['programa'];
		//Si el usuario ha seleccionado un programa diferente al que tenía, entonces debemos borrar los documentos
		//requeridos que se hayan subido previamente y borrar los campos correspondientes del registro del aspirante
		//en la tabla aspirantes.
		if($aspirante->programa_posgrado_id != $programa_seleccionado) {
			if ($aspirante->ruta_carta_motivacion) {			
				Storage::delete($aspirante->ruta_carta_motivacion);
				$aspirante->ruta_carta_motivacion = null;
			}
			if ($aspirante->ruta_propuesta) {
				Storage::delete($aspirante->ruta_propuesta);
				$aspirante->ruta_propuesta = null;
			}
			if ($aspirante->ruta_propuesta_avanzada) {
				Storage::delete($aspirante->ruta_propuesta_avanzada);
				$aspirante->ruta_propuesta_avanzada = null;
			}
			if ($aspirante->ruta_carta_profesor) {
				Storage::delete($aspirante->ruta_carta_profesor);
				$aspirante->ruta_carta_profesor = null;
			}
		}
		//Guardamos el id del programa seleccionado en el registro del aspirante
		$aspirante->programa_posgrado_id = $programa_seleccionado;
		$aspirante->save();
		return redirect('especificos');
	}*/
	
	public function showDocuments() {
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		$aspirante = Aspirante::find($aspirante_id);
		$financiacion = Financiacion::where('aspirantes_id', '=', $aspirante_id)->first();
		if (!$financiacion) {
			$financiacion = new Financiacion;
			$financiacion->tipo_financiacion = '';
			$financiacion->otra_financiacion = '';
			$financiacion->entidad_financiacion = '';
		}
		$programas_posgrado = ProgramaPosgrado::orderBy('id')->get();

		$msg=null;
		$data = array(
			'aspirante' => $aspirante,
            'programas_posgrado' => $programas_posgrado,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
			'financiacion' => $financiacion,
            'msg' => $msg,
			'count' => $count
        );
		//dd($data);
        return view('especificos', $data);	
	}
	
	//Función que ingresa a la DB la información sobre la financiación del aspirante y carga los documentos específicos
	//que son solicitados dependiendo del programa de posgrado elegido
	public function insertDocument() {
		//Insertamos la información de financiación
		$input = Input::all();
		$id = Auth::user()->id;
		$msg = "";
		$financiacion = Financiacion::where('aspirantes_id', '=', $id)->first();
		
		if ($financiacion) {
			//Actualizamos la información existente
			$tipo_financiacion = $input['tipo_financiacion'];
			$financiacion->tipo_financiacion = $tipo_financiacion;
			if ($tipo_financiacion == 'Recursos propios') {
				$financiacion->otra_financiacion = null;
				$financiacion->entidad_financiacion = null;
			}
			else if ($tipo_financiacion == 'Otro') {
				$financiacion->otra_financiacion = $input['otra_financiacion'];
				$financiacion->entidad_financiacion = $input['entidad_financiacion'];
			}
			else {
				$financiacion->otra_financiacion = null;
				$financiacion->entidad_financiacion = $input['entidad_financiacion'];
			}
			$financiacion->save();
			$msg = $msg . "Se actualizó correctamente la información de financiación. ";
		}
		else {
			$financiacion = new Financiacion;
			$tipo_financiacion = $input['tipo_financiacion'];
			$financiacion->tipo_financiacion = $tipo_financiacion;
			if ($tipo_financiacion == 'Recursos propios') {
				$financiacion->otra_financiacion = null;
				$financiacion->entidad_financiacion = null;
			}
			else if ($tipo_financiacion == 'Otro') {
				$financiacion->otra_financiacion = $input['otra_financiacion'];
				$financiacion->entidad_financiacion = $input['entidad_financiacion'];
			}
			else {
				$financiacion->otra_financiacion = null;
				$financiacion->entidad_financiacion = $input['entidad_financiacion'];
			}
			$financiacion->aspirantes_id = $id;
			$financiacion->save();
			$msg = $msg . "Se creó correctamente la información de financiación. ";
		}
		
		//Guardamos los archivos adjuntos que haya subido el aspirante.
		$aspirante = Aspirante::find($id);
		if (isset($input['carta_motivacion'])) {
			$file = Input::file('carta_motivacion');
			$titulo = 'Carta_motivacion_' . $aspirante->nombre . '_' . $aspirante->apellido;
			$file->move(public_path() . '/file/' . $id . '/especificos/' , $titulo . '.pdf');
			$ruta_carta_motivacion = 'file/' . $id . '/especificos/' . $titulo . '.pdf';
			$aspirante->ruta_carta_motivacion = $ruta_carta_motivacion;
			$aspirante->save();
		}
		if (isset($input['propuesta'])) {
			$file = Input::file('propuesta');
			$titulo = 'Propuesta_' . $aspirante->nombre . '_' . $aspirante->apellido;
			$file->move(public_path() . '/file/' . $id . '/especificos/' , $titulo . '.pdf');
			$ruta_propuesta = 'file/' . $id . '/especificos/' . $titulo . '.pdf';
			$aspirante->ruta_propuesta = $ruta_propuesta;
			$aspirante->save();
		}
		if (isset($input['propuesta_avanzada'])) {
			$file = Input::file('propuesta_avanzada');
			$titulo = 'Propuesta_avanzada_' . $aspirante->nombre . '_' . $aspirante->apellido;
			$file->move(public_path() . '/file/' . $id . '/especificos/' , $titulo . '.pdf');
			$ruta_propuesta_avanzada = 'file/' . $id . '/especificos/' . $titulo . '.pdf';
			$aspirante->ruta_propuesta_avanzada = $ruta_propuesta_avanzada;
			$aspirante->save();
		}
		if (isset($input['carta_profesor'])) {
			$file = Input::file('carta_profesor');
			$titulo = 'Carta_profesor_' . $aspirante->nombre . '_' . $aspirante->apellido;
			$file->move(public_path() . '/file/' . $id . '/especificos/' , $titulo . '.pdf');
			$ruta_carta_profesor = 'file/' . $id . '/especificos/' . $titulo . '.pdf';
			$aspirante->ruta_carta_profesor = $ruta_carta_profesor;
			$aspirante->save();
		}
		$msg = $msg . "Se adjuntaron correctamente los documentos cargados";
		return $this->showDocuments();
	}
	
	public function summary(){
		$aspirante_id = Auth::user()->id;
		$main_data = $this->getData($aspirante_id);
		$count = $main_data[0];
		$programa_seleccionado = $main_data[1];
		$correo_area = $main_data[2];
		
		$msg=null;
		$data = array(
			'id' => $aspirante_id,
			'programa_seleccionado' => $programa_seleccionado,
			'correo_area' => $correo_area,
            'msg' => $msg,
			'count' => $count
        );
        return view('resumen', $data);	
	}

}
