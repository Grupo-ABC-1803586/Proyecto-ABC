<?php
require("../../partials/routes.php");
require("../../../app/Controllers/PrestamoController.php");

use App\Controllers\PrestamoController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Modificar Prestamo</title>
    <?php require("../../partials/head_Imports.php"); ?>
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
                        <h1> Modificar Prestamo </h1>
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
                            Error al gestionar prestamo: <?= ($_GET['mensaje']) ?? "" ?>
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
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>
                <!-- /.card-header -->
                <?php if(!empty($_GET["Id"]) && isset($_GET["Id"])){ ?>
                    <p>
                    <?php
                    $DataPrestamo = PrestamoController::searchForID($_GET["Id"]);
                        if(!empty($DataPrestamo)){
                    ?>
                            <!-- form start -->
                            <form class="Prestamo" method="post" Id="frmEditPrestamo" name="frmEditPrestamo" action="../../../app/Controllers/PersonaController.php?action=edit">
                                <input Id="Id" name="Id" value="<?php echo $DataPrestamo->getId(); ?>" hidden required="required" type="text">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="FechaPrestamo" class="col-sm-2 col-form-label">FechaPrestamo</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" Id="FechaPrestamo" name="FechaPrestamo" value="<?= $DataPrestamo->getFechaPrestamo(); ?>" placeholder="Ingrese el nombre del Kit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="FechaEntrega" class="col-sm-2 col-form-label">FechaEntrega</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" Id="FechaEntrega" name="FechaEntrega" value="<?= $DataPrestamo->getFechaEntrega(); ?>" placeholder="Ingrese una breve descripcion del Kit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                                        <div class="col-sm-10">
                                            <input required type="number" minlength="6" class="form-control" Id="Observaciones" name="Observaciones" value="<?= $DataPrestamo->getObservaciones(); ?>" placeholder="Ingrese la placa del kit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                        <div class="col-sm-10">
                                            <input required type="number" minlength="6" class="form-control" Id="Estado" name="Estado" value="<?= $DataPrestamo->getEstado(); ?>" placeholder="Ingrese la placa del kit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Persona" class="col-sm-2 col-form-label">Persona/label>
                                        <div class="col-sm-10">
                                            <input required type="number" minlength="6" class="form-control" Id="Persona" name="Persona" value="<?= $DataPrestamo->getPersona(); ?>" placeholder="Ingrese la placa del kit">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                    <?php }else{ ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                No se encontro ningun registro con estos parametros de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                            </div>
                    <?php } ?>
                    </p>
                <?php } ?>
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
