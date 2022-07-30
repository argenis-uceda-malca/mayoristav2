<?php

namespace Controllers;

use Model\AdminPagos;
use Classes\Email;
use Classes\pdf;
use Model\Usuario;
use Model\DetalleVentaForId;
use Model\Producto;
use Model\Categorias;
use Model\Venta;
use MVC\Router;

use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;

class AdministradorController
{

    public static function home(Router $router)
    {
        session_start();
        isAuth();

        $arreglo = [];

        $consulta = "SELECT c.ventaId , sum(c.cantidad) as cantidad, SUM(c.total) as total, cli.nombres, cli.apellidos, cli.dni, cli.telefono, cli.email,v.fecha, v.estado ";
        $consulta .= "FROM ventas v ";
        $consulta .= "INNER JOIN carrito c ON v.id = c.ventaId ";
        $consulta .= "INNER JOIN clientes cli ON cli.id = c.id_usuario ";
        $consulta .= "INNER JOIN productos p ON p.id = c.id_producto ";
        $consulta .= "group by c.ventaId ";
        $consulta .= "ORDER BY ventaId desc ";
        //debuguear($consulta);

        $ventas = AdminPagos::SQL($consulta);

        //debuguear($ventas);

        $router->renderAdmin('home/index', [
            'ventas' => $ventas
        ]);
    }

    public static function login(Router $router)
    {
        $alertas = [];

        session_start();
        isLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);

