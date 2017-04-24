@extends('unal')

@section('content')
    <h2 class="text-center">Formulario de referencia académica para el aspirante <strong>{{$aspirante}}</strong>, quien
        aplica al programa <strong>{{$programa}}</strong></h2>

    <br>

    @if($referencia->advertencia_datos)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <strong>Nota: </strong>Por favor, tenga en cuenta que toda la información que digite en el formulario, debe
            registrarse únicamente en español
        </div>

        <div class="panel panel-default">
            @if(session()->has('message'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="panel-heading">
                <strong>Datos de quien da la referencia</strong>
            </div>
            <form method="post" action="{{ env('APP_URL') }}referencia_academica" class="form-horizontal"
                  style="margin:20px 0"
                  enctype="multipart/form-data">

                {!! csrf_field() !!}
                <input type="hidden" name="referencia_id" id="referencia_id" value="{{$referencia->id}}">
                <input type="hidden" name="token" id="token" value="{{$token}}">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nombreApellido" class="col-sm-2 control-label">Nombres y Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreApellido" name="nombreApellido"
                                   placeholder="Nombres y Apellidos" required
                                   value="{{$referencia->nombre_de_referencia}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cargo" class="col-sm-2 control-label">Título/Posición/Cargo</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="cargo" name="cargo"
                                   placeholder="Título/Posición/Cargo" required/>
                        </div>
                        <label for="fecha" class="col-md-2 control-label">Fecha</label>
                        <div class="col-md-4">
                            <input type="date" class="datepicker2 maxToday form-control" id="fecha"
                                   name="fecha" placeholder="AAAA-MM-DD"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institucion" class="col-sm-2 control-label">Institución</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="institucion" name="institucion"
                                   placeholder="Institución" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="departamento" name="departamento"
                                   placeholder="Departamento" required/>
                        </div>
                        <label for="telefono_movil" class="col-sm-2 control-label">Teléfono movil</label>
                        <div class="col-md-4">
                            <input type="tel" class="form-control" id="telefono_movil" name="telefono_movil"
                                   placeholder="#######" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pais" class="col-md-2 control-label">País</label>
                        <div class="col-md-4">
                            <select id="pais" class="form-control" name="pais" required>
                                @foreach($paises as $pais)
                                    <option value="{{$pais->id}}"
                                            @if($pais->nombre == "Colombia")
                                            selected
                                            @endif
                                    >{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="ciudad" class="col-md-2 control-label">Ciudad</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="ciudad" name="ciudad"
                                   placeholder="" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tiempo" class="control-label col-md-2">¿Por cuánto tiempo ha conocido al aspirante,
                            y
                            cuál ha sido su relación con él?</label>
                        <div class="col-md-4">
                            <textarea name="tiempo" id="tiempo" cols="50" rows="5" class="form-control"
                                      required></textarea>
                        </div>
                        <label class="control-label col-md-2">¿Recomendaría al aspirante para ser admitido al programa
                            para
                            el cual
                            solicita admisión?</label>
                        <div class="col-md-2">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="recomienda" id="recomienda1" value="0" required> No
                                    recomienda
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="recomienda" id="recomienda2" value="1" required>
                                    Recomienda débilmente
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="recomienda" id="recomienda3" value="2" required>
                                    Recomienda
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="recomienda" id="recomienda4" value="3" required>
                                    Recomienda fuertemente
                                </label>
                            </div>
                        </div>
                        <label class="control-label col-md-1">¿Las calificaciones reflejan de manera justa las
                            habilidades
                            académicas del aspirante?</label>
                        <div class="col-md-1">
                            <div class="radio">
                                <label for="calificaciones1">
                                    <input type="radio" name="calificaciones" id="calificaciones1"
                                           value="calificaciones1" required>
                                    Sí
                                </label>
                            </div>
                            <div class="radio">
                                <label for="calificaciones2">
                                    <input type="radio" name="calificaciones" id="calificaciones2"
                                           value="calificaciones2" required>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">Por favor asigne una calificación al aspirante de acuerdo
                            con
                            los atributos mencionados enseguida</label>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">Atributo</th>
                                    <th class="text-center">Excelente</th>
                                    <th class="text-center">Muy bueno</th>
                                    <th class="text-center">Bueno</th>
                                    <th class="text-center">Aceptable</th>
                                    <th class="text-center">Observaciones</th>
                                </tr>
                                <tr>
                                    <td>Aptitudes académicas</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAptitudes" id="atributosAptitudes1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAptitudes" id="atributosAptitudes2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAptitudes" id="atributosAptitudes3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAptitudes" id="atributosAptitudes4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosAptitudesObservaciones"
                                               id="atributosAptitudesObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de Análisis</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAnalisis" id="atributosAnalisis1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAnalisis" id="atributosAnalisis2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAnalisis" id="atributosAnalisis3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosAnalisis" id="atributosAnalisis4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosAnalisisObservaciones"
                                               id="atributosAnalisisObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Originalidad</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad1"
                                               required value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad2"
                                               required value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad3"
                                               required value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad4"
                                               required value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control"
                                               name="atributosOriginalidadObservaciones"
                                               id="atributosOriginalidadObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacidad de Juicio</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosJuicio" id="atributosJuicio1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosJuicio" id="atributosJuicio2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosJuicio" id="atributosJuicio3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosJuicio" id="atributosJuicio4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosJuicioObservaciones"
                                               id="atributosJuicioObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Habilidades Sociales</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosSociales" id="atributosSociales1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosSociales" id="atributosSociales2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosSociales" id="atributosSociales3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosSociales" id="atributosSociales4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosSocialesObservaciones"
                                               id="atributosSocialesObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Potencial en investigación</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEquipo" id="atributosEquipo1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEquipo" id="atributosEquipo2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEquipo" id="atributosEquipo3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEquipo" id="atributosEquipo4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosEquipoObservaciones"
                                               id="atributosEquipoObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Habilidades de Comunicación Escrita</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEscrita" id="atributosEscrita1" required
                                               value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEscrita" id="atributosEscrita2" required
                                               value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEscrita" id="atributosEscrita3" required
                                               value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosEscrita" id="atributosEscrita4" required
                                               value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosEscritaObservaciones"
                                               id="atributosEscritaObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Habilidades de Comunicación Oral</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOral" id="atributosOral1" required value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOral" id="atributosOral2" required value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOral" id="atributosOral3" required value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosOral" id="atributosOral4" required value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosOralObservaciones"
                                               id="atributosOralObservaciones">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Responsabilidad y Compromiso</td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosCompromiso" id="atributosCompromiso1"
                                               required value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosCompromiso" id="atributosCompromiso2"
                                               required value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosCompromiso" id="atributosCompromiso3"
                                               required value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="atributosCompromiso" id="atributosCompromiso4"
                                               required value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control" name="atributosCompromisoObservaciones"
                                               id="atributosCompromisoObservaciones">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12">En comparación con un grupo de estudiantes que haya
                            conocido
                            al nivel del aspirante, por favor indique dónde ubicaría al aspirante.</label>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">Entre el 1-2%</th>
                                    <th class="text-center">En el 5% superior</th>
                                    <th class="text-center">En el 10% superior</th>
                                    <th class="text-center">En el 25% superior</th>
                                    <th class="text-center">En el 50% superior</th>
                                    <th class="text-center">Entre el 25-50% inferior</th>
                                    <th class="text-center">En el 25% inferior</th>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion1" required value="0">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion2" required value="1">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion3" required value="2">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion4" required value="3">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion5" required value="4">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion6" required value="5">
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="comparacion" id="comparacion7" required value="6">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">El grupo con el que compara al aspirante es:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="grupoCompara" id="grupoCompara"
                                   placeholder="Ej, estudiantes de Pregrado en la U. Nacional de Colombia, sede Bogotá"
                                   required>
                        </div>
                        <label class="control-label col-md-2">Número aproximado de profesionales en ese grupo que usted
                            ha
                            evaluado</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="numeroProfesionale" id="numeroProfesionale"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inconvenientes" class="control-label col-md-12">Por favor adicione comentarios que
                            indiquen si existen factores que puedan evitar que el aspirante se gradúe en el programa de
                            Posgrado a que aspira, o que refuercen la capacidad y promesa del aspirante para graduarse
                            en el
                            programa de Posgrado.</label>
                        <div class="col-md-12">
                        <textarea name="inconvenientes" id="inconvenientes" cols="50" rows="5"
                                  class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" class="form-control" id="correo" name="correo">
                <input type="hidden" class="form-control" id="id" name="id">

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-success form-control">
                            <i class="fa fa-send" aria-hidden="true"></i>
                            Enviar referencia
                        </button>
                    </div>
                </div>
            </form>

        </div>
    @else
        <form method="post" action="{{ env('APP_URL') }}referencia_academica" class="form-horizontal"
              style="margin:20px 0"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <p>
                        Se solicita su autorización para que de manera libre, previa y expresa, permita a la Universidad
                        Nacional de Colombia, el recaudo, almacenamiento y disposición de los datos personales
                        incorporados
                        en el sistema de información y envío de documentos para proceso de admisión de posgrados
                        2017-II.
                    </p>
                    <br>
                    <p>
                        Los datos personales que usted suministrará al sistema, serán administrados por la Universidad
                        Nacional de Colombia, su confidencialidad y seguridad estarán garantizadas de conformidad con
                        las
                        disposiciones legales (Ley 1581 de 2012 y Decreto Reglamentario 1377 de 2013) que regulan la
                        protección de datos personales y conla política de privacidad para el tratamiento de dichos
                        datos,
                        la cual podrá ser consultada en <a href="http://www.unal.edu.co/contenido/habeas/"
                                                           target="_blank">http://www.unal.edu.co/contenido/habeas/</a>.
                    </p>
                    <br>
                    <p>
                        Finalmente se presume que el contenido de la información ingresada es verídica en el marco del
                        principio de la buena fe establecido en el artículo 83 de la Constitución Política de Colombia.
                        Cualquier falsedad o inconsistencia que se identifique por parte de la Universidad Nacional de
                        Colombia en el proceso de verificación de los mismos, será su plena y exclusiva responsabilidad
                        y
                        asumirá de forma directa las consecuencias civiles, penales y administrativas que su actuación
                        genere ante las autoridades públicas.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="form-group">
                        <input type="hidden" name="referencia_id" id="referencia_id" value="{{$referencia->id}}">
                        <input type="hidden" name="token" id="token" value="{{$token}}">
                        <button class="btn btn-success form-control btn-block" name="acepta" id="acepta">
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                            Aceptar condiciones
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endif

    <script>

        (function ($) {

            $("input[type='file']").fileinput({
                language: 'es',
                showUpload: false,
                maxFileSize: 10240,
                allowedFileExtensions: ["pdf"],
                initialPreviewConfig: {
                    width: '100%'
                }
            });

        })(jQuery);

    </script>
@endsection