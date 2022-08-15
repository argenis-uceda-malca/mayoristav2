<?php
include_once __DIR__ . '/../templates/header.php';
?>

<!-- Hero Section Begin -->
<div class="container">
	<section class="hero">
		<div class="row ">
			<div class="col-lg-12">
				<div class="hero__search container">
					<div class="hero__search__form">
						<form action="#">
							<div class="hero__search__categories">
								Categorias
								<span class="arrow_carrot-down"></span>
							</div>
							<input type="text" placeholder="Qué necesitas?">
							<button type="submit" class="site-btn">BUSCAR</button>
						</form>
					</div>
					<div class="hero__search__phone">
						<div class="hero__search__phone__icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="hero__search__phone__text">
							<h5>+51 991 702 781</h5>
							<span>Atención 24/7 </span>
						</div>
					</div>
				</div>
				<div class="">
					<div class="hero__text">
						<span>FRUTA FRESCA</span>
						<h2>Vegetable <br />100% Orgánico</h2>
						<p>Free Pickup and Delivery Available</p>
						<a href="#" class="primary-btn">Compra ahora</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</div>
</header>

</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories" class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
	<div class="container">
		<div class="row">
			<div class="categories__slider owl-carousel">
				<div class="col-lg-3">
					<div class="categories__item set-bg" data-setbg="/build/img/categories/cat-1.jpg">
						<h5><a>Fresh Fruit</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg" data-setbg="/build/img/categories/cat-2.jpg">
						<h5><a>Dried Fruit</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg" data-setbg="/build/img/categories/cat-3.jpg">
						<h5><a>Vegetables</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg" data-setbg="/build/img/categories/cat-4.jpg">
						<h5><a>drink fruits</a></h5>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="categories__item set-bg" data-setbg="/build/img/categories/cat-5.jpg">
						<h5><a>drink fruits</a></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Nuestros Productos</h2>
				</div>
				<div class="featured__controls">
					<ul>
						<li class="active" data-filter="*">Todos </li>
						<?php foreach ($categorias as $key => $categoria) { ?>

							<li data-filter=".categoria<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></li>
						<?php } ?>
						<!--<li data-filter=".fresh-meat">Fresh Meat</li>
						<li data-filter=".vegetables">Vegetables</li>
						<li data-filter=".fastfood">Fastfood</li>-->
					</ul>
				</div>
			</div>
		</div>



		<div class="row featured__filter">
			<?php
			foreach ($productos as $key => $producto) {
				foreach ($categorias as $key => $categoria) {
					if ($producto->idcategoria == $categoria->id) {
			?>
						<div class="col-lg-3 col-md-4 col-sm-6 mix categoria<?php echo $categoria->id ?>">
							<div class="featured__item">
								<div class="featured__item__pic set-bg" data-setbg="/build/img/imgProducto/<?php echo $producto->imagen; ?>">
									<ul class="featured__item__pic__hover">
										<li>
											<a><i class="fa fa-heart"></i></a>
										</li>
										<li>
											<div class="boton-modal " data-target="<?php echo $producto->nombre; ?>" data-img="/build/img/imgProducto/<?php echo $producto->imagen; ?>" data-categoria="<?php echo $categoria->nombre ?>" data-precio="<?php echo $producto->precio; ?>">
												<label for="btn-modal">
													<a><i class="fa fa-retweet"></i></a>
												</label>
											</div>
										</li>
										<li>
											<a href="/cart?id=<?php echo $producto->id; ?>"><i class="fa fa-shopping-cart"></i></a>
										</li>
									</ul>
								</div>
								<div class="featured__item__text">
									<h6><a href="/cart?id=<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></a></h6>
									<h6 style="color: red;"><strike>S/ <?php echo $producto->precio + ($producto->precio) * 0.10; ?></strike></h6>
									<h5>S/ <?php echo $producto->precio; ?></h5>
								</div>
							</div>
						</div>
			<?php }
				}
			} ?>
		</div>
	</div>
</section>
<!-- Featured Section End -->




