<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Auth;
use DB;
use App\Pais as Pais;
use App\Idioma as Idioma;
use App\ProduccionIntelectual as ProduccionIntelectual;
use App\TipoProduccionIntelectual as TipoProduccionIntelectual;
use App\ProgramaPosgrado as ProgramaPosgrado;

class ProduccionIntelectualController extends Controller {
    
    public function show_info($msg = null) {
		$aspirante_id = Auth::user()->id;
		$count = $this->contar_registros($aspirante_id);
		$programa_seleccionado = ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=',
			'programa_posgrado.id')
			->select('programa_posgrado.nombre as nombre')
			->where('aspirantes.id', '=', $aspirante_id)
			->get();
		
        $user_email = Auth::user()->email;

        $producciones_intelectual = ProduccionIntelectual::where('aspirantes_id', '=', $aspirante_id)->get();
        
        $paises = Pais::orderBy('nombre')->get();
        $idiomas = Idioma::all()->keyBy('id');
        $tipos_produccion_intelectual = TipoProduccionIntelectual::all()->keyBy('id');

        $data = array(
            'aspirantes_id' => $aspirante_id,
            'paises'=>$paises,
            'idiomas'=>$idiomas,
            'tipos_produccion_intelectual' => $tipos_produccion_intelectual,
            'producciones_intelectual' => $producciones_intelectual,
			'programa_seleccionado' => $programa_seleccionado,
            'msg' => $msg,
			'count' => $count
        );
        return view('produccion_intelectual', $data);
    }

    public function insert() {
        $input = Input::all();
        $id = Auth::user()->id;
        
        //Efectuamos las operaciones sobre el archivo
		$aleatorio = rand(111111, 999999);
		$titulo = substr($input['nombre'], 0, 12);
		$titulo = $titulo . $aleatorio;
		$titulo = str_replace(' ', '_', $titulo);
		$file = Input::file('adjunto');
		switch($input['tipos_produccion_intelectual_id']){
			case 1:
				if ($input['volumen']=='') {
					unset($input['volumen']);
				}
				if ($input['clasificacion_revista']=='') {
					unset($input['clasificacion_revista']);
				}
				$titulo = 'Revista_' . $titulo;
				break;
			case 2:
				if ($input['isbn']=='') {
					unset($input['isbn']);
				}
				$titulo = 'Libro_' . $titulo;
				break;
			case 3:
				if ($input['isbn']=='') {
					unset($input['isbn']);
				}
				$titulo = 'Capitulo_' . $titulo;			
				break;
			case 4:
				$titulo = 'Patente_' . $titulo;
				break;
		}
		//dd($input);
		$file->move(public_path() . '/file/' . $id . '/produccion_intelectual/' , $titulo . '.pdf');	
		$input['ruta_adjunto'] = 'file/' . $id . '/produccion_intelectual/' . $titulo . '.pdf';
		unset($input['adjunto']);
		
		$input['aspirantes_id'] = $id;
        $produccion_intelectual = ProduccionIntelectual::create($input);
        if ($produccion_intelectual->save()) {
            return $this->show_info("Se ingresó la información de la producción intelectual.");
        }
    }

    public function delete() {
        $input = Input::all();
        $produccion_intelectual = ProduccionIntelectual::find($input["id"]);
		
		if ($produccion_intelectual->ruta_adjunto) {		
			Storage::delete($produccion_intelectual->ruta_adjunto);
		}
        if ($produccion_intelectual->delete()) {
            return $this->show_info("Se borró la información de la  producción intelectual.");
        }
    }
}
