<div class="table-responsive mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Estudiantes</h2>
        <a href="?controlador=estudiantes&accion=crear" class="btn btn-success">+ Nuevo Estudiante</a>
    </div>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 80px; text-align: center;">Foto</th>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th style="width: 170px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($listaEstudiantes)) { ?>
            <?php foreach ($listaEstudiantes as $estudiante) { ?>
                <tr>
                    <td class="text-center">
                        <?php 
                            $foto = $estudiante->getFoto() ? $estudiante->getFoto() : "default.png";
                            $ruta = "./uploads/" . $foto;
                            if (!file_exists($ruta)) {
                                $ruta = "./uploads/default.png";
                            }
                        ?>
                        <img src="<?php echo $ruta; ?>" alt="Foto" width="50" height="50" class="rounded-circle border" style="object-fit: cover;">
                    </td>
                    <td><?php echo $estudiante->getId(); ?></td>
                    <td><strong><?php echo htmlspecialchars($estudiante->getNombres()); ?></strong></td>
                    <td><?php echo htmlspecialchars($estudiante->getApellidos()); ?></td>
                    <td><?php echo htmlspecialchars($estudiante->getDireccion()); ?></td>
                    <td><?php echo htmlspecialchars($estudiante->getTelefono()); ?></td>
                    <td><?php echo htmlspecialchars($estudiante->getEmail()); ?></td>
                    <td class="text-center">
                        <a href="?controlador=estudiantes&accion=editar&id=<?php echo $estudiante->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?controlador=estudiantes&accion=eliminar&id=<?php echo $estudiante->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar a este estudiante?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="8" class="text-center text-muted py-4">No hay estudiantes registrados.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
