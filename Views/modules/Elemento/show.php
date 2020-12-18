<?php
require_once("../../partials/routes.php");
require_once("../../../App/Controllers/ElementoController.php");

use App\Controllers\ElementoController; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos Elemento</title>
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

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/">Proyecto-ABC</a></li>
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
                        Error al consultar el Programa: <?= ($_GET['mensaje']) ?? "" ?>
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
            <div class="card card-warning">
                <?php if(!empty($_GET["Id"]) && isset($_GET["Id"])){
                $DataElemento = ElementoController::searchForId($_GET["Id"]);
                if(!empty($DataElemento)){
                ?>
                <div class="card-header">
                    <h3 class="card-title"><strong> Elemento </strong></h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <p>

                            <strong><i class="fas fa-hammer"></i> Nombre</strong>
                        <p class="text-muted">
                            <?= $DataElemento->getNombre() ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-sticky-note"></i> Descripcion</strong>
                        <p class="text-muted"><?= $DataElemento->getDescripcion() ?></p>
                        <hr>
                        <strong><i class="fas fa-hashtag"></i> Serie</strong>
                        <p class="text-muted"><?= $DataElemento->getSerie() ?></p>
                        <hr>
                        <strong><i class="fas fa-toolbox"></i> Categoria  </strong>
                        <p class="text-muted"><?= $DataElemento->getCategoria()->getNombre() ?></p>
                        </p>
                        <hr>
                        <strong><i class="fas fa-atom"></i> Material</strong>
                        <p class="text-muted"><?= $DataElemento->getMaterial() ?></p>

                    </div>
                    <div class="card-footer">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <a role="button" href="edit.php?Id=<?php echo $DataElemento->getId(); ?>" class="btn btn-warning float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Modificar Elemento
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-dark float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Elemento
                                    </a>
                                </div>
                            </div>
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

    <?php require ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require ('../../partials/scripts.php');?>
</body>
</html>