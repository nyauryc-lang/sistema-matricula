<div class="container mt-5">
    <h2>Editar profesor</h2>
    <form method="POST" action="?controlador=profesores&accion=editar" id="formProfesor">
        <input type="hidden" name="id" value="<?php echo $profesor->getId(); ?>">
        <div class="mb-3">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control"
                   value="<?php echo $profesor->getNombres(); ?>">
        </div>
        <div class="mb-3">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control"
                   value="<?php echo $profesor->getApellidos(); ?>">
        </div>
        <div class="mb-3">
            <label>Especialidad</label>
            <input type="text" name="especialidad" class="form-control"
                   value="<?php echo $profesor->getEspecialidad(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="?controlador=profesores&accion=inicio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
document.getElementById("formProfesor").addEventListener("submit", function (e) {
    const nombres = document.querySelector("[name=nombres]").value.trim();
    const apellidos = document.querySelector("[name=apellidos]").value.trim();
    const especialidad = document.querySelector("[name=especialidad]").value.trim();

    if (nombres === "" || apellidos === "" || especialidad === "") {
        e.preventDefault();
        alert("Todos los campos son obligatorios.");
    }
});
</script>
