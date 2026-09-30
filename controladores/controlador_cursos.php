<?php

require_once("./modelos/Cursos.php");
require_once("./modelos/Profesores.php");

class ControladorCursos {

    public function inicio()
    {
        $conexion = BD::crearInstancia();

        $sql = "SELECT cursos.id, cursos.nombre_curso, cursos.creditos, cursos.id_profesor, 
                       CONCAT(profesores.nombres, ' ', profesores.apellidos) AS nombre_profesor 
                FROM cursos 
                INNER JOIN profesores ON cursos.id_profesor = profesores.id";

        $parametros = [];
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente") {
            $sql .= " WHERE cursos.id_profesor = ?";
            $parametros[] = $_SESSION["idProfesor"] ?? 0;
        }
        $sql .= " ORDER BY cursos.nombre_curso";

        $consulta = $conexion->prepare($sql);
        $consulta->execute($parametros);

        $listaCursos = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $listaCursos[] = new Cursos(
                $fila["id"], 
                $fila["nombre_curso"], 
                $fila["creditos"], 
                $fila["id_profesor"], 
                $fila["nombre_profesor"]
            );
        }

        require_once("./vistas/cursos/inicio.php");
    }

    public function verAlumnos()
    {
        $idCurso = $_GET["id"] ?? 0;
        $conexion = BD::crearInstancia();

        $consultaCurso = $conexion->prepare("SELECT id, nombre_curso, creditos, id_profesor FROM cursos WHERE id = ?");
        $consultaCurso->execute([$idCurso]);
        $curso = $consultaCurso->fetch(PDO::FETCH_ASSOC);

        if (!$curso) {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit;
        }

        // Bloqueo de seguridad: No permite ver alumnos de cursos ajenos si es docente
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente" && $curso["id_profesor"] != ($_SESSION["idProfesor"] ?? 0)) {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit;
        }

        $consulta = $conexion->prepare(
            "SELECT dm.id AS id_detalle, e.id AS id_estudiante, e.nombres, e.apellidos, e.email,
                    rn.id AS id_registro_notas, rn.promedio_final, rn.estado AS estado_nota
             FROM detalle_matricula dm 
             JOIN matricula m ON dm.id_matricula = m.id 
             JOIN estudiantes e ON m.id_estudiante = e.id 
             LEFT JOIN registro_notas rn ON (rn.id_estudiante = e.id AND rn.id_curso = dm.id_curso)
             WHERE dm.id_curso = ?
             ORDER BY e.apellidos ASC"
        );
        $consulta->execute([$idCurso]);
        $listaAlumnos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        require_once("./vistas/cursos/ver_alumnos.php");
    }

    public function crear()
    {
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente") {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit;
        }

        $conexion = BD::crearInstancia();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $consulta = $conexion->prepare("INSERT INTO cursos (nombre_curso, creditos, id_profesor) VALUES (?, ?, ?)");
            $consulta->execute([$_POST["nombre_curso"], $_POST["creditos"], $_POST["id_profesor"]]);

            header("Location: ./?controlador=cursos&accion=inicio");
        } else {
            $consultaProfesores = $conexion->prepare("SELECT * FROM profesores ORDER BY apellidos");
            $consultaProfesores->execute();
            $listaProfesores = [];
            while ($fila = $consultaProfesores->fetch(PDO::FETCH_ASSOC)) {
                $listaProfesores[] = new Profesores($fila["id"], $fila["nombres"], $fila["apellidos"], $fila["especialidad"]);
            }

            require_once("./vistas/cursos/crear.php");
        }
    }

    public function editar()
    {
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente") {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit;
        }

        $conexion = BD::crearInstancia();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $consulta = $conexion->prepare("UPDATE cursos SET nombre_curso=?, creditos=?, id_profesor=? WHERE id=?");
            $consulta->execute([$_POST["nombre_curso"], $_POST["creditos"], $_POST["id_profesor"], $_POST["id"]]);

            header("Location: ./?controlador=cursos&accion=inicio");
        } else {
            $consulta = $conexion->prepare("SELECT * FROM cursos WHERE id=?");
            $consulta->execute([$_GET["id"]]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);
            $curso = new Cursos($fila["id"], $fila["nombre_curso"], $fila["creditos"], $fila["id_profesor"]);

            $consultaProfesores = $conexion->prepare("SELECT * FROM profesores ORDER BY apellidos");
            $consultaProfesores->execute();
            $listaProfesores = [];
            while ($filaProf = $consultaProfesores->fetch(PDO::FETCH_ASSOC)) {
                $listaProfesores[] = new Profesores($filaProf["id"], $filaProf["nombres"], $filaProf["apellidos"], $filaProf["especialidad"]);
            }

            require_once("./vistas/cursos/editar.php");
        }
    }

    public function eliminar()
    {
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente") {
            header("Location: ./?controlador=cursos&accion=inicio");
            exit;
        }

        $conexion = BD::crearInstancia();

        try {
            $consulta = $conexion->prepare("DELETE FROM cursos WHERE id=?");
            $consulta->execute([$_GET["id"]]);
        } catch (PDOException $e) {
  
        }

        header("Location: ./?controlador=cursos&accion=inicio");
    }
}