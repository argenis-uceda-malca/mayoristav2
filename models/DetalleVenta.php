<?php

namespace Model;

class DetalleVenta extends ActiveRecord {
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'ventaId', 'id_producto', 'total','cantidad', 'id_usuario'];

    public $id;
    public $ventaId;
    public $id_producto;
    public $total;
    public $cantidad;
    public $id_usuario;

    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->ventaId = $args['ventaId'] ?? '';
       $this->id_producto = $args['id_producto'] ?? '';
       $this->total = $args['total'] ?? ''; 
       $this->cantidad = $args['cantidad'] ?? ''; 
       $this->id_usuario = $args['id_usuario'] ?? ''; 
    }
}