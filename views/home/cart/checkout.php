<?php
include_once __DIR__ . '../../../templates/header.php';
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2 style="color: #000000;">Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="/" style="color: #000000;">Inicio -</a>
                        <span style="color: #000000;">Carrito de compras</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Completa tus datos para
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Detalles de facturación</h4>
            <form method="POST" action="/crearVenta" id="crearVenta" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nombres<span>*</span></p>
                                    <input class="form-control" id="nombre" name="nombres" placeholder="Ingresa tus Nombres" type="text" required>
                                    <div class="valid-feedback">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                        Es necesario poner el Nombre completo
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Apellidos<span>*</span></p>
                                    <input type="text" id="apellido" name="apellidos" placeholder="Ingresa tus Apellidos" class="form-control" required>
                                    <div class="valid-feedback">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                        Es necesario poner el Apellido
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Número de DNI<span>*</span></p>
                                    <input type="number"  name="dni" placeholder="Ingrese su DNI" class="form-control" required maxlength="8">
                                    <div class="valid-feedback ">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                        Es necesario poner el DNI
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Celular<span>*</span></p>
                                    <input type="number" name="telefono" class="form-control" required>
                                    <div class="valid-feedback ">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingrese su celular
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email" class="form-control" required>
                                    <div class="valid-feedback ">
                                        Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                        Ingrese Email válido
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Ingrese su dirección<span></span></p>
                            <input type="text" class="form-control" placeholder="Ejemplo: Mz H Lote 10 Barrio 1 Sec 2 Urb ..." name="direccion" required>
                            <div class="valid-feedback ">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                Ingrese su dirección
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Ingrese referencias sobre la dirección<span></span></p>
                            <input type="text" class="form-control" placeholder="Referencias sobre su dirección, por ejemplo, calles, avenidas, tiendas, etc" name="referencias" required>
                            <div class="valid-feedback ">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                Ingrese una referencia
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Tu Orden</h4>
                            <div class="checkout__order__products">Productos <span>Total</span></div>
                            <ul>
                                <?php
                                $total = 0;
                                if (isset($_SESSION['carrito'])) {
                                    $arreglo = $_SESSION['carrito'];
                                    $granTotal = 0;
                                    for ($i = 0; $i < count($arreglo); $i++) {
                                        $total = 0;
                                        $total = $total + $arreglo[$i]['precio'] * $arreglo[$i]['cantidad'];
                                        $granTotal = $granTotal + $total;

                                ?>
                                        <li><?php echo $arreglo[$i]['nombre']; ?> <span>S/. <?php echo $total; ?></span></li>
                                        <input type="hidden" name="idProdcuto[]" value="<?php echo $arreglo[$i]['id']; ?>">
                                        <input type="hidden" name="idcategoria[]" value="<?php echo $arreglo[$i]['idcategoria']; ?>">
                                        <input type="hidden" name="totalProducto[]" value="<?php echo $total; ?>">
                                        <input type="hidden" name="cantidad[]" value="<?php echo $arreglo[$i]['cantidad']; ?>">
                                <?php }
                                } ?>


                            </ul>
                            <div class="checkout__order__subtotal">
                                Subtotal <span>S/. <?php echo $granTotal; ?> </span>
                            </div>
                            <div class="checkout__order__total">
                                Total <span>S/. <?php echo $granTotal; ?></span>
                                <input type="hidden" name="total" value="<?php echo $granTotal; ?>">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Desea pagar contraentrega?
                                    <input type="checkbox" id="acc-or" name="estado">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Desea delivery?
                                    <input type="checkbox" id="payment" name="delivery">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>El costo de la entrea por delivery varia deacuerdo al distrito.</p>
                            <p>Seleccione las opciones que desea</p>

                            <!--<input type="hidden" name="fecha" value="2022">-->
                            <button type="submit" class="site-btn">CONFIRMAR</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->



<?php
include_once __DIR__ . '../../../templates/footer.php';
?>

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

    <script src='build/js/app.js'></script>
    <script src='build/js/general.js'></script>
    ";
?>