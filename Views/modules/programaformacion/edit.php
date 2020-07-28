<?php
require("../../partials/routes.php");
require("../../../app/Controllers/ProgramaFormacionController.php");

use App\Controllers\ProgramaFormacionController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Editar Usuario</title>
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
                        <h1>Editar Programa Formacion</h1>
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
                        Error al crear el usuario: <?= ($_GET['mensaje']) ?? "" ?>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-university"></i>&nbsp; Información del Programa Formacion</h3>
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
                            <?php if (!empty($_GET["Id"]) && isset($_GET["Id"])) { ?>
                                <p>
                                <?php
                                $ProgramaFormacion = ProgramaFormacionController::searchForId($_GET["Id"]);
                                if (!empty($ProgramaFormacion)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" id="frmEditUsuario"
                                              name="frmEditUsuario"
                                              action="../../../App/Controllers/ProgramaFormacionController.php?action=edit">
                                            <input id="Id" name="Id" value="<?php echo $ProgramaFormacion->getId(); ?>" hidden
                                                   required="required" type="text">

                                            <div class="form-group row">
                                                <label for="FechaRegistro" class="col-sm-2 col-form-label">Fecha Registro</label>
                                                <div class="col-sm-10">
                                                    <input required type="Date" class="form-control" id="FechaRegistro"
                                                           name="FechaRegistro" value="<?= $ProgramaFormacion->getFechaRegistro(); ?>"
                                                           placeholder="Ingrese sus nombres">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="NumeroFicha" class="col-sm-2 col-form-label">Numero ficha</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="NumeroFicha"
                                                           name="NumeroFicha" value="<?= $ProgramaFormacion->getNumeroFicha(); ?>"
                                                           placeholder="Ingrese sus apellidos">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="FechaInicio" class="col-sm-2 col-form-label">Fecha Inicio</label>
                                                <div class="col-sm-10">
                                                    <input required type="Date" minlength="6" class="form-control"
                                                           id="FechaInicio" name="FechaInicio"
                                                           value="<?= $ProgramaFormacion->getFechaInicio(); ?>"
                                                           placeholder="Ingrese su documento">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="FechaFinalizacion" class="col-sm-2 col-form-label">Fecha Finalizacion</label>
                                                <div class="col-sm-10">
                                                    <input required type="Date" minlength="6" class="form-control"
                                                           id="FechaFinalizacion" name="FechaFinalizacion"
                                                           value="<?= $ProgramaFormacion->getFechaFinalizacion(); ?>"
                                                           placeholder="Ingrese su telefono">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="NombrePrograma" class="col-sm-2 col-form-label">Nombre Programa</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="NombrePrograma"
                                                           name="NombrePrograma" value="<?= $ProgramaFormacion->getNombrePrograma(); ?>"
                                                           placeholder="Ingrese su direccion">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="NivelPrograma" class="col-sm-2 col-form-label">Nivel Programa</label>
                                                <div class="col-sm-10">
                                                    <select id="NivelPrograma" name="NivelPrograma" class="custom-select">
                                                        <option <?= ($ProgramaFormacion->getNivelPrograma() == "Operario") ? "selected" : ""; ?>
                                                                value="Operario">Operario
                                                        </option>
                                                        <option <?= ($ProgramaFormacion->getNivelPrograma() == "Tecnico") ? "selected" : ""; ?>
                                                                value="Tecnico">Tecnico
                                                        </option>
                                                        <option <?= ($ProgramaFormacion->getNivelPrograma() == "Tecnologo") ? "selected" : ""; ?>
                                                                value="Tecnologo">Tecnologo
                                                        </option>
                                                        <option <?= ($ProgramaFormacion->getNivelPrograma() == "Especializacion tecnologica") ? "selected" : ""; ?>
                                                                value="Especializacion tecnologica">Especializacion tecnologica
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-warning">Enviar</button>
                                            <a href="show.php" role="button" class="btn btn-dark float-right">Cancelar</a>
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
