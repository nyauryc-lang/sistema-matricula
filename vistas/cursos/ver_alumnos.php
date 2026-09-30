<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1">Alumnos Matriculados</h2>
            <p class="text-muted mb-0">
                Curso: <strong><?php echo htmlspecialchars($curso["nombre_curso"]); ?></strong> 
                (Créditos: <?php echo $curso["creditos"]; ?>)
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="?controlador=reportes&accion=actaExcel&idCurso=<?php echo $curso['id']; ?>" class="btn btn-success btn-sm">
                Descargar Acta Excel
            </a>
            <a href="?controlador=cursos&accion=inicio" class="btn btn-secondary btn-sm">
                Volver a Cursos
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Estudiantes inscritos en este curso</h5>
            <span class="badge bg-primary"><?php echo count($listaAlumnos); ?> Alumnos</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;" class="text-center">#</th>
                            <th>Estudiante</th>
                            <th>Email de Contacto</th>
                            <th class="text-center">Promedio Final</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($listaAlumnos)): ?>
                        <?php 
                        $i = 1;
                        foreach ($listaAlumnos as $alumno): ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="fw-semibold">
                                    <?php echo htmlspecialchars($alumno["apellidos"] . ", " . $alumno["nombres"]); ?>
                                </td>
                                <td>
                                    <code><?php echo htmlspecialchars($alumno["email"] ?? "Sin email"); ?></code>
                                </td>
                                <td class="text-center fw-bold fs-6">
                                    <?php if ($alumno["promedio_final"] !== null): ?>
                                        <?php echo htmlspecialchars($alumno["promedio_final"]); ?>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Sin calificar</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($alumno["estado_nota"]): ?>
                                        <?php if (strtolower($alumno["estado_nota"]) === 'aprobado'): ?>
                                            <span class="badge bg-success">Aprobado</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Desaprobado</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pendiente</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="?controlador=notas&accion=calificar&id_detalle=<?php echo $alumno['id_detalle']; ?>" 
                                           class="btn btn-primary" title="Registrar o editar nota">
                                            Calificar
                                        </a>

                                        <?php if (!empty($alumno['id_registro_notas'])): ?>
                                            <a href="?controlador=reportes&accion=enviarNotificacion&idRegistroNotas=<?php echo $alumno['id_registro_notas']; ?>" 
                                               class="btn btn-warning" 
                                               onclick="return confirm('¿Enviar notificación por correo a <?php echo htmlspecialchars($alumno['nombres']); ?>?');"
                                               title="Enviar correo con la nota final">
                                                Avisar por correo
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No hay estudiantes matriculados en esta asignatura actualmente.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>