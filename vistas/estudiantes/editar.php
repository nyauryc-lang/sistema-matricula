<div class="container mt-4" style="max-width: 650px;">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Estudiante</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="?controlador=estudiantes&accion=editar" enctype="multipart/form-data" id="formEstudianteEdit">
                <input type="hidden" name="id" value="<?php echo $estudiante->getId(); ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombres *</label>
                        <input type="text" name="nombres" class="form-control" value="<?php echo htmlspecialchars($estudiante->getNombres()); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($estudiante->getApellidos()); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($estudiante->getDireccion()); ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($estudiante->getTelefono()); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($estudiante->getEmail()); ?>">
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <label class="form-label d-block text-start">Foto Actual</label>
                    <?php 
                        $fotoActual = $estudiante->getFoto() ? $estudiante->getFoto() : "default.png";
                        $rutaActual = "./uploads/" . $fotoActual;
                        if (!file_exists($rutaActual)) {
                            $rutaActual = "./uploads/default.png";
                        }
                    ?>
                    <img src="<?php echo $rutaActual; ?>" alt="Foto actual" width="85" height="85" class="rounded-circle border mb-2" style="object-fit: cover;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Cambiar Foto <small class="text-muted">(Opcional)</small></label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">Actualizar Estudiante</button>
                    <a href="?controlador=estudiantes&accion=inicio" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
