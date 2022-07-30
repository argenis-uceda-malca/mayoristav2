<?php

namespace Model;

class AdminPagos extends ActiveRecord {
    protected static $tabla = 'adminpagos';
    protected static $columnasDB = ['ventaId', 'cantidad', 'total', 'nombres','apellidos', 'dni', 'telefono', 'email', 'fecha','estado'];

    public $ventaId;
    public $cantidad;
    public $total;
    public $nombres;
    public $apellidos;
    public $dni;
    public $telefono;
    public $email;
    public $fecha;
    public $estado;

    public function __construct()
    {
        $this->ventaId = $args['ventaId'] ?? null;
        $this->cantidad = $args['cantidad'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }
}