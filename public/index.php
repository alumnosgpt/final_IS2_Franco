<?php

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\EspecialidadController;
use Controllers\ClinicaController;
use Controllers\MedicoController;
use Controllers\PacienteController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/especialidades', [EspecialidadController::class,'index'] );
$router->post('/API/especialidades/guardar', [EspecialidadController::class,'guardarAPI'] );
$router->post('/API/especialidades/modificar', [EspecialidadController::class,'modificarAPI'] );
$router->post('/API/especialidades/eliminar', [EspecialidadController::class,'eliminarAPI'] );
$router->get('/API/especialidades/buscar', [EspecialidadController::class,'buscarAPI'] );

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador


// Agregamos las rutas y controladores para las clínicas
$router->get('/clinica', [ClinicaController::class,'index']);
$router->post('/API/clinica/guardar', [ClinicaController::class,'guardarAPI']);
$router->post('/API/clinica/modificar', [ClinicaController::class,'modificarAPI']);
$router->post('/API/clinica/eliminar', [ClinicaController::class,'eliminarAPI']);
$router->get('/API/clinica/buscar', [ClinicaController::class,'buscarAPI']);

// Agregamos las rutas y controladores para las Medicos
$router->get('/medicos', [MedicoController::class,'index']);
$router->post('/API/medicos/guardar', [MedicoController::class,'guardarAPI']);
$router->post('/API/medicos/modificar', [MedicoController::class,'modificarAPI']);
$router->post('/API/medicos/eliminar', [MedicoController::class,'eliminarAPI']);
$router->get('/API/medicos/buscar', [MedicoController::class,'buscarAPI']);

// Agregamos las rutas y controladores para las Pacientes
$router->get('/pacientes', [PacienteController::class,'index']);
$router->post('/API/pacientes/guardar', [PacienteController::class,'guardarAPI']);
$router->post('/API/pacientes/modificar', [PacienteController::class,'modificarAPI']);
$router->post('/API/pacientes/eliminar', [PacienteController::class,'eliminarAPI']);
$router->get('/API/pacientes/buscar', [PacienteController::class,'buscarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();