<?php

namespace Controllers;

use Model\AdminPagos;
use Classes\Email;
use Model\Usuario;
use Model\DetalleVentaForId;
use Model\Producto;
use Model\Marcas;
use MVC\Router;

class MarcaController
{
    public static function viewMarca(Router $router)
    {
        session_start();
        isAuth();

        $marcas = Marcas::all();
        //debuguear($marcas);
        $router->renderAdmin('home/viewMarcas', [
            'marcas' => $marcas
        ]);
    }

    public static function addEditarMarca(Router $router)
    {
        session_start();
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = new Marcas($_POST);
            
            $resultado = $marca->guardar();

            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                    'marca' => $marca,
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

    
}
