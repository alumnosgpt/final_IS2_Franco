<?php

namespace Model;

class Medico extends ActiveRecord{
    public static $tabla = 'medicos';
    public static $columnasDB = ['medico_nombre', 'medico_espec', 'medico_clinica', 'medico_situacion' ];
    public static $idTabla = 'medico_id';

    public $medico_id;
    public $medico_nombre;
    public $medico_situacion;
    public $medico_espec;
    public $medico_clinica;

    public function __construct($args =[])
    {
        $this->medico_id = $args['medico_id'] ?? null;
        $this->medico_nombre = $args['medico_nombre'] ?? '';
        $this->medico_espec = $args['medico_espec'] ?? '';
        $this->medico_clinica = $args['medico_clinica'] ?? '';
        $this->medico_situacion = $args['medico_situacion'] ?? '1';
    }

}