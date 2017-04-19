<?php
/**
 * Created by PhpStorm.
 * User: mesi
 * Date: 11/04/17
 * Time: 11:53 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use App\Pais as Pais;
use App\Aspirante as Aspirante;
use App\Referencia as Referencia;

class ReferenciasController extends Controller
{
    public function show_candidate_form($msg = null)
    {
        try {
            $aspirante_id = Auth::user()->id;
            $main_data = $this->getData($aspirante_id);
            $count = $main_data[0];
            $programa_seleccionado = $main_data[1];
            $correo_area = $main_data[2];
            $paises = Pais::orderBy('nombre')->get();
        }
        catch (ErrorException $e) {
            $msg = "Error";
        }
        finally {
            $data = array(
                'id' => $aspirante_id,
                'msg' => $msg,
                'programa_seleccionado' => $programa_seleccionado,
                'paises' => $paises,
                'correo_area' => $correo_area,
                'count' => $count
            );
            return view('formulario_referencias', $data);
        }
    }

    public function save_references() {
        $input = Input::all();

        $aspirante = Aspirante::find(Auth::user()->id);

        $referencia1 = new Referencia;
        $referencia1->nombre_de_referencia = $input['nombreApellido1'];
        $referencia1->correo_de_referencia = $input['correo1'];

        $referencia2 = new Referencia;
        $referencia2->nombre_de_referencia = $input['nombreApellido2'];
        $referencia2->correo_de_referencia = $input['correo2'];

        $referencia1->save();
		$referencia2->save();
        //var_dump($referencia1);


//        $data = array(
//            'nombreApellido1' => $referencia1->nombre_de_referencia,
//            'correo1' => $referencia1->correo_de_referencia,
//            'nombreApellido2' => $referencia2->nombre_de_referencia,
//            'correo2' => $referencia2->correo_de_referencia
//        );
//        return view('formulario_referencias', $data);
    }
}