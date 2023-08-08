<?php

namespace Controllers;

use Exception;
use Model\Medico;
use Model\Clinica;
use Model\Especialidad;
use Model\Paciente;
use MVC\Router;

class CitaController{
    public static function index(Router $router){
        $clinicas= Clinica::Fetcharray('SELECT * FROM clinicas where clinica_situacion = 1');
        $especialidades= Especialidad::Fetcharray('SELECT * FROM especialidades where espec_situacion = 1');
        $medicos= Medico::Fetcharray('SELECT * FROM medicos where medico_situacion = 1');
        $router->render('citas/index', [
            'clinicas' => $clinicas,
            'especialidades' => $especialidades,
            'medicos' => $medicos,

        ]);

    }

    public static function guardarAPI(){
        try {

 
         
            $cita = new Cita($_POST);
        
            $resultado = $cita->crear();

  

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
                exit;
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
            exit;
        }
    }

    public static function modificarAPI(){
        try {

            
            $cita = new Cita($_POST);
            $resultado = $cita->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
                exit;
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
                exit;
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI(){
        try {

            $cita_id = $_POST['cita_id'];
            $cita = Cita::find($cita_id);
            $cita->cita_medico = 0;
            $resultado = $cita->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
                exit;
                
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI(){



  
        $cita_fecha = $_GET['cita_fecha'];

        $sql = "SELECT * FROM citas inner join especialidades on cita_paciente = paciente_id inner join medicos on cita_medico = medico_id where cita_situacion = 1 ";
        if($cita_fecha != '') {
            $sql.= " and cita_fecha like '%$cita_fecha%' ";
        }
        try {
            
            $citas= Cita::fetchArray($sql);
    
            echo json_encode($citas);
            exit;
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
