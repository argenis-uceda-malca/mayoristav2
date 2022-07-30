<?php

namespace Model;

class ResumenPedido extends ActiveRecord {
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['ventaId', 'id_producto', 'cantidad', 'total', 'id_usuario', 'producto', 'nombres', 'apellidos', 'dni','email', 'telefono'];

    public $ventaId;
    public $id_producto;
    public $cantidad;
    public $total;
    public $id_usuario;
    public $producto;
    public $nombres;
    public $apellidos;
    public $dni;
    public $email;
    public $telefono;


    public function __construct()
    {
        $this->ventaId = $args['ventaId'] ?? null;
        $this->id_producto = $args['id_producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
}