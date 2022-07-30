<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/admin" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Inicio</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Productos</span></li>

                <li class="sidebar-item"> <a class="sidebar-link" href="/viewProducto" aria-expanded="false"><i class="icon-chart"></i><span class="hide-menu">Productos
                        </span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Administrar</span></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Inventario </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="/viewCategorias" class="sidebar-link"><span class="hide-menu"> Categorías
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="/viewMarcas" class="sidebar-link"><span class="hide-menu"> Marcas
                                </span></a>
                        </li>
                    </ul>
                    
                </li>

                <?php if (isset($_SESSION['admin'])) { ?>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span class="hide-menu">Usuarios </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="/viewColaborador" class="sidebar-link"><span class="hide-menu"> Cobaloradores
                                    </span></a>
                            </li>
                            
                        </ul>
                    </li>

                <?php } ?>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/cuenta" aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span class="hide-menu">Cuenta
                        </span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu"></span></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/logout" aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Salir</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->