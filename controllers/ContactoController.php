<?php

namespace Controllers;
use MVC\Router;

class ContactoController
{
    public static function contacto(Router $router){
        $router->render('home/cart/contacto', [
        ]);
    }
}