<?php
require("../../partials/routes.php");
<<<<<<< HEAD:Views/modules/Prestamo/show.php
require("../../../app/Controllers/PrestamoController.php");

use App\Controllers\PrestamoController; ?>
=======
require("../../../app/Controllers/MarcaController.php");

use App\Controllers\MarcaController; ?>
>>>>>>> Yolixs:Views/modules/Marca/show.php
<!DOCTYPE html>
<html lang="es">
<head>
<<<<<<< HEAD:Views/modules/Prestamo/show.php
    <title><?= getenv('TITLE_SITE') ?> | Datos del Prestamo</title>
    <?php require("../../partials/head_Imports.php"); ?>
=======
    <title><?= getenv('TITLE_SITE') ?> |  Datos de Marca</title>
    <?php require("../../partials/head_imports.php"); ?>
>>>>>>> Yolixs:Views/modules/Marca/show.php
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
<<<<<<< HEAD:Views/modules/Prestamo/show.php
                        <h1>Informacion del Prestamo</h1>
=======
                        <h1>Informacion de Marca</h1>
>>>>>>> Yolixs:Views/modules/Marca/show.php
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">Proyecto-ABC</a></li>
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if(!empty($_GET['respuesta'])){ ?>
                <?php if ($_GET['respuesta'] == "error"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
<<<<<<< HEAD:Views/modules/Prestamo/show.php
                            Error al consultar el Prestamo: <?= ($_GET['mensaje']) ?? "" ?>
=======
                        Error al consultar la categoria: <?= ($_GET['mensaje']) ?? "" ?>
>>>>>>> Yolixs:Views/modules/Marca/show.php
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['Id'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["Id"]) && isset($_GET["Id"])){
<<<<<<< HEAD:Views/modules/Prestamo/show.php
                    $DataPrestamo = PrestamoController::searchForID($_GET["Id"]);
                    if(!empty($DataPrestamo)){
                ?>
                <div class="card-header">
                    <h3 class="card-title"><?= $DataPrestamo->getPersona()  ?></h3>
                </div>
                <div class="card-body">
                    <p>

                        <strong><i class="fas fa-book mr-1"></i> Fecha Prestamo y Fecha Entrega </strong>
                        <p class="text-muted">
                            <?= $DataPrestamo->getFechaPrestamo()." ".$DataPrestamo->getFechaEntrega() ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Observaciones y Estado</strong>
                        <p class="text-muted"><?= $DataPrestamo->getObservaciones().": ".$DataPrestamo->getEstado()?></p>
                        <hr>
                        <hr>
                        <strong><i class="fas fa-user mr-1"></i> Persona </strong>
                        <p class="text-muted"><?= $DataPrestamo->getPersona().": ".$DataPrestamo->getPersona() ?></p>
                        <hr>
                    </p>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                <i class="fas fa-tasks"></i> Gestionar Prestamo
                            </a>
                        </div>
                        <div class="col-auto">
                            <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Prestamo
                            </a>
=======
                    $DataMarca = MarcaController::searchForID($_GET["Id"]);
                    if(!empty($DataMarca)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= $DataMarca->getNombre()  ?></h3>
                        </div>
                        <div class="card-body">
                            <p>

                                <strong><i class="fas fa-book mr-1"></i> Nombre</strong>
                            <p class="text-muted">
                                <?= $DataMarca->getNombre() ?>
                            </p>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="create.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Registrar marca
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="edit.php?id=<?php echo $DataMarca->getId(); ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> editar marca
                                    </a>
                                </div>
                            </div>
>>>>>>> Yolixs:Views/modules/Marca/show.php
                        </div>
                    <?php }else{ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                        </div>
                    <?php }
                } ?>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>
