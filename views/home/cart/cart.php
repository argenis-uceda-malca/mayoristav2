<body>

  <?php
  include_once __DIR__ . '../../../templates/header.php';
  ?>
  <!-- Hero Section Begin -->
  <section class="hero hero-normal">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="hero__search">
            <div class="hero__search__form">
              <form action="#">
                <div class="hero__search__categories">
                  All Categories
                  <span class="arrow_carrot-down"></span>
                </div>
                <input type="text" placeholder="What do yo u need?">
                <button type="submit" class="site-btn">SEARCH</button>
              </form>
            </div>
            <div class="hero__search__phone">
              <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="hero__search__phone__text">
                <h5>+65 11.188.888</h5>
                <span>support 24/7 time</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2 style="color: #000000;">Carrito de Compras</h2>
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

  <!-- Shoping Cart Section Begin -->
  <section class="shoping-cart spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__table">
            <table>
              <thead>
                <tr>
                  <th class="shoping__product">Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th></th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="ejemplo">
                <?php
                $total = 0;
                if (isset($_SESSION['carrito'])) {
                  $arregloCarrito = $_SESSION['carrito'];
                  for ($i = 0; $i < count($arregloCarrito); $i++) {
                    $total = $total + ($arregloCarrito[$i]['precio'] * $arregloCarrito[$i]['cantidad']);
                ?>
                    <tr>
                      <td class="shoping__cart__item">
                        <img src="/build/img/cart/cart-1.jpg" alt="">
                        
                        <h5><?php echo $arregloCarrito[$i]['nombre']; ?></h5>
                      </td>
                      <td class="shoping__cart__price">
                        S/. <?php echo $arregloCarrito[$i]['precio']; ?>
                      </td>
                      <td class="shoping__cart__quantity">

                        <div class="quantity">
                          <div class="pro-qty">
                            <span class="dec qtybtn" id="dec<?php echo $arregloCarrito[$i]['id']; ?>" data-id="<?php echo $arregloCarrito[$i]['id']; ?>">&minus;</span>
                            <input class="txtCantidad" data-precio="<?php echo $arregloCarrito[$i]['precio']; ?>" data-id="<?php echo $arregloCarrito[$i]['id']; ?>" data-cantidad="<?php echo $arregloCarrito[$i]['cantidad']; ?>" type="text" value="<?php echo $arregloCarrito[$i]['cantidad']; ?>">
                            <span class="inc qtybtn">&plus;</span>
                          </div>
                        </div>

                      </td>
                      <td class="shoping__cart__total">
                        <span>S/.</span>
                      </td>
                      <td class="shoping__cart__total cant<?php echo $arregloCarrito[$i]['id']; ?>">
                        <!--<span>S/. </span>-->
                        <?php echo $arregloCarrito[$i]['precio'] * $arregloCarrito[$i]['cantidad']; ?>
                      </td>
                      <td class="shoping__cart__item__close">
                        <span class="icon_close btnEliminar" id="btnEliminar<?php echo $arregloCarrito[$i]['id'] ?>" data-id="<?php echo $arregloCarrito[$i]['id'] ?>" data-precio="<?php echo $arregloCarrito[$i]['precio']; ?>" data-cantidad="<?php echo $arregloCarrito[$i]['cantidad']; ?>"></span>
                      </td>
                    </tr>
                <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="shoping__cart__btns">
            <a href="/" class="primary-btn cart-btn">CONTINUAL COMPRANDO</a>
            <a href="/cart" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
              Actualizar Carrito</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="shoping__continue">
            <div class="shoping__discount">
              <h5>Codigo de Descuento</h5>
              <form action="#">
                <input type="text" placeholder="Ingresa tu código de cupon" disabled>
                <button type="submit" class="site-btn" disabled>APLICAR CUPÓN</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="shoping__checkout">
            <h5>Total del carrito</h5>
            <ul>
              <li>Subtotal <span class="totalCarrito"><?php echo $total ?></span><span>S/. </span></li>
              <li>Total <span id="totalCarrito" data-total="<?php echo $total ?>"><?php echo $total ?></span><span>S/. </span></li>
            </ul>
            <a href="/checkout" class="primary-btn">CONTINUAR CON EL PAGO</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Shoping Cart Section End -->

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
    ";
  ?>