<?php

namespace Controllers;

use Exception;
use Model\Medico;
use Model\Clinica;
use Model\Especialidad;
use MVC\Router;

class MedicoController{
    public static function index(Router $router){
        $clinicas= Clinica::Fetcharray('SELECT * FROM clinicas where clinica_situacion = 1');
        $especialidades= Especialidad::Fetcharray('SELECT * FROM especialidades where espec_situacion = 1');
        $router->render('medicos/index', [
            'clinicas' => $clinicas,
            'especialidades' => $especialidades
        ]);

    }

    public static function guardarAPI(){
        try {

 
         
            $medico = new Medico($_POST);
        
            $resultado = $medico->crear();

  

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

            
            $medico = new Medico($_POST);
            $resultado = $medico->actualizar();

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

            $medico_id = $_POST['medico_id'];
            $medico = Medico::find($medico_id);
            $medico->medico_situacion = 0;
            $resultado = $medico->actualizar();

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



  
        $medico_nombre = $_GET['medico_nombre'];

        $sql = "SELECT * FROM medicos inner join especialidades on medico_espec= espec_id inner join clinicas on medico_clinica = clinica_id where medico_situacion = 1 ";
        if($medico_nombre != '') {
            $sql.= " and medico_nombre like '%$medico_nombre%' ";
        }
        try {
            
            $medicos= Medico::fetchArray($sql);
    
            echo json_encode($medicos);
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
