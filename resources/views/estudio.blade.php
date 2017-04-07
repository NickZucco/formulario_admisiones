@extends('main')

@section('form')

<div class="alert alert-warning alert-dismissible" role="alert">
  <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta que toda la información que digite en el formulario, debe registrarse únicamente en español
</div>

<div class="panel panel-default">
    @if($msg)
    <div class="alert alert-success" role="alert">
        {{$msg}}
    </div>
    @endif
    <div class="panel-heading">
        <strong>Estudios</strong>
    </div>
    <form method="post" action="{{ env('APP_URL') }}estudios" class="form-horizontal" style="margin:20px 0" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="panel-body">
            <div class="form-group">
                <label for="titulo" id="titulo" class="col-sm-12 col-md-2 control-label">Título académico obtenido</label>
                <div class="col-sm-12 col-md-5">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nombre del título académico obtenido" required>
                </div>
				
				<label for="nivel_estudio_id" id="nivel" class="col-sm-12 col-md-2 control-label">Nivel del estudio</label>
                <div class="col-sm-12 col-md-3">
                    <select id="nivel_estudio_id" name="nivel_estudio_id" class="form-control" required>
                        @foreach($niveles as $nivel)
                        <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			
			<div id="otro_nivel_estudio_container" class="form-group">
                <label for="otro_nivel_estudio" class="col-sm-12 col-md-2 control-label">Tipo de estudio realizado</label>
                <div class="col-sm-12 col-md-10">
                    <input type="text" class="form-control typeahead" id="otro_nivel_estudio" name="otro_nivel_estudio" placeholder="Nombre del tipo de estudio realizado" data-provide="typeahead"  autocomplete="off" value="">
                </div>
            </div>
			
            <div class="form-group">
                <label for="institucion" class="col-sm-12 col-md-2 control-label">Nombre de la institución</label>
                <div class="col-sm-12 col-md-10">
                    <input type="text" class="form-control typeahead" id="institucion" name="institucion" placeholder="Nombre de la institución" data-provide="typeahead"  autocomplete="off" value="" required>
                </div>
            </div>

            <div class="form-group">
				<label class="col-sm-12 col-md-2 control-label" for="en_curso" >¿El estudio se encuentra en curso?</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="en_curso" data-id="fecha_finalizacion" value="1" required>Si
				</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="en_curso" data-id="fecha_finalizacion" value="0">No
				</label>
				
                <div id="fecha_inicio_container">
                    <label for="fecha_inicio" class="col-sm-12 col-md-2 control-label">Fecha de inicio</label>
                    <div class="col-sm-12 col-md-2">
                        <input type="text"  class="datepicker2 end maxToday form-control" id="fecha_inicio" name="fecha_inicio" placeholder="####-##-##" required>
                    </div>
                </div>

                <div id="fecha_finalizacion_container">
                    <label for="fecha_finalizacion" class="col-sm-12 col-md-2 control-label">Fecha de finalización</label>
                    <div class="col-sm-12 col-md-2">
                        <input type="text" class="datepicker2 end maxToday form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="####-##-##" required>
                    </div>
                </div>
            </div>
			
			<div class="form-group">
                <label for="maximo_escala" class="col-sm-12 col-md-2 control-label">Máxima nota en la escala</label>
                <div class="col-sm-12 col-md-2">
                    <input type="text" class="form-control" id="maximo_escala" name="maximo_escala" required>
                </div>
				
				<label for="minimo_aprobatorio" class="col-sm-12 col-md-2 control-label">Mínima nota aprobatoria</label>
                <div class="col-sm-12 col-md-2">
                    <input type="text" class="form-control" id="minimo_aprobatorio" name="minimo_aprobatorio" required>
                </div>
				
				<label for="promedio" class="col-sm-12 col-md-2 control-label">Promedio obtenido</label>
                <div class="col-sm-12 col-md-2">
                    <input type="text" class="form-control" id="promedio" name="promedio" required>
                </div>
            </div>

            <div class="form-group">
                <label for="paises_id" class="col-sm-12 col-md-2 control-label">País donde realizó los estudios </label>
                <div class="col-sm-12 col-md-4">
                    <select id="paises_id" name="paises_id" class="form-control" required>
                        @foreach($paises as $pais)
                        <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group adjunto">
                <div class="col-sm-12 col-md-2 ">
                    <label for="adjunto" class="control-label">Documento de soporte: </label>
                </div>
                <div class="col-sm-12 col-md-9">
                    <input id="adjunto" type="file" class="form-control" name="adjunto" required/>
                    <em>Si usted aún se encuentra cursando un programa de pregrado, debe adjuntar como soporte un certificado de estudios oficial.</em>
                    <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF y no tener un tamaño superior a 10MB</em>
                </div>
            </div>

            <div class="form-group additional_attatchments">

                <div class="col-sm-12 col-md-6">
                    <input type="radio" name="additional_attatchments" value="adjunto_entramite_minedu">¿Desea adjuntar documento que manifieste se encuentra en trámite ante el Ministerio de Educación la convalidación de título obtenido en el exterior?<br>
                    <label for="adjunto_entramite_minedu" class="col-sm-12 col-md-12">Documento que manifieste se encuentra en trámite ante el Ministerio de Educación: </label>
                    <div class="col-md-12">
                        <input id="adjunto_entramite_minedu" type="file" class="form-control" name="adjunto_entramite_minedu" disabled/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF y no tener un tamaño superior a 10MB</em>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <input type="radio" name="additional_attatchments" value="adjunto_res_convalidacion"> ¿o desea adjuntar resolución de convalidación?<br>
                    <label for="adjunto_res_convalidacion" class="col-sm-12 col-md-12">Resolución de convalidación: </label>
                    <div class="col-sm-12 col-md-12">
                        <input id="adjunto_res_convalidacion" type="file" class="form-control" name="adjunto_res_convalidacion" disabled/>
                        <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF y no tener un tamaño superior a 10MB</em>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-success form-control">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <i class="fa fa-plus" aria-hidden="true"></i>                    
                    Adicionar información de estudios
                </button>
            </div>
        </div>   

    </form>

    <div class="panel-heading">
        <strong>Resumen de estudios ingresados</strong>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de la institución</th>
                    <th>Título</th>
					<th>Nivel del estudio</th>
                    <th>Fecha de inicio de vinculación</th>
                    <th>Fecha de fin de vinculación</th>
                    <th>Documento de soporte</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            @forelse($estudios as $estudio)
            <tr>
                <td>
                    {{$estudio->institucion}}
                </td>
                <td>
                    {{$estudio->titulo}}
                </td>
				<td>
					@if ($estudio->nivel=='Otro')
						{{$estudio->otro_nivel}}
					@else
						{{$estudio->nivel}}
					@endif
                </td>
                <td>
                    {{$estudio->fecha_inicio}}
                </td>
                <td>
					@if(!$estudio->fecha_finalizacion==null)
						{{$estudio->fecha_finalizacion}}
                    @else
						En curso
                    @endif
                </td>
                <td>
                    @if(!$estudio->ruta_adjunto==null)
						<a href="{{env('APP_URL').$estudio->ruta_adjunto}} " target="_blank">Documento de soporte</a><br>
                    @else
						No requerido
                    @endif                 
                    @if($estudio->ruta_entramite_minedu)
						<a href="{{env('APP_URL').$estudio->ruta_entramite_minedu}}" target="_blank">Documento de manifiesto: En trámite ante MinEdu</a><br>
                    @endif
                    @if($estudio->ruta_res_convalidacion)
						<a href="{{env('APP_URL').$estudio->ruta_res_convalidacion}}" target="_blank">Resolución de convalidación</a><br>
                    @endif
                </td>
                <td>
                    <form method="post" action="{{ env('APP_URL') }}estudios/delete" class="form-horizontal" style="margin:20px 0">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$estudio->id}}"/>
                        <button type="submit" data-id="{{$estudio->id}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No se han ingresado información asociada.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

