<?php require_once("../../partials/routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Persona</title>
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
                        <h1>Crear un Nueva Persona</h1>
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
                            Error al crear persona: <?= $_GET['mensaje'] ?>
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
                <form class="form-horizontal" method="post" id="frmCreateUsuario" name="frmCreateUsuario" action="../../../App/Controller/PersonaController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Documento" class="col-sm-2 col-form-label">Documento</label>
                            <div class="col-sm-10">
                                <input required type="number" minlength="6" class="form-control" id="Documento" name="Documento" placeholder="Ingrese su documento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Ingrese su nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Apellido" class="col-sm-2 col-form-label">Apellido</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Ingrese sus apellidos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Telefono" class="col-sm-2 col-form-label">Telefono</label>
                            <div class="col-sm-10">
                                <input required type="number" minlength="6" class="form-control" id="Telefono" name="Telefono" placeholder="Ingrese su Telefono">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Correo" class="col-sm-2 col-form-label">Correo</label>
                            <div class="col-sm-10">
                                <input required type="text" minlength="6" class="form-control" id="Correo" name="Correo" placeholder="Ingrese su Correo">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Contraseña" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input required type="text" minlength="6" class="form-control" id="Contraseña" name="Contraseña" placeholder="Ingrese su Contraseña">
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

    <?php require_once ('../../partials/footer.php');?>
</div>
<!-- ./wrapper -->
<?php require_once ('../../partials/scripts.php');?>
</body>
</html>
