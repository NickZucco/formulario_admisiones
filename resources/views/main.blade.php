@extends('unal')

@section('content')

 @if (Session::has('status'))
<div class="alert alert-success">
    {{ Session::get('status') }}
</div>
@endif

<div class="row">
    <p style="font-size:22px">Bienvenido/a {{Auth::user()->name}}
    <br>
    <!--<div style="display:inline-block;float:right">
        El formulario se cerrará en&nbsp;<span id="countdown" style="float:right"> </span>
    </div>-->
</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#">Menú Principal</a>-->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li style="border:1px solid black"><a href="{{ env('APP_URL') }}datos" data-path="datos"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Datos personales</a></li>
                @if(App\Aspirante::where('correo', '=', Auth::user()->email)->first())
					<li style="border:1px solid black"><a href="{{ env('APP_URL') }}programas" data-path="programas"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Programas</a></li>
					@forelse($programa_seleccionado as $programa)
						<li id="estudios_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}estudios" data-path="estudios"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;Estudios universitarios [{{$count['estudio']}}]</a></li>
						<li id="distincion_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}distinciones" data-path="distinciones"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Distinciones académicas [{{$count['distincion']}}]</a></li>
						<li id="laboral_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}experiencia_laboral" data-path="experiencia_laboral"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Experiencia laboral [{{$count['laboral']}}]</a></li>
						<li id="docente_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}experiencia_docente" data-path="experiencia_docente"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Experiencia docente [{{$count['docente']}}]</a></li>
						<li id="investigativa_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}experiencia_investigativa" data-path="experiencia_investigativa"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Experiencia investigativa [{{$count['investigativa']}}]</a></li>
						<li id="produccion_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}produccion_intelectual" data-path="produccion_intelectual"><i class="fa fa-lightbulb-o" aria-hidden="true"></i>&nbsp;Producción intelectual [{{$count['produccion']}}]</a></li>
						<li id="idioma_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}idiomas" data-path="idiomas"><i class="fa fa-language" aria-hidden="true"></i>&nbsp;Idiomas [{{$count['idioma']}}]</a></li>
						<li id="referencias_p" style="border:1px solid black"><a href="#" data-path="referencias"><i class="fa fa-puzzle-piece" aria-hidden="true"></i>&nbsp;Referencias</a></li>
						<li id="especifico_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}especificos" data-path="especificos"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Adicionales</a></li>
						<li id="resumen_p" style="border:1px solid black"><a href="{{ env('APP_URL') }}resumen" data-path="resumen"><i class="fa fa-map" aria-hidden="true"></i>&nbsp;Resumen</a></li>
						<li id="formulario_referencias" style="border:1px solid black"><a href="{{ env('APP_URL') }}formulario_referencias" data-path="formulario_referencias"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Formulario Referencias</a></li>
					@empty
						<li style="border:1px solid black"><a href="#" disabled>
						<i class="hidden-xs hidden-sm fa fa-arrow-left" aria-hidden="true"></i>
						 Debe seleccionar y guardar el <i class="fa fa-user" style="color:#95d072" aria-hidden="true"></i> programa de posgrado al cual aspira antes de poder diligenciar los demas campos.</a></li>
					@endforelse
				@else
					<li style="border:1px solid black"><a href="#" disabled>Las demas opciones se habilitarán una vez ingrese sus datos personales y seleccione el programa de posgrado al cual aspira.</a></li>
                @endif
                <li style="border:1px solid black"><a href="{{ env('APP_URL') }}auth/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Cerrar sesión</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@if($correo_area != '')
	<div class="alert alert-warning alert-dismissible" role="alert" style="font-size:18px">
		<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>En caso de tener dudas puede escribir al correo {{$correo_area}}</strong>
	</div>
@endif
<div class="alert alert-warning alert-dismissible" role="alert" style="font-size:18px">
	<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>La Facultad de Ingeniería de la Universidad 
	Nacional de Colombia, no se hace responsable en caso de que el aspirante no pueda ingresar sus datos y documentos
	satisfactoriamente por medio del aplicativo para recepción de hojas de vida para el proceso de admisiones de 
	posgrados 2017-II, debido a demanda de usuarios simultáneos que superen la capacidad del sistema. Se recomienda 
	adelantar el proceso con anterioridad a la fecha de cierre. </strong>
</div>
<div class="col-sm-12 col-md-12" style="border-radius: 5px 5px 5px 5px; box-shadow: 3px 3px 10px #888888; padding: 3px; background-color:#E4F5FA">
	@yield('form')
</div>

<script>

	$(document).ready(function(){
      var count = {!!$count['estudio']!!};
	  if (count > 0) {
		  $('#estudios_p').css('background-color', '#A1F58B');
	  }
	  else $('#estudios_p').css('background-color', '#FFAAAA');
	  count = {!!$count['distincion']!!};
	  if (count > 0) {
		  $('#distincion_p').css('background-color', '#A1F58B');
	  }
	  else $('#distincion_p').css('background-color', '#FFAAAA');
	  count = {!!$count['laboral']!!};
	  if (count > 0) {
		  $('#laboral_p').css('background-color', '#A1F58B');
	  }
	  else $('#laboral_p').css('background-color', '#FFAAAA');
	  count = {!!$count['docente']!!};
	  if (count > 0) {
		  $('#docente_p').css('background-color', '#A1F58B');
	  }
	  else $('#docente_p').css('background-color', '#FFAAAA');
	  count = {!!$count['investigativa']!!};
	  if (count > 0) {
		  $('#investigativa_p').css('background-color', '#A1F58B');
	  }
	  else $('#investigativa_p').css('background-color', '#FFAAAA');
	  count = {!!$count['produccion']!!};
	  if (count > 0) {
		  $('#produccion_p').css('background-color', '#A1F58B');
	  }
	  else $('#produccion_p').css('background-color', '#FFAAAA');
	  count = {!!$count['idioma']!!};
	  if (count > 0) {
		  $('#idioma_p').css('background-color', '#A1F58B');
	  }
	  else $('#idioma_p').css('background-color', '#FFAAAA');

    });


</script>
@stop
