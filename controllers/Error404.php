<?php

namespace Controllers;
use MVC\Router;

class Error404
{
    public static function Error404(Router $router){
        $router->render('templates/404', [
        ]);
    }
}