<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\TopProducs;
use Model\Categorias;

class PageController
{
    public static function inicio(Router $router)
    {
        session_start();

        /*$consulta= "SELECT * FROM  productos" ;
        $productos = Producto::SQL($consulta);*/
        $productos = Producto::all();
        $categorias = Categorias::all();

        $consulta = "SELECT distinct p.nombre , p.id , p.precio, p.imagen  FROM productos p ";
        $consulta .= "INNER JOIN carrito c ON p.id = c.id_producto ";
        $consulta .= "order by p.precio asc ";
        $consulta .= "limit 6 ";
        $productoMenos = Producto::SQL($consulta);

        $consulta2 = "SELECT distinct p.nombre , p.id , p.precio, p.imagen  FROM productos p ";
        $consulta2 .= "INNER JOIN carrito c ON p.id = c.id_producto ";
        $consulta2 .= "order by p.precio desc ";
        $consulta2 .= "limit 6 ";
        $productoMas = Producto::SQL($consulta2);

        $consulta3 = "SELECT p.nombre , sum(c.total) total, p.imagen, p.precio FROM carrito c ";
        $consulta3 .= "INNER JOIN productos p ON p.id = c.id_producto ";
        $consulta3 .= "group by id_producto limit 6 ";
        $topProdcut = TopProducs::SQL($consulta3);

        $router->render('home/index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'productoMenos' => $productoMenos,
            'productoMas' => $productoMas,
            'topProductos' => $topProdcut
        ]);
    }
}
