<?php

namespace Controllers;
use MVC\Router;

class NosotrosController
{
    public static function nosotros(Router $router){
        session_start();
        
        $router->render('home/cart/nosotros', [
        ]);
    }
}