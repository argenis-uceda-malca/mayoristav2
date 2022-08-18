<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\Venta;
use Model\DetalleVenta;
use Model\ResumenPedido;
use Model\Cliente;

class CartController
{
  public static function cart(Router $router)
  {
    session_start();


    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $consulta = "SELECT * FROM  productos WHERE id= $id";

      $productos = Producto::SQL($consulta);



      //Llenando la tabla de carrito de compras
      if (isset($_SESSION['carrito'])) {
        if (isset($_GET['id'])) {
          $arreglo = $_SESSION['carrito'];

          $encontro = false;
          $numero = 0;
          for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i]['id'] == $id) {
              $encontro = true;
              $numero = $i;
            }
          }
          if ($encontro == true) {
            //if($_SERVER['PHP_SELF'] != '/index.php/cart'){
            $arreglo[$numero]['cantidad'] = $arreglo[$numero]['cantidad'] + 1;
            $_SESSION['carrito'] = $arreglo;

            //debuguear($_SESSION);
            header('Location:/cart');
            //}

          } else {
            foreach ($productos as $key => $producto) {
              $nombre = $producto->nombre;
              $precio = $producto->precio;
              $idcategoria = $producto->idcategoria;
              $imagen = $producto->imagen;
              //echo $idcategoria;
            }

            $arregloNuevo = array(
              'id' => $_GET['id'],
              'nombre' => $nombre,
              'precio' => $precio,
              'idcategoria' => $idcategoria,
              'imagen' => $imagen,
              'cantidad' => 1
            );
            array_push($arreglo, $arregloNuevo);
            $_SESSION['carrito'] = $arreglo;
            //debuguear($arreglo);
            header('Location:/cart');
          }
        }
      } else {
        if (isset($_GET['id'])) {

          foreach ($productos as $key => $producto) {
            $nombre = $producto->nombre;
            $precio = $producto->precio;
            $idcategoria = $producto->idcategoria;
            $imagen = $producto->imagen;
          }

          $arreglo[] = array(
            'id' => $_GET['id'],
            'nombre' => $nombre,
            'precio' => $precio,
            'idcategoria' => $idcategoria,
            'imagen' => $imagen,
            'cantidad' => 1
          );

          $_SESSION['carrito'] = $arreglo;
          //debuguear($_SESSION);
          header('Location:/cart');
        }
      }

      $router->render('home/cart/cart', [
        'productos' => $productos
      ]);
    } else {
      $productos = [];
      $router->render('home/cart/cart', [
        'productos' => $productos
      ]);
    }
  }

  public static function eliminarCarrito(Router $router)
  {
    session_start();
    $arreglo = $_SESSION['carrito'];

    for ($i = 0; $i < count($arreglo); $i++) {
      if ($arreglo[$i]['id'] != $_POST['id']) {
        $arregloNuevo[] = array(
          'id' => $arreglo[$i]['id'],
          'nombre' => $arreglo[$i]['nombre'],
          'precio' => $arreglo[$i]['precio'],
          'idcategoria' => $arreglo[$i]['idcategoria'],
          'cantidad' => $arreglo[$i]['cantidad']
        );
      }
    }

    if (isset($arregloNuevo)) {
      $_SESSION['carrito'] = $arregloNuevo;
    } else {
      unset($_SESSION['carrito']);
    }
    //echo 'listo';
  }

  public static function actualizarCarrito(Router $router)
  {
    session_start();
    $arreglo = $_SESSION['carrito'];
    for ($i = 0; $i < count($arreglo); $i++) {
      if ($arreglo[$i]['id'] == $_POST['id']) {
        $arreglo[$i]['cantidad'] = $_POST['cantidad'];
        $_SESSION['carrito'] = $arreglo;
        break;
      }
    }
  }

  public static function checkout(Router $router)
  {
    session_start();

    if (!isset($_SESSION['carrito'])) {
      header('Location: /');
    }
    $arreglo = $_SESSION['carrito'];

    //debuguear($arreglo);

    $productos = [];
    $router->render('home/cart/checkout', [
      'arreglo' => $arreglo
    ]);
  }

  public static function guardar(Router $router)
  {
    session_start();
    //verificar campos vacios
    foreach($_POST as $value){
      if($value == ''){
        $respuesta = array(
          'resultado' => 'vacio',
        );
        die(json_encode($respuesta));
      }
    }

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = s($_POST['dni']);

    $venta = new Venta($_POST);
    $cliente = new Cliente($_POST);

    //debuguear($_POST);
    $resultado = $venta->guardar();

    //debuguear($resultado);
    $busqueda = Cliente::where('dni', $dni);

    if ($busqueda == NULL) {
      $respuesta = $cliente->guardar();
      $id_usuario = $respuesta['id'];
      //debuguear($resultado);
    } else {
      $id_usuario = ($busqueda->id);
    }

    $id = $resultado['id'];
    $idProductos = $_POST['idProdcuto'];
    $totalProducto = $_POST['totalProducto'];
    $cantidad = $_POST['cantidad'];

    $estado = 0;
    if(isset($_POST['estado'])){
      $estado = $_POST['estado'];
    }

    $i = 0;
    //Insert a la tabla DetalleVenta
    foreach ($idProductos as $idProducto) {
      $args = [
        'ventaId' => $id,
        'id_producto' => $idProducto,
        'total' => $totalProducto[$i],
        'cantidad' => $cantidad[$i],
        'id_usuario' => $id_usuario
      ];
      $i = $i + 1;
      $detalleVenta = new DetalleVenta($args);
      $detalleVenta->guardar();
      //debuguear($detalleVenta);
    }
    //echo ($resultado['resultado']);

    if ($resultado) {

      if ($estado == 1) {
        //header('Location: /');
        $_SESSION = [];
        $respuesta = array(
          'resultado' => 'contraentrega',
          'post' => $_POST
        );
      } else {
        //header('Location: /resumen?id=' . $id);
        $respuesta = array(
          'resultado' => 'resumen',
          'id' => $id
        );
      }
      die(json_encode($respuesta));
    }
  }

  public static function resumen(Router $router)
  {
    session_start();

    $id = $_GET['id'];

    $consulta = "SELECT c.ventaId , c.id_producto, c.cantidad, c.total, c.id_usuario, p.nombre as producto, cli.nombres, cli.apellidos, cli.dni, cli.email, cli.telefono , p.imagen ";
    $consulta .= "FROM ventas v ";
    $consulta .= "INNER JOIN carrito c ON v.id = c.ventaId ";
    $consulta .= "INNER JOIN clientes cli ON cli.id = c.id_usuario ";
    $consulta .= "INNER JOIN productos p ON p.id = c.id_producto ";
    $consulta .= "WHERE ventaId=" . $id;

    $ventas = ResumenPedido::SQL($consulta);

    //debuguear($ventas);
    $router->render('home/cart/miPedido', [
      'ventas' => $ventas
    ]);
  }

  public static function resumen2(Router $router){
    session_start();
    if(isset($_SESSION['carrito']) and isset($_SESSION['carrito'])){
      $ventas = $_SESSION['carrito'];

      //debuguear($ventas);
      //debuguear($_SESSION['cliente']);
      $cliente = $_SESSION['cliente'];
      $dni = $_GET['id'];
  
      $router->render('home/cart/miPedido2', [
        'ventas' => $ventas,
      ]);
    }else{
      header('Location:/');
    }
    
  }

  public static function confirmar(Router $router){
    session_start();
    //verificar campos vacios
    foreach($_POST as $value){
      if($value == ''){
        $respuesta = array(
          'resultado' => 'vacio',
        );
        die(json_encode($respuesta));
      }
    }
    if(isset($_POST['delivery'])){
      $delivery = $_POST['delivery'];
    }else{
      $delivery = 0;
    }
    //primero agregar al clientes y almacenarlo en una sessión 
    //segundo, enviar el id del cliente hacia el ajax a travez de "respuesta"

    $dni = s($_POST['dni']);

    $arreglo[] = array(
      'nombres' => s($_POST['nombres']),
      'apellidos' => s($_POST['apellidos']),
      'dni' => s($_POST['dni']),
      'email' => s($_POST['email']),
      'telefono' => s($_POST['telefono']),
    );
    $_SESSION['cliente'] = $arreglo;

    $arreglo2[]= array(
      'direccion'=>s($_POST['direccion']),
      'referencias'=>s($_POST['referencias']),
      'distrito'=>s($_POST['distrito']),
      'delivery'=>($delivery),
    );
    $_SESSION['venta'] = $arreglo2;

    $respuesta = array(
      'resultado' => 'resumen2',
      'id' => $dni,
      'busqueda' => $arreglo
    );
    die(json_encode($respuesta));
  }
}
