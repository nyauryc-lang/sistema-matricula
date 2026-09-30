<?php
// controladores/controlador_notas.php
require_once __DIR__ . "/../conexion.php";

class ControladorNotas {

    public function calificar() {
        $idDetalleMatricula = $_GET["id_detalle"] ?? 0;
        $conexion = BD::crearInstancia();

        $consultaContexto = $conexion->prepare(
            "SELECT dm.id AS id_detalle, dm.id_curso,
                    e.id AS id_estudiante, e.nombres, e.apellidos, e.email,
                    c.nombre_curso, c.id_profesor,
                    rn.id AS id_registro_notas, rn.promedio_final, rn.estado AS estado_nota
             FROM detalle_matricula dm 
             JOIN matricula m ON dm.id_matricula = m.id 
             JOIN estudiantes e ON m.id_estudiante = e.id 
             JOIN cursos c ON dm.id_curso = c.id 
             LEFT JOIN registro_notas rn ON (rn.id_estudiante = e.id AND rn.id_curso = c.id)
             WHERE dm.id = ?"
        );
        $consultaContexto->execute([$idDetalleMatricula]);
        $contexto = $consultaContexto->fetch(PDO::FETCH_ASSOC);

        if (!$contexto) {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit();
        }

        if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "docente") {
            if ($contexto["id_profesor"] != ($_SESSION["idProfesor"] ?? 0)) {
                header("Location: ./?controlador=cursos&accion=inicio");
                exit();
            }
        }

        require_once __DIR__ . "/../vistas/notas/calificar.php";
    }

    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit();
        }

        $idDetalleMatricula = $_POST["id_detalle"] ?? 0;
        $promedioFinal = floatval($_POST["promedio_final"] ?? 0);
        $conexion = BD::crearInstancia();

        $consultaContexto = $conexion->prepare(
            "SELECT dm.id_curso, e.id AS id_estudiante, c.id_profesor 
             FROM detalle_matricula dm 
             JOIN matricula m ON dm.id_matricula = m.id 
             JOIN estudiantes e ON m.id_estudiante = e.id 
             JOIN cursos c ON dm.id_curso = c.id 
             WHERE dm.id = ?"
        );
        $consultaContexto->execute([$idDetalleMatricula]);
        $contexto = $consultaContexto->fetch(PDO::FETCH_ASSOC);

        if (!$contexto) {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit();
        }

        if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "docente") {
            if ($contexto["id_profesor"] != ($_SESSION["idProfesor"] ?? 0)) {
                header("Location: ./?controlador=cursos&accion=inicio");
                exit();
            }
        }

        $idEstudiante = $contexto["id_estudiante"];
        $idCurso = $contexto["id_curso"];
        $estado = ($promedioFinal >= 11) ? "aprobado" : "desaprobado";

        // Verificar si ya existe registro en registro_notas
        $check = $conexion->prepare("SELECT id FROM registro_notas WHERE id_estudiante = ? AND id_curso = ?");
        $check->execute([$idEstudiante, $idCurso]);
        $idRegistro = $check->fetchColumn();

        if ($idRegistro) {
            $stmt = $conexion->prepare("UPDATE registro_notas SET promedio_final = ?, estado = ? WHERE id = ?");
            $stmt->execute([$promedioFinal, $estado, $idRegistro]);
        } else {
            $stmt = $conexion->prepare("INSERT INTO registro_notas (id_estudiante, id_curso, promedio_final, estado) VALUES (?, ?, ?, ?)");
            $stmt->execute([$idEstudiante, $idCurso, $promedioFinal, $estado]);
        }

        header("Location: ./?controlador=cursos&accion=verAlumnos&id=" . $idCurso);
        exit();
    }
}