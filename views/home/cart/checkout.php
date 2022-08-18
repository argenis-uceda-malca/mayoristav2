<?php
include_once __DIR__ . '../../../templates/header_secod.php';
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
                                    <input type="number" name="dni" placeholder="Ingrese su DNI" class="form-control" required maxlength="8">
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

                        <div class="row">
                            <div class="col-lg-9">
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
                            </div>
                            <div class="col-lg-3">
                                <div class="row checkout__input">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p>Distrito</p>
                                            <div class="input-group mb-3">
                                                <select class="" name="distrito" required>
                                                    <option value="0">San Luis</option>
                                                    <option value="1">Otro</option>
                                                    <!--<option value="2">Barranco</option>
                                                    <option value="3">Breña</option>
                                                    <option value="4">Carabayllo</option>
                                                    <option value="5">Cercado de lima</option>
                                                    <option value="6">Chaclacayo</option>
                                                    <option value="7">Chorrillos</option>
                                                    <option value="8">Cieneguilla</option>
                                                    <option value="9">Comas</option>
                                                    <option value="10">El agustino</option>
                                                    <option value="11">Independencia</option>
                                                    <option value="12">Jesús maría</option>
                                                    <option value="13">La molina</option>
                                                    <option value="14">La victoria</option>
                                                    <option value="15">Lince</option>
                                                    <option value="16">Los olivos</option>
                                                    <option value="17">Lurigancho</option>
                                                    <option value="18">Lurín</option>
                                                    <option value="19">Magdalena del mar</option>
                                                    <option value="20">Miraflores</option>
                                                    <option value="20">Pueblo libre</option>
                                                    <option value="20">Puente piedra</option>
                                                    <option value="20">Rímac</option>
                                                    <option value="20">San borja</option>
                                                    <option value="20">San isidro</option>
                                                    <option value="20">San Juan de Lurigancho</option>
                                                    <option value="20">San Juan de Miraflores</option>
                                                    <option value="20">San Luis</option>
                                                    <option value="20">San Martin de Porres</option>
                                                    <option value="20">San Miguel</option>
                                                    <option value="20">Santa Anita</option>
                                                    <option value="20">Santa María del Mar</option>
                                                    <option value="20">Santiago de Surco</option>
                                                    <option value="20">Surquillo</option>
                                                    <option value="20">Villa el Salvador</option>
                                                    <option value="20">Villa Maria del Triunfo</option>-->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <li><?php echo $arreglo[$i]['nombre']; ?> <span>S/ <?php echo $total; ?></span></li>
                                            <input type="hidden" name="idProdcuto[]" value="<?php echo $arreglo[$i]['id']; ?>">
                                            <input type="hidden" name="idcategoria[]" value="<?php echo $arreglo[$i]['idcategoria']; ?>">
                                            <input type="hidden" name="totalProducto[]" value="<?php echo $total; ?>">
                                            <input type="hidden" name="cantidad[]" value="<?php echo $arreglo[$i]['cantidad']; ?>">
                                    <?php }
                                    } ?>


                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal <span>S/ <?php echo $granTotal; ?> </span>
                                </div>
                                <div class="checkout__order__total">
                                    Total <span>S/ <?php echo $granTotal; ?></span>
                                    <input type="hidden" name="total" id="granTotal" value="<?php echo $granTotal; ?>">
                                </div>
                                <!--<div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Desea pagar contraentrega?
                                    <input type="checkbox" id="acc-or" name="estado">
                                    <span class="checkmark"></span>
                                </label>
                            </div>-->
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Desea delivery?
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                        <input type="checkbox" id="payment" name="delivery" value="0">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>El costo del delivery para San Luis es "GRATIS", para otro distrito el costos es de es S/ 8 soles </p>
                                <p>Delivery solo para compras mayores a S/60. </p>

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