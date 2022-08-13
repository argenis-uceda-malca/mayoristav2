<?php

namespace Controllers;

use Model\AdminPagos;
use Classes\Email;
use Model\Usuario;
use Model\DetalleVentaForId;
use Model\Producto;
use Model\Categorias;
use MVC\Router;

class CategoriaController
{
    public static function viewCategoria(Router $router)
    {
        session_start();
        isAuth();

        $categorias = Categorias::all();
        //debuguear($categorias);
        $router->renderAdmin('home/viewCategorias', [
            'categorias' => $categorias
        ]);
    }

    public static function addEditarCategoria(Router $router)
    {
        session_start();
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorias = new Categorias($_POST);
            $resultado = $categorias->guardar();

            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                    'categorias' => $categorias,
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

    public static function eliminarCategoria(){
        session_start();
        isAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $producto = Categorias::find($id);
            $producto->eliminar();
            $respuesta = array(
                'resultado' => 'exito',
                'id_eliminado' => $id,
                'id' => $id
            );

        }
        die(json_encode($respuesta));
    }

}
