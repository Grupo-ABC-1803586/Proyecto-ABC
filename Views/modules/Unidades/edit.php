<?php
require("../../partials/routes.php");
require("../../../App/Controllers/UnidadesController.php");

use App\Controllers\UnidadesController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Modificar Unidades</title>
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
                        <h1>Modificar Unidades</h1>
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
                        Error al editar Unidades: <?= ($_GET['mensaje']) ?? "" ?>
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
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i> <strong>Unidades</strong></h3>
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
                <?php if(!empty($_GET["Id"]) && isset($_GET["Id"])){ ?>
                    <p>
                    <?php
                    $DataUnidades = UnidadesController::searchForID($_GET["Id"]);
                    if(!empty($DataUnidades)){
                        ?>
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="frmModificarcategoria" name="frmModificarcategoria" action="../../../app/Controllers/UnidadesController.php?action=edit">
                            <input id="Id" name="Id" value="<?php echo $DataUnidades->getId(); ?>" hidden required="required" type="text">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="Tipo" class="col-sm-2 col-form-label">Tipo</label>
                                    <div class="col-sm-10">
                                        <select id="Tipo" name="Tipo" class="custom-select">
                                            <option <?= ($DataUnidades->getTipo() == "Cantidad de sustancia") ? "selected":""; ?> value="Cantidad de sustancia">Cantidad de sustancia</option>
                                            <option <?= ($DataUnidades->getTipo() == "Intensidad de electricidad") ? "selected":""; ?> value="Intensidad de electricidad">Intensidad de electricidad</option>>
                                            <option <?= ($DataUnidades->getTipo() == "Intensidad luminosa") ? "selected":""; ?> value="Intensidad luminosa">Intensidad luminosa</option>>
                                            <option <?= ($DataUnidades->getTipo() == "Longitud") ? "selected":""; ?> value="Longitud">Longitud</option>>
                                            <option <?= ($DataUnidades->getTipo() == "Masa") ? "selected":""; ?> value="Masa">Masa</option>>
                                            <option <?= ($DataUnidades->getTipo() == "Otra") ? "selected":""; ?> value="Otra">Otra</option>>                                      </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input required type="text" class="form-control" id="Nombre" name="Nombre" value="<?= $DataUnidades->getNombre(); ?>" placeholder="Ingrese nombre de Unidades">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-dark float-right">Cancelar</a>
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
<?php require('../../partials/scripts.php');?>
</body>
</html>
