<div class="table-responsive mt-5">
    <a href="?controlador=profesores&accion=crear" class="btn btn-success mb-3">+ Nuevo Profesor</a>
    <table class="table border">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($listaProfesores as $profesor) { ?>
                <tr>
                    <td><?php echo $profesor->getId(); ?></td>
                    <td><?php echo $profesor->getNombres(); ?></td>
                    <td><?php echo $profesor->getApellidos(); ?></td>
                    <td><?php echo $profesor->getEspecialidad(); ?></td>
                    <td>
                        <a href="?controlador=profesores&accion=editar&id=<?php echo $profesor->getId(); ?>"
                           class="btn btn-warning btn-sm">Editar</a>

                        <a href="?controlador=profesores&accion=eliminar&id=<?php echo $profesor->getId(); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Seguro que deseas eliminar a este profesor?');">
                           Eliminar</a>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
