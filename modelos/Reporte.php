<?php
// modelos/Reporte.php
require_once __DIR__ . '/../conexion.php';

class ModeloReporte {
    private $db;

    public function __construct() {
        $this->db = BD::crearInstancia();
    }

    // 1. Obtener datos completos para la Constancia de Matrícula (PDF)
    public function obtenerConstanciaMatricula($idMatricula) {
        $stmt = $this->db->prepare("
            SELECT m.id, m.id AS id_matricula, m.fecha_matricula, m.fecha_matricula AS fechaMatricula,
                   m.estado, m.total_creditos, m.total_creditos AS totalCreditos,
                   e.nombres, e.apellidos, e.email
            FROM matricula m
            INNER JOIN estudiantes e ON m.id_estudiante = e.id
            WHERE m.id = :id
        ");
        $stmt->execute([':id' => $idMatricula]);
        $matricula = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$matricula) {
            return null;
        }

        $stmtCursos = $this->db->prepare("
            SELECT c.id, c.nombre_curso, c.creditos
            FROM detalle_matricula dm
            INNER JOIN cursos c ON dm.id_curso = c.id
            WHERE dm.id_matricula = :id
        ");
        $stmtCursos->execute([':id' => $idMatricula]);
        $matricula['cursos'] = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

        return $matricula;
    }

    // 2. Obtener lista de notas por curso para el Acta (Excel)
    public function obtenerActaNotasCurso($idCurso) {
        $stmt = $this->db->prepare("
            SELECT CONCAT(e.nombres, ' ', e.apellidos) AS estudiante,
                   rn.promedio_final,
                   rn.estado
            FROM registro_notas rn
            INNER JOIN estudiantes e ON rn.id_estudiante = e.id
            WHERE rn.id_curso = :idCurso
            ORDER BY e.apellidos ASC
        ");
        $stmt->execute([':idCurso' => $idCurso]);
        $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si aún no hay notas registradas, listar alumnos matriculados
        if (empty($notas)) {
            $stmtAlumnos = $this->db->prepare("
                SELECT CONCAT(e.nombres, ' ', e.apellidos) AS estudiante,
                       'Pendiente' AS promedio_final,
                       m.estado AS estado
                FROM detalle_matricula dm
                INNER JOIN matricula m ON dm.id_matricula = m.id
                INNER JOIN estudiantes e ON m.id_estudiante = e.id
                WHERE dm.id_curso = :idCurso
                ORDER BY e.apellidos ASC
            ");
            $stmtAlumnos->execute([':idCurso' => $idCurso]);
            return $stmtAlumnos->fetchAll(PDO::FETCH_ASSOC);
        }

        return $notas;
    }

    // Obtener datos de un curso por ID
    public function obtenerCursoPorId($idCurso) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE id = :id");
        $stmt->execute([':id' => $idCurso]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Validar si el curso pertenece al docente logueado
    public function validarDocenteCurso($idCurso, $idProfesor) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM cursos WHERE id = :idCurso AND id_profesor = :idProfesor
        ");
        $stmt->execute([':idCurso' => $idCurso, ':idProfesor' => $idProfesor]);
        return $stmt->fetchColumn() > 0;
    }

    // 3. Obtener registro individual para Notificación por Correo
    public function obtenerDatosNotificacionNota($idRegistroNotas) {
        $stmt = $this->db->prepare("
            SELECT rn.id, rn.id AS id_registro_notas, rn.promedio_final, rn.estado,
                   e.nombres, e.apellidos, e.email,
                   c.nombre_curso, c.id_profesor
            FROM registro_notas rn
            INNER JOIN estudiantes e ON rn.id_estudiante = e.id
            INNER JOIN cursos c ON rn.id_curso = c.id
            WHERE rn.id = :id
        ");
        $stmt->execute([':id' => $idRegistroNotas]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listado general de matrículas para el panel de reportería
    public function obtenerMatriculas() {
        $stmt = $this->db->prepare("
            SELECT m.id, m.fecha_matricula, m.total_creditos, m.estado,
                   CONCAT(e.nombres, ' ', e.apellidos) AS estudiante
            FROM matricula m
            INNER JOIN estudiantes e ON m.id_estudiante = e.id
            ORDER BY m.fecha_matricula DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listado general de cursos para el panel de reportería
    public function obtenerCursos() {
        $stmt = $this->db->prepare("
            SELECT c.id, c.nombre_curso, c.creditos,
                   CONCAT(p.nombres, ' ', p.apellidos) AS profesor
            FROM cursos c
            LEFT JOIN profesores p ON c.id_profesor = p.id
            ORDER BY c.nombre_curso ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listado general de notas para el panel de reportería
    public function obtenerTodasNotas() {
        try {
            $stmt = $this->db->prepare("
                SELECT rn.id, rn.promedio_final, rn.estado,
                       CONCAT(e.nombres, ' ', e.apellidos) AS estudiante,
                       e.email, c.nombre_curso
                FROM registro_notas rn
                INNER JOIN estudiantes e ON rn.id_estudiante = e.id
                INNER JOIN cursos c ON rn.id_curso = c.id
                ORDER BY c.nombre_curso, e.apellidos
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}