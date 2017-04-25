@extends('main')

@section('form')

<div class="alert alert-warning alert-dismissible" role="alert" style="font-size:18px">
	<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta que toda la información que digite en el formulario, debe registrarse únicamente en español
</div>

@if($msg)
<div class="alert alert-success" role="alert" style="font-size:18px">
    {{$msg}}
</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading" style="font-size:20px">
        Información de la postulación del aspirante   
    </div>
    <div class="panel-body" style="font-size:20px">
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<p><strong>Área curricular</strong></p>
			</div>
			<div class="col-sm-12 col-md-8">
				<p><strong>{{$programa_completo->area_curricular}}</strong></p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<p><strong>Programa de posgrado</strong></p>
			</div>
			<div class="col-sm-12 col-md-8">
				<p><strong>{{$programa_completo->programa}}</strong></p>
			</div>
		</div>
	</div>
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