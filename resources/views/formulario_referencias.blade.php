@extends('main')

@section('form')
    @if($opcion)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>Nota: </strong>Por favor, tenga en
            cuenta que toda la información que digite en el formulario, debe registrarse únicamente en español
        </div>

        <div class="panel panel-default">
            @if(session()->has('message'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="panel-heading">
                <strong>Datos de quien va a dar la referencia{{$opcion == 1 ? ' académica.' : '.'}}</strong>
            </div>
            <form method="post" action="{{ env('APP_URL') }}formulario_referencias" class="form-horizontal"
                  style="margin:20px 0"
                  enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nombreApellido1" class="col-sm-2 control-label">Nombres y Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreApellido1" name="nombreApellido1"
                                   placeholder="Nombres y Apellidos" 
                                   @if(isset($referencias[0]['dato']->referencia_completa) && $referencias[0]['dato']->referencia_completa)
                                   disabled
                                   @endif
                                   value="{{isset($referencias[0]['ref']->nombre_de_referencia)?$referencias[0]['ref']->nombre_de_referencia:''}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correo1" class="col-sm-2 control-label">Correo electrónico</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="correo1" name="correo1"
                                   placeholder="ejemplo@proveedor.com" 
                                   @if(isset($referencias[0]['dato']->referencia_completa) && $referencias[0]['dato']->referencia_completa)
                                   disabled
                                   @endif
                                   value="{{isset($referencias[0]['ref']->correo_de_referencia)?$referencias[0]['ref']->correo_de_referencia:''}}"/>
                            @if(isset($referencias[0]['dato']->referencia_completa))
                                <input type="hidden" class="form-control" id="correo" name="currentCorreo1"
                                       value="{{$referencias[0]['ref']->correo_de_referencia}}">
                            @endif
                        </div>
                        @if($opcion == 1)
                            <input type="hidden" name="tipo1" id="tipo1" value="0">
                        @else
                            <label class="control-label col-md-2">Tipo de referencia</label>
                            <div class="col-sm-4">
                                <div class="radio">
                                    <label for="academica1">
                                        <input type="radio" name="tipo1" id="academica1" value="0"
                                               @if(isset($referencias[0]['dato']->tipo_referencia) && !$referencias[0]['dato']->tipo_referencia)
                                               checked="checked"
                                                @endif
                                        >
                                        Académica
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="personal1">
                                        <input type="radio" name="tipo1" id="personal1" value="1"
                                               @if(isset($referencias[0]['dato']->tipo_referencia) && $referencias[0]['dato']->tipo_referencia)
                                               checked="checked"
                                                @endif>
                                        Profesional
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(isset($referencias[0]['dato']->referencia_completa) && !$referencias[0]['dato']->referencia_completa)
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-3">
                                <button type="submit" class="btn btn-block btn-danger" id="delete2" name="delete2" value="{{$referencias[0]['dato']->id}}">
                                    <i class="fa fa-user-times"></i>
                                    Eliminar esta referencia
                                </button>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-block btn-warning" id="remind2" name="remind2" value="{{$referencias[0]['dato']->id}}">
                                    <i class="fa fa-paper-plane-o "></i>
                                    Enviar recordatorio nuevamente
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nombreApellido2" class="col-sm-2 control-label">Nombres y Apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombreApellido2" name="nombreApellido2"
                                   placeholder="Nombres y Apellidos" 
                                   @if(isset($referencias[1]['dato']->referencia_completa) && $referencias[1]['dato']->referencia_completa)
                                   disabled
                                   @endif
                                   value="{{isset($referencias[1]['ref']->nombre_de_referencia)?$referencias[1]['ref']->nombre_de_referencia:''}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correo2" class="col-sm-2 control-label">Correo electrónico</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="correo2" name="correo2"
                                   placeholder="ejemplo@proveedor.com" 
                                   @if(isset($referencias[1]['dato']->referencia_completa) && $referencias[1]['dato']->referencia_completa)
                                   disabled
                                   @endif
                                   value="{{isset($referencias[1]['ref']->correo_de_referencia)?$referencias[1]['ref']->correo_de_referencia:''}}"/>
                            @if(isset($referencias[1]['dato']->referencia_completa))
                                <input type="hidden" class="form-control" id="correo" name="currentCorreo2"
                                       value="{{$referencias[1]['ref']->correo_de_referencia}}">
                            @endif
                        </div>
                        @if($opcion == 1)
                            <input type="hidden" name="tipo2" id="tipo2" value="0">
                        @else
                            <label class="control-label col-md-2">Tipo de referencia</label>
                            <div class="col-sm-4">
                                <div class="radio">
                                    <label for="academica2">
                                        <input type="radio" name="tipo2" id="academica2" value="0"
                                               @if(isset($referencias[1]['dato']->tipo_referencia) && !$referencias[1]['dato']->tipo_referencia)
                                               checked="checked"
                                                @endif
                                        >
                                        Académica
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="personal2">
                                        <input type="radio" name="tipo2" id="personal2" value="1"
                                               @if(isset($referencias[1]['dato']->tipo_referencia) && $referencias[1]['dato']->tipo_referencia)
                                               checked="checked"
                                                @endif
                                        >
                                        Profesional
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(isset($referencias[1]['dato']->referencia_completa) && !$referencias[1]['dato']->referencia_completa)
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-3">
                                <button type="submit" class="btn btn-block btn-danger" id="delete2" name="delete2" value="{{$referencias[1]['dato']->id}}">
                                    <i class="fa fa-user-times"></i>
                                    Eliminar esta referencia
                                </button>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-block btn-warning" id="remind2" name="remind2" value="{{$referencias[1]['dato']->id}}">
                                    <i class="fa fa-paper-plane-o "></i>
                                    Enviar recordatorio nuevamente
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <input type="hidden" class="form-control" id="id" name="id">

                <hr>

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
    @else
        <h3 class="text-center">El programa al que aspira no solicita referencias</h3>
    @endif

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