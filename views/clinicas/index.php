<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinicas</title>
</head>
<body>
    <h1 class="text-center">Formulario de clínicas</h1>
    <div class="row justify-content-center mb-5">
        <form class="col-lg-8 border bg-light p-3" id="formularioClinica">
            <input type="hidden" name="clinica_id" id="clinica_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="clinica_nombre">Nombre de la clínica</label>
                    <input type="text" name="clinica_nombre" id="clinica_nombre" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <button type="submit" form="formularioClinica" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
            <h2>Listado de clínicas</h2>
            <table class="table table-bordered table-hover" id="tablaClinicas">
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
    <script src="<?= asset('./build/js/clinicas/index.js')  ?>"></script>
</body>
</html>
