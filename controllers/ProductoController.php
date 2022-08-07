<?php

namespace Controllers;

use Model\AdminPagos;
use Classes\Email;
use Model\Usuario;
use Model\DetalleVentaForId;
use Model\Producto;
use Model\Categorias;
use Model\Marcas;
use MVC\Router;

class ProductoController
{
    public static function viewProducto(Router $router)
    {
        session_start();
        isAuth();
        $arreglo = [];

        //$consulta = "SELECT p.id, p.nombre, p.precio, c.nombre as categoria ";
        $consulta = "SELECT p.id, p.nombre, p.precio, p.idcategoria, p.stock , p.idmarca ";
        $consulta .= "FROM productos p ";
        $consulta .= "INNER JOIN categorias c ON c.id = p.idcategoria ";
        $consulta .= "INNER JOIN marca m ON m.id = p.idmarca ";
        $consulta .= "ORDER BY p.id desc ";

        $arreglo = Producto::SQL($consulta);
        $categorias = Categorias::all();
        $marcas = Marcas::all();

        $router->renderAdmin('home/ViewProducto', [
            'arreglo' => $arreglo,
            'categorias' => $categorias,
            'marcas' => $marcas
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


            /*Archivo imagen*/
            $carpetaImagenes = '../public/build/img/imgProducto/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            //generar nombre unico
            $nombreImagen = md5( uniqid( rand(), true)).".jpg";
            
            move_uploaded_file($_FILES['archivo_imagen']['tmp_name'],  $carpetaImagenes . $nombreImagen); 
               
            $producto->setImagen($nombreImagen);

            /*Fin de archivo imagen*/

            
            $resultado = $producto->guardar();

            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                    'producto' => $producto,
                    'resultado2' => $resultado,
                    'post' => $_POST,
                    'infoImg' => $_FILES
                );
            } else {
                $respuesta = array(
                    'resultado' => 'error'
                );
            }
        }
        die(json_encode($respuesta, JSON_UNESCAPED_UNICODE));
    }

    public static function editarProducto()
    {
        session_start();
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
            $producto = new Producto($_POST);

            /*Archivo imagen*/
            $carpetaImagenes = '../public/build/img/imgProducto/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            //generar nombre unico
            $nombreImagen = md5( uniqid( rand(), true)).".jpg";
            
            move_uploaded_file($_FILES['archivo_imagen']['tmp_name'],  $carpetaImagenes . $nombreImagen); 
               
            $producto->setImagen($nombreImagen);

            /*Fin de archivo imagen*/

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
        die(json_encode($respuesta, JSON_UNESCAPED_UNICODE));
    }

    public static function eliminarProducto(){
        session_start();
        isAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $producto = Producto::find($id);
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
