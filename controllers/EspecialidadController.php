<?php

namespace Controllers;

use Exception;
use Model\Especialidad;
use MVC\Router;

class EspecialidadController{
    public static function index(Router $router){
        $especialidades= Especialidad::all();
        $router->render('especialidades/index', [
            'especialidades' => $especialidades,
        ]);

    }

    public static function guardarAPI(){
        try {
            $especialidad = new Especialidad($_POST);
            $resultado = $especialidad->crear();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
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

    public static function modificarAPI(){
        try {
            $especialidad = new Especialidad($_POST);
            $resultado = $especialidad->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
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
            $espec_id = $_POST['espec_id'];
            $especialidad = Especialidad::find($espec_id);
            $especialidad->espec_situacion = 0;
            $resultado = $especialidad->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
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
        $espec_nombre = $_GET['espec_nombre'];

        $sql = "SELECT * FROM especialidades where espec_situacion = 1 ";
        if($espec_nombre != '') {
            $sql.= " and espec_nombre like '%$espec_nombre%' ";
        }
        try {
            
            $especialidades= Especialidad::fetchArray($sql);
    
            echo json_encode($especialidades);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}