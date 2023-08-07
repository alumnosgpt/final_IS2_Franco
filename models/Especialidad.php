<?php

namespace Model;

class Especialidad extends ActiveRecord{
    public static $tabla = 'especialidades';
    public static $columnasDB = ['espec_nombre','espec_situacion'];
    public static $idTabla = 'espec_id';

    public $espec_id;
    public $espec_nombre;
    public $espec_situacion;

    public function __construct($args =[])
    {
        $this->espec_id = $args['espec_id'] ?? null;
        $this->espec_nombre = $args['espec_nombre'] ?? '';
        $this->espec_situacion = $args['espec_situacion'] ?? '1';
    }

}