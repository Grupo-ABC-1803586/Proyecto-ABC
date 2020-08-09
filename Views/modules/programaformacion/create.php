<?php require("../../partials/routes.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Usuarixo</title>
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
                        <h1>Crear un Nuevo Programa Formacion</h1>
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
                            Error al crear el usuario: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Horizontal Form -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-university"></i>&nbsp;&nbsp;<strong>Programa Formacion</strong></h3>
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
                <!-- form start -->
                <form class="form-horizontal" method="post" id="frmCreateUsuario" name="frmCreateUsuario" action="../../../App/Controllers/ProgramaFormacionController.php?action=create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="FechaRegistro" class="col-sm-2 col-form-label">FECHA REGISTRO</label>
                            <div class="col-sm-10">
                                <input required type="date" class="form-control" id="FechaRegistro" name="FechaRegistro" placeholder="Ingrese la  fecha registro">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NumeroFicha" class="col-sm-2 col-form-label">NUMERO FICHA</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="NumeroFicha" name="NumeroFicha" placeholder="Ingrese el numero ficha">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="FechaInicio" class="col-sm-2 col-form-label">FECHA INICIO</label>
                            <div class="col-sm-10">
                                <input required type="date" minlength="6" class="form-control" id="FechaInicio" name="FechaInicio" placeholder="Ingrese su documento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="FechaFinalizacion" class="col-sm-2 col-form-label">FECHA FINALIZACION</label>
                            <div class="col-sm-10">
                                <input required type="date" minlength="6" class="form-control" id="FechaFinalizacion" name="FechaFinalizacion" placeholder="Ingrese su telefono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NombrePrograma" class="col-sm-2 col-form-label">NOMBRE PROGRAMA</label>
                            <div class="col-sm-10">
                                <input required type="text" class="form-control" id="NombrePrograma" name="NombrePrograma" placeholder="Ingrese el  Nombre Programa">
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="NivelPrograma" class="col-sm-2 col-form-label">Nivel Programa</label>
                                <div class="col-sm-10">
                                    <select id="NivelPrograma" name="NivelPrograma" class="custom-select">
                                        <option value="TECNICO">Tecnico</option>
                                        <option value="TECNOLOGO"> Tecnologo </option>

                                    </select>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Enviar</button>
                        <a href="index.php" role="button" class="btn btn-dark float-right">Cancelar</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
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
