<?php require("../../partials/routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Sancion</title>
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
                        <h1>Crear Nueva Sancion</h1>
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
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            Error al crear la Sancion: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateSanciones" name="frmCreateSanciones" action="../../../App/Controllers/SancionesController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Tipo" class="col-sm-2 col-form-label">Tipo</label><!-- COMO HACER PARA QUE SEA ENUM-->
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Tipo" name="Tipo" placeholder="Ingrese su nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Ingrese la Descripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Prestamo" class="col-sm-2 col-form-label">Prestamo</label>
                            <div class="col-sm-10">
                                <?= PrestamoController::selectPrestamo(false,
                                    true,
                                    'Prestamo',
                                    'Prestamo',
                                    (!empty($dataSanciones)) ? $dataSanciones->getPrestamo()->getId() : '',
                                    'form-control select2bs4 select2-info',
                                    "")
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Persona" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                                <?= PersonaController::selectEstadoPersona(false,
                                    true,
                                    'Persona',
                                    'Persona',
                                    (!empty($dataSanciones)) ? $dataSanciones->getPersona()->getId() : '',
                                    'form-control select2bs4 select2-info',
                                    "")
                                ?>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Enviar</button>
                        <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
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
