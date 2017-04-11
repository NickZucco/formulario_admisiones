@extends('main')

@section('form')

@if($msg)
	<div class="alert alert-success" role="alert" style="font-size:18px">
		{{$msg}}
	</div>
@endif

<form name="registro" id="registro" method="post" action="{{ env('APP_URL') }}produccion_intelectual" class="form-horizontal" style="margin:20px 0"  enctype="multipart/form-data">
	{!! csrf_field() !!}
	
	<div class="panel panel-default">
	
		<div class="panel-heading" style="font-size:20px">
			<strong>Producción intelectual</strong>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="tipos_produccion_intelectual_id" class="col-sm-12 col-md-2 control-label">Tipo de producción intelectual</label>
				<div class="col-sm-12 col-md-3">
					<select id="tipos_publicacion" name="tipos_produccion_intelectual_id" class="form-control">
						<option value="0">--Seleccione una opción--</option>
						@foreach($tipos_produccion_intelectual as $tipo_produccion_intelectual)
							<option value="{{$tipo_produccion_intelectual->id}}">{{$tipo_produccion_intelectual->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		
		<div class="panel-heading">
			<div style="font-weight: bold">Datos de la producción: <span id="tipo_produccion_lbl"></span></div>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-sm-12 col-md-12" id="msg_form" style="text-align: center">
					Por favor, seleccione un tipo de publicación para ver el formulario asociado.
				</div>
				
				<!--Revistas indexadas-->
				<div id="1" class="publication_form">
					<div class="form-group">
						<label for="titulo_revista" class="col-sm-12 col-md-2 control-label">Título de la revista</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="titulo_revista" name="titulo_revista" required>
						</div>
						<label for="tipo_revista" class="control-label col-sm-12 col-md-1">Tipo de revista</label>
						<div class="col-sm-12 col-md-4">
							<select id="tipo_revista" name="tipo_revista" data-form="2" class="form-control" required>
								<option value="INTERNACIONAL">Internacional</option>
								<option value="NACIONAL">Nacional</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Título del artículo</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="autor" class="col-sm-12 col-md-2 control-label">Autor(es) como aparece en el artículo</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="autor" name="autor" required>
						</div>
					</div>
					<div class="form-group">
						<label for="clasificacion_revista" class="col-sm-12 col-md-2 control-label">Clasificación de la revista (según Colciencias)</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="clasificacion_revista" name="clasificacion_revista">
						</div>
						<label for="issn_revista" class="col-sm-12 col-md-1 control-label">ISSN</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="issn_revista" name="issn_revista">
						</div>
					</div>
					<div class="form-group">
						<label for="volumen_revista" class="col-sm-12 col-md-2 control-label">Volumen</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="volumen_revista" name="volumen_revista">
						</div>
						<label for="fasciculo_revista" class="col-sm-12 col-md-1 control-label">Fascículo</label>
						<div class="col-sm-12 col-md-4">
							<input type="text" class="form-control" id="fasciculo_revista" name="fasciculo_revista">
						</div>
					</div>
					<div class="form-group">
						<label for="pagina_inicial" class="col-sm-12 col-md-2 control-label">Página inicial</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="pagina_inicial" name="pagina_inicial">
						</div>
						<label for="pagina_final" class="col-sm-12 col-md-1 control-label">Página final</label>
						<div class="col-sm-12 col-md-4">
							<input type="text" class="form-control" id="pagina_final" name="pagina_final">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-5">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label for="idiomas_id" class="col-sm-12 col-md-1 control-label">Idioma </label>
						<div class="col-sm-12 col-md-4">
							<select id="idiomas_id" name="idiomas_id" class="form-control" required>
								@foreach($idiomas as $idioma)
									<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="serie" class="col-sm-12 col-md-2 control-label">Serie</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="serie" name="serie">
						</div>
					</div>
				</div>
				
				<!--Libro-->
				<div id="2" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Título del libro</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="autor" class="col-sm-12 col-md-2 control-label">Autor(es) como aparece en el libro</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="autor" name="autor" required>
						</div>
					</div>
					<div class="form-group">
						<label for="editorial" class="col-sm-12 col-md-2 control-label">Editorial</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="editorial" name="editorial">
						</div>
						<label for="edicion" class="col-sm-12 col-md-1 control-label">Edición</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="edicion" name="edicion">
						</div>
					</div>
					<div class="form-group">
						<label for="numero_paginas_libro" class="col-sm-12 col-md-2 control-label">Número de páginas</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="numero_paginas_libro" name="numero_paginas_libro">
						</div>
						<label for="isbn" class="col-sm-12 col-md-1 control-label">ISBN</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="isbn" name="isbn">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-5">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label for="idiomas_id" class="col-sm-12 col-md-1 control-label">Idioma </label>
						<div class="col-sm-12 col-md-4">
							<select id="idiomas_id" name="idiomas_id" class="form-control" required>
								@foreach($idiomas as $idioma)
									<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<!--Capitulo de libro-->
				<div id="3" class="publication_form">
					<div class="form-group">
						<label for="titulo_libro" class="col-sm-12 col-md-2 control-label">Título del libro</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="titulo_libro" name="titulo_libro" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Título del capítulo</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="editorial" class="col-sm-12 col-md-2 control-label">Editorial</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="editorial" name="editorial">
						</div>
						<label for="edicion" class="col-sm-12 col-md-1 control-label">Edición</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="edicion" name="edicion">
						</div>
					</div>
					<div class="form-group">
						<label for="serie" class="col-sm-12 col-md-2 control-label">Serie</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="serie" name="serie">
						</div>
						<label for="isbn" class="col-sm-12 col-md-1 control-label">ISBN</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="isbn" name="isbn">
						</div>
					</div>
					<div class="form-group">
						<label for="pagina_inicial" class="col-sm-12 col-md-2 control-label">Página inicial</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="pagina_inicial" name="pagina_inicial">
						</div>
						<label for="pagina_final" class="col-sm-12 col-md-1 control-label">Página final</label>
						<div class="col-sm-12 col-md-4">
							<input type="text" class="form-control" id="pagina_final" name="pagina_final">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-5">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label for="idiomas_id" class="col-sm-12 col-md-1 control-label">Idioma </label>
						<div class="col-sm-12 col-md-4">
							<select id="idiomas_id" name="idiomas_id" class="form-control" required>
								@foreach($idiomas as $idioma)
									<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<!--Patente-->
				<div id="4" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Nombre de la patente</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
						<label for="tipo_patente" class="control-label col-sm-12 col-md-1">Tipo de patente</label>
						<div class="col-sm-12 col-md-4">
							<select id="tipo_patente" name="tipo_patente" data-form="2" class="form-control" required>
								<option value="Patente">Patente</option>
								<option value="Modelo de utilidad">Modelo de utilidad</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="descripcion_patente" class="col-sm-12 col-md-2 control-label">Descripción</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="descripcion_patente" name="descripcion_patente">
						</div>
					</div>
					<div class="form-group">
						<label for="numero_patente" class="col-sm-12 col-md-2 control-label">Número de patente</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="numero_patente" name="numero_patente">
						</div>
					</div>
					<div class="form-group">
						<label for="entidad_patente" class="col-sm-12 col-md-2 control-label">Entidad que registra</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="entidad_patente" name="entidad_patente">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-5">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label for="idiomas_id" class="col-sm-12 col-md-1 control-label">Idioma </label>
						<div class="col-sm-12 col-md-4">
							<select id="idiomas_id" name="idiomas_id" class="form-control" required>
								@foreach($idiomas as $idioma)
									<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<!--Software-->
				<div id="5" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Nombre del software</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre_comercial_software" class="col-sm-12 col-md-2 control-label">Nombre comercial del software</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre_comercial_software" name="nombre_comercial_software">
						</div>
					</div>
					<div class="form-group">
						<label for="titulo_registro" class="col-sm-12 col-md-2 control-label">Título de registro</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="titulo_registro" name="titulo_registro">
						</div>
						<label for="numero_registro" class="col-sm-12 col-md-1 control-label">Número de registro</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="numero_registro" name="numero_registro">
						</div>
					</div>
					<div class="form-group">
						<label for="nombre_titular" class="col-sm-12 col-md-2 control-label">Nombre del titular</label>
						<div class="ol-sm-12 col-md-5">
							<input type="text" class="form-control" id="nombre_titular" name="nombre_titular">
						</div>
						<label for="fecha_solicitud" class="col-sm-12 col-md-1 control-label">Fecha de solicitud</label>
						<div class="col-sm-12 col-md-4">
							<input type="text" class="datepicker2 end maxToday form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="####-##-##">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-10">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 col-md-2 control-label" for="contrato_fabricacion" >¿El software tiene contrato de fabricación?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_fabricacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_fabricacion" value="0">No
						</label>
						<label class="col-sm-12 col-md-2 control-label" for="contrato_explotacion">¿El software tiene contrato de explotación?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_explotacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_explotacion" value="0">No
						</label>
						<label class="col-sm-12 col-md-2 control-label" for="contrato_comercializacion" >¿El software tiene contrato de comercialización?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_comercializacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_comercializacion" value="0">No
						</label>
					</div>
				</div>
				
				<!--Planta piloto-->
				<div id="6" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Nombre de la planta</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="producto_tiene" class="col-sm-12 col-md-2 control-label">El producto tiene:</label>
						<div class="col-sm-12 col-md-10">
							<select id="producto_tiene" name="producto_tiene" data-form="2" class="form-control" required>
								<option value="Secreto empresarial">Secreto empresarial</option>
								<option value="Patente">Patente</option>
								<option value="Registro">Registro</option>
								<option value="Ninguno">Ninguno</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-10">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<!--Diseño industrial-->
				<div id="7" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Nombre del diseño industrial</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="producto_tiene" class="col-sm-12 col-md-2 control-label">El producto tiene:</label>
						<div class="col-sm-12 col-md-10">
							<select id="producto_tiene" name="producto_tiene" data-form="2" class="form-control" required>
								<option value="Secreto empresarial">Secreto empresarial</option>
								<option value="Patente">Patente</option>
								<option value="Registro">Registro</option>
								<option value="Ninguno">Ninguno</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="titulo_registro" class="col-sm-12 col-md-2 control-label">Título de registro</label>
						<div class="col-sm-12 col-md-5">
							<input type="text" class="form-control" id="titulo_registro" name="titulo_registro">
						</div>
						<label for="numero_registro" class="col-sm-12 col-md-1 control-label">Número de registro</label>
						<div class="ol-sm-12 col-md-4">
							<input type="text" class="form-control" id="numero_registro" name="numero_registro">
						</div>
					</div>
					<div class="form-group">
						<label for="nombre_titular" class="col-sm-12 col-md-2 control-label">Nombre del titular</label>
						<div class="ol-sm-12 col-md-5">
							<input type="text" class="form-control" id="nombre_titular" name="nombre_titular">
						</div>
						<label for="fecha_solicitud" class="col-sm-12 col-md-1 control-label">Fecha de solicitud</label>
						<div class="col-sm-12 col-md-4">
							<input type="text" class="datepicker2 end maxToday form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="####-##-##">
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-10">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 col-md-2 control-label" for="contrato_fabricacion" >¿El diseño tiene contrato de fabricación?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_fabricacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_fabricacion" value="0">No
						</label>
						<label class="col-sm-12 col-md-2 control-label" for="contrato_explotacion" >¿El diseño tiene contrato de explotación?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_explotacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_explotacion" value="0">No
						</label>
						<label class="col-sm-12 col-md-2 control-label" for="contrato_comercializacion" >¿El diseño tiene contrato de comercialización?</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_comercializacion" value="1" required>Si
						</label>
						<label class="col-sm-12 col-md-1 control-label">
							<input type="radio" name="contrato_comercializacion" value="0">No
						</label>
					</div>
				</div>
				
				<!--Otras producciones-->
				<div id="8" class="publication_form">
					<div class="form-group">
						<label for="nombre" class="col-sm-12 col-md-2 control-label">Nombre de la producción</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="tipo_produccion" class="col-sm-12 col-md-2 control-label">Tipo de la producción</label>
						<div class="col-sm-12 col-md-10">
							<input type="text" class="form-control" id="tipo_produccion" name="tipo_produccion" required>
						</div>
					</div>
					<div class="form-group">
						<label for="año" class="col-sm-12 col-md-2 control-label">Año</label>
						<div class="col-sm-12 col-md-5">
							<input type="number" class="form-control" id="año" name="año" required>
						</div>
						<label for="mes" class="col-sm-12 col-md-1 control-label">Mes</label>
						<div class="col-sm-12 col-md-4">
							<select id="mes" name="mes" data-form="2" class="form-control" required>
								<option value="Enero">Enero</option>
								<option value="Febrero">Febrero</option>
								<option value="Marzo">Marzo</option>
								<option value="Abril">Abril</option>
								<option value="Mayo">Mayo</option>
								<option value="Junio">Junio</option>
								<option value="Julio">Julio</option>
								<option value="Agosto">Agosto</option>
								<option value="Septiembre">Septiembre</option>
								<option value="Octubre">Octubre</option>
								<option value="Noviembre">Noviembre</option>
								<option value="Diciembre">Diciembre</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="paises_id" class="col-sm-12 col-md-2 control-label">País</label>
						<div class="col-sm-12 col-md-5">
							<select id="paises_id" name="paises_id" class="form-control" required>
								@foreach($paises as $pais)
									<option value="{{$pais->id}}">{{$pais->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label for="idiomas_id" class="col-sm-12 col-md-1 control-label">Idioma </label>
						<div class="col-sm-12 col-md-4">
							<select id="idiomas_id" name="idiomas_id" class="form-control" required>
								@foreach($idiomas as $idioma)
									<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

                <div id="additional_fields">
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
				
			</div>
		</div>
    </div>
</form>

<div class="panel panel-default">
	<div class="panel-heading" style="font-size:18px">
		<strong>Resumen de productos intelectuales</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Tipo de producción</th>
					<th>Nombre</th>
					<th>Año</th>
					<th>Mes</th>
					<th>País</th>
					<th>Documento de soporte</th>
					<th>Opciones</th>
				</tr>
			</thead>
			@forelse($producciones_intelectual as $produccion_intelectual)
			<tr>
				<td>
					{{$tipos_produccion_intelectual[$produccion_intelectual->tipos_produccion_intelectual_id]->nombre}}
				</td>
				<td>
					{{$produccion_intelectual->nombre}}
					@if ($produccion_intelectual->tipos_produccion_intelectual_id == 1 || $produccion_intelectual->tipos_produccion_intelectual_id == 2) 
							- {{$produccion_intelectual->autor}}
					@elseif ($produccion_intelectual->tipos_produccion_intelectual_id == 3)
						- Libro: {{$produccion_intelectual->titulo_libro}}
					@endif
				</td>
				<td>
					{{$produccion_intelectual->año}}
				</td>
				<td>
					{{$produccion_intelectual->mes}}
				</td>
				<td>
					{{$produccion_intelectual->pais}}
				</td>
				<td>
					<a href="{{env('APP_URL').$produccion_intelectual->ruta_adjunto}}" target="_blank">Documento adjunto</a>
				</td>
				<td>
					<form method="post" action="{{ env('APP_URL') }}produccion_intelectual/delete" style="margin:20px 0">     
						{!! csrf_field() !!}
						<input type="hidden" name="id" value="{{$produccion_intelectual->id}}"/>
						<button  type="submit" data-id="{{$produccion_intelectual->id}}" class="btn btn-danger btn-sm">
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
    (function ($) {
        $(".publication_form").hide();
        $("#additional_fields").hide();
		
        $("#tipos_publicacion").change(function () {

            $(".publication_form").hide();
            $(".publication_form").find("input,select,textarea").attr("disabled","disabled");
            $(".publication_form").find("input,select,textarea").attr("readonly","readonly");
			
            var id = $("#tipos_publicacion option:selected").val();
            $("#" + id).show();
            $("#" + id).find("input,select,textarea").removeAttr("disabled");
            $("#" + id).find("input,select,textarea").removeAttr("readonly");
            $("#tipo_produccion_lbl").text($("#tipos_publicacion option:selected").text());
			switch(id) {
				case '1':
					break;
				case '2':
					break;
				case '3':
					break;
			}
			if (id != 0) {
				$("#msg_form").hide();
				$("#additional_fields").show();
			}
			else {
				$("#msg_form").show();
				$("#additional_fields").hide();
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