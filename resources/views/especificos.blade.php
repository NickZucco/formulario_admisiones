@extends('main')

@section('form')

<div class="panel panel-default">
    @if($msg)
    <div class="alert alert-success" role="alert" style="font-size:18px">
        {{$msg}}
    </div>
    @endif

    <div class="panel-heading" style="font-size:20px">
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
		<div class="panel-heading" style="font-size:20px">
			<strong>Financiación</strong>
		</div>
        <div class="panel-body">
			<div class="form-group">
				<label for="tipo_financiacion" class="control-label col-sm-12 col-md-2">Tipo de financiación</label>
				<div class="col-sm-12 col-md-10">
					<select id="tipo_financiacion" name="tipo_financiacion" data-form="2" class="form-control" required>
						<option value="Recursos propios"
							@if($financiacion->tipo_financiacion == "Recursos propios")
								selected
							@endif
						>Recursos propios</option>
						<option value="Crédito"
							@if($financiacion->tipo_financiacion == "Crédito")
                                selected
							@endif
						>Crédito</option>
						<option value="Beca"
							@if($financiacion->tipo_financiacion == "Beca")
                                selected
							@endif
						>Beca</option>
						<option value="Financiamiento por parte de una empresa"
							@if($financiacion->tipo_financiacion == "Financiamiento por parte de una empresa")
                                selected
							@endif
						>Financiamiento por parte de una empresa</option>
						<option value="Financiamiento mixto"
							@if($financiacion->tipo_financiacion == "Financiamiento mixto")
                                selected
							@endif>
						Financiamiento mixto</option>
						<option value="Otro"
							@if($financiacion->tipo_financiacion == "Otro")
                                selected
							@endif
						>Otro</option>
					</select>
				</div>
			</div>
			<div class="form-group" id="otra_financiacion_container">
				<label for="otra_financiacion" class="col-sm-12 col-md-2 control-label">Especifique el tipo de financiación</label>
				<div class="col-sm-12 col-md-10">
					<input type="text" class="form-control" id="otra_financiacion" name="otra_financiacion" 
					value="{{$financiacion->otra_financiacion}}">
				</div>
			</div>
			<div class="form-group" id="entidad_financiacion_container">
				<label for="entidad_financiacion" class="col-sm-12 col-md-2 control-label">Entidad financiadora</label>
				<div class="col-sm-12 col-md-10">
					<input type="text" class="form-control" id="entidad_financiacion" name="entidad_financiacion"
					value="{{$financiacion->entidad_financiacion}}">
				</div>
			</div>
		</div>
        
		<div class="panel-heading" style="font-size:20px" id="documentos_heading">
			<strong>Documentos específicos para el programa de posgrado</strong>
		</div>
		<div class="panel-body">
            <div id="carta_motivacion_form">
                <div class="form-group">
                    <label for="carta_motivacion" class="col-sm-12 col-md-3 control-label">Documento adjunto con 
					carta de motivación del aspirante, máximo una página.</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="carta_motivacion" type="file" class="form-control" name="carta_motivacion"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
					@if($aspirante->ruta_carta_motivacion)
						<div class="col-sm-12 col-md-5" style="background-color:#FFB560; font-size:15px">
							<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_carta_motivacion}}" target="_blank">Carta de motivación</a>
							<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						</div>
					@endif
                </div>
            </div>
			
			<div id="propuesta_form">
                <div class="form-group">
                    <label for="propuesta" class="col-sm-12 col-md-3 control-label">Documento adjunto con escrito 
					del tema o idea a plantear o a desarrollar durante el programa, máximo 2500 caracteres con 
					espacios.</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="propuesta" type="file" class="form-control" name="propuesta"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
					@if($aspirante->ruta_propuesta)
						<div class="col-sm-12 col-md-5" style="background-color:#FFB560; font-size:15px">
							<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_propuesta}}" target="_blank">Propuesta de trabajo de grado</a>
							<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						</div>
					@endif
                </div>
            </div>
			
			<div id="propuesta_avanzada_form">
                <div class="form-group">
                    <label for="propuesta_avanzada" class="col-sm-12 col-md-3 control-label">Documento adjunto de 
					prepropuesta avalada por un docente de la Universidad Nacional.</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="propuesta_avanzada" type="file" class="form-control" name="propuesta_avanzada"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
					@if($aspirante->ruta_propuesta_avanzada)
						<div class="col-sm-12 col-md-5" style="background-color:#FFB560; font-size:15px">
							<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_propuesta_avanzada}}" target="_blank">Propuesta detallada de trabajo de grado</a>
							<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						</div>
					@endif
                </div>
            </div>
			
			<div id="carta_profesor_form">
                <div class="form-group">
                    <label for="carta_profesor" class="col-sm-12 col-md-3 control-label">Carta de un profesor avalando 
					su aplicación al programa y comprometiéndose a ser tutor del estudiante.</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="carta_profesor" type="file" class="form-control" name="carta_profesor"/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF 
						(.pdf) y no tener un tamaño superior a 10MB</em>
                    </div>
					@if($aspirante->ruta_carta_profesor)
						<div class="col-sm-12 col-md-5" style="background-color:#FFB560; font-size:15px">
							<strong>Archivo cargado previamente: <a href="{{env('APP_URL').$aspirante->ruta_carta_profesor}}" target="_blank">Carta de recomendación de un profesor</a>
							<br><em>Por favor, tenga en cuenta que al cargar un nuevo archivo, se actualizará el archivo previamente cargado</em></strong>
						</div>
					@endif
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-success form-control">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Adicionar información
                    </button>
                </div>
            </div> 
        </div>
    </form>
    @endif
