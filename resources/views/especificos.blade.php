@extends('main')

@section('form')

<div class="panel panel-default">
    @if($msg)
    <div class="alert alert-success" role="alert">
        {{$msg}}
    </div>
    @endif
    <div class="panel-heading">
        <strong>Requerimientos específicos según el programa de posgrado escogido</strong>
    </div>

    @if($programa_seleccionado->isEmpty())
    <div class="alert alert-warning" role="alert">
        No se ha seleccionado un programa de posgrado. Por favor, seleccione primero el programa al cual se 
		postuló en la ruta 
		<a href="{{ env('APP_URL') }}programas" data-path="programas" class="alert-link"><i class="fa fa-user" 
		aria-hidden="true"></i>&nbsp;Programas</a> e intentelo nuevamente.
    </div>
    @else
    <form name="registro" id="registro" method="post" action="{{ env('APP_URL') }}especificos" class="form-horizontal" style="margin:20px 0"  enctype="multipart/form-data">     
        {!! csrf_field() !!}
        <div class="panel-body">
           
            <div id="carta_motivacion_form" class="well">
                <div class="form-group">
                    <label for="carta_motivacion" class="col-sm-12 col-md-3 control-label">Documento adjunto con 
					carta de motivación del aspirante, máximo una página.</label>
                    <div class="col-sm-12 col-md-5">
                        <input id="carta_motivacion" type="file" class="form-control" name="carta_motivacion"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
                    <div class="col-sm-12 col-md-4">
						@if($aspirante->ruta_carta_motivacion)
						<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_carta_motivacion}}" target="_blank">Carta de motivación</a>
						<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						@endif
                    </div>
                </div>
            </div>
			
			<div id="propuesta_form" class="well">
                <div class="form-group">
                    <label for="propuesta" class="col-sm-12 col-md-3 control-label">Documento adjunto con escrito 
					del tema o idea a plantear o a desarrollar durante el programa, máximo 2500 caracteres con 
					espacios.</label>
                    <div class="col-sm-12 col-md-5">
                        <input id="propuesta" type="file" class="form-control" name="propuesta"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
                    <div class="col-sm-12 col-md-4">
						@if($aspirante->ruta_propuesta)
						<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_propuesta}}" target="_blank">Propuesta de trabajo de grado</a>
						<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						@endif
                    </div>
                </div>
            </div>
			
			<div id="propuesta_avanzada_form" class="well">
                <div class="form-group">
                    <label for="propuesta_avanzada" class="col-sm-12 col-md-3 control-label">Documento adjunto de 
					propuesta incluyendo antecedentes, justificación, objetivos, definición del problema, metodología, 
					cronograma, presupuesto y bibliografía, avalada por un docente de la Universidad Nacional que 
					será su tutor.</label>
                    <div class="col-sm-12 col-md-5">
                        <input id="propuesta_avanzada" type="file" class="form-control" name="propuesta_avanzada"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
                    <div class="col-sm-12 col-md-4">
						@if($aspirante->ruta_propuesta_avanzada)
						<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_propuesta_avanzada}}" target="_blank">Propuesta avanzada de trabajo de grado</a>
						<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						@endif
                    </div>
                </div>
            </div>
			
			<div id="carta_profesor_form" class="well">
                <div class="form-group">
                    <label for="carta_profesor" class="col-sm-12 col-md-3 control-label">Carta de un profesor avalando 
					su aplicación al programa y comprometiéndose a ser tutor del estudiante.</label>
                    <div class="col-sm-12 col-md-5">
                        <input id="carta_profesor" type="file" class="form-control" name="carta_profesor"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        @if($aspirante->ruta_carta_profesor)
						<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_carta_profesor}}" target="_blank">Carta de recomendación de un profesor</a>
						<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						@endif
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-success form-control">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Adicionar documentos
                    </button>
                </div>
            </div> 
        </div>
    </form>
    @endif
</div>

<script>
    
    (function ($) {
		
		$(document).ready(function() {
			//Ocultamos los 4 campos para subir adjuntos presentes en el formulario.
			$('#carta_motivacion_form').hide();
			$('#propuesta_form').hide();
			$('#propuesta_avanzada_form').hide();
			$('#carta_profesor_form').hide();
			//Tomamos del controlador el array $programa_seleccionado que es un objeto con una única propiedad,
			//el id del programa seleccionado.
			var programa_seleccionado = {!!$programa_seleccionado!!};
			//Ya que solo importa el número como tal, sacamos el valor del atributo id de la primera y única
			//posición del array.
			var programa_id = programa_seleccionado[0].id;
			console.log(programa_seleccionado);
			console.log(programa_id);
			//Definimos estáticamente los arrays de requerimientos. En caso de que en un futuro se deseen definir
			//dinámicamente, es necesario crear una tabla de documentos requeridos en la DB, y también crear una
			//tabla que relacione los documentos requeridos con los programas.
			var req_carta_motivacion = new Array(1, 3, 4, 5, 18, 19, 26, 27, 32);
			var req_propuesta = new Array(5, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 24, 25, 26, 27, 28, 29, 
											33, 34, 35, 36, 37, 38, 39, 40, 41, 42);
			var req_propuesta_avanzada = new Array(2, 3, 4, 6, 7, 41, 42);
			var req_carta_profesor = new Array(1, 5, 4, 26, 27, 41, 42);
			//Verificamos en cuales arrays está incluido programa_id para habilitar la subida del archivo adjunto.
			if ($.inArray(programa_id, req_carta_motivacion) != -1) {
				$('#carta_motivacion_form').show();
			}
			if ($.inArray(programa_id, req_propuesta) != -1) {
				$('#propuesta_form').show();
			}
			if ($.inArray(programa_id, req_propuesta_avanzada) != -1) {
				$('#propuesta_avanzada_form').show();
			}
			if ($.inArray(programa_id, req_carta_profesor) != -1) {
				$('#carta_profesor_form').show();
			}
		});

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

@stop