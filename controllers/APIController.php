<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use Model\Producto;

class APIController {
    public static function index() {
        //$servicios = Servicio::all();
        $produtos = Producto::all();
        
        //debuguear($produtos);
        echo json_encode($produtos);
        
    }

    public static function guardar() {
        
        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena la Cita y el Servicio

        // Almacena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }


}