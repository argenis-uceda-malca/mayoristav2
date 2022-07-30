<?php 

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\Categorias;

class PageController{
    public static function inicio(Router $router) {
        session_start();
        
        /*$consulta= "SELECT * FROM  productos" ;
        $productos = Producto::SQL($consulta);*/
        $productos = Producto::all();
        $categorias = Categorias::all();

        $router->render('home/index', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

}
