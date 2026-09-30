<div class="table-responsive mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Gestión de Matrículas</h3>
        <a href="?controlador=matricula&accion=crear" class="btn btn-success">+ Nueva Matrícula</a>
    </div>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Estudiante</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cursos</th>
                <th scope="col">Total Créditos</th>
                <th scope="col">Estado</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php if (!empty($listaMatriculas)): ?>
            <?php foreach ($listaMatriculas as $matricula) { ?>
                <tr>
                    <td><?php echo $matricula->getId(); ?></td>
                    <td class="fw-semibold"><?php echo htmlspecialchars($matricula->getNombreEstudiante()); ?></td>
                    <td><?php echo htmlspecialchars($matricula->getFechaMatricula()); ?></td>
                    <td>
                        <?php echo htmlspecialchars(implode(", ", $matricula->getCursos())); ?>
                    </td>
                    <td class="text-center"><?php echo $matricula->getTotalCreditos(); ?></td>
                    <td>
                        <span class="badge bg-success"><?php echo strtoupper($matricula->getEstado()); ?></span>
                    </td>
                    <td class="text-center">
                        <a href="?controlador=reportes&accion=constanciaPdf&id=<?php echo $matricula->getId(); ?>"
                           class="btn btn-danger btn-sm" target="_blank" title="Descargar Constancia Oficial en PDF">
                           PDF Constancia
                        </a>
                        <a href="?controlador=matricula&accion=eliminar&id=<?php echo $matricula->getId(); ?>"
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas eliminar esta matrícula?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">No hay matrículas registradas.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>