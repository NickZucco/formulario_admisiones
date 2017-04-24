@extends('unal')

@section('content')
    <h2 class="text-center">Formulario diligenciado exitosamente</h2>

    <br>

    <p>
        <strong>{{$referencia->nombre_de_referencia}}</strong>, gracias. El formulario fue diligenciado exitosamente y
        enviado para continuar con el procesode <strong>{{$aspirante->nombre}} {{$aspirante->apellido}}</strong>
    </p>
@endsection