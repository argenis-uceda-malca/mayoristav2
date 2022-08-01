<?php

namespace Controllers;
use MVC\Router;

class PagoFinalizado
{
    public static function pagoFin(Router $router){
        session_start();
        $_SESSION = [];

        $router->render('home/cart/pagoFin', [
        ]);
    }
}