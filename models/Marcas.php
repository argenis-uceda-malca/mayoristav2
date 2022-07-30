<?php 

namespace Model;

class Marcas extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'marca';
    protected static $columnasDB = ['id', 'nombre','descripcion'];

    public $id;
    public $nombre;
    public $descripcion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';

    }
}