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
        <strong>Resumen</strong>
    </div>
	<div class="panel-body">
		<div class="form-group">
			<label for="titulo_revista" class="col-sm-12 col-md-2 col-md-offset-3 control-label" style="margin-top:20px">Hoja de vida del aspirante</label>
			<div class="col-sm-12 col-md-4">
				<form method="get" action="{{ env('APP_URL') }}resumen/hv" style="margin-top:20px">
					{!! csrf_field() !!}
					<input type="hidden" name="id" value="{{$id}}"/>
					<button type="submit" data-id="{{$id}}" class="btn btn-danger btn-sm">
						<i class="fa fa-clone" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</div>
		<div class="form-group">
			<label for="titulo_revista" class="col-sm-12 col-md-2 col-md-offset-3 control-label" style="margin-top:20px">Documentos adjuntos del aspirante</label>
			<div class="col-sm-12 col-md-4">
				<form method="get" action="{{ env('APP_URL') }}resumen/adjuntos" style="margin-top:20px">
					{!! csrf_field() !!}
					<input type="hidden" name="id" value="{{$id}}"/>
					<button type="submit" data-id="{{$id}}" class="btn btn-danger btn-sm">
						<i class="fa fa-folder-open" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</div>
	</div>
<script>
    (function ($) {
		
    })(jQuery);
</script>
@stop
