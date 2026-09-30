<div class="container mt-5">
    <h2>Nuevo profesor</h2>
    <form method="POST" action="?controlador=profesores&accion=crear" id="formProfesor">
        <div class="mb-3">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control">
        </div>
        <div class="mb-3">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control">
        </div>
        <div class="mb-3">
            <label>Especialidad</label>
            <input type="text" name="especialidad" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
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
