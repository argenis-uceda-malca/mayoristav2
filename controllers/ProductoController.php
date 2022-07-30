<?php

namespace Controllers;

use Model\AdminPagos;
use Classes\Email;
use Model\Usuario;
use Model\DetalleVentaForId;
use Model\Producto;
use Model\Categorias;
use MVC\Router;

class ProductoController
{
    public static function viewProducto(Router $router)
    {
        session_start();
        isAuth();
        $arreglo = [];

        //$consulta = "SELECT p.id, p.nombre, p.precio, c.nombre as categoria ";
        $consulta = "SELECT p.id, p.nombre, p.precio, p.idcategoria, p.stock ";
        $consulta .= "FROM productos p ";
        $consulta .= "INNER JOIN categorias c ON c.id = p.idcategoria ";
        $consulta .= "ORDER BY p.id desc ";

        $arreglo = Producto::SQL($consulta);

        $categorias = Categorias::all();
        $router->renderAdmin('home/viewProducto', [
            'arreglo' => $arreglo,
            'categorias' => $categorias
        ]);
    }

    public static function editProducto(Router $router)
    {
        session_start();
        isAuth();


        $id = $_GET['id'];
        $producto = Producto::where('id', $id);
        $categoria = Categorias::where('id', $producto->idcategoria);
        $categorias = Categorias::all();
        //debuguear($categoria);

        $router->renderAdmin('home/editProducto', [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'categoria' => $categoria->nombre,
            'descripcion' => $categoria->descripcion,
            'categorias' => $categorias
        ]);
    }

    public static function addEditarProducto(Router $router)
    {
        session_start();
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto($_POST);
            $resultado = $producto->guardar();

            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                    'producto' => $producto,
                    'resultado2' => $resultado,
                    'post' => $_POST
                );
            } else {
                $respuesta = array(
                    'resultado' => 'error'
                );
            }
        }
        die(json_encode($respuesta));
    }

    public static function editarProducto()
    {
        session_start();
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
            $producto = new Producto($_POST);
            $resultado = $producto->guardar();

            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                );
            } else {
                $respuesta = array(
                    'resultado' => 'error'
                );
            }
        }
        die(json_encode($respuesta));
    }

    
}
