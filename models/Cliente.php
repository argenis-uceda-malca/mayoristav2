<?php

namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombres', 'apellidos', 'dni','email', 'telefono'];

    public $id;
    public $nombres;
    public $apellidos;
    public $dni;
    public $email;
    public $telefono;

    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->nombres = $args['nombres'] ?? '';
       $this->apellidos = $args['apellidos'] ?? '';
       $this->dni = $args['dni'] ?? ''; 
       $this->email = $args['email'] ?? ''; 
       $this->telefono = $args['telefono'] ?? ''; 
    }
}