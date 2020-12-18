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

                            <?php if (!empty($_GET["Id"]) && isset($_GET["Id"])) {
                                $dataitem = ItemsController::searchForID($_GET["Id"]);
                                if (!empty($dataitem)) {
                                    ?>
                                    <div class="card card-warning">
                                     <div class="card-header">
                                      <h3 class="card-title"> <strong>Items</strong> </h3>
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
                                        <hr>
                                        <strong><i class="far fa-calendar mr-1"></i> Placa</strong>
                                        <p class="text-muted"><?= $dataitem->getPlaca(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-sticky-note"></i> Descripcion</strong>
                                        <p class="text-muted"><?= $dataitem->getDescripcion(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-donate"></i> Costo</strong>
                                        <p class="text-muted"><?= $dataitem->getCosto(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-globe"></i> Ubicacion</strong>
                                        <p class="text-muted"><?= $dataitem->getUbicacion(); ?></p>
                                        <hr>
                                        <strong><i class="fas fa-camera"></i> Imagen</strong>
                                        <p class="text-muted"><img src="../../public/filesUploaded/<?= $dataitem->getImagen(); ?>" alt="Imagen del item" width="250" height="250"></p>
                                        <hr>
                                        <strong><i class="fas fa-tools"></i> Elemento</strong>
                                        <p class="text-muted"><?= $dataitem->getElemento()->getNombre()?></p>
                                        <hr>
                                        <strong><i class="fas fa-ruler-combined"></i> Unidades</strong>
                                        <p class="text-muted"><?= $dataitem->getUnidades()->getNombre() ?></p>
                                        <hr>
                                        <strong><i class="fab fa-steam"></i> Marca</strong>
                                        <p class="text-muted"><?= $dataitem->getMarca()->getNombre() ?></p>
                                        <hr>
                                        <strong><i class="fas fa-user-ninja mr-1"></i>Kit</strong>
                                        <p class="text-muted"><?= $dataitem->getKit()->getNombre()?></p>
                                        <hr>
                                        <strong><i class="fas fa-pen-square"></i> Estado</strong>
                                        <p class="text-muted"><?= $dataitem->getEstado(); ?></p>
                                        </p>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <a role="button" href="edit.php?Id=<?php echo $dataitem->getId(); ?>" class="btn btn-warning float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-tasks"></i> Modificar Items
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a role="button" href="create.php" class="btn btn-dark float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-plus"></i> Crear Items
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a href="index.php" role="button" class="btn btn-dark float-right">Volver</a>
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