<script>
	$( document ).ready(function() {
 		$("input[name='additional_attatchments']").attr("required", "required");
		//Al cargar la página se ocultan los campos fecha de inicio y fecha de finalización
		$('#fecha_inicio_container').hide();
		$('#fecha_finalizacion_container').hide();
		$('#otro_nivel_estudio_container').hide();
 	});

    (function ($) {
		//Función que se ejecuta cada vez que cambia el valor del radio button En curso?
        $("input[name='en_curso']").on("change", function () {
			$('#fecha_inicio_container').show();
            var $this = $(this);
			//Si el valor es No
            if ($this.val() == 0) {
				//Mostrar la fecha de finalización y los campos para carga de adjuntos de convalidación
                $('#fecha_finalizacion_container').show();
				$(".additional_attatchments").show();
				//Revisar los valores del país y la institución seleccionadas actualmente en el formulario
				var pais = $("#paises_id").val();
				var institucion = $('#institucion').val();
				//Si el país no es Colombia, entonces los adjuntos de resolución o convalidación ante MinEdu
				//son requeridos.
				if (pais != 57) {
					$("input[name='additional_attatchments']").attr("required", "required");
					$("#adjunto_entramite_minedu").removeAttr("disabled");
					$("#adjunto_res_convalidacion").removeAttr("disabled");
				}
            } 
			//Si el valor es Sí
			else {
				//Ocultar la fecha de finalización y los campos para carga de adjuntos
                $('#fecha_finalizacion_container').hide();
				$(".additional_attatchments").hide();
				//Deshabilitar y quitar atributo requerido a los adjuntos de resolución o convalidación ante MinEdu
				$("input[name='additional_attatchments']").removeAttr("required");
				$("#adjunto_entramite_minedu").attr("disabled");
				$("#adjunto_res_convalidacion").attr("disabled");
            }
        });
		
		//Función que se ejecuta cuando cambia el valor del select box nivel_estudio_id
		$('#nivel_estudio_id').on("change", function () {
            var selected = $(this).find("option:selected");
			//Si se selecciona la opción Otro, entonces se activa un campo de texto para ingresar el nombre del
			//tipo de estudio
            if ($.trim(selected.text().toLowerCase()) == 'otro') {
				$('#otro_nivel_estudio_container').show();
				$('#otro_nivel_estudio').attr('disabled', false);
                $('#otro_nivel_estudio').attr("required", "required");
            } 
			//Si se selecciona cualquier otro valor de la lista se oculta el campo de texto
			else {
                $('#otro_nivel_estudio_container').hide();
				$('#otro_nivel_estudio').attr('disabled', true);
                $('#otro_nivel_estudio').removeAttr("required");
            }

        });
		
        $("input[name='additional_attatchments']").on("change", function () {
            var pais = $("#paises_id").val();
            var id = $(this).val();
            var name = $(this).attr("name");
            
            $("input[name='" + name + "']").each(function (i, e) {
             
                $("#" + $(this).val()).fileinput("disable");
                $("#" + $(this).val()).removeAttr("required");
            });
            $("#" + id).fileinput("enable");
            if (pais != 57) {
                $("#" + id).attr("required", "required");
            }
        });
		
        var unal_places = [
            'Universidad Nacional de Colombia - Sede Bogotá',
        ];
		
        var unal_bh = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: unal_places
        });
		
        $('#institucion').typeahead(
                null, {
                    name: 'unal_names',
                    source: unal_bh
                }
        );

        $("#institucion").focusout(function () {
            var i = 0;
            var unal_selected = false;
            while (unal_places.length > i && !unal_selected) {
                if (unal_places[i] == $("#institucion").val()) {
                    unal_selected = true;
                }
                i++;
            }
            if (unal_selected) {
                $("#paises_id").val('57').change();
            }
        });

        $('#institucion').bind('typeahead:select', function (ev, suggestion) {
            unal_selected = true;
        });

        $('#paises_id').on("change", function () {
            var $selected=$(this).find("option:selected");
            
            if ($.trim($selected.text().toLowerCase()) != 'colombia') {
				$("input[name='additional_attatchments']").attr('disabled', false);
                $("input[name='additional_attatchments']").attr("required", "required");
            } else {
                $("input[name='additional_attatchments']").removeAttr("required");
				$("input[name='additional_attatchments']").prop('checked', false);
				$("input[name='additional_attatchments']").attr('disabled', true);
                $("input[name='additional_attatchments']").each(function (i, e) {
                    $("#" + $(this).val()).removeAttr("required");
					$("#" + $(this).val()).attr('disabled', true);
                });
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