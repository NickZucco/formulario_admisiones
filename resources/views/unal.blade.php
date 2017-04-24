<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]> <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]> <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9]> <html class="ie9 oldie"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html>
    <!--<![endif]-->

    <head>

        <meta charset="utf-8">
        <!--
        =============================================================================
        === PLANTILLA DESARROLLADA POR LA OFICINA DE MEDIOS DIGITALES - UNIMEDIOS ===
        =============================================================================
        -->
        <link rel="shortcut icon" href="{{env('APP_URL')}}images/favicon.ico" type="image/x-icon">

        <meta name="revisit-after" content="1 hour">
        <meta name="distribution" content="all">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.5, user-scalable=yes">
        <meta name="expires" content="1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="all">

        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/bootstrap.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/bootstrap.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/reset.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/unal.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/base.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/tablet.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/phone.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/small.css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/printer.css" media="print">
        <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}css/form.css" media="print">

        <link href="{{ env('APP_URL') }}css/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ env('APP_URL') }}css/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ env('APP_URL') }}css/formulario.css" rel="stylesheet" type="text/css">
        <link href="{{ env('APP_URL') }}css/fileinput/fileinput.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ env('APP_URL') }}css/bootstrap-multiselect/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>
        <link href="{{ env('APP_URL') }}css/bootstrap-typeahead/style.css" rel="stylesheet" type="text/css"/>

        <script src="{{ env('APP_URL') }}js/jquery.js" type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/unal.js" type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/datetimepicker/moment.js"  type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/datetimepicker/moment-with-locales.js" type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/datetimepicker/datetimepicker.min.js"></script>
        <script src="{{ env('APP_URL') }}js/fileupload/fileinput.min.js" type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/fileupload/fileinput_locale_es.js" type="text/javascript"></script>

        <script src="{{ env('APP_URL') }}js/bootstrap-typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
        <script src="{{ env('APP_URL') }}js/bootstrap-multiselect/bootstrap-multiselect.js" type="text/javascript"></script>

        <!--[if lt IE 9]><script src="{{env('APP_URL')}}js/html5shiv.js" type="text/javascript"></script><![endif]-->
        <!--[if lt IE 9]><script src="{{env('APP_URL')}}js/respond.js" type="text/javascript"></script><![endif]-->


        <title>{{env('APP_NAME')}}</title>
    </head>

    <body>
        <div id="services">
            <div class="indicator hidden-xs"></div>
            <ul class="dropdown-menu">
                <li>
                    <a href="http://correo.unal.edu.co" target="_blank"><img src="{{env('APP_URL')}}images/icnServEmail.png" width="32" height="32" alt="Correo Electrónico">Correo Electrónico</a>
                </li>
                <li>
                    <a href="http://www.sia.unal.edu.co" target="_blank"><img src="{{env('APP_URL')}}images/icnServSia.png" width="32" height="32" alt="Sistema de Información Académica">Sistema de Información Académica</a>
                </li>
                <li>
                    <a href="http://www.sinab.unal.edu.co" target="_blank"><img src="{{env('APP_URL')}}images/icnServLibrary.png" width="32" height="32" alt="Biblioteca">Biblioteca</a>
                </li>
                <li>
                    <a href="http://168.176.5.43:8082/Convocatorias/indice.iface" target="_blank"><img src="{{env('APP_URL')}}images/icnServCall.png" width="32" height="32" alt="Convocatorias">Convocatorias</a>
                </li>
                <li>
                    <a href="http://identidad.unal.edu.co"><img src="{{env('APP_URL')}}images/icnServIdentidad.png" width="32" height="32" alt="Identidad U.N.">Identidad U.N.</a>
                </li>
            </ul>
        </div>
        <header id="unalTop">
            <div class="logo">
                <a href="http://unal.edu.co">
                    <!--[if (gte IE 9)|!(IE)]><!-->
                    <svg width="93%" height="93%">
                    <image xlink:href="{{env('APP_URL')}}images/escudoUnal.svg" width="100%" height="100%" class="hidden-print"/>
                    </svg>

                    <!--<![endif]-->
                    <!--[if lt IE 9]>
              <img src="{{env('APP_URL')}}images/escudoUnal.png" width="93%" height="auto" class="hidden-print"/>
          <![endif]-->
                    <img src="{{env('APP_URL')}}images/escudoUnal_black.png" class="visible-print" />
                </a>
            </div>
            <div class="seal">
                <img class="hidden-print" alt="Escudo de la República de Colombia" src="{{env('APP_URL')}}images/sealColombia.png" width="66" height="66" />

                <img class="visible-print" alt="Escudo de la República de Colombia" src="{{env('APP_URL')}}images/sealColombia_black.png" width="66" height="66" />
            </div>
            <div class="firstMenu">

                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <div class="btn-group languageMenu hidden-xs">
                    <div class="btn btn-default dropdown-toggle" data-toggle="dropdown">es<span class="caret"></span></div>
                    <ul class="dropdown-menu">
                        <li><a href="index.html#">es</a></li>
                        <li><a href="index.html#">en</a></li>
                    </ul>
                </div>
                <ul class="socialLinks hidden-xs">
                    <li>
                        <a href="https://www.facebook.com/UNColombia" target="_blank" class="facebook" title="Página oficial en Facebook"></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/UNColombia" target="_blank" class="twitter" title="Cuenta oficial en Twitter"></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCnE6Zj2llVxcvL5I38B0Ceg" target="_blank" class="youtube" title="Canal oficial de Youtube"></a>
                    </li>
                    <li>
                        <a href="http://agenciadenoticias.unal.edu.co/nc/sus/type/rss2.html" target="_blank" class="rss" title="Suscripción a canales de información RSS"></a>
                    </li>
                </ul>
                <div class="navbar-default">
                    <nav id="profiles">
                        <ul class="nav navbar-nav dropdown-menu">
                            <li class="item_Aspirantes #>"><a href="index.html#">Aspirantes</a></li>
                            <li class="item_Estudiantes #>"><a href="index.html#">Estudiantes</a></li>
                            <li class="item_Egresados #>"><a href="index.html#">Egresados</a></li>
                            <li class="item_Docentes #>"><a href="index.html#">Docentes</a></li>
                            <li class="item_Administrativos #>"><a href="index.html#">Administrativos</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="bs-navbar" class="navbar-collapse collapse navigation">
                <div class="site-url">
                    <a href="{{env('APP_URL')}}">{{env('APP_URL')}}</a>
                </div>
                <div class="buscador">
                    <div class="gcse-searchbox-only" data-resultsUrl="http://unal.edu.co/resultados-de-la-busqueda/" data-newWindow="true"></div>
                </div>
                <div class="mainMenu">

                    <div class="btn-group">
                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown">Sedes<span class="caret"></span></div>
                        <ul class="dropdown-menu dropItem-16">
                            <li><a href="http://www.imani.unal.edu.co" target="_blank">Amazonia</a><span class="caret-right"></span></li>
                            <li><a href="http://www.bogota.unal.edu.co" target="_blank">Bogotá</a><span class="caret-right"></span></li>
                            <li><a href="http://www.caribe.unal.edu.co" target="_blank">Caribe</a><span class="caret-right"></span></li>
                            <li><a href="http://www.manizales.unal.edu.co" target="_blank">Manizales</a><span class="caret-right"></span></li>
                            <li><a href="http://www.medellin.unal.edu.co" target="_blank">Medellín</a><span class="caret-right"></span></li>
                            <li><a href="http://www.orinoquia.unal.edu.co" target="_blank">Orinoquia</a><span class="caret-right"></span></li>
                            <li><a href="http://www.palmira.unal.edu.co" target="_blank">Palmira</a><span class="caret-right"></span></li>
                            <li><a href="http://www.tumaco-pacifico.unal.edu.co" target="_blank">Tumaco</a><span class="caret-right"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="btn-group hidden-sm hidden-md hidden-lg hidden-print">
                    <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="unalOpenMenuServicios" data-target="#services">Servicios<span class="caret"> </span>
                    </div>
                </div>
                <div class="btn-group hidden-sm hidden-md hidden-lg hidden-print">
                    <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="unalOpenMenuPerfiles" data-target="#profiles">Perfiles<span class="caret"> </span>
                    </div>
                </div>
            </div>

        </header>

        <main class="detalle">
            @yield('content')
        </main>

        <footer class="clear">
            <nav class="col-md-3 col-lg-3 col-sm-3 col-xs-4 col-xxs-6 gobiernoLinea">
                <a href="http://www.legal.unal.edu.co" target="_top">Régimen Legal</a>
                <a href="http://www.unal.edu.co/dnp" target="_top">Talento humano</a>
                <a href="http://www.unal.edu.co/contratacion/" target="_top">Contratación</a>
                <a href="http://www.unal.edu.co/dnp/" target="_top">Ofertas de empleo</a>
                <a href="http://rendiciondecuentas.unal.edu.co/" target="_top">Rendición de cuentas</a>
                <a href="http://docentes.unal.edu.co/concurso-profesoral/" target="_top">Concurso docente</a>
                <a href="http://www.pagovirtual.unal.edu.co/" target="_top">Pago Virtual</a>
                <a href="http://www.unal.edu.co/control_interno/index.html" target="_top">Control interno</a>
                <a href="http://unal.edu.co/siga/" target="_top">Calidad</a>
                <a href="http://unal.edu.co/buzon-de-notificaciones/" target="_self">Buzón de notificaciones</a>
            </nav>
            <nav class="col-md-3 col-lg-3 col-sm-3 col-xs-4 col-xxs-6 gobiernoLinea">
                <a href="http://correo.unal.edu.co" target="_top">Correo institucional</a>
                <a href="index.html#">Mapa del sitio</a>
                <a href="http://redessociales.unal.edu.co" target="_top">Redes Sociales</a>
                <a href="index.html#">FAQ</a>
                <a href="http://unal.edu.co/quejas-y-reclamos/" target="_self">Quejas y reclamos</a>
                <a href="http://unal.edu.co/atencion-en-linea/" target="_self">Atención en línea</a>
                <a href="http://unal.edu.co/encuesta/" target="_self">Encuesta</a>
                <a href="index.html#">Contáctenos</a>
                <a href="http://www.onp.unal.edu.co" target="_top">Estadísticas</a>
                <a href="index.html#">Glosario</a>
            </nav>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 col-xxs-12 footer-info">
                <p class="col-sm-12 col-md-6 contacto">
                    <b>Contacto página web:</b><br/> Dirección .....<br/> Edificio ...<br/> Bogotá D.C., Colombia<br/> (+57 1) 316 5000 Ext. 13351
                </p>
                <p class="col-sm-12 col-md-6 derechos">
                    © Copyright 2014<br/> Algunos derechos reservados.<br/>
                    <a title="Comuníquese con el administrador de este sitio web" href="mailto:untic_fibog@unal.edu.co">untic_fibog@unal.edu.co</a><br/>
                    <a href="index.html#">Acerca de este sitio web</a><br/> Actualización:04/09/16
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 logos">
                <div class="col-xs-6 col-sm-12 col-md-6 no-padding">
                    <a class="col-xs-6 col-sm-12" href="http://www.orgulloun.unal.edu.co">
                        <img class="hidden-print" alt="Orgullo UN" src="{{env('APP_URL')}}images/log_orgullo.png" width="78" height="21" />
                        <img class="visible-print" alt="Orgullo UN" src="{{env('APP_URL')}}images/log_orgullo_black.png" width="94" height="37" />
                    </a>

                    <a class="col-xs-6 col-sm-12 imgAgencia" href="http://www.agenciadenoticias.unal.edu.co/inicio.html">
                        <img class="hidden-print" alt="Agencia de noticias" src="{{env('APP_URL')}}images/log_agenc.png" width="94" height="25" />
                        <img class="visible-print" alt="Agencia de noticias" src="{{env('APP_URL')}}images/log_agenc_black.png" width="94" height="37" />
                    </a>
                </div>
                <div class="col-xs-6 col-sm-12 col-md-6 no-padding">
                    <a class="col-xs-6 col-sm-12" href="https://www.sivirtual.gov.co/memoficha-entidad/-/entidad/T0356">
                        <img alt="Trámites en línea" src="{{env('APP_URL')}}images/log_gobiern.png" width="67" height="51" />
                    </a>

                    <a class="col-xs-6 col-sm-12" href="http://www.contaduria.gov.co/">
                        <img alt="Contaduría general de la republica" src="{{env('APP_URL')}}images/log_contra.png" width="67" height="51" />
                    </a>
                </div>

            </div>
        </footer>
    </body>

</html>