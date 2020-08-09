<?php
require_once("../../partials/routes.php");
require_once("../../../App/Controllers/PersonaController.php");

use App\Controllers\PersonaController; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Datos de la Persona</title>
    <?php require_once("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require_once("../../partials/navbar_customization.php"); ?>

    <?php require_once("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Informacion de la Persona</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">ABC</a></li>
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
                            Error al consultar la Persona: <?= ($_GET['mensaje']) ?? "" ?>
                    </div>
                <?php } ?>
            <?php } else if (empty($_GET['Documento'])) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Faltan criterios de busqueda <?= ($_GET['mensaje']) ?? "" ?>
                </div>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <?php if(!empty($_GET["id"]) && isset($_GET["id"])){
                    $DataPersona = PersonaController::searchForID($_GET["id"]);
                    if(!empty($DataPersona)){
                ?>
                <div class="card-header">
                    <h3 class="card-title"><?= $DataPersona->getNombre()  ?></h3>
                </div>
                <div class="card-body">
                    <p>

                        <strong><i class="fas fa-book mr-1"></i> Nombres y Apellidos</strong>
                        <p class="text-muted">
                            <?= $DataPersona->getNombre()." ".$DataPersona->getApellido() ?>
                        </p>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Telefono</strong>
                        <p class="text-muted"><?= $DataPersona->getTelefono() ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Correo</strong>
                        <p class="text-muted"><?= $DataPersona->getCorreo() ?></p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Estado y Rol</strong>
                        <p class="text-muted"><?= $DataPersona->getEstado()." - ".$DataPersona->getRol() ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Contraseña</strong>
                        <p class="text-muted"><?= $DataPersona->getContraseña() ?></p>
                        <hr>
                    </p>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <a role="button" href="index.php" class="btn btn-success float-right" style="margin-right: 5px;">
                                <i class="fas fa-tasks"></i> Gestionar Persona
                            </a>
                        </div>
                        <div class="col-auto">
                            <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Persona
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

    <?php require_once ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require_once ('../../partials/scripts.php');?>
</body>
</html>