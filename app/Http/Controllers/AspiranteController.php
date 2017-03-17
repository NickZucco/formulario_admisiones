<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use App\Aspirante as Aspirante;
use App\TipoDocumento as TipoDocumento;
use App\Pais as Pais;
use App\EstadoCivil as EstadoCivil;
use App\ProgramaPosgrado as ProgramaPosgrado;

class AspiranteController extends Controller {

    public function show_info($msg = null) {
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
			
            $user_email = Auth::user()->email;

            $candidate_info = Aspirante::where('correo', '=', $user_email)->first();

            $tipos_documento = TipoDocumento::all();
            $paises = Pais::orderBy('nombre')->get();
            $estados_civiles = EstadoCivil::all();
			$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
				'programa_posgrado.id')
				->select('programa_posgrado.nombre as nombre')
				->where('aspirantes.id', '=', $aspirante_id)
				->get();

            if (!$candidate_info) {
                $candidate_info = Aspirante::where('id', '=', 0)->first();
            }
        } catch (ErrorException $e) {
            $msg = "Ocurrió un error recopilando su información personal. Se recomienda cerrar sesión y abrirla nuevamente.";
        } finally {

            $data = array(
                'id' => $aspirante_id,
                'correo' => $user_email,
                'candidate_info' => $candidate_info,
                'tipos_documento' => $tipos_documento,
                'paises' => $paises,
                'estados_civiles' => $estados_civiles,
				'programa_seleccionado' => $programa_seleccionado,
                'msg' => $msg,
				'count' => $count
            );
            return view('aspirante', $data);
        }
    }

    public function insert() {
        $input = Input::all();
		$id = Auth::user()->id;
		
		//Validar si la cédula ingresada ya se encuentra en la base de datos_personales
		$aspirante_cedula = Aspirante::where('documento', $input['documento'])->get();
		$aspirante_cedula = $aspirante_cedula->toArray();
		//dd($aspirante_cedula);
		if(!empty($aspirante_cedula)){
			if ($id != $aspirante_cedula['0']['id']) {
				return redirect()->back()->with('message', 'El número de documento ingresado ya se encuentra en la base de datos');
			}
		}
        
        $input['id'] = $id;
        $record = Aspirante::find($id);

        if ($record) {
			//Efectuamos las operaciones sobre los archivos adjuntos
			//Borramos y guardamos nuevamente el soporte del documento de identidad
			Storage::delete($record->ruta_adjunto_documento);
			
			$file = Input::file('adjunto_documento');
			$file->move(public_path() . '/file/' . $id . '/datos_personales/' , 'documento_identidad.pdf');
			
			$input['ruta_adjunto_documento'] = 'file/' . $id . '/datos_personales/' . 'documento_identidad.pdf';
			unset($input['adjunto_documento']);
			
			//Borramos y guardamos nuevamente el soporte de la tarjeta profesional
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
		
		$areas_curriculares = DB::table('area_curricular')->orderBy('id')->get();
		$programas_posgrado = ProgramaPosgrado::orderBy('id')->get();
		$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
			'programa_posgrado.id')
			->select('programa_posgrado.nombre as nombre')
			->where('aspirantes.id', '=', $aspirante_id)
			->get();
		
		$msg=null;
		$data = array(
            'areas_curriculares' => $areas_curriculares,
            'programas_posgrado' => $programas_posgrado,
			'programa_seleccionado' => $programa_seleccionado,
            'msg' => $msg,
			'count' => $count
        );
        return view('programas', $data);	
	}
	
	//Función que guarda el programa de posgrado seleccionado por el usuario
	public function saveProgram() {
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
	}
	
	public function showDocuments() {
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
		$aspirante = Aspirante::find($aspirante_id);
		$programas_posgrado = ProgramaPosgrado::orderBy('id')->get();
		$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
			'programa_posgrado.id')
			->select('programa_posgrado.id as id')
			->where('aspirantes.id', '=', $aspirante_id)
			->get();
		
		$msg=null;
		$data = array(
			'aspirante' => $aspirante,
            'programas_posgrado' => $programas_posgrado,
			'programa_seleccionado' => $programa_seleccionado,
            'msg' => $msg,
			'count' => $count
        );
        return view('especificos', $data);	
	}
	
	public function insertDocument() {
		$input = Input::all();
		$id = Auth::user()->id;
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
		return $this->showDocuments("Se adjuntaron correctamente los documentos cargados");
	}

}
