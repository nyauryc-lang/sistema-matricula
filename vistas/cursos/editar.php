<div class="container mt-5">
    <h2>Editar Curso</h2>
    <form method="POST" action="?controlador=cursos&accion=editar" id="formCurso">
        <input type="hidden" name="id" value="<?php echo $curso->getId(); ?>">
        
        <div class="mb-3">
            <label>Nombre del Curso</label>
            <input type="text" name="nombre_curso" class="form-control" 
                   value="<?php echo $curso->getNombreCurso(); ?>" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" min="1" 
                   value="<?php echo $curso->getCreditos(); ?>" required>
        </div>
        <div class="mb-3">
            <label>Profesor Asignado</label>
            <select name="id_profesor" class="form-select" required>
                <option value="">-- Selecciona un Profesor --</option>
                <?php foreach ($listaProfesores as $profesor) { ?>
                    <option value="<?php echo $profesor->getId(); ?>" 
                        <?php echo ($profesor->getId() == $curso->getIdProfesor()) ? 'selected' : ''; ?>>
                        <?php echo $profesor->getNombres() . ' ' . $profesor->getApellidos(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="?controlador=cursos&accion=inicio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
