@extends('unal')

@section('content')
<style>
.dropdown-menu {
	max-height: 300px;
	overflow-y: auto;
	overflow-x: auto;
	font-size: 8px;
}

.dropdown-menu li {
	font-size: 12px;
}

</style>

<div class="panel-heading">
    <p>Bienvenido {{Auth::user()->name}}</p>
    <p>Seleccione uno o varios programas para ver los candidatos inscritos.   </p>
</div>

<div class="panel-body">
    <div class="form-group">
        <div class="col-md-4">
            <select size="5" id="program_list" multiple="multiple" class="form-control">
                <option value="0">Todos los programas</option>
                @foreach($programas as $programa)
					<option value="{{$programa->id}}">{{$programa->nombre}}</option>
                @endforeach
            </select>
        </div>

		<div class="col-md-3">
            <form method="get" action="{{ env('APP_URL') }}auth/logout">     
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-danger">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>

<div class="panel-heading">
    <strong>Resumen de aspirantes registrados</strong>
</div>
<div class="panel-body">
    <table id="candidates" class="datatable table table-striped">
        <thead>
            <tr>
				<th style="text-align: center">Número</th>
                <th style="text-align: center">Documento de identidad</th>
                <th style="text-align: center">Nombres y apellidos</th>
                <th style="text-align: center">Correo</th>
                <th style="text-align: center">Fecha de registro</th>
                <th style="text-align: center">Fecha de última actualización</th>
                <th style="text-align: center">Hoja de vida</th>
                <th style="text-align: center">Adjuntos</th>
            </tr>
        </thead>
        <tbody>
            <tr id="not_selected_program">
                <td colspan="8"> No se ha seleccionado ningun programa todavia. Por favor, seleccione al menos un programa para mostrar la lista de candidatos inscritos.</td>
            </tr>
			<?php $numero_candidatos = 1; ?>
            @foreach($aspirantes as $aspirante)
            <tr data-id="{{$aspirante->id}}" class="candidate_row">
				<td style="text-align: center">
                    <strong>{{$numero_candidatos}}</strong>
					<?php $numero_candidatos++; ?>
                </td>
                <td style="text-align: center"> 
                    {{$aspirante->documento}}
                </td>
                <td style="text-align: center">
                    {{$aspirante->nombre}} {{$aspirante->apellido}}
                </td>
                <td style="text-align: center">
                    {{$aspirante->correo}}
                </td>
                <td style="text-align: center">
                    {{$aspirante->created_at}}
                </td>
                <td style="text-align: center">
                    {{$aspirante->updated_at}}
                </td>
                <td style="text-align: center">
                    <form method="get" action="{{ env('APP_URL') }}admin/candidatos/reporte" style="margin:20px 0">     
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$aspirante->id}}"/>
                        <button type="submit" data-id="{{$aspirante->id}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-clone" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
                <td style="text-align: center">
                    <form method="get" action="{{ env('APP_URL') }}admin/candidatos/adjuntos" style="margin:20px 0">     
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$aspirante->id}}"/>
                        <button type="submit" data-id="{{$aspirante->id}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                        </button>
                    </form> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<script type="text/javascript">
    (function ($) {
		var aspirantes = {!!$aspirantes!!};
        var selected_program_ids = [];
		
		//La variable excel_input es utilizada para cambiar dinámicamente el value del elemento input
		//que tiene el id "excel_input". Como se sabe, el value de un campo input debe tener la forma
		//value="1" o value="mi_nombre", es decir, estar asignado a un string. Dado que en este campo
		//input se quiere pasar como parámetro al controlador AdminController el listado de los IDs de
		//los perfiles seleccionados de la lista desplegable, es necesario modificar el string que se le
		//asigna a value por medio de JavaScript.
		var excel_input = document.getElementById("excel_input");

        $("#candidates .candidate_row").hide();

        function updateCandidates(index, checked) {
			$("#not_selected_program").hide();
            $("#candidates .candidate_row").hide();
						
			if (!checked) {
				var itr = selected_program_ids.indexOf(index);
				if (index > -1) {
					selected_program_ids.splice(itr, 1);
				}
			}
			else {
				selected_program_ids.push(index);
			}
			
			if(selected_program_ids.length<=0){
				$("#not_selected_program").show();
			}
			else {
				if ($.inArray('0', selected_program_ids) != -1) {
					$("#candidates .candidate_row").show();
				}
				else {
					$.each(selected_program_ids, function (index, item) {
						$.each(aspirantes, function (spids_index, spids_item) {
							if (spids_item.programa_posgrado_id == item) {
								$("#candidates .candidate_row[data-id='" + spids_item.id + "']").show();
							}
						});
					});
				}
			}          
        }
		
        $('#program_list').multiselect({			
            nSelectedText: 'seleccionados',
            nonSelectedText: 'No hay elementos seleccionados',
            numberDisplayed: 0, 
            onChange: function (option, checked, select) {
                updateCandidates($(option).val(), checked);
            }
        });
        
    })(jQuery);

</script>

@stop
