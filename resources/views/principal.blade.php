<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Gestión Agentes de Seguros - Leire</title>
    <link rel="stylesheet" href="css/all.css">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
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
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modalNuevo"><i class="icon-user-follow"></i>  Nuevo Cliente</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#"><i class="icon-user-following"></i>  Nueva Referencia</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#"><i class="icon-event"></i> Citas Hoy</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#"><i class="icon-notebook"></i> Vencimientos Mes Actual</a>
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
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="img/avatars/8.jpg" class="img-avatar" alt="raul.tahiche.daw@gamil.com">
                <span class="d-md-down-none">Raúl </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>
                <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>
                <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Cerrar sesión</a>
            </div>
        </li>
    </ul>
</header>

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">
                    Gestión
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-user"></i> Clientes</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-people"></i> Listado Clientes </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-user-follow"></i> Nuevo Cliente </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-user"></i> Referencias</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-people"></i> Listado Referencias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-user-follow"></i> Nueva Referencia</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-event"></i> Vencimientos</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-calendar"></i> Mes </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-book-open"></i> Rango</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Agenda</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-clock"></i> Citas Hoy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-calendar"></i> Calendario</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Configuraciones</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-briefcase"></i> Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-list"></i> Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-options"></i> Ramos</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main.html"><i class="icon-question"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">SGASL</span></a>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Raúl</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Clientes
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" id="opcion" name="opcion">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Apellidos</option>
                                    <option value="descripcion">DNI</option>

                                </select>
                                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Dni</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Localidad</th>
                            <th>Provincia</th>
                            <th>Profesión</th>
                            <th>Contacto</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Raúl</td>
                            <td>González Moreno</td>
                            <td>785440620M</td>
                            <td>raul.tahiche@gmail.com</td>
                            <td>620324500</td>
                            <td>C/Tomás de Iriarte 8</td>
                            <td>Tahiche</td>
                            <td>Las Palmas</td>
                            <td>Desarrollador</td>
                            <td></td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Verónica</td>
                            <td>Rueda Vizcaíno</td>
                            <td>78552582S</td>
                            <td>veronica.tahiche@gmail.com</td>
                            <td>686859714</td>
                            <td>C/Los Andes 2</td>
                            <td>Arrecife</td>
                            <td>Las Palmas</td>
                            <td>Agente de seguros</td>
                            <td></td>
                            <td>
                                <span class="badge badge-danger">No Activo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Leire</td>
                            <td>González Rueda</td>
                            <td></td>
                            <td>leire.tahiche@gmail.com</td>
                            <td></td>
                            <td>C/Tomás de Iriarte 8</td>
                            <td>Tahiche</td>
                            <td>Las Palmas</td>
                            <td>Estudiante</td>
                            <td></td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>María</td>
                            <td>Martínez Suarez</td>
                            <td>31682520F</td>
                            <td>maria@gmail.com</td>
                            <td>999222222</td>
                            <td>C/Ave del Paraíso 12</td>
                            <td>San Bartolome</td>
                            <td>Las Palmas</td>
                            <td>Desempleada</td>
                            <td></td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>Manuel</td>
                            <td>González Perez</td>
                            <td>31648963E</td>
                            <td>lolo.tahiche@gmail.com</td>
                            <td>686218279</td>
                            <td>C/Inventada 16</td>
                            <td>Arrecife</td>
                            <td>Las Palmas</td>
                            <td>Alfarero</td>
                            <td></td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Ant</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Nuevo Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduzca el nombre">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-7">
                                    <input type="text" id="apellidos" name="apeliidos" class="form-control" placeholder="Introduzca los apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">DNI</label>
                                <div class="col-md-3">
                                    <input type="text" id="dni" name="dni" class="form-control" placeholder="Introduzca el DNI/CIF">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Email</label>
                                <div class="col-md-7">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Introduzca un email válido">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Teléfono</label>
                                <div class="col-md-3">
                                    <input type="text" id="dni" name="dni" class="form-control" placeholder="Introduzca teléfono">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Fec. Nacim.</label>
                                <div class="col-md-4">
                                    <input type="date" id="email" name="email" class="form-control" >
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Sexo</label>
                                <div class="col-md-2">
                                    <select name="sexo" id="sexo" class="form-control">
                                        <option value="hombre">Hombre</option>
                                        <option value="mujer">Mujer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Domicilio</label>
                                <div class="col-md-5">
                                    <input type="text" id="domicilio" name="domicilio" class="form-control" placeholder="Introduzca Dirección">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Localidad</label>
                                <div class="col-md-2">
                                    <input type="text" id="localidad" name="localidad" class="form-control" placeholder="Localidad">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">C.Postal</label>
                                <div class="col-md-2">
                                    <input type="text" id="codigoPostal" name="codigoPostal" class="form-control" placeholder="C.Postal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Provincia</label>
                                <div class="col-md-3">
                                    <input type="text" id="provincia" name="provincia" class="form-control" placeholder="Provincia">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Cuenta</label>
                                <div class="col-md-4">
                                    <input type="text" id="banco" name="banco" class="form-control" placeholder="Introduzca IBAN o número de cuenta">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Profesion</label>
                                <div class="col-md-2">
                                    <input type="text" id="profesion" name="profesion" class="form-control" placeholder="Profesión">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 form-control-label" for="text-input">Contacto</label>
                                <div class="col-md-3">
                                    <input type="text" id="contacto" name="contacto" class="form-control" placeholder="Persona contacto">
                                </div>
                                <label class="col-md-1 form-control-label" for="text-input">Observac.</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="5" id="comment"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!-- Inicio del modal Eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Estas seguro de eliminar este cliente?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Fin del modal Eliminar -->
    </main>
    <!-- /Fin del contenido principal -->
</div>



<footer class="app-footer">
    <span>Raúl González</a> &copy; 2018</span>
    <span class="ml-auto">Desarrollado por Raúl González Moreno 1º D.A.W. <a href="http://www.ieszonzamas.es">C.I.F. Zonzamas</a></span>
</footer>

<script src="js/all.js"></script>
</body>

</html>