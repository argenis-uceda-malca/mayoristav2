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