<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold text-primary mb-1">Módulo de Reportería Institucional</h2>
            <p class="text-muted mb-0">Generación de constancias oficiales (PDF), actas académicas (Excel) y notificaciones automáticas por correo.</p>
        </div>
        <div>
            <span class="badge bg-primary px-3 py-2 fs-6">IEST La Recoleta</span>
        </div>
    </div>

    <!-- Tarjetas de Acceso a Reportes -->
    <div class="row g-4 mb-5">
        <!-- 1. Constancia en PDF -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-danger">
                <div class="card-body d-flex flex-column text-center p-4">
                    <div class="mb-3">
                        <span class="badge bg-danger-subtle text-danger p-3 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                              <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.143.244-.427.721-.698 1.488-.813.547-.082 1.282-.09 2.181-.027.614-.707 1.15-1.574 1.579-2.565-.246-.865-.38-1.748-.403-2.613-.016-.628.163-1.07.494-1.287.31-.203.682-.19 1.01.036.375.257.518.72.394 1.272-.127.564-.47 1.258-.98 2.016.48.91 1.077 1.638 1.764 2.156.684.516 1.458.784 2.298.784.62 0 1.096-.2 1.393-.585.3-.39.362-.916.182-1.545a1.8 1.8 0 0 0-.256-.516c-.08-.109-.168-.198-.266-.27l.142-.257c.228.093.447.218.647.375.409.324.629.742.646 1.233.018.497-.168.995-.55 1.472-.423.528-1.037.808-1.803.821-.994.016-1.936-.31-2.775-.957a16.6 16.6 0 0 1-1.89-1.814 14.1 14.1 0 0 1-1.637 2.47c-.502.593-1.04 1.066-1.59 1.401a4.9 4.9 0 0 1-1.038.455.77.77 0 0 1-.36.05z"/>
                            </svg>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold">Constancia de Matrícula (PDF)</h5>
                    <p class="card-text text-muted flex-grow-1">Generación de constancias oficiales de matrícula en formato PDF (Dompdf) con créditos y detalle de asignaturas.</p>
                    <a href="?controlador=matricula&accion=inicio" class="btn btn-outline-danger w-100">
                        Ver Matrículas y Descargar
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. Acta de Notas en Excel -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="card-body d-flex flex-column text-center p-4">
                    <div class="mb-3">
                        <span class="badge bg-success-subtle text-success p-3 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                              <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.748l2.116 2.572a.5.5 0 0 0 .768-.64L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.252 5.884 6.68z"/>
                              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold">Acta de Notas (Excel)</h5>
                    <p class="card-text text-muted flex-grow-1">Exportación de actas completas en hojas de cálculo `.xlsx` (PhpSpreadsheet) con listas de alumnos, promedios y estado.</p>
                    <a href="?controlador=cursos&accion=inicio" class="btn btn-outline-success w-100">
                        Ver Cursos y Exportar
                    </a>
                </div>
            </div>
        </div>

        <!-- 3. Notificación de Nota Final -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 border-top border-4 border-warning">
                <div class="card-body d-flex flex-column text-center p-4">
                    <div class="mb-3">
                        <span class="badge bg-warning-subtle text-warning p-3 rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                              <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l1.326-.795 5.64 3.47A1 1 0 0 1 14 13h-1.5a.5.5 0 0 0 0 1H14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2.238-6.528 3.891a.5.5 0 0 1-.472 0L1.5 4.238V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.238z"/>
                              <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.01-.14 1.2-.236l.22.846c-.22.106-.704.28-1.42.28-2.48 0-4.14-1.58-4.14-4.47v-.214C8.262 9.53 10.15 8 12.519 8h.044c2.617 0 4.29 1.83 4.29 4.398v.214c0 1.523-.846 2.75-2.274 2.75-.805 0-1.428-.43-1.637-.992l-.08.066c-.463.38-1.077.626-1.84.626-1.503 0-2.522-1.04-2.522-2.607 0-1.684 1.134-2.784 2.825-2.784.802 0 1.41.282 1.767.625l.08-.066v-.41c0-.825-.56-1.308-1.436-1.308-.667 0-1.233.26-1.59.578l-.348-.795c.535-.453 1.343-.8 2.274-.8 1.624 0 2.656.96 2.656 2.53v3.743c0 .54.195.845.548.845.454 0 .867-.384.867-1.196v-.214zM12.16 11.23c-1.01 0-1.652.686-1.652 1.657 0 .97.642 1.657 1.652 1.657 1.01 0 1.652-.686 1.652-1.657 0-.97-.642-1.657-1.652-1.657z"/>
                            </svg>
                        </span>
                    </div>
                    <h5 class="card-title fw-bold">Notificación por Correo</h5>
                    <p class="card-text text-muted flex-grow-1">Envío automatizado de notas a los correos electrónicos registrados de los estudiantes usando PHPMailer.</p>
                    <a href="#seccion-notas" class="btn btn-outline-warning w-100">
                        Ver Registros de Notas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Generador Rápido de Reportes -->
    <div class="row g-4 mb-5">
        <!-- Selector rápido de Constancia PDF -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold">Descarga Rápida de Constancia (PDF)</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($matriculas)): ?>
                        <p class="text-muted small">Selecciona una matrícula para generar su documento en PDF:</p>
                        <form method="GET" action="index.php" target="_blank" class="row g-2">
                            <input type="hidden" name="controlador" value="reportes">
                            <input type="hidden" name="accion" value="constanciaPdf">
                            <div class="col-8">
                                <select name="id" class="form-select" required>
                                    <option value="">-- Seleccionar Matrícula --</option>
                                    <?php foreach ($matriculas as $mat): ?>
                                        <option value="<?= $mat['id'] ?>">
                                            MAT-<?= str_pad($mat['id'], 4, '0', STR_PAD_LEFT) ?> - <?= htmlspecialchars($mat['estudiante']) ?> (<?= $mat['fecha_matricula'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-danger w-100">
                                    Generar PDF
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">No hay matrículas registradas aún.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Selector rápido de Acta Excel -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold">Exportación Rápida de Acta (Excel)</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($cursos)): ?>
                        <p class="text-muted small">Selecciona una asignatura para descargar el acta en `.xlsx`:</p>
                        <form method="GET" action="index.php" class="row g-2">
                            <input type="hidden" name="controlador" value="reportes">
                            <input type="hidden" name="accion" value="actaExcel">
                            <div class="col-8">
                                <select name="idCurso" class="form-select" required>
                                    <option value="">-- Seleccionar Asignatura --</option>
                                    <?php foreach ($cursos as $c): ?>
                                        <option value="<?= $c['id'] ?>">
                                            <?= htmlspecialchars($c['nombre_curso']) ?> (Docente: <?= htmlspecialchars($c['profesor'] ?? 'Sin asignar') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-success w-100">
                                    Descargar Excel
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">No hay cursos registrados aún.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Notificaciones de Notas por Correo -->
    <div class="card shadow-sm border-0" id="seccion-notas">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Notificación de Calificaciones a Estudiantes (PHPMailer)</h5>
            <span class="badge bg-secondary"><?= count($notas) ?> Registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Email de Contacto</th>
                            <th>Curso / Asignatura</th>
                            <th class="text-center">Promedio Final</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notas)): ?>
                            <?php foreach ($notas as $nota): ?>
                                <tr>
                                    <td><?= $nota['id'] ?></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($nota['estudiante']) ?></td>
                                    <td><code><?= htmlspecialchars($nota['email'] ?? 'Sin email') ?></code></td>
                                    <td><?= htmlspecialchars($nota['nombre_curso']) ?></td>
                                    <td class="text-center fw-bold fs-6">
                                        <?= htmlspecialchars($nota['promedio_final']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (strtolower($nota['estado']) === 'aprobado'): ?>
                                            <span class="badge bg-success">Aprobado</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Desaprobado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="?controlador=reportes&accion=enviarNotificacion&idRegistroNotas=<?= $nota['id'] ?>" 
                                           class="btn btn-sm btn-warning"
                                           onclick="return confirm('¿Enviar notificación por correo a <?= htmlspecialchars($nota['estudiante']) ?> (<?= htmlspecialchars($nota['email']) ?>)?');">
                                            Enviar Correo
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    No hay calificaciones registradas en la tabla <code>registro_notas</code>. Puedes importar los datos de prueba desde <code>sample_data.sql</code>.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>