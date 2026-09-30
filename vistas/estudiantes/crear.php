<div class="container mt-4" style="max-width: 650px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Nuevo Estudiante</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="?controlador=estudiantes&accion=crear" enctype="multipart/form-data" id="formEstudiante">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombres *</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" name="apellidos" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto de Perfil <small class="text-muted">(Opcional: Si no seleccionas, se asignará una por defecto)</small></label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Estudiante</button>
                    <a href="?controlador=estudiantes&accion=inicio" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
