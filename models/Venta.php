<?php

namespace Model;

class Venta extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'ventas';
    protected static $columnasDB = ['id', 'dni', 'fecha', 'estado', 'direccion', 'referencias', 'delivery'];

    public $id;
    public $dni;
    public $total;
    public $fecha;
    public $estado;
    public $direccion;
    public $referencias;
    public $delivery;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->dni = $args['dni'] ?? '';
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->estado = $args['estado'] ?? '0';
        $this->direccion = $args['direccion'] ?? null;
        $this->referencias = $args['referencias'] ?? null;
        $this->delivery = $args['delivery'] ?? '0';
    }
}