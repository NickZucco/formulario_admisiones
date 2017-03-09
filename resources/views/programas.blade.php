@extends('main')

@section('form')

<div class="alert alert-warning alert-dismissible" role="alert">
	<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta que toda la información que digite en el formulario, debe registrarse únicamente en español
</div>

@if($msg)
<div class="alert alert-success" role="alert">
    {{$msg}}
</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        Selección del programa de posgrado al cual se postuló el aspirante   
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label for="nombre_area" class="col-md-2 control-label">Áreas curriculares de la Facultad de Ingeniería</label>
            <div class="col-md-8">
                <select id="lista_areas_curriculares" class="form-control">
					<option value="0">--Seleccione un área curricular--</option>
                    @foreach($areas_curriculares as $area)
						<option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="panel-heading">
        Información de programas de posgrado ofrecidos por cada área curricular
    </div>
    <form method="post" action="{{ env('APP_URL') }}programas" class="form-horizontal" style="margin:20px 0">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="panel-heading">
                        <h4>Lista completa de programas de posgrado disponibles por área curricular</h4>
                    </div>
                    <div class="panel-body">
                        <table id="programas" class="table table-striped table-hover"> 
                            <thead>
                                <tr>
                                    <th width="70%">Nombre del programa</th>
                                    <th width="30%">¿Seleccionar?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="programa_no_seleccionado">
                                    <td colspan="8"> No se ha seleccionado ningún área curricular. Por favor, seleccione un área para mostrar la lista de programas asociados.</td>
                                </tr>
                                @foreach($programas_posgrado as $programa)
                                <tr data-id="{{$programa->id}}" class="programa_row area_curricular_{{$programa->area_curricular_id}}">
                                    <td>{{$programa->nombre}}</td>
                                    <td>
                                        <input id="programa-{{$programa->id}}" data-id="{{$programa->id}}" class="programa" name="programa" type="checkbox" value="{{$programa->id}}" class="checkbox">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-sm-12 col-md-12">
                    <div>
                        <div class="panel-heading">
                            <h4>Programa de posgrado seleccionado previamente</h4>
                        </div>
                        <div class="panel-body">
							@forelse($programa_seleccionado as $programa)
								<p><strong>{{$programa->nombre}}</strong></p>
							@empty
								<div class="alert alert-warning" role="alert">
									No se encontró un programa de posgrado seleccionado. Por favor, seleccione un programa de la tabla y de click en el botón <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar programa seleccionado.
								</div>
							@endforelse
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-success form-control">
                    <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar programa seleccionado
                </button>
            </div>
        </div>
        {!! csrf_field() !!}

    </form>
</div>


<script type="text/javascript">
    (function ($) {
		//Inicialmente, cuando se carga la página, ningún programa se visualiza puesto que por defecto
		//ningún área curricular está seleccionada en la lista.
		$("#programa_no_seleccionado").show();
		$(".programa_row").hide();
		
		//Función que se ejecuta cada vez que cambia la opción seleccionada del select box con
		//id="lista_areas_curriculares"
		$("#lista_areas_curriculares").change(function () {
			//Tomar el valor actual seleccionado
			var id = $("#lista_areas_curriculares option:selected").val();
			//Ocultar todos los programas de posgrado
			$("#programa_no_seleccionado").hide();
			$(".programa_row").hide();
			//Mostrar solo los programas correspondientes al área curricular seleccionada
			switch(id) {
				case '0':
					$("#programa_no_seleccionado").show();
					break;
				case '1':
					$(".area_curricular_1").show();
					break;
				case '2':
					$(".area_curricular_2").show();
					break;
				case '3':
					$(".area_curricular_3").show();
					break;
				case '4':
					$(".area_curricular_4").show();
					break;
				case '5':
					$(".area_curricular_5").show();
					break;
			}
		});
		
		// the selector will match all input controls of type :checkbox
		// and attach a click event handler 
		$("input:checkbox").on('click', function() {
		  // in the handler, 'this' refers to the box clicked on
		  var $box = $(this);
		  if ($box.is(":checked")) {
			// the name of the box is retrieved using the .attr() method
			// as it is assumed and expected to be immutable
			var group = "input:checkbox[name='" + $box.attr("name") + "']";
			// the checked state of the group/box on the other hand will change
			// and the current value is retrieved using .prop() method
			$(group).prop("checked", false);
			$box.prop("checked", true);
		  } else {
			$box.prop("checked", false);
		  }
		});        

    })(jQuery);

</script>

@stop