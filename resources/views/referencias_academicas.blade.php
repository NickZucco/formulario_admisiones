@extends('main')

@section('form')
    <div class="alert alert-warning alert-dismissible" role="alert">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta
        que toda la información que digite en el formulario, debe registrarse únicamente en español
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
        <form method="post" action="{{ env('APP_URL') }}datos" class="form-horizontal" style="margin:20px 0"
              enctype="multipart/form-data">

            {!! csrf_field() !!}

            <div class="panel-body">
                <div class="form-group">
                    <label for="nombreApellido" class="col-sm-2 control-label">Nombres y Apellidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombreApellido" name="nombreApellido"
                               placeholder="Nombres y Apellidos" required/>
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
                        <input type="text" class="datepicker2 maxToday form-control" id="fecha"
                               name="fecha" placeholder="####-##-##"
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
                        <input type="number" class="form-control" id="telefono_movil" name="telefono_movil"
                               placeholder="#######" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pais" class="col-md-2 control-label">País</label>
                    <div class="col-md-4">
                        <select id="pais" class="form-control" name="pais" required>
                            @foreach($paises as $pais)
                                <option value="{{$pais->id}}"
                                        @if(/*$pais->id == $candidate_info->pais_residencia ||*/ $pais->nombre == "Colombia")
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
                    <label for="tiempo" class="control-label col-md-2">¿Por cuánto tiempo ha conocido al aspirante, y
                        cuál ha sido su relación con él?</label>
                    <div class="col-md-4">
                        <textarea name="tiempo" id="tiempo" cols="50" rows="5" class="form-control"></textarea>
                    </div>
                    <label class="control-label col-md-2">¿Recomendaría al aspirante para ser admitido al programa para
                        el cual
                        solicita admisión?</label>
                    <div class="col-md-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="recomienda" id="recomienda1" value="recomienda1"> No
                                recomienda
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="recomienda" id="recomienda2" value="recomienda2">
                                Recomienda débilmente
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="recomienda" id="recomienda3" value="recomienda3">
                                Recomienda
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="recomienda" id="recomienda4" value="recomienda4">
                                Recomienda fuertemente
                            </label>
                        </div>
                    </div>
                    <label class="control-label col-md-1">¿Las calificaciones reflejan de manera justa las habilidades
                        académicas del aspirante?</label>
                    <div class="col-md-1">
                        <div class="radio">
                            <label for="calificaciones1">
                                <input type="radio" name="calificaciones" id="calificaciones1" value="calificaciones1">
                                Sí
                            </label>
                        </div>
                        <div class="radio">
                            <label for="calificaciones2">
                                <input type="radio" name="calificaciones" id="calificaciones2" value="calificaciones2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12">Por favor asigne una calificación al aspirante de acuerdo con
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
                                    <input type="radio" name="atributosAptitudes" id="atributosAptitudes1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAptitudes" id="atributosAptitudes2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAptitudes" id="atributosAptitudes3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAptitudes" id="atributosAptitudes4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosAptitudesObservaciones"
                                           id="atributosAptitudesObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Capacidad de Análisis</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAnalisis" id="atributosAnalisis1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAnalisis" id="atributosAnalisis2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAnalisis" id="atributosAnalisis3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosAnalisis" id="atributosAnalisis4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosAnalisisObservaciones"
                                           id="atributosAnalisisObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Originalidad</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad1"
                                           required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad2"
                                           required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad3"
                                           required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOriginalidad" id="atributosOriginalidad4"
                                           required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosOriginalidadObservaciones"
                                           id="atributosOriginalidadObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Capacidad de Juicio</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosJuicio" id="atributosJuicio1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosJuicio" id="atributosJuicio2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosJuicio" id="atributosJuicio3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosJuicio" id="atributosJuicio4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosJuicioObservaciones"
                                           id="atributosJuicioObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Habilidades Sociales</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosSociales" id="atributosSociales1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosSociales" id="atributosSociales2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosSociales" id="atributosSociales3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosSociales" id="atributosSociales4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosSocialesObservaciones"
                                           id="atributosSocialesObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Potencial en investigación</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEquipo" id="atributosEquipo1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEquipo" id="atributosEquipo2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEquipo" id="atributosEquipo3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEquipo" id="atributosEquipo4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosEquipoObservaciones"
                                           id="atributosEquipoObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Habilidades de Comunicación Escrita</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEscrita" id="atributosEscrita1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEscrita" id="atributosEscrita2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEscrita" id="atributosEscrita3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosEscrita" id="atributosEscrita4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosEscritaObservaciones"
                                           id="atributosEscritaObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Habilidades de Comunicación Oral</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOral" id="atributosOral1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOral" id="atributosOral2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOral" id="atributosOral3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosOral" id="atributosOral4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosOralObservaciones"
                                           id="atributosOralObservaciones" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Responsabilidad y Compromiso</td>
                                <td class="text-center">
                                    <input type="radio" name="atributosCompromiso" id="atributosCompromiso1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosCompromiso" id="atributosCompromiso2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosCompromiso" id="atributosCompromiso3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="atributosCompromiso" id="atributosCompromiso4" required>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="atributosCompromisoObservaciones"
                                           id="atributosCompromisoObservaciones" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12">En comparación con un grupo de estudiantes que haya conocido
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
                                    <input type="radio" name="comparacion" id="comparacion1" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion2" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion3" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion4" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion5" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion6" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="comparacion" id="comparacion7" required>
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
                    <label class="control-label col-md-2">Número aproximado de profesionales en ese grupo que usted ha
                        evaluado</label>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="numeroProfesionale" id="numeroProfesionale"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inconvenientes" class="control-label col-md-12">Por favor adicione comentarios que
                        indiquen si existen factores que puedan evitar que el aspirante se gradúe en el programa de
                        Posgrado a que aspira, o que refuercen la capacidad y promesa del aspirante para graduarse en el
                        programa de Posgrado.</label>
                    <div class="col-md-12">
                        <textarea name="inconvenientes" id="inconvenientes" cols="50" rows="5"
                                  class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <input type="hidden" class="form-control" id="correo" name="correo">
            <input type="hidden" class="form-control" id="id" name="id">
        </form>

    </div>

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