<?php

namespace Model;

class Cita extends ActiveRecord{
    public static $tabla = 'citas';
    public static $columnasDB = ['cita_paciente', 'cita_medico', 'cita_fecha', 'cita_hora', 'cita_referencia','cita_situacion' ];
    public static $idTabla = 'cita_id';

    public $cita_id;
    public $cita_paciente;
    public $cita_medico;
    public $cita_fecha;
    public $cita_hora;
    public $cita_referencia;
    public $cita_situacion;

    public function __construct($args =[])  
    {
        $this->cita_id = $args['cita_id'] ?? null;
        $this->cita_paciente = $args['cita_paciente'] ?? '';
        $this->cita_medico = $args['cita_medico'] ?? '';
        $this->cita_fecha = $args['cita_fecha'] ?? '';
        $this->cita_hora = $args['cita_hora'] ?? '';
        $this->cita_referencia = $args['cita_referencia'] ?? '';
        $this->cita_situacion = $args['cita_situacion'] ?? 1;
    }

}