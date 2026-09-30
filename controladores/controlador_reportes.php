<?php
// controladores/controlador_reportes.php
require_once __DIR__ . '/../modelos/Reporte.php';

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorReportes {
    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloReporte();
    }

    // Vista principal del módulo de Reportería
    public function inicio() {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'docente') {
            header('Location: index.php');
            exit;
        }

        $matriculas = $this->modelo->obtenerMatriculas();
        $cursos = $this->modelo->obtenerCursos();
        $notas = $this->modelo->obtenerTodasNotas();

        require_once __DIR__ . '/../vistas/reportes/inicio.php';
    }

    // 1. Constancia de Matrícula en PDF (Dompdf)
    public function constanciaPdf() {
        if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'admin') {
            die("Acceso no autorizado.");
        }

        $idMatricula = $_GET['id'] ?? $_GET['idMatricula'] ?? null;
        if (!$idMatricula) {
            die("ID de matrícula no especificado.");
        }

        $data = $this->modelo->obtenerConstanciaMatricula($idMatricula);

        if (!$data) {
            die("Matrícula no encontrada.");
        }

        // Limpiar cualquier búfer previo para evitar corrupción de PDF
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Captura del HTML de la plantilla
        ob_start();
        require __DIR__ . '/../vistas/reportes/constancia_pdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Constancia_Matricula_{$idMatricula}.pdf", ["Attachment" => true]);
        exit;
    }

    // 2. Acta de Notas por Curso en Excel (PhpSpreadsheet)
    public function actaExcel() {
        $idCurso = $_GET['idCurso'] ?? $_GET['id'] ?? null;
        if (!$idCurso) {
            die("ID de curso no especificado.");
        }

        $rol = $_SESSION['rol'] ?? '';

        // Validación de propiedad para docentes (si existe sesión)
        if ($rol === 'docente') {
            $idProfesorSesion = $_SESSION['id_profesor'] ?? 0;
            if (!$this->modelo->validarDocenteCurso($idCurso, $idProfesorSesion)) {
                die("Acceso denegado: No dictas este curso.");
            }
        }

        $curso = $this->modelo->obtenerCursoPorId($idCurso);
        $alumnos = $this->modelo->obtenerActaNotasCurso($idCurso);

        // Limpiar búfer previo
        if (ob_get_length()) {
            ob_end_clean();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Acta de Notas");

        $nombreCurso = $curso ? $curso['nombre_curso'] : "Curso_" . $idCurso;

        // Título institucional
        $sheet->setCellValue('A1', 'IEST LA RECOLETA - ACTA OFICIAL DE NOTAS');
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(13);

        $sheet->setCellValue('A2', 'Asignatura: ' . $nombreCurso);
        $sheet->mergeCells('A2:C2');
        $sheet->getStyle('A2')->getFont()->setItalic(true);

        // Encabezados
        $sheet->setCellValue('A4', 'Nombre Completo del Estudiante');
        $sheet->setCellValue('B4', 'Promedio Final');
        $sheet->setCellValue('C4', 'Estado');
        $sheet->getStyle('A4:C4')->getFont()->setBold(true);

        $row = 5;
        if (!empty($alumnos)) {
            foreach ($alumnos as $alumno) {
                $sheet->setCellValue('A' . $row, $alumno['estudiante']);
                $sheet->setCellValue('B' . $row, $alumno['promedio_final']);
                $sheet->setCellValue('C' . $row, ucfirst($alumno['estado']));
                $row++;
            }
        } else {
            $sheet->setCellValue('A5', 'No hay estudiantes o notas registradas para este curso.');
            $sheet->mergeCells('A5:C5');
        }

        // Autoajuste de columnas
        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $cleanCursoName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreCurso);
        $filename = "Acta_Notas_" . $cleanCursoName . ".xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // 3. Notificación por Correo (PHPMailer)
    public function enviarNotificacion() {
        $idRegistroNotas = $_GET['idRegistroNotas'] ?? $_GET['id'] ?? null;
        if (!$idRegistroNotas) {
            die("ID de registro de notas no especificado.");
        }

        $registro = $this->modelo->obtenerDatosNotificacionNota($idRegistroNotas);

        if (!$registro) {
            die("Registro de nota no encontrado.");
        }

        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'docente') {
            if (isset($_SESSION['id_profesor']) && $registro['id_profesor'] != $_SESSION['id_profesor']) {
                die("Acceso denegado: No eres el docente asignado a este curso.");
            }
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            // Configuración SMTP (Ajustar a Mailtrap o servidor deseado)
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tu_usuario_mailtrap';     // Reemplazar con credenciales
            $mail->Password   = 'tu_password_mailtrap';    // Reemplazar con credenciales
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;

            $mail->setFrom('no-reply@matriculasystem.edu.pe', 'Sistema de Matrícula');
            $mail->addAddress($registro['email'], $registro['nombres'] . ' ' . $registro['apellidos']);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Notificación de Nota Final - ' . $registro['nombre_curso'];
            $mail->Body    = "
                <h3>Estimado(a) " . htmlspecialchars($registro['nombres'] . ' ' . $registro['apellidos']) . ",</h3>
                <p>Se ha registrado su nota final para el curso <strong>" . htmlspecialchars($registro['nombre_curso']) . "</strong>:</p>
                <ul>
                    <li><strong>Promedio Final:</strong> " . htmlspecialchars($registro['promedio_final']) . "</li>
                    <li><strong>Estado:</strong> " . htmlspecialchars($registro['estado']) . "</li>
                </ul>
                <p>Saludos cordiales,<br>IEST La Recoleta</p>
            ";

            $mail->send();
            echo "<script>alert('Correo enviado con éxito a " . htmlspecialchars($registro['email']) . "'); window.history.back();</script>";
        } catch (Exception $e) {
            $errorMsg = addslashes($mail->ErrorInfo);
            echo "<script>alert('Error al enviar el correo: {$errorMsg}\\nVerifique sus credenciales SMTP en controlador_reportes.php'); window.history.back();</script>";
        }
        exit;
    }
}