</div>

<script>
    
    (function ($) {
		
		//Función que se ejecuta una vez se ha cargado la página web
		$(document).ready(function() {
			//Una vez se ha cargado la página, podemos saber la opción seleccionada del select box Tipo de financiación
			//En base a este valor inicial ejecutamos el mismo código que está en la función de cambio para la opción
			//seleccionada del select box.
			var $selected=$('#tipo_financiacion').find("option:selected");
            if ($.trim($selected.text().toLowerCase()) != 'recursos propios') {
				$('#entidad_financiacion_container').show();
				$('#entidad_financiacion').attr("required", "required");
				$('#entidad_financiacion').attr('disabled', false);
				if ($.trim($selected.text().toLowerCase()) == 'otro') {
					$('#otra_financiacion_container').show();
					$('#otra_financiacion').attr("required", "required");
					$('#otra_financiacion').attr('disabled', false);
				}
				else {
					$('#otra_financiacion_container').hide();
					$('#otra_financiacion').attr('disabled', true);
					$('#otra_financiacion').removeAttr("required");
				}
            }
			else {
                $('#otra_financiacion_container').hide();
				$('#entidad_financiacion_container').hide();
				$('#otra_financiacion').attr('disabled', true);
				$('#entidad_financiacion').attr('disabled', true);
				$('#otra_financiacion').removeAttr("required");
				$('#entidad_financiacion').removeAttr("required");
            }

			//Ocultamos los 4 campos para subir adjuntos presentes en el formulario.
			$('#carta_motivacion_form').hide();
			$('#propuesta_form').hide();
			$('#propuesta_avanzada_form').hide();
			$('#carta_profesor_form').hide();
			//Tomamos del controlador el array $programa_seleccionado que es un objeto con dos propiedades,
			//el id del programa seleccionado y el nombre. Solo nos interesa el id.
			var programa_seleccionado = {!!$programa_seleccionado!!};
			//Ya que solo importa el número id como tal, sacamos el valor del atributo de la primera y única
			//posición del array.
			var programa_id = programa_seleccionado[0].id;
			//Definimos estáticamente los arrays de requerimientos. En caso de que en un futuro se deseen definir
			//dinámicamente, es necesario crear una tabla de documentos requeridos en la DB, y también crear una
			//tabla que relacione los documentos requeridos con los programas.
			var req_carta_motivacion = new Array(1, 3, 4, 5, 8, 16, 17, 18, 19, 20, 21, 32, 33, 34, 41, 42);
			var req_propuesta = new Array(10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 24, 25, 26, 27, 28, 29, 
											33, 34, 35, 36, 37, 38, 39, 40);
			var req_propuesta_avanzada = new Array(2, 3, 4, 5, 6, 7, 41, 42);
			var req_carta_profesor = new Array(1, 3, 4, 5);
			//Verificamos en cuales arrays está incluido programa_id para habilitar la subida del archivo adjunto.
			var documento_requerido = false;
			if ($.inArray(programa_id, req_carta_motivacion) != -1) {
				$('#carta_motivacion_form').show();
				documento_requerido = true;
			}
			if ($.inArray(programa_id, req_propuesta) != -1) {
				$('#propuesta_form').show();
				documento_requerido = true;
			}
			if ($.inArray(programa_id, req_propuesta_avanzada) != -1) {
				$('#propuesta_avanzada_form').show();
				documento_requerido = true;
			}
			if ($.inArray(programa_id, req_carta_profesor) != -1) {
				$('#carta_profesor_form').show();
				documento_requerido = true;
			}
			//Si el programa seleccionado no requiere ningún documento específico, entonces ocultamos el encabezado
			//de la sección correspondiente
			if (!documento_requerido) $('#documentos_heading').hide();
		});
		
		//Función que se ejecuta cada vez que cambia la selección del select box tipo_financiacion
		$('#tipo_financiacion').on("change", function () {
			//En la variable selected ponemos la cadena de texto que contiene la opción seleccionada
            var $selected=$(this).find("option:selected");
            //Verificamos si la opción es diferente a Recursos propios
			//Si es diferente mostramos el campo Entidad financiadora
            if ($.trim($selected.text().toLowerCase()) != 'recursos propios') {
				//Mostramos el campo y le asignamos el atributo requerido
				$('#entidad_financiacion_container').show();
				$('#entidad_financiacion').attr("required", "required");
				$('#entidad_financiacion').attr('disabled', false);
				//Si la opción seleccionada es Otro, también debemos mostrar el campo para especificar qué
				//tipo de financiación es
				if ($.trim($selected.text().toLowerCase()) == 'otro') {
					//Mostramos el campo y le asignamos el atributo requerido
					$('#otra_financiacion_container').show();
					$('#otra_financiacion').attr("required", "required");
					$('#otra_financiacion').attr('disabled', false);
				}
				else {
					$('#otra_financiacion_container').hide();
					$('#otra_financiacion').attr('disabled', true);
					$('#otra_financiacion').removeAttr("required");
				}
            }
			//Si la opción seleccionada es Recursos propios entonces ocultamos los campos para otra financiación
			//y entidad financiadora
			else {
                $('#otra_financiacion_container').hide();
				$('#entidad_financiacion_container').hide();
				$('#otra_financiacion').attr('disabled', true);
				$('#entidad_financiacion').attr('disabled', true);
				$('#otra_financiacion').removeAttr("required");
				$('#entidad_financiacion').removeAttr("required");
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