<?php require("../../partials/routes.php");
<<<<<<< HEAD:Views/modules/Prestamo/index.php
require("../../../app/Controllers/PrestamoController.php");

use App\Controllers\Controller; ?>
=======
require("../../../app/Controllers/UnidadesController.php");

use App\Controllers\UnidadesController; ?>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Layout</title>
    <?php require("../../partials/head_Imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
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
                        <h1> Prestamo </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/"> Proyecto-ABC </a></li>
                            <li class="breadcrumb-item active"> Inicio </li>
=======
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/Views/">Proyecto-ABC</a></li>
                            <li class="breadcrumb-item active">Inicio</li>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if(!empty($_GET['respuesta']) && !empty($_GET['action'])){ ?>
                <?php if ($_GET['respuesta'] == "Correcto"){ ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php if ($_GET['action'] == "create"){ ?>
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                            Se a reazilado exitosamente el prestamo!
                        <?php }else if($_GET['action'] == "update"){ ?>
                            Los datos del Prestamo han sido actualizados correctamente!
=======
                            Unidades ha sido creada con exito!
                        <?php }else if($_GET['action'] == "update"){ ?>
                            Los datos de unidades han sido actualizados correctamente!
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                    <h3 class="card-title">Gestionar Prestamo</h3>
=======
                    <h3><strong><i class="fas fa-eye"></i>Listar Unidades</h3></strong></h3>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                            <a role="button" href="create.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Prestamo
=======
                            <a role="button" href="create.php" class="btn btn-warning float-right" style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Unidades
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tbPrestamo" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                                    <th>Codigo</th>
                                    <th>Fecha Prestamo</th>
                                    <th>Fecha Entrega</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Persona</th>
=======
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                                $arrPrestamo = PrestamoController::getAll();
                                foreach ($arrPrestamo as $Prestamo){
                                    ?>
                                    <tr>
                                        <td><?php echo $Prestamo->getId(); ?></td>
                                        <td><?php echo $Prestamo->getFechaPrestamo(); ?></td>
                                        <td><?php echo $Prestamo->getFechaEntrega(); ?></td>
                                        <td><?php echo $Prestamo->getObservacion(); ?></td>
                                        <td><?php echo $Prestamo->getEstado(); ?></td>
                                        <td><?php echo $Prestamo->getPersona(); ?></td>
                                        <td>
                                            <a href="edit.php?Id=<?php echo $Prestamo->getId(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?Id=<?php echo $Prestamo->getId(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>

=======
                                $arrUnidades = UnidadesController::getAll();
                                foreach ($arrUnidades as $Unidades){
                                    ?>
                                    <tr>
                                        <td><?php echo $Unidades->getId(); ?></td>
                                        <td><?php echo $Unidades->getTipo(); ?></td>
                                        <td><?php echo $Unidades->getNombre(); ?></td>
                                        <td>
                                            <a href="edit.php?Id=<?php echo $Unidades->getId(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a href="show.php?Id=<?php echo $Unidades->getId(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
<<<<<<< HEAD:Views/modules/Prestamo/index.php
                                    <th>Codigo</th>
                                    <th>Fecha Prestamo</th>
                                    <th>Fecha Entrega</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Persona</th>
=======
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
>>>>>>> Yolixs:Views/modules/Unidades/index.php
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>



                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Pie de Página.
                </div>
                <!-- /.card-footer-->
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
<!-- DataTables -->
<script src="<?= $adminlteURL ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/jszip/jszip.js"></script>
<script src="<?= $adminlteURL ?>/plugins/pdfmake/pdfmake.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>

<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../components/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave" : true, //Guardar la configuracion del usuario
        });
    });
</script>

</body>
</html>
