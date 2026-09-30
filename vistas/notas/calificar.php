<div class="row justify-content-center my-4">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold">Registro de Calificación</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3 pb-3 border-bottom">
                    <p class="mb-1"><strong>Estudiante:</strong> <?php echo htmlspecialchars($contexto["nombres"] . " " . $contexto["apellidos"]); ?></p>
                    <p class="mb-1"><strong>Correo:</strong> <?php echo htmlspecialchars($contexto["email"] ?? "Sin email"); ?></p>
                    <p class="mb-0"><strong>Curso:</strong> <?php echo htmlspecialchars($contexto["nombre_curso"]); ?></p>
                </div>

                <form method="POST" action="?controlador=notas&accion=guardar">
                    <input type="hidden" name="id_detalle" value="<?php echo $contexto["id_detalle"]; ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Promedio Final (Escala 0 a 20):</label>
                        <input type="number" step="0.01" min="0" max="20" name="promedio_final" 
                               class="form-control form-control-lg text-center fw-bold"
                               value="<?php echo htmlspecialchars($contexto["promedio_final"] ?? "11.00"); ?>" required autofocus>
                        <div class="form-text">Notas mayores o iguales a 11 se consideran <strong>Aprobado</strong>.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1 py-2 fw-semibold">
                            Guardar Nota
                        </button>
                        <a href="?controlador=cursos&accion=verAlumnos&id=<?php echo $contexto['id_curso']; ?>" class="btn btn-outline-secondary py-2">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>