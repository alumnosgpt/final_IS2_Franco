<?php
namespace Model;

class Clinica extends ActiveRecord{
    public static $tabla = 'clinicas';
    public static $columnasDB = ['clinica_nombre','clinica_situacion'];
    public static $idTabla = 'clinica_id';

    public $clinica_id;
    public $clinica_nombre;
    public $clinica_situacion;

    public function __construct($args = [])
    {
        $this->clinica_id = $args['clinica_id'] ?? null;
        $this->clinica_nombre = $args['clinica_nombre'] ?? '';
        $this->clinica_situacion = $args['clinica_situacion'] ?? '1';
    }
}


