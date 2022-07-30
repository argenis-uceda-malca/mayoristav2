<?php

namespace Model;

class Venta extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'ventas';
    protected static $columnasDB = ['id', 'dni', 'fecha', 'estado'];

    public $id;
    public $dni;
    public $total;
    public $fecha;
    public $estado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->dni = $args['dni'] ?? '';
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->estado = $args['estado'] ?? null;
    }
}