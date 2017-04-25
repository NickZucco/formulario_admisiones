@extends('unal')

@section('content')
    <h2 class="text-center">Formulario diligenciado exitosamente</h2>

    <br>

    <p class="text-center">
        Apreciado {{$referencia}}, el formulario al que intenta acceder ya ha sido diligenciado, en caso de tener dudas
        por favor remitirlas al correo electrónico <a href="mailto:{{$correo}}">{{$correo}}</a>
    </p>
@endsection