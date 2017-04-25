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
        <strong>Idiomas</strong>
    </div>
    <form method="post" action="{{ env('APP_URL') }}idiomas" class="form-horizontal" style="margin:20px 0" enctype="multipart/form-data">     
        {!! csrf_field() !!}
		
		<div class="form-group" id="acreditar_ingles_container">
			<label for="acreditar_ingles" class="col-sm-12 col-md-10 control-label">¿Acreditará el nivel de suficiencia 
			exigido en idioma inglés por la Universidad mediante la prueba que aplica la Dirección Nacional de 
			Admisiones?</label>
			<label class="col-sm-12 col-md-1 control-label">
				<input type="radio" id="acreditar_ingles" name="acreditar_ingles" value="1">Si
			</label>
			<label class="col-sm-12 col-md-1 control-label">
				<input type="radio" name="acreditar_ingles" value="0">No
			</label>
        </div>	

        <div class="form-group">
            <label for="idiomas_id" class="col-sm-12 col-md-2 control-label">Idioma </label>
            <div class="col-sm-12 col-md-6">
                <select id="idiomas_id" name="idiomas_id" class="form-control" required>
                    @foreach($idiomas as $idioma)
                    <option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
                    @endforeach
                </select>
            </div>
			
			<div id="nativo_container">
				<label for="nativo" class="col-sm-12 col-md-2 control-label">¿Es su idioma nativo?</label>
					<label class="col-sm-12 col-md-1 control-label">
						<input type="radio" id="nativo" name="nativo" value="1" required>Si
					</label>
					<label class="col-sm-12 col-md-1 control-label">
						<input type="radio" id="nativo" name="nativo" value="0">No
					</label>
			</div>
        </div>		
		
        <div class="form-group">
			<div id="nombre_certificado">
				<label for="nombre_certificado" class="col-sm-12 col-md-2 control-label">Nombre del certificado</label>
				<div class="col-sm-12 col-md-10">
					<input type="text" id="nombre_certificado_input" class="form-control" name="nombre_certificado" placeholder="" required>
				</div>
			</div>            
        </div>
		
        <div id="puntaje" class="form-group">
			<label for="" class="col-sm-12 col-md-2 control-label">Puntaje</label>
			<div class="col-sm-12 col-md-6">
				<input type="text" id="puntaje_input" class="form-control" name="puntaje" placeholder="">
			</div>
			
			@if ($nivel_programa->nivel_id == 4)
				<label for="" class="col-sm-12 col-md-2 control-label">Nivel según el marco de referencia europeo</label>
				<div class="col-sm-12 col-md-2">
					<select id="marco_referencia" name="marco_referencia" class="form-control" required>
						<option value="B1">B1</option>
						<option value="B1">B2</option>
						<option value="B1">C1</option>
						<option value="B1">C2</option>
					</select>
				</div>
			@endif
        </div>
		
        <div class="form-group">
			<div id="adjunto">
				<label for="adjunto" class="col-sm-12 col-md-2 control-label">Documento de soporte:</label>
				<div class="col-sm-12 col-md-5">
					<input type="file" id="adjunto_input" class="form-control" name="adjunto">
					<br><em>Por favor, tenga en cuenta que el archivo adjunto debe estar en formato PDF y no tener un tamaño superior a 10MB</em>
				</div>
			</div>            
        </div>
		
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-success form-control">
                    <i class="fa fa-language" aria-hidden="true"></i>
                    <i class="fa fa-plus" aria-hidden="true"></i>                    
                    Adicionar información de idioma
                </button>
            </div>
        </div>  

    </form>    

    <div class="panel-heading" style="font-size:20px">
        <strong>Resumen de idiomas dominados</strong>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Idioma</th>
					<th>Nativo</th>
                    <th>Tipo de certificación</th>
                    <th>Documento de soporte</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            @forelse($idiomas_certificados as $idioma_certificado)
            <tr>
                <td>
                    {{$idiomas[$idioma_certificado->idiomas_id]->nombre}}
                </td>
				<td>
					@if($idioma_certificado->nativo == 1)
						Si
					@else
						No
					@endif
                </td>
                <td>
					@if($idioma_certificado->nativo == 1 || $idioma_certificado->acreditar_ingles == 1)
						No requerido
					@else
						{{$idioma_certificado->nombre_certificado}}
					@endif                    
                </td>
                <td>
					@if($idioma_certificado->nativo == 1 || $idioma_certificado->acreditar_ingles == 1)
						No requerido
					@else
						<a href="{{env('APP_URL').$idioma_certificado->ruta_adjunto}}" target="_blank">Documento adjunto</a>
					@endif                    
                </td>
                <td>
                    <form method="post" action="{{ env('APP_URL') }}idiomas/delete" style="margin:20px 0">     
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$idioma_certificado->id}}"/>
                        <button type="submit" data-id="{{$idioma_certificado->id}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No se han ingresado información asociada.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

