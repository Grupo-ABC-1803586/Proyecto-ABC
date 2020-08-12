<?php
require("../../partials/routes.php");
require("../../../App/Controllers/ItemsController.php");

use App\Controllers\ItemsController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos de Items</title>
    <?php require("../../partials/head_imports.php"); ?>
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
                        <h1>Informacion de Items</h1>
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

            <?php if (!empty($_GET['respuesta'])) { ?>
                <?php if ($_GET['respuesta'] == "error") { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al consultar el usuario: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['Id'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-green">
                            <?php if (!empty($_GET["Id"]) && isset($_GET["Id"])) {
                                $DataItems = ItemsController::searchForID($_GET["Id"]);
                                if (!empty($DataItems)) {
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-shopping-cart"></i> &nbsp; Ver
                                            Información de <?= $DataItems->getId() ?>
                                            -<?= $DataItems->getId() ?></h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                                    data-source="show.php" data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                    class="fas fa-expand"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"
                                                    data-toggle="tooltip" title="Remove">
                                                <i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            <strong><i class="fas fa-sort-numeric-down mr-1"></i> Numero</strong>
                                        <p class="text-muted">
                                            <?= $DataItems->getId() . "-" . $DataItems->getId(); ?>
                                        </p>
                                        <hr>
                                        <strong><i class="far fa-calendar mr-1"></i> Placa</strong>
                                        <p class="text-muted"><?= $DataItems->getPlaca(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-money-bill mr-1"></i> Descripcion</strong>
                                        <p class="text-muted"><?= $DataItems->getDescripcion(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-cog mr-1"></i> Costo</strong>
                                        <p class="text-muted"><?= $DataItems->getCosto(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-money-bill mr-1"></i> Ubicacion</strong>
                                        <p class="text-muted"><?= $DataItems->getUbicacion(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-cog mr-1"></i> Imagen</strong>
                                        <p class="text-muted"><?= $DataItems->getImagen(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-user-ninja mr-1"></i> Elemento</strong>
                                        <p class="text-muted"><?= $DataItems->getElemento()->getNombre()?></p>
                                        <hr>
                                        <strong><i class="far fa-user mr-1"></i> Marca</strong>
                                        <p class="text-muted"><?= $DataItems->getMarca()->getNombre() ?></p>
                                        <hr>
                                        <strong><i class="fas fa-user-ninja mr-1"></i>Kit</strong>
                                        <p class="text-muted"><?= $DataItems->getKit()->getNombre()?></p>
                                        <hr>
                                        <strong><i class="far fa-user mr-1"></i> Unidades</strong>
                                        <p class="text-muted"><?= $DataItems->getUnidades()->getNombre() ?></p>
                                        <hr>
                                        <strong><i class="fas fa-cog mr-1"></i> Estado</strong>
                                        <p class="text-muted"><?= $DataItems->getEstado(); ?></p>
                                        </p>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <a role="button" href="index.php" class="btn btn-success float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-tasks"></i> Listar Items
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a role="button" href="create.php" class="btn btn-primary float-right"
                                                   style="margin-right: 5px;">
                                                    <i class="fas fa-plus"></i> Registrar Items
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
</body>
</html>
