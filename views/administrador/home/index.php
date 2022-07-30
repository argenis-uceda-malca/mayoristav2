<?php
include_once __DIR__ . '/../../templates/administrador/header.php';
?>

<?php
include_once __DIR__ . '/../../templates/administrador/sidebar.php';
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- *************************************************************** -->
        <!-- Start Top Leader Table -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Registro de Pagos</h4>
                            <div class="ml-auto">
                                <div class="dropdown sub-dropdown">
                                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-dark" data-toggle="modal" data-target="#reportModal"> Generar Reporte</button>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0" id="registro" >
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-muted">Datos del comprador
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">Telefono</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">Cantidad</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Monto
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Fecha
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Estado
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                        <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ventas as $key => $venta) { ?>
                                        <tr>
                                            <td class="border-top-0 px-2 py-4">
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="">
                                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                            <?php echo $venta->nombres; ?> <?php echo $venta->apellidos; ?>
                                                        </h5>
                                                        <span class="text-muted font-14"><?php echo $venta->email; ?></span><br>
                                                        <span class="text-muted font-14">DNI: <?php echo $venta->dni; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                <?php echo $venta->telefono; ?>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                <?php echo $venta->cantidad; ?>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                S/. <?php echo $venta->total; ?>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                <?php echo $venta->fecha; ?>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-light btnModalEstado" data-toggle="modal" data-target="#myModalEstado" data-id="<?php echo $venta->ventaId; ?>" id="<?php echo $venta->ventaId; ?>"><i class="fa fa-circle text-<?php echo $venta->estado?> font-12" data-toggle="tooltip" data-placement="top" title="Estado"></i></button>
                                            </td>
                                            <td class="border-top-0 text-center px-2 py-4">
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-secondary btnModal" data-toggle="modal" data-target="#myModal" data-id="<?php echo $venta->ventaId; ?>" id="<?php echo $venta->ventaId; ?>"><i class="fas fa-eye"></i> Ver </button>
                                            </td>
                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4">
                                                <a href="#" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End Top Leader Table -->
        <!-- *************************************************************** -->


        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detalle de la venta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div id="MyModaltable_header">
                            <table class="table table_header no-wrap v-middle mb-0" id="registro">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-center">Nombre</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Apellido</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Teléfono</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo">
                                </tbody>
                            </table>
                        </div>
                        <div id="MyModaltable">
                            <table class="table no-wrap v-middle mb-0" id="registro">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-center">Productos</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Categoria</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Cantidad</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Precio</th>
                                        <th class="border-0 font-14 font-weight-medium text-center">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Report modal content -->
        <div id="reportModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Genere su reportorte</h4>
                                <code>Seleccione el intevalo de fecha</code>
                                <form class="mt-4" id="report" method="POST" action="/report">
                                    <h6 class="card-subtitle">Fecha de inicio </h6>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fechaInicio" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    <h6 class="card-subtitle">Fecha de fin </h6>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fechafin" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success" name="excel"><i class="far fa-file-excel"></i> Excel</button>
                                            <button type="submit" class="btn btn-outline-danger" name="pdf"><i class="far fa-file-pdf"></i> PDF</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Estado modal content -->
        <div id="myModalEstado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cambiar Estado</h4>
                                <code>Estados: 'Atendido' 'En proceso' 'Cancelado'</code>
                                <form class="mt-4" id="updateEstado" action="/updateEstado" method="POST">
                                    <h6 class="card-subtitle">Estado del Pedido</h6>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <select class="custom-select" id="inputGroupSelect02" name="estado">
                                                <option value="success">Atendido</option>
                                                <option value="primary">Cancelado</option>
                                                <option value="danger">En Proceso</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="text-center">
                                            <input type="hidden" name="id" id="id">
                                            <button type="submit" class="btn btn-outline-primary">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->

<?php
include_once __DIR__ . '/../../templates/administrador/footer.php';
?>


<?php
$script = "
    <script src='/build/admin/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js'></script>
    <script src='/build/admin/dist/js/pages/datatable/datatable-basic.init.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='/build/js/admin.js'></script>
    
    ";
?>