<script>
	$( document ).ready(function() {
		//Cargamos en una variable de Javascript el nivel de estudio (4 es para doctorado)
		var nivel_programa = {!!$nivel_programa!!};
		var nivel_estudio = nivel_programa.nivel_id;
		
		//Cargamos el conjunto de registros de certificados de idiomas en una variable de Javascript
		var idiomas_certificados = {!!$idiomas_certificados!!};
		console.log(idiomas_certificados);
		
		//Convertimos el objeto en un arreglo
		var idiomas = $.map(idiomas_certificados, function(value, index) {
			return [value];
		});
		
		//Verificamos si ya se guardó el idioma inglés anteriormente
		var ingles_guardado = 0;
		for (var i = 0; i < idiomas.length; i++) {
			console.log(idiomas[i]);
			if (idiomas[i].idiomas_id == 2) ingles_guardado = 1;
		}
		console.log(ingles_guardado);
		
		if (nivel_estudio == 4 && ingles_guardado == 0) {
			$("#idiomas_id").val("2");
			$('#acreditar_ingles_container').show();
			$('#acreditar_ingles').prop('required', true);
			$("#nombre_certificado, #puntaje, #adjunto, #nativo_container").hide();
			$("#nombre_certificado_input, #adjunto_input, #idiomas_id, #nativo").removeAttr("required");
		}
		else {
			//Al cargar la página se oculta el campo de pregunta sobre acreditación de inglés
			//si el estudio es diferente a un doctorado
			$('#acreditar_ingles_container').hide();
		}
		

 	});
	
    (function ($) {
        $("input[name='nativo']").on("change", function () {			
            if ($(this).val() == 0) {				
                $("#nombre_certificado, #puntaje, #adjunto").show();
				$("#nombre_certificado_input, #adjunto_input, #marco_referencia").attr("required", "required");
            } else {  
                $("#nombre_certificado, #puntaje, #adjunto").hide();
				$("#nombre_certificado_input, #adjunto_input").removeAttr("required");
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
		
		//Función que se activa cuando cambia la selección de idioma en el formulario. Select box idiomas_id
		$('#idiomas_id').on("change", function () {
            var $selected=$(this).find("option:selected");
            var nivel_programa = {!!$nivel_programa!!};
			var nivel_estudio = nivel_programa.nivel_id;
			//El idioma seleccionado es inglés
            if ($.trim($selected.text().toLowerCase()) == 'inglés') {
				if (nivel_estudio == 4) {
					$('#acreditar_ingles_container').show();
					$('#acreditar_ingles').attr("required, required");
				}
            }
			else {
				if (nivel_estudio == 4) {
					$('#acreditar_ingles_container').hide();
					$('#acreditar_ingles').removeAttr("required");
					$("#nombre_certificado, #puntaje, #adjunto, #nativo_container").show();
					$("#nombre_certificado_input, #adjunto_input, #marco_referencia, #idiomas_id, #nativo").attr("required", "required");
				}
				else {
					$("#nombre_certificado, #puntaje, #adjunto, #nativo_container").show();
					$("#nombre_certificado_input, #adjunto_input, #marco_referencia, #idiomas_id, #nativo").attr("required", "required");
				}
            }
        });
		
		//Función que se ejecuta cada vez que cambia el valor del radio button de acreditación
        $("input[name='acreditar_ingles']").on("change", function () {
			var $this = $(this);
			//Si el valor es No
            if ($this.val() == 0) {
				$("#nombre_certificado, #puntaje, #adjunto, #nativo_container").show();
				$("#nombre_certificado_input, #adjunto_input, #marco_referencia, #idiomas_id, #nativo").attr("required", "required");
			}
			//Si el valor es Sí
			else {
				$("#nombre_certificado, #puntaje, #adjunto, #nativo_container").hide();
				$("#nombre_certificado_input, #adjunto_input, #idiomas_id, #nativo").removeAttr("required");
			}
		});
    })(jQuery);
</script>
@stop
