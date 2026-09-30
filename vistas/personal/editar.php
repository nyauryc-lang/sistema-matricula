<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Editar Personal</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="?controlador=personal&accion=editar" enctype="multipart/form-data" id="formPersonalEdit">
                <input type="hidden" name="id" value="<?php echo $personal->getId(); ?>">

                <div class="mb-3">
                    <label class="form-label">Nombres y Apellidos *</label>
                    <input type="text" name="nombres" class="form-control" value="<?php echo htmlspecialchars($personal->getNombres()); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($personal->getCorreo()); ?>" required>
                </div>

                <div class="mb-3 text-center">
                    <label class="form-label d-block text-start">Foto Actual</label>
                    <?php 
                        $fotoActual = $personal->getFoto() ? $personal->getFoto() : "default.png";
                        $rutaActual = "./uploads/" . $fotoActual;
                        if (!file_exists($rutaActual)) {
                            $rutaActual = "./uploads/default.png";
                        }
                    ?>
                    <img src="<?php echo $rutaActual; ?>" alt="Foto actual" width="90" height="90" class="rounded-circle border mb-2" style="object-fit: cover;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Cambiar Foto <small class="text-muted">(Opcional)</small></label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Actualizar Personal</button>
                    <a href="?controlador=personal&accion=inicio" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
