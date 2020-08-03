<?php

require_once("../../../App/Controllers/MarcaController.php");

require_once("../../../App/Controllers/UnidadesController.php");
require_once("../../partials/routes.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title><?= getenv('TITLE_SITE') ?> | Crear Items</title>
    <?php require("../../partials/head_imports.php"); ?>
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

        <?php if (!empty($_GET['respuesta'])) { ?>
            <?php if ($_GET['respuesta'] != "correcto") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Error al crear Items: <?= $_GET['mensaje'] ?>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear un nuevo Items</h1>
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
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> &nbsp; Información de Items</h3>
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

                            <div class="card-body">
                                <form class="form-horizontal" method="post" id="frmCreateVenta" name="frmCreateVenta"
                                      action="../../../App/Controllers/ItemsController.php?action=create">

                                    <?php
                                    $dataitem = null;
                                    if (!empty($_GET['Id'])) {
                                        $dataitem = ItemsController::searchForID($_GET['Id']);
                                    }
                                    ?>


                                    </div>
                                    <div class="form-group row">
                                        <label for="Marca" class="col-sm-4 col-form-label">Marca</label>
                                        <div class="col-sm-8">
                                            <?= MarcaController::selectMarca(false,
                                                true,
                                                'Marca',
                                                'Marca',
                                                (!empty($dataitem)) ? $dataitem->getMarca()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "rol = 'Marca' and estado = 'Activo'")
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Unidades" class="col-sm-4 col-form-label">Unidades</label>
                                        <div class="col-sm-8">
                                            <?= UnidadesController::selectUnidades(false,
                                                true,
                                                'Unidades',
                                                'Unidades',
                                                (!empty($dataitem)) ? $dataitem->getUnidades()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "rol = 'Unidades' and estado = 'Activo'")
                                            ?>
                                        </div>
                                    </div>

                                    <hr>
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-parachute-box"></i>Detalle de prestamo</h3>
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

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <a role="button" href="#" data-toggle="modal" data-target="#modal-add-producto"
                                           class="btn btn-primary float-right"
                                           style="margin-right: 5px;">
                                            <i class="fas fa-plus"></i> Añadir Prestamo
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table id="tblDetalleProducto"
                                               class="datatable table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $arrDetallePrestamo = DetallePrestamo::getAll();
                                            foreach ($arrDetallePrestamo as $detallePrestamo) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $detallePrestamo->getId(); ?></td>
                                                    <td><?php echo $detallePrestamo->getPrestamo()->getNombre(); ?></td>
                                                    <td><?php echo $detallePrestamo->getCantidad(); ?></td>
                                                    <td><?php echo $detallePrestamo->getPrecio(); ?></td>
                                                    <td>
                                                        <a href="edit.php?id=<?php echo $detallePrestamo->getId(); ?>"
                                                           type="button" data-toggle="tooltip" title="Actualizar"
                                                           class="btn docs-tooltip btn-primary btn-xs"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="show.php?id=<?php echo $detallePrestamo->getId(); ?>"
                                                           type="button" data-toggle="tooltip" title="Ver"
                                                           class="btn docs-tooltip btn-warning btn-xs"><i
                                                                class="fa fa-eye"></i></a>
                                                        <?php if ($detallePrestamo->getEstado() != "Activo") { ?>
                                                            <a href="../../../app/Controllers/ProductosController.php?action=activate&Id=<?php echo $detalleVenta->getId(); ?>"
                                                               type="button" data-toggle="tooltip" title="Activar"
                                                               class="btn docs-tooltip btn-success btn-xs"><i
                                                                    class="fa fa-check-square"></i></a>
                                                        <?php } else { ?>
                                                            <a type="button"
                                                               href="../../../app/Controllers/ProductosController.php?action=inactivate&Id=<?php echo $detalleVenta->getId(); ?>"
                                                               data-toggle="tooltip" title="Inactivar"
                                                               class="btn docs-tooltip btn-danger btn-xs"><i
                                                                    class="fa fa-times-circle"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>FechaPrestamo</th>
                                                <th>FechaEntrega</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div id="modals">
        <div class="modal fade" id="modal-add-producto">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Prestamo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../../app/Controllers/VentasController.php?action=create" method="post">
                        <div class="modal-body">
                            <input id="venta_id" name="venta_id" value="<?= !empty($dataitem) ? $dataitem->getId() : ''; ?>" hidden
                                   required="required" type="text">
                            <div class="form-group row">
                                <label for="producto_id" class="col-sm-4 col-form-label">Prestamo</label>
                                <div class="col-sm-8">
                                    <?= PrestamoController::selectProducto(false,
                                        true,
                                        'producto_id',
                                        'producto_id',
                                        '',
                                        'form-control select2bs4 select2-info',
                                        "estado = 'Activo'")
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="producto_id" class="col-sm-4 col-form-label">Producto</label>
                                <div class="col-sm-8">
                                    <input required type="number" class="form-control" id="cantidad" name="cantidad"
                                           placeholder="Ingrese la cantidad">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
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
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>


</body>
</html>
