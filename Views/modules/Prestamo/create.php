<?php require("../../partials/routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Agregar Prestamo</title>
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
                        <h1>Crear nuevo Prestamo
                                                                                                                         </h1>
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
                <?php if ($_GET['respuesta'] != "correcto"){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            Error al crear el Prestamo: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Prestamo</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="Modificar Prestamo" method="post" id="frmCreateKit" name="frmCreateKit" action="../../../app/Controllers/PrestamoController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Fecha Prestamo" class="col-sm-2 col-form-label">Fecha Prestamo</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="Fecha Prestamo" name="Fecha Prestamo" placeholder="Ingrese la fecha del prestamo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Fecha Entrega" class="col-sm-2 col-form-label">Fecha Entrega</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="Fecha Entrega" name="Fecha Entrega" placeholder="Ingrese la fecha del devolución del prestamo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Observaciones" class="col-sm-2 col-form-label">Observaciones</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Observaciones" name="Observaciones" placeholder="Ingrese una breve descripcion del prestamo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Estado" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                                <select id="Estado" name="Estado" class="custom-select">
                                    <option value="Activo">Activo </option>
                                    <option value="Inactivo">Inactivo </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Persona" class="col-sm-2 col-form-label">Responsable</label>
                            <div class="col-sm-10">
                                <input required type="number" minlength="6" class="form-control" id="Persona" name="Persona" placeholder="Ingrese la placa del Kit">
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
<?php require ('../../partials/scripts.php');?>
</body>
</html>