<!--Ventana Modal-->
<input type="checkbox" id="btn-modal">
<div class="container-modal">
	<div class="content-modal">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="product__details__pic">
					<div class="product__details__pic__item">
						<img class="product__details__pic__item--large" id="modal_img_producto" src="" alt="" style="max-width: 270px; max-height: 270px;">
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="product__details__text">
					<h3 id="modal_nombre_producto">Nombre Producto</h3>
					<h6 id="modal_categoria_producto" style="padding-bottom: 8px;"> </h6>
					<div class="product__details__rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-half-o"></i>
					</div>
					<div class="product__details__price" id="modal_precio_producto_antes" style="color: #ac9393; font-size: 17px; text-decoration: line-through;"></div>
					<div class="product__details__price" id="modal_precio_producto"><?php echo $producto->precio; ?></div>
					
				</div>
			</div>

		</div>
	</div>
	<label for="btn-modal" class="cerrar-modal"></label>
</div>
<!--Fin de Ventana Modal-->




<!-- Banner Begin -->
<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="/build/img/banner/banner-1.jpg" alt="">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="/build/img/banner/banner-2.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="latest-product__text">
					<h4>Más Vendidos</h4>
					<div class="latest-product__slider owl-carousel">
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (($topProductos) as $topProducto) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $topProducto->imagen; ?>" alt="producto">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $topProducto->nombre ?></h6>
											<span>S/ <?php echo $topProducto->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (array_reverse($topProductos) as $topProducto) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $topProducto->imagen; ?>" alt="producto">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $topProducto->nombre ?></h6>
											<span>S/ <?php echo $topProducto->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="latest-product__text">
					<h4>Menores Precios</h4>
					<div class="latest-product__slider owl-carousel">
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (($productoMenos) as $proMenos) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $proMenos->imagen; ?>" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $proMenos->nombre ?></h6>
											<span>S/ <?php echo $proMenos->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (array_reverse($productoMenos) as $proMenos) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $proMenos->imagen; ?>" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $proMenos->nombre ?></h6>
											<span>S/ <?php echo $proMenos->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="latest-product__text">
					<h4>Mayores Precios</h4>
					<div class="latest-product__slider owl-carousel">
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (($productoMas) as $proMas) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $proMas->imagen; ?>" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $proMas->nombre ?></h6>
											<span>S/ <?php echo $proMas->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
						<div class="latest-prdouct__slider__item">
							<?php
							$i = 0;
							foreach (array_reverse($productoMas) as $proMas) {
								if ($i < 3) {
							?>
									<a href="#" class="latest-product__item">
										<div class="latest-product__item__pic">
											<img src="/build/img/imgProducto/<?php echo $proMas->imagen; ?>" alt="">
										</div>
										<div class="latest-product__item__text">
											<h6><?php echo $proMas->nombre ?></h6>
											<span>S/ <?php echo $proMas->precio ?></span>
										</div>
									</a>
							<?php
									$i = $i + 1;
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Latest Product Section End -->

<br><br><br>
<div class="section-title">
	<h2>Encuentranos aquí</h2>
</div>
<br><br><br>

<!-- Map Begin -->
<div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d975.4042684811426!2d-76.99822167081355!3d-12.069846799465754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c63b20e861b7%3A0x6d566c1933d6e617!2sAugusto%20Durand%202485%2C%20San%20Luis%2015021!5e0!3m2!1ses-419!2spe!4v1657497835662!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	<div class="map-inside">
		<i class="icon_pin"></i>
		<div class="inside-widget">
			<h4>HIN inversiones</h4>
			<ul>
				<li>Telefono: +51 991 702 781</li>
				<li>Augusto Durand 2485, San Luis 15021</li>
			</ul>
		</div>
	</div>
</div>
<!-- Map End -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<?php
include_once __DIR__ . '/../templates/footer.php';
?>

<?php
$script = "
	<!-- Js Plugins -->
    <script src='/build/js/jquery-3.3.1.min.js'></script>
    <script src='/build/js/bootstrap.min.js'></script>
    <script src='/build/js/jquery.nice-select.min.js'></script>
    <script src='/build/js/jquery-ui.min.js'></script>
    <script src='/build/js/jquery.slicknav.js'></script>
    <script src='/build/js/mixitup.min.js'></script>
    <script src='/build/js/owl.carousel.min.js'></script>
    <script src='/build/js/main.js'></script>
	
    ";
?>