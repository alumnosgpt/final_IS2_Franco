<?php

namespace Controllers;

use Exception;
use Model\Paciente;
use MVC\Router;

class PacienteController{
    public static function index(Router $router){
        $pacientes= Paciente::all();
        $router->render('pacientes/index', [
            'pacientes' => $pacientes,
        ]);

    }

    public static function guardarAPI(){
        try {
         
            $paciente = new Paciente($_POST);
        
            $resultado = $paciente->crear();

  

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

            
            $paciente = new Paciente($_POST);
      
            $resultado = $paciente->actualizar();
      

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

            $paciente_id = $_POST['paciente_id'];
            $paciente = Paciente::find($paciente_id);
            $paciente->paciente_situacion = 0;
            $resultado = $paciente->actualizar();

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

      
        $paciente_nombre = $_GET['paciente_nombre'];

        $sql = "SELECT * FROM pacientes where paciente_situacion = 1 ";
        if($paciente_nombre != '') {
            $sql.= " and paciente_nombre like '%$paciente_nombre%' ";
        }
        try {
            
            $pacientes= Paciente::fetchArray($sql);
    
            echo json_encode($pacientes);
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
