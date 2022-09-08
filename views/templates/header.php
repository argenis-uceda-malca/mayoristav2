    <!-- Page Preloder -->
    <!--
    <div id="preloder">
        <div class="loader"></div>
    </div>
    -->

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/"><img src="/build/img/logoPrincipal-removebg-preview.png" style="width: 100px; height: 100px;" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span></span></a></li>
                <li><a href="/cart"><i class="fa fa-shopping-bag"></i> <span>
                            <?php
                            if (isset($_SESSION['carrito'])) {
                                echo count($_SESSION['carrito']);
                            } else {
                                echo 0;
                            }
                            ?>
                        </span></a></li>
            </ul>
            <div class="header__cart__price"><span>Carrito</span></div>
        </div>
        <div class="humberger__menu__widget">
            <!--<div class="header__top__right__language">
                <img src="/build/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>-->
            <div class="header__top__right__auth">
                <a href="/login"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/">Inicio</a></li>
                <!--<li><a href="./shop-grid.html">Tienda</a></li>
                <li><a href="#">Paginas</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>-->
                <li><a href="/nosotros">Nosotros</a></li>
                <li><a href="/contacto">Contacto</a></li>
                <li>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+51 991 702 781</h5>
                            <span>Atención 24/7 </span>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="https://www.facebook.com/HIN-Inversiones-106561198751645" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/hin_inversiones2022/" target="_blank"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> henrynycol2022@gmail.com</li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header" style="padding-bottom: 30px;">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> henrynycol2022@gmail.com</li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="/https://www.facebook.com/HIN-Inversiones-106561198751645" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/hin_inversiones2022/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                            <!--<div class="header__top__right__language">
                                <img src="/build/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>-->
                            <div class="header__top__right__auth">
                                <a href="/login"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hero__item set-bg" style=" height: 700px; align-content: flex-start" data-setbg="/build/img/hero/banner_productos.png">
            <div class="container" style="padding-bottom: 0; margin-bottom: 0; max-height: 200px; ">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="/"><img src="/build/img/logoPrincipal-removebg-preview.png" style="width: 100px; height: 100px;" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li class="active"><a href="/">Inicio</a></li>
                                <!--<li><a href="./shop-grid.html">Productos</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="header__menu__dropdown">
                                        <li><a href="./shop-details.html">Shop Details</a></li>
                                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                        <li><a href="./checkout.html">Check Out</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>-->
                                <li><a href="/nosotros">Nosotros</a></li>
                                <li><a href="/contacto">Contacto</a></li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i> <span></span></a></li>
                                <li style="background-color: #ffffff; padding: 2px; border-radius: 50%; padding-right: 5px; padding-left: 5px;"><a href="/cart"><i class="fa fa-shopping-bag"></i> <span>
                                            <?php
                                            if (isset($_SESSION['carrito'])) {
                                                echo count($_SESSION['carrito']);
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                        </span></a></li>
                            </ul>
                            <div class="header__cart__price"><span>Carrito</span></div>
                        </div>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>

            <!-- Header Section End -->