<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades</title>
</head>
<body>
    <h1 class="text-center">Formulario de especialidades</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioEspecialidad">
            <input type="hidden" name="especialidad_id" id="especialidad_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="especialidad_nombre">Nombre de la especialidad</label>
                    <input type="text" name="especialidad_nombre" id="especialidad_nombre" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="especialidad_situacion">Situación</label>
                    <select name="especialidad_situacion" id="especialidad_situacion" class="form-control">
                        <option value="1">Activa</option>
                        <option value="0">Inactiva</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioEspecialidad" id="btnGuardar" data-saludo= "hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center" id="divTabla">
        <div class="col-lg-8">
            <h2>Listado de especialidades</h2>
            <table class="table table-bordered table-hover" id="tablaEspecialidades">
                <thead class="table-dark">
                    <tr>
                        <th>NO. </th>
                        <th>NOMBRE</th>
                        <th>GUARDAR</th>
                        <th>MODIFICAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?= asset('./build/js/especialidades/index.js')  ?>"></script>
</body>
</html>