<?php 

namespace Model;


class TopProducs extends ActiveRecord {

    protected static $tabla = 'topProducs';
    protected static $columnasDB = ['nombre', 'total', 'imagen', 'precio'];

    public $nombre;
    public $total;
    public $imagen;
    public $precio;


    public function __construct($args = [])
    {
        $this->nombre = $args['nombre'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->precio = $args['precio'] ?? '';

    }
}