<div class="container">
        <h1 class="text-center">Formulario de ingreso de Citas</h1>
        <div class="row justify-content-center">
            <form   class="col-lg-8 border bg-light p-3">
                <div class="row mb-3">
                    <div class="col">
                        <label for="cita_paciente">Nombre del paciente</label>
                        <select name="cita_paciente" id="cita_paciente" class="form-control">
                            <option value="">SELECCIONE...</option>
                            <?php foreach ($pacientes as $key => $paciente) : ?>
                                <option value="<?= $paciente['PACIENTE_ID'] ?>"><?= $paciente['PACIENTE_NOMBRE'] ?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cita_medico">Medico asignado</label>
                        <select name="cita_medico" id="cita_medico" class="form-control">
                            <option value="">SELECCIONE...</option>
                            <?php foreach ($medicos as $key => $medico) : ?>
                                <option value="<?= $medico['MEDICO_ID'] ?>"><?= $medico['MEDICO_NOMBRE'] ?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cita_fecha">Fecha de la cita</label>
                        <input type="date" value="<?= date('Y-m-d') ?>" name="cita_fecha" id="cita_fecha" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cita_hora">Horario</label>
                        <input type="time" value="<?= date('H:i') ?>" name="cita_hora" id="cita_hora" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cita_referencia">¿Tiene referencia? </label>
                        <select name="cita_referencia" id="cita_referencia" class="form-control">
                            <option value="si">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= asset('./build/js/citas/index.js')  ?>"></script>
</body>
</html>
