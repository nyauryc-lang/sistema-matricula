<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Nuevo Personal</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="?controlador=personal&accion=crear" enctype="multipart/form-data" id="formPersonal">
                <div class="mb-3">
                    <label class="form-label">Nombres y Apellidos *</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Ej. Juan Pérez" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" name="correo" class="form-control" placeholder="Ej. juan@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto de Perfil <small class="text-muted">(Opcional - Si no se sube, se asignará una por defecto)</small></label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Personal</button>
                    <a href="?controlador=personal&accion=inicio" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
