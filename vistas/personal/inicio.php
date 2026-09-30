<div class="table-responsive mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Personal</h2>
        <a href="?controlador=personal&accion=crear" class="btn btn-success">+ Nuevo Personal</a>
    </div>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 90px; text-align: center;">Foto</th>
                <th>ID</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th style="width: 180px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($listaPersonal)) { ?>
            <?php foreach ($listaPersonal as $p) { ?>
                <tr>
                    <td class="text-center">
                        <?php 
                            $fotoMostrar = $p->getFoto() ? $p->getFoto() : "default.png";
                            $rutaFoto = "./uploads/" . $fotoMostrar;
                            if (!file_exists($rutaFoto)) {
                                $rutaFoto = "./uploads/default.png";
                            }
                        ?>
                        <img src="<?php echo $rutaFoto; ?>" alt="Foto" width="55" height="55" class="rounded-circle border" style="object-fit: cover;">
                    </td>
                    <td><?php echo $p->getId(); ?></td>
                    <td><strong><?php echo htmlspecialchars($p->getNombres()); ?></strong></td>
                    <td><?php echo htmlspecialchars($p->getCorreo()); ?></td>
                    <td class="text-center">
                        <a href="?controlador=personal&accion=editar&id=<?php echo $p->getId(); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?controlador=personal&accion=eliminar&id=<?php echo $p->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este registro?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center text-muted py-4">No hay registros de personal. ¡Agrega el primero con el botón "+ Nuevo Personal"!</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
