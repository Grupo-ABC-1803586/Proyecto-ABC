<?php
require("../../partials/routes.php");
require("../../../App/Controllers/MarcaController.php");

use App\Controllers\MarcaController; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?= getenv('TITLE_SITE') ?> |  Datos de Marca</title>
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
                        <h1>Informacion de Marca</h1>
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
                        Error al consultar la categoria: <?= ($_GET['mensaje']) ?? "" ?>
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
                    $DataMarca = MarcaController::searchForID($_GET["Id"]);
                    if(!empty($DataMarca)){
                        ?>
                        <div class="card-header">
                            <h3 class="card-title"> <strong>Marca</strong> </h3>
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
                                    <a role="button" href="edit.php?Id=<?php echo $DataMarca->getId(); ?>" class="btn btn-warning float-right" style="margin-right: 5px;">
                                        <i class="fas fa-tasks"></i> Modificar Marca
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a role="button" href="create.php" class="btn btn-dark float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus"></i> Crear Marca
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="index.php" role="button" class="btn btn-dark float-right">Volver</a>
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
