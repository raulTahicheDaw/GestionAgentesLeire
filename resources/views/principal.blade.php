<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Gestion Agentes Seguros">
    <meta name="keyword" content="Sistema gestion seguros Laravel Vue Js, Sistema gestion seguros Laravel Vue Js">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/iconfav.png">
    <title>Gestión Agentes de Seguros - Leire</title>
    <link rel="stylesheet" href="css/all.css">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    <header class="app-header navbar navbar-light bg-light">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand navbar-light bg-light" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" @click="menu=2" href="#"><i
                            class="icon-user-follow"></i> Nuevo Cliente</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" @click="menu=4" href="#"><i class="icon-user-following"></i> Nueva Referencia</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" @click="menu=6" href="#"><i class="icon-event"></i> Citas Hoy</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" @click="menu=12" href="#"><i class="icon-notebook"></i> Vencimientos Mes Actual</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Citas para hoy
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas Mes
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">{{Auth::user()->usuario}} </span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>
            </li>
        </ul>
    </header>

    <div class="app-body">
        @if(Auth::check())
            @if(Auth::user()->idrol==1)
                @include('plantilla.sidebaradministrador')
            @elseif(Auth::user()->idrol==2)
                @include('plantilla.sidebargeneral')
            @else
            @endif
        @endif
    <!-- Contenido Principal -->
    @yield('contenido')
    <!-- /Fin del contenido principal -->
    </div>
</div>


<footer class="app-footer fixed-bottom" style="height: 50px;">
    <span>Raúl González</a> &copy; 2018</span>
    <span class="ml-auto">Desarrollado por Raúl González Moreno 1º D.A.W. <a href="http://www.ieszonzamas.es">C.I.F. Zonzamas</a></span>
</footer>
<script src="js/sweetalert2.all.js"></script>
<script src="js/app.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/pace.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/template.js"></script>
</body>

</html>