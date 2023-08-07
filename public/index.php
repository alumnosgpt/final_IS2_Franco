<?php

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\EspecialidadController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/especialidades', [EspecialidadController::class,'index'] );
$router->post('/API/especialidades/guardar', [EspecialidadController::class,'guardarAPI'] );
$router->post('/API/especialidades/modificar', [EspecialidadController::class,'modificarAPI'] );
$router->post('/API/especialidades/eliminar', [EspecialidadController::class,'eliminarAPI'] );
$router->get('/API/especialidades/buscar', [EspecialidadController::class,'buscarAPI'] );

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
