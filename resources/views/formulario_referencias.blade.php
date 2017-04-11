@extends('main')

@section('form')
    <div class="alert alert-warning alert-dismissible" role="alert">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en cuenta
        que toda la información que digite en el formulario, debe registrarse únicamente en español
    </div>

    <div class="panel panel-default">
        @if(session()->has('message'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="panel-heading">
            <strong>Datos de quien va a dar la referencia</strong>
        </div>
        <form method="post" action="{{ env('APP_URL') }}formulario_referencias" class="form-horizontal" style="margin:20px 0"
              enctype="multipart/form-data">

            {!! csrf_field() !!}

            <div class="panel-body">
                <div class="form-group">
                    <label for="nombreApellido1" class="col-sm-2 control-label">Nombres y Apellidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombreApellido1" name="nombreApellido1"
                               placeholder="Nombres y Apellidos" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo1" class="col-sm-2 control-label">Correo electrónico</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="correo1" name="correo1"
                               placeholder="ejemplo@proveedor.com" required/>
                    </div>
                    <label class="control-label col-md-2">Tipo de referencia</label>
                    <div class="col-sm-4">
                        <div class="radio">
                            <label for="academica1">
                                <input type="radio" name="tipo1" id="academica1" value="academica">
                                Académica
                            </label>
                        </div>
                        <div class="radio">
                            <label for="personal1">
                                <input type="radio" name="tipo1" id="personal1" value="personal">
                                Personal
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="panel-body">
                <div class="form-group">
                    <label for="nombreApellido2" class="col-sm-2 control-label">Nombres y Apellidos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombreApellido2" name="nombreApellido2"
                               placeholder="Nombres y Apellidos" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo2" class="col-sm-2 control-label">Correo electrónico</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="correo2" name="correo2"
                               placeholder="ejemplo@proveedor.com" required/>
                    </div>
                    <label class="control-label col-md-2">Tipo de referencia</label>
                    <div class="col-sm-4">
                        <div class="radio">
                            <label for="academica2">
                                <input type="radio" name="tipo2" id="academica2" value="academica">
                                Académica
                            </label>
                        </div>
                        <div class="radio">
                            <label for="personal2">
                                <input type="radio" name="tipo2" id="personal2" value="personal">
                                Personal
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" class="form-control" id="correo" name="correo">
            <input type="hidden" class="form-control" id="id" name="id">

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-success form-control">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Guardar referencias
                    </button>
                </div>
            </div>
        </form>

    </div>

    <script>

        (function ($) {

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
@endsection