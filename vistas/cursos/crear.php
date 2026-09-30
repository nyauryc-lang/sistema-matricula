<div class="container mt-5">
    <h2>Nuevo Curso</h2>
    <form method="POST" action="?controlador=cursos&accion=crear" id="formCurso">
        <div class="mb-3">
            <label>Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label>Profesor Asignado</label>
            <select name="id_profesor" class="form-select" required>
                <option value="">-- Selecciona un Profesor --</option>
                <?php foreach ($listaProfesores as $profesor) { ?>
                    <option value="<?php echo $profesor->getId(); ?>">
                        <?php echo $profesor->getNombres() . ' ' . $profesor->getApellidos(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="?controlador=cursos&accion=inicio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
