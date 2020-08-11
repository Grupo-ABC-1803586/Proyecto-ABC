<?php
require("../../partials/routes.php");
require("../../../App/Controllers/ItemsController.php");

use App\Controllers\ItemsController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Items</title>
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
                        <h1>Editar Nuevo Items</h1>
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
                        Error al crear el Items: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['id'])) { ?>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-box"></i>&nbsp; Información de Items</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="create.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                                <p>
                                <?php
                                $DataItems = ItemsController::searchForID($_GET["id"]);
                                if (!empty($DataItems)) {
                                    ?>
                                    <div class="card-body">
                                        <!-- form start -->
                                        <form class="form-horizontal" method="post" id="frmEditProducto"
                                              name="frmEditProducto"
                                              action="../../../App/Controllers/ItemsController.php?action=edit">
                                            <input id="Id" name="Id" value="<?php echo $DataItems->getId(); ?>" hidden required="required" type="text">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="placa" class="col-sm-2 col-form-label">Placa</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="Placa" name="Placa" value="<?= $DataItems->getPlaca(); ?>" placeholder="Ingrese Placa">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="Descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="Descripcion" name="Descripcion" value="<?= $DataItems->getDescripcion(); ?>" placeholder="Ingrese Descripcion">
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="Costo" class="col-sm-2 col-form-label">Costo</label>
                                                            <div class="col-sm-10">
                                                                <input required type="float" class="form-control" id="Costo" name="Costo" value="<?= $DataItems->getCosto(); ?>" placeholder="Ingrese Costo">
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label for="Ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="Ubicacion" name="Ubicacion" value="<?= $DataItems->getUbicacion(); ?>" placeholder="Ingrese Ubicacion">
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-group row">
                                                                    <label for="Imagen" class="col-sm-2 col-form-label">Imagen</label>
                                                                    <div class="col-sm-10">
                                                                        <input required type="text" class="form-control" id="Imagen" name="Imagen" value="<?= $DataItems->getImagen(); ?>" placeholder="Inserte Imagen">
                                                                    </div>
                                                                </div>

                                            <div class="form-group row">
                                                <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select id="Estado" name="Estado" class="custom-select">
                                                        <option <?= ($DataItems->getEstado() == "Activo") ? "selected" : ""; ?>
                                                                value="Activo">Activo
                                                        </option>
                                                        <option <?= ($DataItems->getEstado() == "Inactivo") ? "selected" : ""; ?>
                                                                value="Inactivo">Inactivo
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-info">Enviar</button>
                                            <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->

                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php } ?>
                                </p>
                            <?php } ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
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
