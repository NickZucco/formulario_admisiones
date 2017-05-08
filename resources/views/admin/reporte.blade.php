<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			* {
				font-family: Helvetica;
			}
			.page-break {
				page-break-after: always;
			}
			body {
				margin:0;
				padding:0;
			}
			h1 {
				text-align: center;
				padding-bottom: -10px;
				padding-top: 20px;
				font-size: 30px;
			}
			p {
				text-align: center;
				padding-bottom: -15px;
				font-size: 14px;
			}
			#datos_encabezado{
				padding-top: 30px;
				padding-bottom: 5px;
				font-size: 24px;
			}
			#datos_encabezado2{
				font-size: 24px;
			}
			.tabla_datos{
				font-size: 11px;
				width: 100%;
				border-collapse: collapse;
				border: 1px solid;
			}
			td {
				padding-top: 1em;
				padding-bottom: 1em;
				padding-left: 15px;
			}
		</style>
	</head>
	<body>
		<h1>HOJA DE VIDA DE ASPIRANTE</h1>
		<p>Universidad Nacional de Colombia - Sede Bogotá<p>
		<p>Facultad de Ingeniería - Admisión a posgrados 2017-II<p>
		
		<!-- Sección de datos personales, tomados de la variable $aspirante -->
		<h2 id="datos_encabezado">Datos Personales</h2>
		<hr>
		<table class="tabla_datos">
			<tr>
				<td>
					<strong>Apellidos</strong>
				</td>
				<td>
					{{$aspirante->apellido}}
				</td>
				<td>
					<strong>Nombres</strong>
				</td>
				<td>
					{{$aspirante->nombre}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Correo electrónico</strong>
				</td>
				<td>
					{{$aspirante->correo}}
				</td>
				<td>
					<strong>Número de documento</strong>
				</td>
				<td>
					{{$aspirante->documento}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Tipo de documento</strong>
				</td>
				<td>
					{{$aspirante->tipo_documento}}
				</td>
				<td>
					<strong>Ciudad de expedición</strong>
				</td>
				<td>
					{{$aspirante->ciudad_documento}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Fecha de nacimiento</strong>
				</td>
				<td>
					{{$aspirante->fecha_nacimiento}}
				</td>
				<td>
					<strong>País de nacimiento</strong>
				</td>
				<td>
					{{$aspirante->pais_nacimiento}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>País de residencia</strong>
				</td>
				<td>
					{{$aspirante->pais_residencia}}
				</td>
				<td>
					<strong>Dirección</strong>
				</td>
				<td>
					{{$aspirante->direccion}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Estado Civil</strong>
				</td>
				<td>
					{{$aspirante->estado_civil}}
				</td>
				<td>
					<strong>Ciudad desde la cual aplica</strong>
				</td>
				<td>
					{{$aspirante->ciudad_aplicante}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Teléfono fijo</strong>
				</td>
				<td>
					{{$aspirante->telefono_fijo}}
				</td>
				<td>
					<strong>Teléfono móvil</strong>
				</td>
				<td>
					{{$aspirante->celular}}
				</td>
			</tr>
		</table>
		<br>
		<!-- Sección de programa de posgrado, tomada de la variable $programa_seleccionado -->
		<h3>Programa de Posgrado seleccionado</h3>
		<hr>
		<table class="tabla_datos">
			<tr>
				<td>
					<strong>Área curricular</strong>
				</td>
				<td>
					{{$programa_seleccionado->area_curricular}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Programa de posgrado</strong>
				</td>
				<td>
					{{$programa_seleccionado->programa}}
				</td>
			</tr>
		</table>
		<br>
		<!-- Sección de financiación, tomada de la variable $financiacion -->
		<!-- Se debe verificar si la información de financiación existe en la base de datos -->
		@if (!$financiacion == null)
			<h3>Financiación</h3>
			<hr>
			<table class="tabla_datos">
				<tr>
					<td>
						<strong>Tipo de financiación</strong>
					</td>
					@if ($financiacion->tipo != "Otro")
						<td>
							{{$financiacion->tipo}}
						</td>
					@else
						<td>
							{{$financiacion->otra}}
						</td>
					@endif
				</tr>
				@if ($financiacion->tipo != "Recursos propios")
					<tr>
						<td>
							<strong>Entidad Financiadora</strong>
						</td>
						<td>
							{{$financiacion->entidad}}
						</td>
					</tr>
				@endif
			</table>
		@endif
		<!-- Inicialización de las variables globales sobrantes y categoria-->
		<?php
			$sobrantes = 0;
			$categoria = 0;
		?>
		
		<!-- Sección de estudios, tomados de la variable $estudios -->
		<!-- Declaración de una variable para contar el número de estudios y saber cuando
			 crear una página nueva y otra variable con el número total de estudios -->
		<?php $total_estudios = count($estudios); ?>
		@if ($total_estudios > 0)
			<?php 
				$numero_estudios = 0;
				$sobrantes = $total_estudios % 4;
			?>
			<!-- Nueva página -->
			<div class="page-break"></div>
			<h2 id="datos_encabezado2">Estudios</h2>
			@foreach ($estudios as $estudio)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título académico obtenido</strong>
						</td>
						<td>
							{{$estudio->titulo}}
						</td>
						<td>
							<strong>Nivel del estudio</strong>
						</td>
						@if ($estudio->nivel_estudio != "Otro")
							<td>
								{{$estudio->nivel_estudio}}
							</td>
						@else
							<td>
								{{$estudio->otro_nivel}}
							</td>
						@endif
					</tr>
					<tr>
						<td>
							<strong>Nombre de la institución</strong>
						</td>
						<td>
							{{$estudio->institucion}}
						</td>
						<td>
							<strong>País donde realizó los estudios</strong>
						</td>
						<td>
							{{$estudio->pais}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿Estudio en curso?</strong>
						</td>
						<td>
							@if ($estudio->en_curso == 1)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Fecha de inicio</strong>
						</td>
						<td>
							{{$estudio->fecha_inicio}}
						</td>
						<td>
							<strong>Fecha de finalización</strong>
						</td>
						<td>
							@if ($estudio->en_curso == 0)
								{{$estudio->fecha_finalizacion}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Máxima nota en la escala</strong>
						</td>
						<td>
							{{$estudio->maximo}}
						</td>
						<td>
							<strong>Mínima nota aprobatoria</strong>
						</td>
						<td>
							{{$estudio->minimo}}
						</td>
						<td>
							<strong>Promedio obtenido</strong>
						</td>
						<td>
							{{$estudio->promedio}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de estudios en 1 y verificamos si ya se han colocado
					 4 estudios en la hoja de vida y si aún quedan más estudios pendientes
					 para agregar una página nueva -->
				<?php $numero_estudios++; ?>
				@if ($numero_estudios % 4 == 0 && $numero_estudios < $total_estudios)
					<!-- Nueva página -->
					<div class="page-break"></div>
				@elseif ($numero_estudios == $total_estudios)
					<?php $estudios_sobrantes = $sobrantes; ?>
					<?php $categoria = 1; ?>
				@endif
			@endforeach
		@else
			<?php $estudios_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de distinciones académicas, tomadas de la variable $distinciones -->
		<!-- Declaración de una variable para contar el número de distinciones y saber cuando
			 crear una página nueva y otra variable con el número total de distinciones -->
		<?php $total_distinciones = count($distinciones); ?>
		@if ($total_distinciones > 0)
			<?php $numero_distinciones = 0; ?>
			@if ($estudios_sobrantes == 1)
				<?php
					$numero_distinciones = 2;
					$total_distinciones = $total_distinciones + 2;
				?>
			@elseif ($estudios_sobrantes == 2)
				<?php 
					$numero_distinciones = 3; 
					$total_distinciones = $total_distinciones + 3;
				?>
			@elseif ($estudios_sobrantes == 3)
				<?php 
					$numero_distinciones = 4; 
					$total_distinciones = $total_distinciones + 4;
				?>
			@elseif ($estudios_sobrantes == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_distinciones % 5; ?>
			<h2 id="datos_encabezado2">Distinciones académicas</h2>
			@foreach ($distinciones as $distincion)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la distinción</strong>
						</td>
						<td>
							{{$distincion->nombre}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Nombre de la institución</strong>
						</td>
						<td>
							{{$distincion->institucion}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Fecha en que se otorgó</strong>
						</td>
						<td>
							{{$distincion->fecha_entrega}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de distinciones en 1 y verificamos si ya se han colocado
					 5 distinciones en la hoja de vida y si aún quedan más distinciones pendientes
					 para agregar una página nueva -->
				<?php $numero_distinciones++; ?>
				@if ($numero_distinciones % 5 == 0 && $numero_distinciones < $total_distinciones )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<br>
				@elseif ($numero_distinciones == $total_distinciones)
					<?php $distinciones_sobrantes = $sobrantes; ?>
					<?php $categoria = 2; ?>
				@endif
			@endforeach
		@else
			<?php $distinciones_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de experiencia laboral, tomadas de la variable $experiencia_laboral -->
		<!-- Declaración de una variable para contar el número de experiencias y saber cuando
			 crear una página nueva y otra variable con el número total de experiencias -->
		<?php $total_experiencias = count($experiencia_laboral); ?>
		@if ($total_experiencias > 0)
			<?php $numero_experiencias = 0; ?>
			@if ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_experiencias = 1; 
						$total_experiencias = $total_experiencias + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_experiencias = 2; 
						$total_experiencias = $total_experiencias + 2;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_experiencias = 3; 
						$total_experiencias = $total_experiencias + 3;
					?>
				@elseif ($distinciones_sobrantes == 4)
					<?php 
						$numero_experiencias = 3; 
						$total_experiencias = $total_experiencias + 3;
					?>
				@elseif ($distinciones_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_experiencias = 2; 
						$total_experiencias = $total_experiencias + 2;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_experiencias = 3; 
						$total_experiencias = $total_experiencias + 3;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_experiencias % 4; ?>
			<h2 id="datos_encabezado2">Experiencia laboral</h2>
			@foreach ($experiencia_laboral as $laboral)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la institución o empresa</strong>
						</td>
						<td>
							{{$laboral->institucion}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Nombre del cargo</strong>
						</td>
						<td>
							{{$laboral->cargo}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Función principal</strong>
						</td>
						<td>
							{{$laboral->funcion}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Tipo de vinculación</strong>
						</td>
						<td>
							{{$laboral->tipo_vinculacion}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿En curso?</strong>
						</td>
						<td>
							@if ($laboral->en_curso == 1)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Fecha de inicio</strong>
						</td>
						<td>
							{{$laboral->fecha_inicio}}
						</td>
						<td>
							<strong>Fecha de finalización</strong>
						</td>
						<td>
							@if ($laboral->en_curso == 1)
								N/A
							@else
								{{$laboral->fecha_finalizacion}}
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de experiencias en 1 y verificamos si ya se han colocado
					 4 experiencias en la hoja de vida y si aún quedan más experiencias pendientes
					 para agregar una página nueva -->
				<?php $numero_experiencias++; ?>
				@if ($numero_experiencias % 4 == 0 && $numero_experiencias < $total_experiencias)
					<!-- Nueva página -->
					<div class="page-break"></div>
				@elseif ($numero_experiencias == $total_experiencias)
					<?php $laborales_sobrantes = $sobrantes; ?>
					<?php $categoria = 3; ?>
				@endif
			@endforeach
		@else
			<?php $laborales_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de experiencia investigativa, tomadas de la variable $experiencia_investigativa -->
		<!-- Declaración de una variable para contar el número de experiencias y saber cuando
			 crear una página nueva y otra variable con el número total de experiencias -->
		<?php $total_experiencias = count($experiencia_investigativa); ?>
		@if ($total_experiencias > 0)
			<?php $numero_experiencias = 0;	?>
			@if ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_experiencias = 1; 
						$total_experiencias = $total_experiencias + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_experiencias = 2; 
						$total_experiencias = $total_experiencias + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_experiencias = 1;
						$total_experiencias = $total_experiencias + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_experiencias = 1; 
						$total_experiencias = $total_experiencias + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_experiencias = 2; 
						$total_experiencias = $total_experiencias + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_experiencias = 1; 
						$total_experiencias = $total_experiencias + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_experiencias = 2; 
						$total_experiencias = $total_experiencias + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_experiencias % 3; ?>
			<h2 id="datos_encabezado2">Experiencia investigativa</h2>
			@foreach ($experiencia_investigativa as $investigativa)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre del proyecto</strong>
						</td>
						<td>
							{{$investigativa->proyecto}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la institucion</strong>
						</td>
						<td>
							{{$investigativa->institucion}}
						</td>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$investigativa->pais}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Área del proyecto</strong>
						</td>
						<td>
							{{$investigativa->area_proyecto}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Funciones principales</strong>
						</td>
						<td>
							@if(!$investigativa->funcion_principal==null)
								{{$investigativa->funcion_principal}}
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿El proyecto tiene financiación?</strong>
						</td>
						<td>
							@if ($investigativa->entidad_financiadora)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Entidad Financiadora</strong>
						</td>
						<td>
							@if ($investigativa->entidad_financiadora)
								{{$investigativa->entidad_financiadora}}
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿En curso?</strong>
						</td>
						<td>
							@if ($investigativa->en_curso == 1)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Fecha de inicio</strong>
						</td>
						<td>
							{{$investigativa->fecha_inicio}}
						</td>
						<td>
							<strong>Fecha de finalización</strong>
						</td>
						<td>
							@if ($investigativa->en_curso == 1)
								N/A
							@else
								{{$investigativa->fecha_finalizacion}}
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de experiencias en 1 y verificamos si ya se han colocado
					 3 experiencias en la hoja de vida y si aún quedan más experiencias pendientes
					 para agregar una página nueva -->
				<?php $numero_experiencias++; ?>
				@if ($numero_experiencias % 3 == 0 && $numero_experiencias < $total_experiencias )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<hr>
				@elseif ($numero_experiencias == $total_experiencias)
					<?php $investigativa_sobrantes = $sobrantes; ?>
					<?php $categoria = 4; ?>
				@endif
			@endforeach
		@else
			<?php $investigativa_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de articulos en revistas indexadas, tomados de la variable $articulos_revista -->
		<?php $total_articulos = count($articulos_revista); ?>
		@if ($total_articulos > 0)
			<?php $numero_articulos = 0;	?>
			@if ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_articulos = 1; 
						$total_articulos = $total_articulos + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_articulos = 2; 
						$total_articulos = $total_articulos + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_articulos = 1; 
						$total_articulos = $total_articulos + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_articulos = 2; 
						$total_articulos = $total_articulos + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_articulos = 1;
						$total_articulos = $total_articulos + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_articulos = 1; 
						$total_articulos = $total_articulos + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_articulos = 2; 
						$total_articulos = $total_articulos + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_articulos = 1; 
						$total_articulos = $total_articulos + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_articulos = 2; 
						$total_articulos = $total_articulos + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_articulos % 3; ?>
			<h2 id="datos_encabezado2">Artículos en revistas indexadas</h2>
			@foreach ($articulos_revista as $articulo)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título del artículo</strong>
						</td>
						<td>
							{{$articulo->articulo}}
						</td>
						<td>
							<strong>Fecha públicación</strong>
						</td>
						<td>
							{{$articulo->año}} - {{$articulo->mes}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Título de la revista</strong>
						</td>
						<td>
							{{$articulo->titulo_revista}}
						</td>
						<td>
							<strong>Tipo de revista</strong>
						</td>
						<td>
							{{$articulo->tipo_revista}}
						</td>
					</tr>				
					<tr>
						<td>
							<strong>Autor(es)</strong>
						</td>
						<td>
							{{$articulo->autor}}
						</td>
						<td>
							<strong>Clasificación de la revista</strong>
						</td>
						<td>
							@if ($articulo->clasificacion_revista)
								{{$articulo->clasificacion_revista}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$articulo->pais}}
						</td>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$articulo->idioma}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Volumen</strong>
						</td>
						<td>
							@if ($articulo->volumen_revista)
								{{$articulo->volumen_revista}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>ISSN</strong>
						</td>
						<td>
							@if ($articulo->fasciculo_revista)
								{{$articulo->fasciculo_revista}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Volumen</strong>
						</td>
						<td>
							@if ($articulo->serie)
								{{$articulo->serie}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Página inicial</strong>
						</td>
						<td>
							@if ($articulo->pagina_inicial)
								{{$articulo->pagina_inicial}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Página final</strong>
						</td>
						<td>
							@if ($articulo->pagina_final)
								{{$articulo->pagina_final}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>ISSN</strong>
						</td>
						<td>
							@if ($articulo->issn)
								{{$articulo->issn}}
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de artículos de revista en 1 y verificamos si ya se han colocado
					 3 artículos en la hoja de vida y si aún quedan más artículos pendientes
					 para agregar una página nueva -->
				<?php $numero_articulos++; ?>
				@if ($numero_articulos % 3 == 0 && $numero_articulos < $total_articulos )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<hr>
				@elseif ($numero_articulos == $total_articulos)
					<?php $articulos_sobrantes = $sobrantes; ?>
					<?php $categoria = 5; ?>
				@endif
			@endforeach
		@else
			<?php $articulos_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de libros, tomados de la variable $libros -->
		<?php $total_libros = count($libros); ?>
		@if ($total_libros > 0)
			<?php $numero_libros = 0;	?>
			@if ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_libros = 1; 
						$total_libros = $total_libros + 1;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_libros = 2; 
						$total_libros = $total_libros + 2;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_libros = 1; 
						$total_libros = $total_libros + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_libros = 2; 
						$total_libros = $total_libros + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_libros = 1; 
						$total_libros = $total_libros + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_libros = 2; 
						$total_libros = $total_libros + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_libros = 1;
						$total_libros = $total_libros + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_libros = 1; 
						$total_libros = $total_libros + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_libros = 2; 
						$total_libros = $total_libros + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_libros = 1; 
						$total_libros = $total_libros + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_libros = 2; 
						$total_libros = $total_libros + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_libros % 3; ?>
			<h2 id="datos_encabezado2">Libros</h2>
			@foreach ($libros as $libro)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título del libro</strong>
						</td>
						<td>
							{{$libro->libro}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Autor(es)</strong>
						</td>
						<td>
							{{$libro->autor}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Fecha publicación</strong>
						</td>
						<td>
							{{$libro->año}} - {{$libro->mes}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Editorial</strong>
						</td>
						<td>
							@if ($libro->editorial)
								{{$libro->editorial}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Edición</strong>
						</td>
						<td>
							@if ($libro->edicion)
								{{$libro->edicion}}
							@else
								N/A
							@endif
						</td>
					</tr>				
					<tr>
						<td>
							<strong>Número de páginas</strong>
						</td>
						<td>
							@if ($libro->numero_paginas)
								{{$libro->numero_paginas}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>ISBN</strong>
						</td>
						<td>
							@if ($libro->isbn)
								{{$libro->isbn}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$libro->pais}}
						</td>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$libro->idioma}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de libros en 1 y verificamos si ya se han colocado
					 3 libros en la hoja de vida y si aún quedan más libros pendientes
					 para agregar una página nueva -->
				<?php $numero_libros++; ?>
				@if ($numero_libros % 3 == 0 && $numero_libros < $total_libros )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<hr>
				@elseif ($numero_libros == $total_libros)
					<?php $libros_sobrantes = $sobrantes; ?>
					<?php $categoria = 6; ?>
				@endif
			@endforeach
		@else
			<?php $libros_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de capítulos de libros, tomados de la variable $capitulos_libro -->
		<?php $total_capitulos = count($capitulos_libro); ?>
		@if ($total_capitulos > 0)
			<?php $numero_capitulos = 0;	?>
			@if ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_capitulos = 1;
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_capitulos = 1; 
						$total_capitulos = $total_capitulos + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_capitulos = 2; 
						$total_capitulos = $total_capitulos + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_capitulos % 3; ?>
			<h2 id="datos_encabezado2">Capítulos de Libro</h2>
			@foreach ($capitulos_libro as $capitulo)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título del libro</strong>
						</td>
						<td>
							{{$capitulo->libro}}
						</td>
						<td>
							<strong>Fecha publicación</strong>
						</td>
						<td>
							{{$capitulo->año}} - {{$capitulo->mes}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título del capítulo</strong>
						</td>
						<td>
							{{$capitulo->capitulo}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Editorial</strong>
						</td>
						<td>
							@if ($libro->editorial)
								{{$libro->editorial}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Edición</strong>
						</td>
						<td>
							@if ($libro->edicion)
								{{$libro->edicion}}
							@else
								N/A
							@endif
						</td>
					</tr>				
					<tr>
						<td>
							<strong>Serie</strong>
						</td>
						<td>
							@if ($capitulo->serie)
								{{$capitulo->serie}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>ISBN</strong>
						</td>
						<td>
							@if ($libro->isbn)
								{{$libro->isbn}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Página inicial</strong>
						</td>
						<td>
							@if ($capitulo->pagina_inicial)
								{{$capitulo->pagina_inicial}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Página final</strong>
						</td>
						<td>
							@if ($libro->pagina_final)
								{{$libro->pagina_final}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$libro->pais}}
						</td>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$libro->idioma}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de capítulos en 1 y verificamos si ya se han colocado
					 3 capítulos en la hoja de vida y si aún quedan más capítulos pendientes
					 para agregar una página nueva -->
				<?php $numero_capitulos++; ?>
				@if ($numero_capitulos % 3 == 0 && $numero_capitulos < $total_capitulos )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<hr>
				@elseif ($numero_capitulos == $total_capitulos)
					<?php $capitulos_sobrantes = $sobrantes; ?>
					<?php $categoria = 7; ?>
				@endif
			@endforeach
		@else
			<?php $capitulos_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de patentes, tomados de la variable $patentes -->
		<?php $total_patentes = count($patentes); ?>
		@if ($total_patentes > 0)
			<?php $numero_patentes = 0;	?>
			@if ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_patentes = 1;
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_patentes = 1; 
						$total_patentes = $total_patentes + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_patentes = 2; 
						$total_patentes = $total_patentes + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_patentes % 3; ?>
			<h2 id="datos_encabezado2">Patentes</h2>
			@foreach ($patentes as $patente)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la patente</strong>
						</td>
						<td>
							{{$patente->patente}}
						</td>
						<td>
							<strong>Tipo de la patente</strong>
						</td>
						<td>
							{{$patente->tipo_patente}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$patente->pais}}
						</td>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$patente->idioma}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Descripción</strong>
						</td>
						<td>
							@if ($patente->descripcion)
								{{$patente->descripcion}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Número de patente</strong>
						</td>
						<td>
							@if ($patente->numero_patente)
								{{$patente->numero_patente}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Entidad que registra</strong>
						</td>
						<td>
							@if ($patente->entidad_patente)
								{{$patente->entidad_patente}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Fecha de registro</strong>
						</td>
						<td>
							{{$patente->año}} - {{$patente->mes}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de patentes en 1 y verificamos si ya se han colocado
					 3 patentes en la hoja de vida y si aún quedan más patentes pendientes
					 para agregar una página nueva -->
				<?php $numero_patentes++; ?>
				@if ($numero_patentes % 3 == 0 && $numero_patentes < $total_patentes )
					<!-- Nueva página -->
					<div class="page-break"></div>
				@elseif ($numero_patentes == $total_patentes)
					<?php $patentes_sobrantes = $sobrantes; ?>
					<?php $categoria = 8; ?>
				@endif
			@endforeach
		@else
			<?php $patentes_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de software, tomados de la variable $softwares -->
		<?php $total_softwares = count($softwares); ?>
		@if ($total_softwares > 0)
			<?php $numero_softwares = 0;	?>
			@if ($categoria == 8)
				@if ($patentes_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($patentes_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($patentes_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_softwares = 1;
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_softwares = 1; 
						$total_softwares = $total_softwares + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_softwares = 2; 
						$total_softwares = $total_softwares + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_softwares % 3; ?>
			<h2 id="datos_encabezado2">Software</h2>
			@foreach ($softwares as $software)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre del software</strong>
						</td>
						<td>
							{{$software->software}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Nombre comercial del software</strong>
						</td>
						<td>
							@if ($software->nombre_comercial)
								{{$software->nombre_comercial}}
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título de registro</strong>
						</td>
						<td>
							@if ($software->titulo_registro)
								{{$software->titulo_registro}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Número de registro</strong>
						</td>
						<td>
							@if ($software->numero_registro)
								{{$software->numero_registro}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Nombre del titular</strong>
						</td>
						<td>
							@if ($software->nombre_titular)
								{{$software->nombre_titular}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Fecha de solicitud</strong>
						</td>
						<td>
							@if ($software->fecha_solicitud)
								{{$software->fecha_solicitud}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$software->pais}}
						</td>
						<td>
							<strong>Fecha de producción</strong>
						</td>
						<td>
							{{$software->año}} - {{$software->mes}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Contrato de fabricación</strong>
						</td>
						<td>
							@if ($software->contrato_fabricacion)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Contrato de explotación</strong>
						</td>
						<td>
							@if ($software->contrato_explotacion)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Contrato de comercialización</strong>
						</td>
						<td>
							@if ($software->contrato_comercializacion)
								Sí
							@else
								No
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de patentes en 1 y verificamos si ya se han colocado
					 3 patentes en la hoja de vida y si aún quedan más patentes pendientes
					 para agregar una página nueva -->
				<?php $numero_softwares++; ?>
				@if ($numero_softwares % 3 == 0 && $numero_softwares < $total_softwares )
					<!-- Nueva página -->
					<div class="page-break"></div>
				@elseif ($numero_softwares == $total_softwares)
					<?php $softwares_sobrantes = $sobrantes; ?>
					<?php $categoria = 9; ?>
				@endif
			@endforeach
		@else
			<?php $softwares_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de diseños industriales, tomados de la variable $diseños_industrial -->
		<?php $total_diseños = count($diseños_industrial); ?>
		@if ($total_diseños > 0)
			<?php $numero_diseños = 0; ?>
			@if ($categoria == 9)
				@if ($softwares_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($softwares_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($softwares_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 8)
				@if ($patentes_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($patentes_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($patentes_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_diseños = 1;
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($distinciones_sobrantes == 0 || $distinciones_sobrantes == 4)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_diseños = 1; 
						$total_diseños = $total_diseños + 1;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_diseños = 2; 
						$total_diseños = $total_diseños + 2;
					?>
				@elseif ($estudios_sobrantes == 0 || $estudios_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_diseños % 3; ?>
			<h2 id="datos_encabezado2">Diseños industriales</h2>
			@foreach ($diseños_industrial as $diseño)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre del diseño industrial</strong>
						</td>
						<td>
							{{$diseño->diseño}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>El producto tiene</strong>
						</td>
						<td>
							{{$diseño->producto_tiene}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Título de registro</strong>
						</td>
						<td>
							@if ($diseño->titulo_registro)
								{{$diseño->titulo_registro}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Número de registro</strong>
						</td>
						<td>
							@if ($diseño->numero_registro)
								{{$diseño->numero_registro}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>Nombre del titular</strong>
						</td>
						<td>
							@if ($diseño->nombre_titular)
								{{$diseño->nombre_titular}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Fecha de solicitud</strong>
						</td>
						<td>
							@if ($diseño->fecha_solicitud)
								{{$diseño->fecha_solicitud}}
							@else
								N/A
							@endif
						</td>
					</tr>
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$diseño->pais}}
						</td>
						<td>
							<strong>Fecha de producción</strong>
						</td>
						<td>
							{{$diseño->año}} - {{$diseño->mes}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Contrato de fabricación</strong>
						</td>
						<td>
							@if ($diseño->contrato_fabricacion)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Contrato de explotación</strong>
						</td>
						<td>
							@if ($diseño->contrato_explotacion)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Contrato de comercialización</strong>
						</td>
						<td>
							@if ($diseño->contrato_comercializacion)
								Sí
							@else
								No
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de diseños industriales en 1 y verificamos si ya se han colocado
					 3 diseños en la hoja de vida y si aún quedan más diseños pendientes
					 para agregar una página nueva -->
				<?php $numero_diseños++; ?>
				@if ($numero_diseños % 3 == 0 && $numero_diseños < $total_diseños )
					<!-- Nueva página -->
					<div class="page-break"></div>
				@elseif ($numero_diseños == $total_diseños)
					<?php $diseños_sobrantes = $sobrantes; ?>
					<?php $categoria = 10; ?>
				@endif
			@endforeach
		@else
			<?php $diseños_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de plantas piloto, tomados de la variable $plantas_piloto -->
		<?php $total_plantas = count($plantas_piloto); ?>
		@if ($total_plantas > 0)
			<?php $numero_plantas = 0; ?>
			@if ($categoria == 10)
				@if ($diseños_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($diseños_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($diseños_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 9)
				@if ($softwares_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($softwares_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($softwares_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 8)
				@if ($patentes_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($patentes_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($patentes_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_plantas = 2; 
						$total_plantas = $total_plantas + 2;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_plantas = 2; 
						$total_plantas = $total_plantas + 2;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_plantas = 1;
						$total_plantas = $total_plantas + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_plantas = 2; 
						$total_plantas = $total_plantas + 2;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($distinciones_sobrantes == 4)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($distinciones_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_plantas = 2; 
						$total_plantas = $total_plantas + 2;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_plantas = 3; 
						$total_plantas = $total_plantas + 3;
					?>
				@elseif ($estudios_sobrantes == 3)
					<?php 
						$numero_plantas = 4; 
						$total_plantas = $total_plantas + 4;
					?>
				@elseif ($estudios_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_plantas % 5; ?>
			<h2 id="datos_encabezado2">Plantas piloto</h2>
			@foreach ($plantas_piloto as $planta)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la planta</strong>
						</td>
						<td>
							{{$planta->planta}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>El producto tiene</strong>
						</td>
						<td>
							{{$planta->producto_tiene}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$planta->pais}}
						</td>
						<td>
							<strong>Fecha de producción</strong>
						</td>
						<td>
							{{$planta->año}} - {{$planta->mes}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de plantas piloto en 1 y verificamos si ya se han colocado
					 5 plantas en la hoja de vida y si aún quedan más plantas pendientes
					 para agregar una página nueva -->
				<?php $numero_plantas++; ?>
				@if ($numero_plantas % 5 == 0 && $numero_plantas < $total_plantas )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<br>
				@elseif ($numero_plantas == $total_plantas)
					<?php $plantas_sobrantes = $sobrantes; ?>
					<?php $categoria = 11; ?>
				@endif
			@endforeach
		@else
			<?php $plantas_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de otras_producciones, tomados de la variable $otras_producciones -->
		<?php $total_otras = count($otras_producciones); ?>
		@if ($total_otras > 0)
			<?php $numero_otras = 0; ?>
			@if ($categoria == 11)
				@if ($plantas_sobrantes == 1)
					<?php 
						$numero_otras = 1;
						$total_otras = $total_otras + 1;
					?>
				@elseif ($plantas_sobrantes == 2)
					<?php 
						$numero_otras = 2; 
						$total_otras = $total_otras + 2;
					?>
				@elseif ($plantas_sobrantes == 3)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($plantas_sobrantes == 4)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($plantas_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 10)
				@if ($diseños_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($diseños_sobrantes == 2)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($diseños_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 9)
				@if ($softwares_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($softwares_sobrantes == 2)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($softwares_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 8)
				@if ($patentes_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($patentes_sobrantes == 2)
					<?php 
						$numero_plantas = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($patentes_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_otras = 2; 
						$total_otras = $total_otras + 2;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_otras = 2; 
						$total_otras = $total_otras + 2;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_otras = 1;
						$total_otras = $total_otras + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_otras = 2; 
						$total_otras = $total_otras + 2;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($distinciones_sobrantes == 4)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($distinciones_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_otras = 2; 
						$total_otras = $total_otras + 2;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_otras = 3; 
						$total_otras = $total_otras + 3;
					?>
				@elseif ($estudios_sobrantes == 3)
					<?php 
						$numero_otras = 4; 
						$total_otras = $total_otras + 4;
					?>
				@elseif ($estudios_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_otras % 5; ?>
			<h2 id="datos_encabezado2">Otras Producciones</h2>
			@foreach ($otras_producciones as $otra)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la producción</strong>
						</td>
						<td>
							{{$otra->produccion}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Tipo de la producción</strong>
						</td>
						<td>
							{{$otra->tipo_produccion}}
						</td>
						<td>
							<strong>Fecha de producción</strong>
						</td>
						<td>
							{{$otra->año}} - {{$otra->mes}}
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>País</strong>
						</td>
						<td>
							{{$otra->pais}}
						</td>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$otra->idioma}}
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de plantas piloto en 1 y verificamos si ya se han colocado
					 5 plantas en la hoja de vida y si aún quedan más plantas pendientes
					 para agregar una página nueva -->
				<?php $numero_otras++; ?>
				@if ($numero_otras % 5 == 0 && $numero_otras < $total_otras )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<br>
				@elseif ($numero_otras == $total_otras)
					<?php $otras_sobrantes = $sobrantes; ?>
					<?php $categoria = 12; ?>
				@endif
			@endforeach
		@else
			<?php $otras_sobrantes = 0; ?>
		@endif
		
		<!-- Sección de certificados de idiomas, tomadas de la variable $idiomas_certificados -->
		<!-- Declaración de una variable para contar el número de certificados y saber cuando
			 crear una página nueva y otra variable con el número total de certificados -->
		<?php $total_idiomas = count($idiomas_certificados); ?>
		@if ($total_idiomas > 0)
			<?php $numero_idiomas = 0; ?>
			@if ($categoria == 12)
				@if ($otras_sobrantes == 1)
					<?php 
						$numero_idiomas = 1;
						$total_idiomas = $total_idiomas + 1;
					?>
				@elseif ($otras_sobrantes == 2)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($otras_sobrantes == 3)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($otras_sobrantes == 4)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($otras_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 11)
				@if ($plantas_sobrantes == 1)
					<?php 
						$numero_idiomas = 1;
						$total_idiomas = $total_idiomas + 1;
					?>
				@elseif ($plantas_sobrantes == 2)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($plantas_sobrantes == 3)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($plantas_sobrantes == 4)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($plantas_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 10)
				@if ($diseños_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($diseños_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($diseños_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 9)
				@if ($softwares_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($softwares_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($softwares_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 8)
				@if ($patentes_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($patentes_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($patentes_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 7)
				@if ($capitulos_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($capitulos_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($capitulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 6)
				@if ($libros_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($libros_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($libros_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 5)
				@if ($articulos_sobrantes == 1)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($articulos_sobrantes == 2)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($articulos_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 4)
				@if ($investigativa_sobrantes == 1)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($investigativa_sobrantes == 2)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($investigativa_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 3)
				@if ($laborales_sobrantes == 1)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($laborales_sobrantes == 2)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($laborales_sobrantes == 0 || $laborales_sobrantes == 3)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 2)
				@if ($distinciones_sobrantes == 1)
					<?php 
						$numero_idiomas = 1;
						$total_idiomas = $total_idiomas + 1;
					?>
				@elseif ($distinciones_sobrantes == 2)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($distinciones_sobrantes == 3)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($distinciones_sobrantes == 4)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($distinciones_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 1)
				@if ($estudios_sobrantes == 1)
					<?php 
						$numero_idiomas = 2; 
						$total_idiomas = $total_idiomas + 2;
					?>
				@elseif ($estudios_sobrantes == 2)
					<?php 
						$numero_idiomas = 3; 
						$total_idiomas = $total_idiomas + 3;
					?>
				@elseif ($estudios_sobrantes == 3)
					<?php 
						$numero_idiomas = 4; 
						$total_idiomas = $total_idiomas + 4;
					?>
				@elseif ($estudios_sobrantes == 0)
					<div class="page-break"></div>
				@endif
			@elseif ($categoria == 0)
				<div class="page-break"></div>
			@endif
			<?php $sobrantes = $total_idiomas % 5; ?>
			<h2 id="datos_encabezado2">Idiomas certificados</h2>
			<hr>
			<br>
			@foreach ($idiomas_certificados as $idioma_certificado)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿Acreditará el nivel de suficiencia en idioma inglés 
							mediante la prueba que aplica la Dirección Nacional 
							de Admisiones?</strong>
						</td>
						<td>
							@if ($programa_seleccionado->nivel_estudio == 4 && 
							$idioma_certificado->idioma == "Inglés")
								@if ($idioma_certificado->acreditar_ingles == 1)
									Sí
								@else
									No
								@endif
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Idioma</strong>
						</td>
						<td>
							{{$idioma_certificado->idioma}}
						</td>
						<td>
							<strong>¿Es su idioma nativo?</strong>
						</td>
						<td>
							@if ($idioma_certificado->nativo == 1)
								Sí
							@else
								No
							@endif
						</td>
					</tr>
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre del certificado</strong>
						</td>
						<td>
							@if ($idioma_certificado->certificado)
								{{$idioma_certificado->certificado}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Puntaje</strong>
						</td>
						<td>
							@if ($idioma_certificado->puntaje)
								{{$idioma_certificado->puntaje}}
							@else
								N/A
							@endif
						</td>
						<td>
							<strong>Nivel marco europeo</strong>
						</td>
						<td>
							@if ($programa_seleccionado->nivel_estudio == 4)
								@if ($idioma_certificado->marco_referencia)
									{{$idioma_certificado->marco_referencia}}
								@else
									N/A
								@endif
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<br>
				<hr>
				<!-- Aumentamos el número de idiomas en 1 y verificamos si ya se han colocado
					 5 idiomas en la hoja de vida y si aún quedan más idiomas pendientes
					 para agregar una página nueva -->
				<?php $numero_idiomas++; ?>
				@if ($numero_idiomas % 5 == 0 && $numero_idiomas < $total_idiomas )
					<!-- Nueva página -->
					<div class="page-break"></div>
					<hr>
				@endif
			@endforeach
		@endif
		
		<!-- Sección de experiencia docente, tomadas de la variable $experiencia_docente -->
		<!-- Declaración de una variable para contar el número de experiencias y saber cuando
			 crear una página nueva y otra variable con el número total de experiencias -->
		<?php 
			$numero_experiencias = 0; 
			$total_experiencias = count($experiencia_docente);
		?>
		@if ($total_experiencias > 0)
			<h2 id="datos_encabezado2">Experiencia docente</h2>
			<hr>
			<br>
			@foreach ($experiencia_docente as $docente)
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Nombre de la institución</strong>
						</td>
						<td>
							{{$docente->institucion}}
						</td>
					</tr>
					<tr>
						<td>
							<strong>Dedicación</strong>
						</td>
						<td>
							{{$docente->dedicacion}}
						</td>
					</tr>
					@if (!$docente->area==null)
					<tr>
						<td>
							<strong>Áreas de trabajo</strong>
						</td>
						<td>
							{{$docente->area}}
						</td>
					</tr>
					@endif
				</table>
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>¿En curso?</strong>
						</td>
						<td>
							@if ($docente->en_curso == 1)
								Sí
							@else
								No
							@endif
						</td>
						<td>
							<strong>Fecha de inicio</strong>
						</td>
						<td>
							{{$docente->fecha_inicio}}
						</td>
						<td>
							<strong>Fecha de finalización</strong>
						</td>
						<td>
							@if ($docente->en_curso == 0)
								{{$docente->fecha_finalizacion}}
							@else
								N/A
							@endif
						</td>
					</tr>
				</table>
				<!-- La información de las asignaturas impartidas se almacena en la base de datos en formato
					 JSON, por lo tanto es necesario primero pasarlo a un array asociativo para manipular
					 los datos -->
				<?php $asignaturas = json_decode($docente->asignaturas, true); ?>
				<!-- En base al array $asignaturas se construye una tabla de asignaturas impartidas -->
				<table class="tabla_datos">
					<tr>
						<td>
							<strong>Asignatura</strong>
						</td>
						<td>
							<strong>Intensidad (horas/semana)</strong>
						</td>
					</tr>
					@foreach($asignaturas as $asignatura)
						<tr>
							<td>
								{{$asignatura["nombre"]}}
							</td>
							<td>
								{{$asignatura["intensidad"]}}
							</td>
						</tr>
					@endforeach
				</table>
				<br>
				<hr>
			@endforeach
		@endif
	</body>
</html>