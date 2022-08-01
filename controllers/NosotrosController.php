<?php

namespace Controllers;
use MVC\Router;

class NosotrosController
{
    public static function nosotros(Router $router){
        $router->render('home/cart/nosotros', [
        ]);
    }
}