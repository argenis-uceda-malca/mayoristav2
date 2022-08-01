<?php
include_once __DIR__ . '../../../templates/header.php';
?>

<script src='https://sdk.mercadopago.com/js/v2'></script>

<?php
$total = 0;
foreach ($ventas as $key => $venta) {
    $total = $total + $venta->total;
}
?>

<?php
// SDK de Mercado Pago
require __DIR__ .  '../../../../vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2658067067371995-091118-9a053d5a9a56767ce675849f6d870beb-194231546');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => "http://localhost:8080/pagoFin",
    "failure" => "http://localhost/",
    "pending" => "http://localhost/"
);

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = '0001';
$item->title = 'Mi producto';
$item->quantity = 1;
$item->currency_id = "PEN";
$item->unit_price = $total;
$preference->items = array($item);
$preference->save();
?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-0 "></div>
            <div class="col-lg-5 col-md-6 ">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Tus Datos</h4>
                        <div class="blog__sidebar__recent">
                            <?php
                            $total = 0;
                            foreach ($ventas as $key => $venta) {
                                $nombres = $venta->nombres;
                                $apellidos = $venta->apellidos;
                                $dni = $venta->dni;
                                $telefono = $venta->telefono;
                                $correo = $venta->email;
                            }
                            ?>
                            <div class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__text">
                                    <p><b>Nombre: </b><?php echo $nombres; ?> <?php echo $apellidos; ?><br /> </p>
                                    <p><b>N° DNI: </b><?php echo $dni; ?><br /> </p>
                                    <p><b>Telefono: </b><?php echo $telefono; ?><br /> </p>
                                    <p><b>Correo: </b><?php echo $correo; ?><br /> </p>
                                </div>
                            </div>
                            <?php  ?>
                        </div>
                        <h4>Tu pedido</h4>
                        <div class="blog__sidebar__recent">
                            <?php
                            $total = 0;
                            foreach ($ventas as $key => $venta) {
                                $nombre = $venta->nombres;
                                $apellidos = $venta->apellidos;
                                $total = $total + $venta->total
                            ?>
                                <div class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="build/img/blog/sidebar/sr-1.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <p style="margin:0"><b>Producto: </b><?php echo $venta->producto; ?> </p>
                                        <p style="margin:0"><b>Cantidad: </b><?php echo $venta->cantidad; ?> </p>
                                        <p style="margin:0"><b>SubTotal: </b>S/.<?php echo $venta->total; ?> </p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>Detalles de tu compra</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span></span>
                    </div>
                    <div class="product__details__price">S/. <?php echo $total; ?></div>
                    <p><?php echo $nombre; ?> <?php echo $apellidos; ?> estas a un paso de completar tu compra, verifica que los datos de tu compra sean
                        correctos </p>


                    <div class="row justify-content-start align-items-center"">
                        <div class=" col-4">
                        <img src="build/img/mercadopago.jpg">
                    </div>
                    <div class="cho-container" class="col-8 align-items-center"></div>

                </div>



                <ul>

                    <li><b>Ecuentranos en </b>
                        <div class="share">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    </div>
</section>

<?php
$script = "
	
    <script src='/build/js/jquery-3.3.1.min.js'></script>
    <script src='/build/js/bootstrap.min.js'></script>
    <script src='/build/js/jquery.nice-select.min.js'></script>
    <script src='/build/js/jquery-ui.min.js'></script>
    <script src='/build/js/jquery.slicknav.js'></script>
    <script src='/build/js/mixitup.min.js'></script>
    <script src='/build/js/owl.carousel.min.js'></script>
    <script src='/build/js/main.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    ";
?>


<script>
    // Agrega credenciales de SDK
    const mp = new MercadoPago("TEST-3be9317d-8097-4c25-a9fd-eb5e75a07155", {
        locale: "es-PE",
    });

    // Inicializa el checkout
    mp.checkout({
        preference: {
            id: "<?php echo $preference->id; ?>",
        },
        render: {
            container: ".cho-container", // Indica el nombre de la clase donde se mostrará el botón de pago
            label: "Pagar con Mercado Pago", // Cambia el texto del botón de pago (opcional)
        },
    });
</script>