@extends('main')

@section('form')

<div class="panel panel-default">
    @if($msg)
    <div class="alert alert-success" role="alert" style="font-size:18px">
        {{$msg}}
    </div>
    @endif
    <div class="panel-heading" style="font-size:20px">
        <strong>Resumen</strong>
    </div>
    <form method="post" action="{{ env('APP_URL') }}resumen/hv" class="form-horizontal" style="margin:20px 0">
        {!! csrf_field() !!}

        <div class="panel-body">
			<div class="form-group">
				<div class="col-sm-12 col-md-4 col-md-offset-4">
					<form method="post" action="{{ env('APP_URL') }}resumen/hv">
						{!! csrf_field() !!}
						<button type="submit" class="btn btn-block btn-success" id="descargar_hv" name="id" value="{{$id}}">
							<i class="fa fa-user-times"></i>
							Descargar hoja de vida
						</button>
					</form>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-12 col-md-4 col-md-offset-4">
					<form method="post" action="{{ env('APP_URL') }}resumen/adjuntos">
						{!! csrf_field() !!}
						<button type="submit" class="btn btn-block btn-success" id="descargar_adjuntos" name="id" value="{{$id}}">
							<i class="fa fa-user-times"></i>
							Descargar adjuntos
						</button>
					</form>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
    (function ($) {
		
    })(jQuery);
</script>
@stop
