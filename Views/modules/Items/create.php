<?php

require_once("../../../App/Controllers/MarcaController.php");
require_once("../../../App/Controllers/ItemsController.php");
require_once("../../../App/Controllers/UnidadesController.php");
require_once("../../../App/Controllers/ElementoController.php");
require_once("../../../App/Controllers/KitController.php");

require_once("../../partials/routes.php");

use App\Controllers\MarcaController;
use App\Controllers\UnidadesController;
use App\Controllers\ItemsController;
use App\Controllers\ElementoController;
use App\Controllers\KitController;

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
                    <div class="col-md-8">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-archive"></i> &nbsp; Información de Items</h3>
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
                                      action="../../../App/Controllers/ItemsController.php?action=create" enctype="multipart/form-data">

                                    <?php
                                    $dataitem = null;
                                    if (!empty($_GET['Id'])) {
                                        $dataitem = ItemsController::searchForID($_GET['Id']);
                                    }
                                    ?>

                                    <div class="form-group row">
                                        <label for="Placa" class="col-sm-2 col-form-label">Placa</label>
                                        <div class="col-sm-10">
                                            <input required type="text" class="form-control" id="Placa" name="Placa" placeholder="Ingrese placa">
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label for="Descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Ingrese descripcion">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Costo" class="col-sm-2 col-form-label">Costo</label>
                                            <div class="col-sm-10">
                                                <input required type="float" class="form-control" id="Costo" name="Costo" placeholder="Ingrese costo">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" Id="Ubicacion" name="Ubicacion" placeholder="Ingrese ubicacion">
                                            </div>
                                        </div>
                                    <div class="form-group row" >
                                            <label for="Imagen" class="col-sm-2 col-form-label">Imagen</label>
                                            <div class="col-sm-20">
                                                <input required type="file" size="32" class="" Id="Imagen" name="Imagen" placeholder="Imagen">
                                            </div>
                                        <div class="d-flex justify-content-center" >
                                            <img Id="output" />
                                        </div>
                                        </div>
                                    <div class="form-group row">
                                        <label for="Elemento" class="col-sm-2 col-form-label">Elemento</label>
                                        <div class="col-sm-10">
                                            <?= ElementoController::selectElemento(false,
                                                true,
                                                'Elemento',
                                                'Elemento',
                                                (!empty($dataitem)) ? $dataitem->getElemento()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "")

                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Unidades" class="col-sm-2 col-form-label">Unidades</label>
                                        <div class="col-sm-10">
                                            <?= UnidadesController::selectUnidades(false,
                                                true,
                                                'Unidades',
                                                'Unidades',
                                                (!empty($dataitem)) ? $dataitem->getUnidades()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "")

                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Marca" class="col-sm-2 col-form-label">Marca</label>
                                        <div class="col-sm-10">
                                            <?= MarcaController::selectMarca(false,
                                                true,
                                                'Marca',
                                                'Marca',
                                                (!empty($dataitem)) ? $dataitem->getMarca()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "")
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Kit" class="col-sm-2 col-form-label">Kit</label>
                                        <div class="col-sm-10">
                                            <?= KitController::selectKit(false,
                                                true,
                                                'Kit',
                                                'Kit',
                                                (!empty($dataitem)) ? $dataitem->getKit()->getId() : '',
                                                'form-control select2bs4 select2-info',
                                                "")

                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                        <div class="col-sm-10">
                                            <select id="rol" name="Estado" class="custom-select">
                                                <option value="Activo">Activo</option>
                                                <option value="Inactivo">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">Enviar</button>
                                        <a href="index.php" role="button" class="btn btn-dark float-right">Cancelar</a>
                                    </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
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
    function removeAtributes(){
        $("#Imagen").removeAttr("required");
    }

    function addAtributes(){
        $("Imagen").prop("required","required");
    }

    $( "#Imagen" ).change(function() {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
            output.width = 160;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>


</body>
</html>
