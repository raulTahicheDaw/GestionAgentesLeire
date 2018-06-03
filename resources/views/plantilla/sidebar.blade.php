<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-title">
                <a class="nav-link" href="#">Inicio</a>
            </li>
            <li @click="menu=1" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-user"></i>Clientes</a>
            </li>
            <li @click="menu=3" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-phone"></i>Referencias</a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>Agenda</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-clock"></i>Citas por dia</a>
                    </li>
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-calendar"></i>Calendario</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i>Vencimientos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i>
                    Configuraciones</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-briefcase"></i> Productos</a>
                    </li>
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-list"></i> Categorías</a>
                    </li>
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-options"></i> Ramos</a>
                    </li>
                </ul>
            </li>
            <li @click="menu=13" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-question"></i> Ayuda <span
                            class="badge badge-danger">PDF</span></a>
            </li>
            <li @click="menu=14" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span
                            class="badge badge-info">SGASL</span></a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>