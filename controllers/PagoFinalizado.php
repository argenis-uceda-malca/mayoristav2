<?php

namespace Controllers;

use MVC\Router;
use Model\Venta;
use Model\DetalleVenta;
use Model\Cliente;

use Illuminate\Support\Facedes\Http;

class PagoFinalizado
{
    public static function pagoFin(Router $router)
    {
        session_start();

        /*$payment_id = $_GET['payment_id'];
        $url = "https://api.mercadopago.com/v1/payments/$payment_id"."?access_token=APP_USR-7012405370879454-080700-344b63422b70931bd494dd5d580f3f04-1174727618";
        $datos = json_decode($url, true);

        debuguear($datos);*/
        
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if ($status == "approved") {
    
                if (isset($_SESSION['cliente']) and isset($_SESSION['venta'])) {
                    $arregloCliente = $_SESSION['cliente'];
                    for ($i = 0; $i < count($arregloCliente); $i++) {
                        $dni =  $arregloCliente[$i]['dni'];
    
                        $cliente = [
                            'nombres' => $arregloCliente[$i]['nombres'],
                            'apellidos' => $arregloCliente[$i]['apellidos'],
                            'dni' => $arregloCliente[$i]['dni'],
                            'email' => $arregloCliente[$i]['email'],
                            'telefono' => $arregloCliente[$i]['telefono'],
                        ];
                    }
    
                    $arregloVenta = $_SESSION['venta'];
                    for ($i = 0; $i < count($arregloVenta); $i++) {
                        $direccion =  $arregloVenta[$i]['direccion'];
                        $referencias =  $arregloVenta[$i]['referencias'];
                    }
    
                    $args = [
                        'dni' => $dni,
                        'direccion' => $direccion,
                        'referencias' => $referencias,
                    ];
    
    
                    $venta = new Venta($args);
                    $cliente = new Cliente($cliente);
    
                    //debuguear($cliente);
    
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
    
                    foreach ($_SESSION['carrito'] as $producto) {
                        $args = [
                            'ventaId' => $resultado['id'],
                            'id_producto' => $producto['id'],
                            'total' => $producto['precio'],
                            'cantidad' => $producto['cantidad'],
                            'id_usuario' => $id_usuario
                        ];
                        $detalleVenta = new DetalleVenta($args);
                        $detalleVenta->guardar();
                    }
    
                    //debuguear($detalleVenta);
    
                    $_SESSION = [];
                }
    
    
                $router->render('home/cart/pagoFin', [
                    'mensaje' => "Gracias por tu compra"
                ]);
            } else {
    
                $router->render('home/cart/pagoFin', [
                    'mensaje' => "Error al completar la Compra"
                ]);
            }
        }else{
            header('Location:/');
        }
        

    }
}
