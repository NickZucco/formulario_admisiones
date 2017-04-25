@extends('unal')

@section('content')


<div class="row">
    <div class="col-sm-12   col-md-6 col-md-offset-3" style="border-radius: 5px 5px 5px 5px; box-shadow: 3px 3px 10px #888888; padding: 3px; background-color:#DBF2D8">    

        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1"><br> 
            <div class="escudocabecera"><img src="{{env('APP_URL')}}images/logosimbolo_central_2c.png" width="40%"></div>
            <h4 align="center" class="Estilo12">Registro al formulario de aspirantes - {{env("APP_NAME")}}</h4>

            @if (count($errors) > 0)
            <div class="alert alert-danger" style="font-size:18px">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
			@if (Session::has('warning'))
            <div class="alert alert-warning" style="font-size:18px">
                {{ Session::get('warning') }}
            </div>
            @endif

            <form name="registro" id="registro" method="post" action="{{ env('APP_URL') }}auth/register" class="form-horizontal" style="margin:20px 0">
                {!! csrf_field() !!}
                <div class="form-group"> 
                    <label for="pin" class="control-label col-sm-5">PIN de inscripción</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name="pin" id="pin" placeholder="##########">
                    </div>
                </div>
				
				<div class="form-group"> 
                    <label for="document" class="control-label col-sm-5">Documento</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name="document" id="document" placeholder="#######">
                    </div>
                </div>

                <div class="form-group"> 
                    <label for="email" class="control-label col-sm-5">Correo electrónico</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name="email" id="email" placeholder="micorreo@miproveedor.com">
                    </div>
                </div>

                <div class="form-group"> 
                    <label for="password" class="control-label col-sm-5">Contraseña</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                    </div>
                </div>
				
                <div class="form-group"> 
                    <label for="password_confirmation" class="control-label col-sm-5">Confirmar contraseña</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="********">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label col-sm-5">CAPTCHA</label>
                    <div class="col-sm-12 col-md-7">
                        {!! Recaptcha::render() !!}
                    </div>
                </div> 
				
				<div for="agree" class="form-group">
					<h3>ESTIMADO ASPIRANTE</h3>
					<br>
					<p>Se solicita su autorización para que de manera libre, previa y expresa, permita a la 
					Universidad Nacional de Colombia, el recaudo, almacenamiento y disposición de los datos 
					personales incorporados en el sistema de información y envío de documentos para proceso de 
					admisión de posgrados 2017-II. </p>
					<br>
					<p>Los datos personales que usted suministrará al sistema, serán administrados por la 
					Universidad Nacional de Colombia, su confidencialidad y seguridad estarán garantizadas de 
					conformidad con las disposiciones legales (Ley 1581 de 2012 y Decreto Reglamentario 1377 de 
					2013) que regulan la protección de datos personales y con la política de privacidad para el 
					tratamiento de dichos datos, la cual podrá ser consultada en
					<a href="http://www.unal.edu.co/contenido/habeas/" target="blank">http://www.unal.edu.co/contenido/habeas/.</a></p>
					<br>
					<p>Finalmente se recuerda al aspirante que el usuario y contraseña es personal, y por tanto 
					su uso será de su exclusiva responsabilidad; en consecuencia, se presume que el contenido de 
					la información y archivos ingresados son verídicos en el marco del principio de la buena fe 
					establecido en el artículo 83 de la Constitución Política de Colombia. Cualquier falsedad o 
					inconsistencia que se identifique por parte de la Universidad Nacional de Colombia en el proceso
					de verificación de los mismos, será plena y exclusivamente responsabilidad del aspirante que 
					asumirá de forma directa las consecuencias civiles, penales y administrativas que su actuación 
					genere ante las autoridades públicas.</p>
					<br>
                    <center><label align="center" for="name" class="control-label">
						{{ Form::checkbox('agree', 1, null) }}&nbsp;&nbsp;&nbsp;He leído y acepto los términos 
						del proceso de envío de documentos.
					</label></center>
                </div>

                <div class="form-group">
                    <div class="form-group"> 
                        <p align="center"><b>&nbsp;Si tiene usuario y contraseña, por favor ingrese <a href="login">aquí</a>.</b></p>
                    </div>

                    <div class="form-group"> 
                        <center><input class="form-control" type="submit" name="envio" value="Continuar"></center>
                    </div>
                </div>
            </form>			

            <script>
                
                 $("#registro").submit(function(event){
                 var isValid = true;
                 var agreeBox = document.getElementsByName('agree');
                 console.log(agreeBox[0]);
                 if (!agreeBox[0].checked){
                 alert('Debe aceptar los términos y condiciones del proceso de envío de documentos para registrarse.');
                 event.preventDefault();
                 }else{
                 $("#registro").submit()
                 }
                 });
                 
            </script>

        </div>
    </div>
</div>

@stop