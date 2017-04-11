@extends('main')

@section('form')

<div class="alert alert-warning alert-dismissible" role="alert" style="font-size:18px">
  <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta que toda la información que digite en el formulario, debe registrarse únicamente en español
</div>

<div class="panel panel-default">
    @if($msg)
    <div class="alert alert-success" role="alert" style="font-size:18px">
        {{$msg}}
    </div>
    @endif
    <div class="panel-heading" style="font-size:20px">
        <strong>Experiencia en investigación</strong>
    </div>

    <form name="registro" id="registro" method="post" action="{{ env('APP_URL') }}experiencia_investigativa" class="form-horizontal" style="margin:20px 0" enctype="multipart/form-data">     
        {!! csrf_field() !!}

        <div class="panel-body">
            <div class="form-group">
                <label for="nombre_proyecto" class="col-sm-12 col-md-2 control-label">Nombre de la investigación</label>
                <div class="col-sm-12 col-md-10">
                    <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" placeholder="Nombre del proyecto" required>
                </div>
            </div>
			
			<div class="form-group">
                <label for="institucion" class="col-sm-12 col-md-2 control-label">Institución donde se desarrolló la investigación</label>
                <div class="col-sm-12 col-md-10">					
                    <input type="text" class="form-control typeahead" id="institucion" name="institucion" placeholder="Nombre de la institución" data-provide="typeahead"  autocomplete="off" value="" required>
                </div>
            </div>
			
            <div class="form-group">
                <label for="area_proyecto" class="col-sm-12 col-md-2 control-label">Área del proyecto</label>
                <div class="col-sm-12 col-md-10">
                    <input type="text" class="form-control" id="area_proyecto" name="area_proyecto" placeholder="Área del proyecto" required>
                </div>
            </div>
			
			<div class="form-group">
				<label class="col-sm-12 col-md-2 control-label" for="en_curso" >¿Proyecto tiene financiación?</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="financiacion" data-id="entidad_financiadora" value="1" required>Si
				</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="financiacion" data-id="entidad_financiadora" value="0">No
				</label>
				<div id="entidad_financiadota_container">
					<label for="entidad_financiadora" class="col-sm-12 col-md-2 control-label">Entidad financiadora</label>
					<div class="col-sm-12 col-md-6">
						<input type="text" class="form-control" id="entidad_financiadora" name="entidad_financiadora">
					</div>
				</div>
            </div>
			
            <div class="form-group">
                <label for="funcion_principal" class="col-sm-12 col-md-2 control-label">Funciones principales</label>
                <div class="col-sm-12 col-md-10">
                    <textarea name="funcion_principal" id="funcion_principal" class="form-control" maxlength="200" placehoder="Funciones principales"></textarea>
                </div>
            </div>

            <div class="form-group">
				<label class="col-sm-12 col-md-2 control-label" for="en_curso" >¿Vinculación en curso?</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="en_curso" data-id="fecha_finalizacion" value="1" required>Si
				</label>
				<label class="col-sm-12 col-md-1 control-label">
					<input type="radio" name="en_curso" data-id="fecha_finalizacion" value="0">No
				</label>
				
                <div id="fecha_inicio_container">
                    <label for="fecha_inicio" class="col-sm-12 col-md-2 control-label">Fecha de inicio de vinculación</label>
                    <div class="col-sm-12 col-md-2">
                        <input type="text"  class="datepicker2 end maxToday form-control" id="fecha_inicio" name="fecha_inicio" placeholder="####-##-##" required>
                     </div>
                </div>

                <div id="fecha_finalizacion_container">
                    <label for="fecha_finalizacion" class="col-sm-12 col-md-2 control-label">Fecha de finalización de vinculación</label>
                    <div class="col-sm-12 col-md-2">
                        <input type="text" class="datepicker2 end maxToday form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="####-##-##" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
                <div class="col-sm-4">
                    <select id="paises_id" name="paises_id" class="form-control">
                        @foreach($paises as $pais)
                        <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			
            <div class="form-group">
                <label for="adjunto" class="col-sm-12 col-md-2 control-label">Documento de soporte: </label>
                <div class="col-sm-12 col-md-10">
                    <input id="adjunto" type="file" class="form-control" name="adjunto" required />
                    <br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF y no tener un tamaño superior a 10MB</em>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-success form-control">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Agregar experiencia investigativa
                    </button>
                </div>
            </div>     
        </div>

    </form>

    <div class="panel-heading" style="font-size:20px">
        <strong>Resumen de experiencia investigativa</strong>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre del proyecto</th>
                    <th>Área del proyecto</th>
                    <th>Fecha de inicio de vinculación</th>
                    <th>Fecha de fin de vinculación</th>
                    <th>Documento adjunto</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            @forelse($experiencias_investigativa as $experiencia_investigativa)
            <tr>
                <td>
                    {{$experiencia_investigativa->nombre_proyecto}}
                </td>
                <td>
                    {{$experiencia_investigativa->area_proyecto}}
                </td>
                <td>
                    {{$experiencia_investigativa->fecha_inicio}}
                </td>
                <td>
					@if(!$experiencia_investigativa->fecha_finalizacion==null)
						{{$experiencia_investigativa->fecha_finalizacion}}
                    @else
						Vinculación vigente
                    @endif               
                </td>
                <td>
					@if(!$experiencia_investigativa->ruta_adjunto==null)
						<a href="{{env('APP_URL').$experiencia_investigativa->ruta_adjunto}}" target="_blank">Documento adjunto</a>
                    @else
						No requerido
                    @endif                    
                </td>
                <td>
                    <form method="post" action="{{ env('APP_URL') }}experiencia_investigativa/delete" style="margin:20px 0">     
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$experiencia_investigativa->id}}"/>
                        <button type="submit" data-id="{{$experiencia_investigativa->id}}" class="btn btn-danger btn-sm">
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
		//Al cargar la página se ocultan los campos fecha de inicio y fecha de finalización
		$('#fecha_inicio_container').hide();
		$('#fecha_finalizacion_container').hide();
		$('#entidad_financiadota_container').hide();
 	});
	
    (function ($) {
        var unal_places = [
            'Universidad Nacional de Colombia - Sede Bogotá',
        ];
		
        var unal_bh = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: unal_places
        });
		
        $('#institucion').typeahead(
                null,
                {
                    name: 'unal_names',
                    source: unal_bh
                }
        );
		
		$('#institucion').bind('typeahead:select', function (ev, suggestion) {
            unal_selected = true;
        });
		
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
        
        //Función que se ejecuta cada vez que cambia el valor del radio button En curso?
		$("input[name='en_curso']").on("change", function () {
			$('#fecha_inicio_container').show();
			var $this = $(this);
            //Si el valor es No
            if ($this.val() == 0) {
				//Mostrar la fecha de finalización
                $('#fecha_finalizacion_container').show();
				$('#fecha_finalizacion').attr("required", "required");
				$('#fecha_finalizacion').removeAttr("disabled");
            }
			//Si el valor es Sí
			else {
				//Ocultar la fecha de finalización
                $('#fecha_finalizacion_container').hide();
				$('#fecha_finalizacion').attr("disabled");
				$('#fecha_finalizacion').removeAttr("required");
            }
        });
		
		//Función que se ejecuta cada vez que cambia el valor del radio button 
		//Proyecto tiene financiación?
		$("input[name='financiacion']").on("change", function () {
			var $this = $(this);
            //Si el valor es No
            if ($this.val() == 0) {
				//Ocultar el campo de entidad financiadora y quitar atributo requerido
                $('#entidad_financiadota_container').hide();
				$('#entidad_financiadora').attr("disabled");
				$('#entidad_financiadora').removeAttr("required");
            }
			//Si el valor es Sí
			else {
				//Mostrar el campo de entidad financiadota y hacer que sea requerido
                $('#entidad_financiadota_container').show();
				$('#entidad_financiadora').attr("required", "required");
				$('#entidad_financiadora').removeAttr("disabled");
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
