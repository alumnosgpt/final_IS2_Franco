<?php

namespace Model;

class Paciente extends ActiveRecord{
    public static $tabla = 'pacientes';
    public static $columnasDB = ['paciente_nombre','paciente_dpi','paciente_telefono','paciente_situacion'];
    public static $idTabla = 'paciente_id';

    public $paciente_id;
    public $paciente_nombre;
    public $paciente_dpi;
    public $paciente_telefono;
    public $paciente_situacion;

    public function __construct($args =[])
    {
        $this->paciente_id = $args['paciente_id'] ?? null;
        $this->paciente_nombre = $args['paciente_nombre'] ?? '';
        $this->paciente_dpi = $args['paciente_dpi'] ?? '';
        $this->paciente_telefono = $args['paciente_telefono'] ?? '';
        $this->paciente_situacion = $args['paciente_situacion'] ?? '1';
    }

}