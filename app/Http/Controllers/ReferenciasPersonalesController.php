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
            $main_data = $this->getData($aspirante_id);
            $count = $main_data[0];
            $programa_seleccionado = $main_data[1];
            $correo_area = $main_data[2];
            $paises = Pais::orderBy('nombre')->get();
        } catch (ErrorException $e) {
            $msg = "Error";
        } finally {
            $data = array(
                'id' => $aspirante_id,
                'msg' => $msg,
                'programa_seleccionado' => $programa_seleccionado,
                'paises' => $paises,
                'correo_area' => $correo_area,
                'count' => $count
            );
            return view('referencias_personales', $data);
        }
    }
}