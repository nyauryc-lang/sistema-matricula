<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar variables de entorno desde .env (credenciales de Supabase)
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($val));
        }
    }
}

// Autoload de Composer (Dompdf, PhpSpreadsheet, PHPMailer)
if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    require_once __DIR__ . "/vendor/autoload.php";
}

require_once("./conexion.php");


$controlador = $_GET["controlador"] ?? "paginas";
$accion = $_GET["accion"] ?? "inicio";

// Acciones binarias o de redirección directa que no deben emitir la plantilla HTML
$accionesDirectas = [
    'reportes' => ['constanciaPdf', 'actaExcel', 'enviarNotificacion'],
    'login'    => ['verificar', 'salir'],
    'notas'    => ['guardar']
];

if (isset($accionesDirectas[$controlador]) && in_array($accion, $accionesDirectas[$controlador])) {
    require_once("./ruteador.php");
    exit;
}

require_once("./vistas/template.php");