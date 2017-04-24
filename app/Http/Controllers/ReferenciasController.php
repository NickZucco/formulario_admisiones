<?php
/**
 * Created by PhpStorm.
 * User: mesi
 * Date: 11/04/17
 * Time: 11:53 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use App\Pais as Pais;
use App\Aspirante as Aspirante;
use App\Referencia as Referencia;
use App\AspiranteReferencia as AspiranteReferencia;
use App\ProgramaPosgrado as ProgramaPosgrado;


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
            $aspirante_referencia = array();
            foreach (AspiranteReferencia::where('aspirantes_id', '=', $aspirante_id)->get() as $ar) {
                $ref_builder = array();
                $ref_builder['ref'] = Referencia::where('id', '=', $ar->referencias_id)->first();
                $ref_builder['dato'] = $ar;
                array_push($aspirante_referencia, $ref_builder);
            }
            $opcion = null;
            switch (ProgramaPosgrado::join('aspirantes', 'aspirantes.programa_posgrado_id', '=', 'programa_posgrado.id')
                ->select('programa_posgrado.id')
                ->where('aspirantes.id', '=', $aspirante_id)
                ->first()->id) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 12:
                case 14:
                case 16:
                case 18:
                case 20:
                case 22:
                case 24:
                case 26:
                case 28:
                case 30:
                case 32:
                case 33:
                case 35:
                case 37:
                case 39:
                    $opcion = 1;
                    break;
                case 13:
                case 15:
                case 17:
                case 19:
                case 21:
                case 23:
                case 25:
                case 27:
                case 29:
                case 31:
                case 34:
                case 36:
                case 38:
                case 40:
                    $opcion = 2;
                    break;
                default:
                    $opcion = 0;
            }
        } catch (ErrorException $e) {
            $msg = "Error";
        } finally {
            $data = array(
                'id' => $aspirante_id,
                'msg' => $msg,
                'programa_seleccionado' => $programa_seleccionado,
                'paises' => $paises,
                'correo_area' => $correo_area,
                'count' => $count,
                'referencias' => $aspirante_referencia,
                'opcion' => $opcion
            );
            return view('formulario_referencias', $data);
        }
    }

    public function save_references()
    {
        $input = Input::all();

        if (isset($input['delete1'])) {
            AspiranteReferencia::destroy($input['delete1']);
            return redirect('formulario_referencias');
        }

        if (isset($input['delete2'])) {
            AspiranteReferencia::destroy($input['delete2']);
            return redirect('formulario_referencias');
        }

        $referencia1 = null;
        if (array_key_exists('correo1', $input) && $input['correo1'] != '' && $input['nombreApellido1'] != '') {
            $referencia1 = array_key_exists('currentCorreo1', $input) ? Referencia::where('correo_de_referencia', '=', $input['currentCorreo1'])->first() : new Referencia;
            $referencia1->nombre_de_referencia = $input['nombreApellido1'];
            $referencia1->correo_de_referencia = $input['correo1'];
            try {
                $referencia1->save();
            } catch (QueryException $e) {
                $referencia1 = Referencia::where('correo_de_referencia', '=', $input['correo1'])->first();
            }
        }

        $referencia2 = null;
        if (array_key_exists('correo2', $input) && $input['correo2'] != '' && $input['nombreApellido2'] != '') {
            $referencia2 = array_key_exists('currentCorreo2', $input) ? Referencia::where('correo_de_referencia', '=', $input['currentCorreo2'])->first() : new Referencia;
            $referencia2->nombre_de_referencia = $input['nombreApellido2'];
            $referencia2->correo_de_referencia = $input['correo2'];
            try {
                $referencia2->save();
            } catch (QueryException $e) {
                $referencia2 = Referencia::where('correo_de_referencia', '=', $input['correo2'])->first();
            }
        }

        if (is_null($referencia1) && is_null($referencia2))
            return redirect('formulario_referencias');

        $refs = array();
        if (!is_null($referencia1)) array_push($refs, $referencia1->id);
        if (!is_null($referencia2)) array_push($refs, $referencia2->id);

        $current_references = array();
        foreach (AspiranteReferencia::where('aspirantes_id', '=', Auth::user()->id)
                     ->whereIn('referencias_id', $refs)
                     ->get() as $ar) {
            array_push($current_references, $ar);
        }

        $aspirante_referencia_1 = null;
        $send1 = false;
        if (!is_null($referencia1)) {
            if (count($current_references) > 0) {
                $aspirante_referencia_1 = array_shift($current_references);
            } else {
                $aspirante_referencia_1 = new AspiranteReferencia;
                $send1 = true;
            }
            $aspirante_referencia_1->aspirantes_id = Auth::user()->id;
            $aspirante_referencia_1->referencias_id = $referencia1->id;
            if (array_key_exists('tipo1', $input)) {
                $aspirante_referencia_1->tipo_referencia = $input['tipo1'];
            }
            $aspirante_referencia_1->save();
        }

        $aspirante_referencia_2 = null;
        $send2 = false;
        if (!is_null($referencia2)) {
            if (count($current_references) > 0) {
                $aspirante_referencia_2 = array_shift($current_references);
            } else {
                $aspirante_referencia_2 = new AspiranteReferencia;
                $send2 = true;
            }
            $aspirante_referencia_2->aspirantes_id = Auth::user()->id;
            $aspirante_referencia_2->referencias_id = $referencia2->id;
            if (array_key_exists('tipo2', $input)) {
                $aspirante_referencia_2->tipo_referencia = $input['tipo2'];
            }
            $aspirante_referencia_2->save();
        }

        $aspirante = Aspirante::find(Auth::user()->id);
        $main_data = $this->getData(Auth::user()->id);
        $programa_seleccionado = $main_data[1][0];

        if (isset($input['remind1'])){
            $this->sendEmailToReferer(
                $referencia1,
                $aspirante_referencia_1->tipo_referencia ? 'profesionales' : 'académicas',
                $aspirante->nombre . ' ' . $aspirante->apellido,
                $programa_seleccionado->nombre,
                env('APP_URL')
            );
            return redirect('formulario_referencias');
        }

        if (isset($input['remind2'])){
            $this->sendEmailToReferer(
                $referencia2,
                $aspirante_referencia_2->tipo_referencia ? 'profesionales' : 'académicas',
                $aspirante->nombre . ' ' . $aspirante->apellido,
                $programa_seleccionado->nombre,
                env('APP_URL')
            );
            return redirect('formulario_referencias');
        }

        if ($send1)
            $this->sendEmailToReferer(
                $referencia1,
                $aspirante_referencia_1->tipo_referencia ? 'profesionales' : 'académicas',
                $aspirante->nombre . ' ' . $aspirante->apellido,
                $programa_seleccionado->nombre,
                env('APP_URL')
            );
        if ($send2)
            $this->sendEmailToReferer(
                $referencia2,
                $aspirante_referencia_2->tipo_referencia ? 'profesionales' : 'académicas',
                $aspirante->nombre . ' ' . $aspirante->apellido,
                $programa_seleccionado->nombre,
                env('APP_URL')
            );
        return redirect('formulario_referencias');
    }

    private function sendEmailToReferer($referer, $tipo_referencia, $aspirante, $programa, $enlace)
    {
        $subject = 'Solicitud de referencia proceso de admisión posgrados';
        Mail::send('emails.mail_to_referers', [
            'html' => 'view',
            'title' => $subject,
            'name' => $referer->nombre_de_referencia,
            'tipo_referencia' => $tipo_referencia,
            'aspirante' => $aspirante,
            'programa' => $programa,
            'enlace' => $enlace
        ], function ($message) use ($referer, $subject) {
            $message->subject($subject);
            $message->from(env("MAIL_USERNAME"), 'Facultad de Ingeniería Unviersidad Nacional de Colombia Sede Bogotá');
            $message->to($referer->correo_de_referencia);
        });
    }
}