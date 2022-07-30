<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class ColaboradoresController
{

    public static function ViewColaboradores(Router $router)
    {
        session_start();
        isAuth();

        $colaboradores = Usuario::all();

        //debuguear($colaboradores);

        $router->renderAdmin('home/viewColaboradores',  [
            'colaboradores' => $colaboradores,

        ]);
    }

    public static function addEditarColaborador(Router $router)
    {
        session_start();
        isAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = Usuario::where('id', $_POST['id']);

            $colaborador = new Usuario($_POST);

            $usuario->nombre = null;
            $usuario->apellido = null;
            $usuario->email = null;
            $usuario->telefono = null;

            $usuario->nombre = $colaborador->nombre;
            $usuario->apellido = $colaborador->apellido;
            $usuario->email = $colaborador->email;
            $usuario->telefono = $colaborador->telefono;
            $usuario->admin = $colaborador->admin;

            //$usuario->hashPassword();

            $resultado = $usuario->guardar();
            if ($resultado) {
                $respuesta = array(
                    'resultado' => 'exito',
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

    public static function getInfoUser(Router $router)
    {
        session_start();
        isAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $auth = new Usuario($_POST);
            $usuario = Usuario::where('email', $auth->email);
        }
        die(json_encode($_POST));
    }

    public static function cuenta(Router $router)
    {
        $alertas = [];

        session_start();
        isAuth();

        $id = $_SESSION['id'];
        $usuario = Usuario::where('id', $id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
            $auth = new Usuario($_POST);

            if (empty($alertas)) {

                //$usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // Verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {

                        /*$consulta = "UPDATE usuarios SET ";
                        $consulta .= "nombre = '".$auth->nombre."', ";
                        $consulta .= "apellido = '".$auth->apellido."', ";
                        $consulta .= "admin = '".$usuario->admin."', ";
                        $consulta .= "email = '".$auth->email."', ";
                        $consulta .= "password = '".$auth->password."', ";
                        $consulta .= "telefono = '".$auth->telefono."', ";
                        $consulta .= "confirmado = '".$usuario->confirmado."', ";
                        $consulta .= "token = '".$usuario->token."' ";
                        $consulta .= "WHERE (id = '".$id."')";
                    */
                        $usuario->nombre = null;
                        $usuario->apellido = null;
                        $usuario->email = null;
                        $usuario->password = null;
                        $usuario->telefono = null;

                        $usuario->nombre = $auth->nombre;
                        $usuario->apellido = $auth->apellido;
                        $usuario->email = $auth->email;
                        $usuario->password = $_POST['newpassword'];
                        $usuario->telefono = $auth->telefono;
                        $usuario->hashPassword();

                        $arreglo = $usuario->guardar();

                        $respuesta = array(
                            'resultado' => 'exito'
                        );
                    } else {
                        $respuesta = array(
                            'resultado' => 'alerta'
                        );
                    }
                } else {
                    $respuesta = array(
                        'resultado' => 'error',
                        'post' => $_POST
                    );
                }
            }
            die(json_encode($respuesta));
        }

        $router->renderAdmin('home/cuenta',  [
            'arreglo' => $usuario
        ]);
    }
}
