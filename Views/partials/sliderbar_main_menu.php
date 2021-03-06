<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="<?= $baseURL ?>/views/components/img/Sena.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= getenv('ALIASE_SITE') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="<?= $baseURL ?>/views/components/img/universo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">William Diaz</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= $baseURL; ?>/views/index.php" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>

                </li>
                <li class="nav-header">Modulos Principales</li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-university"></i>
                        <p>
                            PROGRAMA FORMACION
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/programaformacion/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/programaformacion/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-toolbox"></i>
                        <p>
                            CATEGORIA
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Categoria/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Categoria/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tools"></i>
                        <p>
                            ELEMENTO
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Elemento/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Elemento/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tools"></i>
                        <p>
                            Persona
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Persona/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Persona/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tools"></i>
                        <p>
                            Sanciones
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Sanciones/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Sanciones/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-ruler-combined"></i>
                        <p>
                            UNIDADES
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Unidades/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Unidades/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fab fa-steam"></i>
                        <p>
                            MARCA
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Marca/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Marca/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-archive"></i>
                        <p>
                            ITEMS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Items/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Items/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tools"></i>
                        <p>
                            KIT
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Kit/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Kit/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                    <p>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-angle-left right"></i>
                        Prestamo
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Prestamo/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Prestamo/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                    <p>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-angle-left right"></i>
                        Detalle Prestamo
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Prestamo/index.php" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $baseURL ?>/views/modules/Prestamo/create.php" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Registrar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>