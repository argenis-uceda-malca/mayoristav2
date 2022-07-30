<?php

namespace Model;

class DetalleVentaForId extends ActiveRecord {
    protected static $tabla = 'DetalleVentaForId';
    protected static $columnasDB = ['ventaId', 'nombre', 'categoria', 'precio','cantidad', 'total'];

    public $ventaId;
    public $nombre;
    public $categoria;
    public $precio;
    public $cantidad;
    public $total;


    public function __construct()
    {
        $this->ventaId = $args['ventaId'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->total = $args['total'] ?? '';
    }

    
}