            if (empty($alertas)) {

                $usuario = Usuario::where('email', $auth->email);
                //debuguear($usuario);
                if ($usuario) {
                    // Verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        //session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                        }
                        $respuesta = array(
                            'resultado' => 'exito',
                            'usuario' => $usuario->nombre
                        );
                    } else {
                        $respuesta = array(
                            'resultado' => 'error'
                        );
                    }
                } else {
                    $respuesta = array(
                        'resultado' => 'error'
                    );
                }
            }
            die(json_encode($respuesta));
        }

        $router->renderAdmin('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /login');
    }

    public static function getInfo()
    {
        session_start();
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //$auth = new DetalleVentaForId($_POST);
            $ventaId = $_POST['ventaId'];

            //debuguear($ventaId);
            //$detalle = $auth->getInfo($auth->ventaId);
            $consulta = "SELECT c.ventaId, p.nombre , cat.nombre as categoria, p.precio, c.cantidad, c.total ";
            $consulta .= "FROM ventas v ";
            $consulta .= "INNER JOIN carrito c ON v.id = c.ventaId ";
            $consulta .= "INNER JOIN productos p ON p.id = c.id_producto ";
            $consulta .= "INNER JOIN categorias cat ON cat.id = p.idcategoria ";
            $consulta .= "WHERE c.ventaId =  ${ventaId} ";

            $consulta2 = "SELECT c.ventaId , sum(c.cantidad) as cantidad, SUM(c.total) as total, cli.nombres, cli.apellidos, cli.dni, cli.telefono, cli.email ";
            $consulta2 .= "FROM ventas v ";
            $consulta2 .= "INNER JOIN carrito c ON v.id = c.ventaId ";
            $consulta2 .= "INNER JOIN clientes cli ON cli.id = c.id_usuario ";
            $consulta2 .= "INNER JOIN productos p ON p.id = c.id_producto ";
            $consulta2 .= "WHERE c.ventaId = ${ventaId} ";
            $consulta2 .= "group by c.ventaId ";

            $detalle = DetalleVentaForId::SQL($consulta);
            $ventas = AdminPagos::SQL($consulta2);

            if ($detalle) {
                $respuesta = array(
                    'detalle' => $detalle,
                    'ventas' => $ventas
                );
            }


            die(json_encode($respuesta));
        }
    }

    public static function report(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $inicio = $_POST['fechaInicio'];
            $fin = $_POST['fechafin'];

            //debuguear($_POST);

            $consulta = "SELECT c.ventaId , sum(c.cantidad) as cantidad, SUM(c.total) as total, cli.nombres, cli.apellidos, cli.dni, cli.telefono, cli.email, v.fecha ";
            $consulta .= "FROM ventas v ";
            $consulta .= "INNER JOIN carrito c ON v.id = c.ventaId ";
            $consulta .= "INNER JOIN clientes cli ON cli.id = c.id_usuario ";
            $consulta .= "INNER JOIN productos p ON p.id = c.id_producto ";
            $consulta .= "WHERE v.fecha between '" . $inicio . "' and '" . $fin . "' ";
            $consulta .= "group by c.ventaId ";
            $consulta .= "ORDER BY ventaId desc ";

            if (isset($_POST['excel'])) {

                header('Content-Type:text/csv; charset=latin1');
                header('Content-Disposition: attachment; filename="Reporte de Ventas.csv"');

                $salida = fopen('php://output', 'w');

                fputcsv($salida, array('ventaId', 'cantidad', 'total', 'nombres', 'apellidos', 'dni', 'telefono', 'email', 'fecha'));

                //aqui estaba la consulta

                $ventas = AdminPagos::SQL($consulta);

                foreach ($ventas as $venta) {
                    fputcsv($salida, array($venta->ventaId, $venta->cantidad, $venta->total, $venta->nombres, $venta->apellidos, $venta->dni, $venta->telefono, $venta->email, $venta->fecha));
                }
            }
            if (isset($_POST['pdf'])) {
                $ventas = AdminPagos::SQL($consulta);
                $gt = 0;
                $contenido =
                    '<!DOCTYPE html>
                    <html lang="en">
                    <head>
                      <meta charset="UTF-8">
                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Document</title>
                    </head>
                    <body>
                      <style>
                        h2{
                          font-family: Verdana, Geneva, Tahoma, sans-serif;
                          text-align: center;
                        }
                        table{
                          font-family: Arial, Helvetica, sans-serif;
                          border-collapse: collapse;
                          width: 100%;
                          margin-left: auto;
                          margin-right: auto;
                        }
                    
                        td,th{
                          border: 1px solid #444;
                          padding: 8px;
                          text-align: left;
                        }
                    
                        .my-table{
                          text-align: left;
                        }

                        .header{
                            text-align: center;
                          }
                    
                        #sing{
                          padding-top: 50px;
                          text-align: right;
                        }
                    
                      </style>
                    
                      <table>
                        <tr>
                            <th colspan="7" class="my-table header">Reporte de ventas del '.$inicio.' al '.$fin.'</th>
                        </tr>
                        <thead>
                          <tr>
                            <th>ID venta</th>
                            <th>DNI</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>';

                foreach ($ventas as $row) {
                    $contenido .= '<tr>
                            <td class="my-table">' . $row->ventaId . '</td>
                            <td class="my-table">' . $row->dni . '</td>
                            <td class="my-table">' . $row->apellidos . '</td>
                            <td class="my-table">' . $row->telefono . '</td>
                            <td class="my-table">' . $row->fecha . '</td>
                            <td class="my-table">' . $row->cantidad . '</td>
                            <td class="my-table">S/.' . $row->total . '</td>
                            </tr>';
                    $gt = $row->total + $gt;
                }

                $contenido .= '
                
                        </tbody>
                            <tr>
                                <th colspan="6" class="my-table">Gran Total</th>
                                <th >S/.' . $gt . '</th>
                            </tr>
                        </table>
                      </body>
                      </html>';



                // Nombre del pdf
                $filename = 'Reporte('.date('d-m-Y').').pdf';

                // Opciones para prevenir errores con carga de imágenes
                $options = new Options();
                $options->set('isRemoteEnabled', true);

                // Instancia de la clase
                $dompdf = new Dompdf($options);

                // Cargar el contenido HTML
                $dompdf->loadHtml($contenido);

                // Formato y tamaño del PDF
                $dompdf->setPaper('A4', 'portrait');

                // Renderizar HTML como PDF
                $dompdf->render();

                // Salida para descargar
                $dompdf->stream($filename, ['Attachment' => true]);
            }
        }
    }
    public static function updateEstado()
    {
        session_start();
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $consulta = Venta::where('id', $_POST['id']);
            $venta = new Venta($_POST);

            $consulta->estado = null;
            $consulta->estado = $venta->estado;

            $resultado = $consulta->guardar();

            $respuesta = array(
                'resultado' => 'exito',
                'consulta' => $consulta,
                'venta' => $venta,
                'resultado ' => $resultado

            );

            /*if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
                );
            } else {
                $respuesta = array(
                    'resultado' => 'error'
                );
            }*/
            die(json_encode($respuesta));
        }
    }
}
