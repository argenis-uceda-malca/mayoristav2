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
                            <h4 class="card-title">Lista de Productos</h4>


                            <div class="ml-auto">
                                <div class="dropdown sub-dropdown">
                                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#myModalNuevoProducto"><i class="fas fa-plus"></i> Agregar Nuevo</button>
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a class="dropdown-item" href="#">Insert</a>
                                        <a class="dropdown-item" href="#">Update</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0 AllDataTables" id="registro">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">ID</h5>
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Producto</h5>
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">S/. Precio</h5>
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Categoria</h5>
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Marca</h5>
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Stock</h5>
                                        </th>

                                        <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                        <th class="border-0 font-14 font-weight-medium text-muted"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arreglo as $key => $producto) { ?>
                                        <tr>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $producto->id; ?>
                                            </td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $producto->nombre; ?></td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $producto->precio; ?></td>
                                            <?php
                                            foreach ($categorias as $categoria) {
                                                if ($producto->idcategoria == $categoria->id) {
                                                    $nombreCategoria = $categoria->nombre;
                                                }
                                            }
                                            foreach ($marcas as $marca) {
                                                if ($producto->idmarca == $marca->id) {
                                                    $nombreMarca = $marca->nombre;
                                                }
                                            }
                                            ?>

                                            <?php  ?>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $nombreCategoria; ?></td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $nombreMarca; ?></td>
                                            <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4"><?php echo $producto->stock; ?></td>

                                            <td class="border-top-0 text-center px-2 py-4">
                                                <!--<a class="btn waves-effect waves-light btn-rounded btn-outline-secondary " href="/editProducto?id=<?php echo $producto->id; ?>" title="Editar">Editar</a>-->
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-secondary editbtn" data-toggle="modal" data-target="#myModalProducto" data-idcategoria="<?php echo $producto->idcategoria; ?>" id=""><i class="fa fa-edit" aria-hidden="true"></i></button>
                                            </td>
                                            <td class="border-top-0 text-center px-2 py-4">
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

        <!-- Edit modal content -->
        <div id="myModalProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualice el producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form action="POST" id="editarProducto" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>S/. Precio </label>
                                            <input type="number" class="form-control" placeholder="S/." name="precio" id="precio" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select" id="inputGroupSelect02" name="idcategoria" required>
                                                    <?php foreach ($categorias as $categoria) { ?>
                                                        <option id="idcategoria" value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select" id="inputGroupSelect01" name="idmarca" required>
                                                    <?php foreach ($marcas as $marca) { ?>
                                                        <option value="<?php echo $marca->id; ?>" id="marca"><?php echo $marca->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Stock </label>
                                            <input type="number" class="form-control" placeholder="Stock" name="stock" id="stock" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Cargar de Imagen</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="archivo_imagen" required>
                                                    <label class="custom-file-label" for="inputGroupFile01">Buscar Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <input type="hidden" name="id" id="id">
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                    <!--<button type="reset" class="btn btn-dark">Cancelar</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Add modal content -->
        <div id="myModalNuevoProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Registre un producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="addProducto" class="needs-validation" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control " name="nombre" id="nombre" placeholder="Ingrese Nombre del Producto" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="number" class="form-control" placeholder="S/." name="precio" id="precio" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select" id="inputGroupSelect01" name="idcategoria" required>
                                                    <?php foreach ($categorias as $categoria) { ?>
                                                        <option value="<?php echo $categoria->id; ?>" id="categoria"><?php echo $categoria->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marcas</label>
                                            <div class="input-group mb-3">
                                                <select class="custom-select" id="inputGroupSelect01" name="idmarca" required>
                                                    <?php foreach ($marcas as $marca) { ?>
                                                        <option value="<?php echo $marca->id; ?>" id="marca"><?php echo $marca->nombre; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Stock </label>
                                            <input type="number" class="form-control" placeholder="Stock" name="stock" id="stock" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Cargar de Imagen</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="archivo_imagen" required>
                                                    <label class="custom-file-label" for="inputGroupFile01">Buscar Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                    <!--<button type="reset" class="btn btn-dark">Cancelar</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
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

    <script src='https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js'></script>
    
        <script src='https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js'></script>
    

    
    <script src='/build/js/admin.js'></script>
    ";
?>