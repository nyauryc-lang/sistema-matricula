<div class="table-responsive mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">Gestión de Cursos y Asignaturas</h3>
            <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente"): ?>
                <span class="badge bg-info text-dark">Mis Cursos Asignados</span>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin"): ?>
            <a href="?controlador=cursos&accion=crear" class="btn btn-success">+ Nuevo Curso</a>
        <?php endif; ?>
    </div>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del Curso</th>
                <th scope="col" class="text-center">Créditos</th>
                <th scope="col">Profesor Asignado</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php if (!empty($listaCursos)): ?>
            <?php foreach ($listaCursos as $curso) { ?>
                <tr>
                    <td><?php echo $curso->getId(); ?></td>
                    <td class="fw-semibold"><?php echo htmlspecialchars($curso->getNombreCurso()); ?></td>
                    <td class="text-center"><?php echo $curso->getCreditos(); ?></td>
                    <td><?php echo htmlspecialchars($curso->getNombreProfesor()); ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="?controlador=cursos&accion=verAlumnos&id=<?php echo $curso->getId(); ?>"
                               class="btn btn-info text-white" title="Ver alumnos inscritos en este curso">
                               Ver alumnos
                            </a>
                            <a href="?controlador=reportes&accion=actaExcel&idCurso=<?php echo $curso->getId(); ?>"
                               class="btn btn-success" title="Exportar Acta de Notas a Excel">
                               Acta Excel
                            </a>
                            <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin"): ?>
                                <a href="?controlador=cursos&accion=editar&id=<?php echo $curso->getId(); ?>"
                                   class="btn btn-warning">Editar</a>
                                <a href="?controlador=cursos&accion=eliminar&id=<?php echo $curso->getId(); ?>"
                                   class="btn btn-outline-danger"
                                   onclick="return confirm('¿Seguro que deseas eliminar este curso?');">
                                   Eliminar</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">
                    No hay cursos asignados o registrados actualmente.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>